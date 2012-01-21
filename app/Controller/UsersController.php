<?php

App::import('Vendor', 'facebook/facebook');  

class UsersController extends AppController {
    public $name = 'Users';
    public $components = array('OauthConsumer');

    var $fb;  
      
    public function index() {
        $this->set('Users', $this->User->find('all'));
    }

    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('signup', 'login', 'twitter', 'twitter_callback'
                , 'facebook', 'facebook_callback');

        $this->fb = new Facebook(array(  
            'appId'  => Configure::Read('Facebook.appId'),  
            'secret' => Configure::Read('Facebook.secret'),  
            'cookie' => true,  
        ));  
    }

    public function signup() {
        if ($this->request->is('post')) {
            
            $this->User->create();
            $this->User->set($this->request->data);
            
            if ($this->User->save()) {
                $this->Session->setFlash(__('Your account has been created'));
                $this->Auth->login($this->request->data); // manually log in the user
                return $this->redirect($this->Auth->redirect()); // redirect
            } else {
                $this->Session->setFlash(__('Your newly created account could not be saved.'));
            }
        }
    }
    
    function login() {
        if(!empty($this->data)) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            else {
                $this->Session->setFlash(__('Email or password is incorrect',true));
            }
        }
    } 

    public function logout() {
        $logout_url = $this->Auth->logout();
        $this->Session->setFlash('Successfully logged out');

        // rewrite logout url for facebook users
        if ($this->Auth->user('type') == 2) {
            $params = array('next' => 'http://kazumax.kamiya.com' . $logout_url);

            $logout_url = $facebook->getLogoutUrl($params);
        }
        
        $this->redirect($logout_url);
    }       

    public function twitter() {
        $requestToken = $this->OauthConsumer->getRequestToken('Twitter', 
                'https://api.twitter.com/oauth/request_token', 
                'http://kazumax.kamiya.com/users/twitter_callback');
        $this->Session->write('twitter_request_token', $requestToken);
        $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' 
                . $requestToken->key);
    }

    public function twitter_callback() {
        $requestToken = $this->Session->read('twitter_request_token');
        $accessToken = $this->OauthConsumer->getAccessToken('Twitter', 
                'https://api.twitter.com/oauth/access_token', $requestToken);

        if (empty($accessToken)) {
            $this->Session->setFlash('Access Token invalid');
            $this->redirect('/');
        }
        
        // 認証ユーザ情報の取得
        $json = $this->OauthConsumer->get('Twitter', $accessToken->key, 
                $accessToken->secret, 
                'http://twitter.com/account/verify_credentials.json', array());
        $user = json_decode($json);

        if (!$this->User->find('first', array('conditions' 
            => array(
                'email' => $user->id . '@twitter'
                , 'type' => 1
                , 'deleted' => NULL
            )))) {
            // create new user
            $this->User->save(array('User' 
                => array(
                    'email' => $user->id . '@twitter'
                    , 'type' => 1
                    , 'name' => $user->name
                )), false);
            
            $this->Session->setFlash('Twitter user created');
        }
        else {
            $this->Session->setFlash('Returning Twitter user');
        }
        
        $this->Auth->login(array('email' => $user->id . '@twitter'
            , 'type' => 1, 'name' => $user->name));
        $this->redirect($this->Auth->redirect());
    }   

    public function facebook() {
        $this->log('facebook() called', LOG_DEBUG);
        
        $url = $this->fb->getLoginUrl(array('redirect_uri' => 
            'http://kazumax.kamiya.com/users/facebook_callback', 
            'req_perms' => 'email'));  
        $this->redirect($url);  
    }

    public function facebook_callback() {
        $this->log('facebook_callback() called', LOG_DEBUG);
        $uid = $this->fb->getUser();  
        if ($uid == 0) {
            $this->log('no facebook uid!', LOG_DEBUG);
            $this->Session->setFlash('Facebook login failed');
            $this->redirect('/');
        }
        
        $me = null;  
        try {  
            $me = $this->fb->api('/me');
            
            $access_token = $this->fb->getAccessToken();  
        } catch (FacebookApiException $e) {  
            error_log($e);  
        }
        
        $name = $me['first_name'] . ' ' . $me['last_name'];
        if (!$this->User->find('first', array('conditions' 
            => array(
                'email' => $me['id'] . '@facebook'
                , 'type' => 2
                , 'deleted' => NULL
            )))) {
            // create new user
            $this->User->save(array('User' 
                => array(
                    'email' => $me['id'] . '@facebook'
                    , 'type' => 2
                    , 'name' => $name,  
                )), false);
            
            $this->Session->setFlash('Facebook user created');
        }
        else {
            $this->Session->setFlash('Returning Facebook user');
        }
        
        $this->Auth->login(array('email' => $me['id'] . '@facebook',
                'name' => $name,  
                'type' => 2));
        
        $this->redirect($this->Auth->redirect());
    }
}

?>
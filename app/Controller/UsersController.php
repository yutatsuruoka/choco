<?php

App::import('Vendor', 'facebook/facebook');  

class UsersController extends AppController {
    public $name = 'Users';
    public $components = array('OauthConsumer');

    var $fb;  
      
    public function index() {
        $this->set('users', $this->User->find('all'));
    }
    
    public function view($id = null) {
    	$this->User->id = $id;
        $this->set('user', $this->User->read());
    }

    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('signup', 'login', 'twitter', 'twitter_callback'
                , 'facebook', 'facebook_callback', 'beg', 'beg_callback');

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
                return $this->login_success($this->request->data['email']);
            } else {
                $this->Session->setFlash(__('Your newly created account could not be saved.'));
            }
        }
    }
    
    function login() {
        if(!empty($this->data)) {
            if ($this->Auth->login()) {
                return $this->login_success($this->data['User']['email']);
            }
            else {
                $this->Session->setFlash(__('Email or password is incorrect',true));
            }
        }
    } 
    
    function login_success($user, $redirect = true) {
        $u =  $this->User->find('first', array(
            'conditions' => array('email' => $user->id . '@twitter')));
        $this->current_user = $u['User'];
        
        $this->Auth->login(array('id' => $this->current_user['id']
                , 'email' => $user->id . '@twitter'
                , 'type' => 1
                , 'name' => $user->name));

        
        if ($redirect) {
            return $this->redirect($this->Auth->redirect());
        }
    }

    public function logout() {
        $logout_url = $this->Auth->logout();
        $this->Session->setFlash('Successfully logged out');

        // rewrite logout url for facebook users
        if ($this->Auth->user('type') == 2) {
            $params = array('next' => $logout_url);

            $logout_url = $facebook->getLogoutUrl($params);
        }
        
        $this->redirect($logout_url);
    }       

    public function beg() {
        $requestToken = $this->OauthConsumer->getRequestToken('Twitter', 
                'https://api.twitter.com/oauth/request_token', 
                Router::url('/', true) . 'users/beg_callback');
        $this->Session->write('twitter_request_token', $requestToken);
        $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' 
                . $requestToken->key);
    }

    public function beg_callback() {        
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
        
        $this->login_success($user, false);
        
        $this->Session->write('user_Id', $this->current_user['id']);

        $this->redirect('/users/set_address/');
    } 
    
    public function set_address() {
	var_dump($this->Session->read('user_Id'));
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                $this->redirect(array('controller' => 'users', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }
	
    public function give() {
        $postId = $this->request->params['pass'][0];
        
        $requestToken = $this->OauthConsumer->getRequestToken('Twitter', 
                'https://api.twitter.com/oauth/request_token', 
                Router::url('/', true) . 'users/give_callback/' . $postId);
        $this->Session->write('twitter_request_token', $requestToken);
        $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' 
                . $requestToken->key);
    }

    public function give_callback() {
        $postId = $this->request->params['pass'][0];
        
        $requestToken = $this->Session->read('twitter_request_token');
        $accessToken = $this->OauthConsumer->getAccessToken('Twitter', 
                'https://api.twitter.com/oauth/access_token', $requestToken);

        if (empty($accessToken)) {
            $this->Session->setFlash('Access Token invalid at give_callback()');
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
            
            $this->Session->setFlash('Twitter user created at give_callback()');
        }
        else {
            $this->Session->setFlash('Returning Twitter user at give_callback()');
        }
        
        // check that we are the right person
        $this->loadModel("Post");
        $this->Post->findById($postId);
        
        // successful login
        $this->login_success($user, false);
        
        $this->redirect("/posts/set_type/" . $postId);
    }   
}

?>

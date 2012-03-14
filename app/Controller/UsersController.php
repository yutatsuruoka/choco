<?php

App::import('Vendor', 'facebook/facebook');

function filter_male($var) {
    return strcmp($var['sex'], 'male') == 0;
}

function filter_female($var) {
    return strcmp($var['sex'], 'female') == 0;
}

function sort_friends($var1, $var2) {
    return strnatcmp($var1['name'], $var2['name']);
}

class UsersController extends AppController {
    public $name = 'Users';
    public $components = array('OauthConsumer');
    var $uses = array('User', 'Post', 'Product'); 
    public $theme = '';
    var $facebook;  
    
    
    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('signup', 'login', 'twitter', 'twitter_callback'
                , 'facebook', 'facebook_callback', 'beg', 'beg_callback', 'begfb_callback', 'give', 'give_callback');

        $this->facebook = new Facebook(array(  
            'appId'  => Configure::Read('Facebook.appId'),  
            'secret' => Configure::Read('Facebook.secret'),  
            'cookie' => true,  
        ));  
    }

	private function get_redirect_url($url) {

        $url_parts = @parse_url($url);
        if (!$url_parts) return false;
        if (!isset($url_parts['host'])) return false; //can't process relative URLs
        if (!isset($url_parts['path'])) $url_parts['path'] = '/';

        $sock = fsockopen($url_parts['host'], (isset($url_parts['port']) 
                ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
        if (!$sock) return false;

        $request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) 
                ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n";
        $request .= 'Host: ' . $url_parts['host'] . "\r\n";
        $request .= "Connection: Close\r\n\r\n";
        fwrite($sock, $request);
        $response = '';
        while(!feof($sock)) $response .= fread($sock, 8192);
        fclose($sock);

        if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
            if ( substr($matches[1], 0, 1) == "/" )
                return $url_parts['scheme'] . "://" . $url_parts['host'] 
                    . trim($matches[1]);
            else
                return trim($matches[1]);

        } else {
            return false;
        }
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

        $this->Session->write('accessKey', $accessToken->key);
        $this->Session->write('accessSecret', $accessToken->secret);
        
        // 認証ユーザ情報の取得
        $json = $this->OauthConsumer->get('Twitter', $accessToken->key, 
                $accessToken->secret, 
                'http://twitter.com/account/verify_credentials.json', array());
        $user = json_decode($json);
		
        if (!$this->User->find('first', array('conditions' 
            => array(
                'email' => $user->id . '@twitter'
                 , 'name' => $user->name
            )))) {
            // create new user
            $this->User->save(array('User' 
                => array(
                    'email' => $user->id . '@twitter'
                    , 'type' => 1
                    , 'name' => $user->name
                    , 'screen_name' => $user->screen_name
                )), false);            
        }
        
        $this->login_success($user, false);

        // update post.boy_id with new/logged in user
        $this->Post->id = $this->Session->read('insert_id');
        $this->Post->saveField('userid', $this->current_user['id']);
        $this->Post->saveField('girl_id', $user->screen_name);
        
        $avatar_url = 'https://api.twitter.com/1/users/profile_image?'
                    . 'screen_name=' . $user->screen_name
                    . '&size=bigger';
                $girl_avatar = $this->get_redirect_url($avatar_url);
        $this->Post->saveField('girl_avatar', $girl_avatar);            

        $this->Session->write('user_Id', $this->current_user['id']);        
        $this->Session->write('user_Name', $this->current_user['name']);
        
        $this->redirect('/users/set_address_tw/');
    } 
    
    
    public function begfb_callback() {
        $this->log('facebook_callback() called', LOG_DEBUG);
        
        $uid = $this->facebook->getUser();  
        if ($uid == 0) {
            $this->log('no facebook uid!', LOG_DEBUG);
            $this->Session->setFlash('Facebook login failed');
            $this->redirect('/');
        }
        
        $me = null;  
        try {  
            $me = $this->facebook->api('/me');
            
            //フレンドID取得
            //$friendIds = $this->facebook->api('/fql?q=SELECT+name+FROM+friend+WHERE+uid1=me()');
            //$friendIds = $this->facebook->api('/me/friends');
            $fql = 'SELECT uid, name, sex FROM user ';
            $fql .= ' WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me());';
            $ret_obj = $this->facebook->api(array(
                                   'method' => 'fql.query',
                                   'query' => $fql,
                                 ));
            // #324: sort the friends list
            usort($ret_obj, "sort_friends");
            
            $friendIds['data'] = $ret_obj;
            
            $friendIds['male'] = array_filter($ret_obj, "filter_male");
            $friendIds['female'] = array_filter($ret_obj, "filter_female");

            $access_token = $this->facebook->getAccessToken();  
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
            
            /* $this->Session->setFlash('Facebook user created'); */
        }
        else {
            /* $this->Session->setFlash('Returning Facebook user'); */
        }
        
        $user = $this->User->find('first', array('conditions' 
            => array(
                'email' => $me['id'] . '@facebook'
                , 'type' => 2
                , 'deleted' => NULL
            )));
        
        
		$fb_avatar_url = 'https://graph.facebook.com/' . $me['id'] . '/picture';
		$fb_girl_avatar = $this->get_redirect_url($fb_avatar_url);    
        $this->Post->id = $this->Session->read('insert_id');
        $this->Post->saveField('girl_avatar', $fb_girl_avatar);
        $this->Post->saveField('userid', $user['User']['id']);
        $this->Post->saveField('girl_id', $user['User']['name']);
        $this->Session->write('user_Id', $user['User']['id']); 
        $this->Session->write('friendIds', $friendIds); 
        $this->Auth->login(array('email' => $me['id'] . '@facebook',
                'name' => $name,  
                'type' => 2));              
        
        $this->redirect('/users/set_address_fb/');
    }
        
    public function set_address_tw() {
        $this->User->id = $this->Session->read('user_Id');
        $this->Post->id = $this->Session->read('insert_id');
        $this->set('user', $this->User->read());
        $this->set('post', $this->Post->read());
        if ($this->request->is('post')) {
            if (!empty($this->data)) {
            	$data = $this->request->data;
      		  	if ($this->User->save($this->request->data)) {
      		  		// boy_id save
           			// remove @ mark
                	$boy_id = $data["twname"];
                	$fc = substr($boy_id, 0, 1);
                	while ($fc == '@'
                    	    || $fc == ' ') {
                    	$boy_id = substr($boy_id, 1);                    
                    	$fc = substr($boy_id, 0, 1);
                	}
                	$data["twname"] = $boy_id;
            		$add['Post'] = array(
      					'boy_id' => $data["twname"],
   					);
        			$this->Post->save($add);  
        				            
        			$this->OauthConsumer->post('Twitter'
        	                , $this->Session->read('accessKey')
            	            , $this->Session->read('accessSecret')
                	        , 'https://api.twitter.com/1/statuses/update.json'
                    	    , array('status' => 
                        	    '.@' . $data["twname"] . ' クン、ホワイトデーには当然3倍返しだよね？コレ買って〜！！'
                            	. '【このツイートはneda.lyを利用して送られています】'
                           	 . ' http://neda.ly/posts/set_type/' . $this->Session->read('insert_id')
                           	 . ' #nedaly'
                        	));
                    $this->Session->setFlash('');
                    $this->redirect(array('controller' => 'users', 'action' => 'thankyou'));
            	}
            }
    	}
        $this->set('errors', $this->User->validationErrors);  
    }
   
    public function set_address_fb() {
        $this->User->id = $this->Session->read('user_Id');
        $this->Post->id = $this->Session->read('insert_id');
        $friendIds = $this->Session->read('friendIds');        
        $this->set('user', $this->User->read());
        $this->set('post', $this->Post->read());
        if ($this->request->is('post')) {
            if (!empty($this->data)) {
      		  	$data = $this->request->data;
	            if ($this->User->save($this->request->data)) {
            		$add['Post'] = array(
      					'boy_id' => $data["fbname"],
   					);
        			$this->Post->save($add);
	            	
	            	foreach($friendIds['data'] as $fid ){
	            		if($fid['name'] == $data["fbname"]){
	            			$data_id = $fid['id'];
	            		}
	            	}
	            	//ウォールへの投稿
	            	$attachment = array(
						"message"=>$data["fbname"] . "クン、ホワイトデーには当然3倍返しだよね？コレ買って〜！！ http://neda.ly/posts/set_type/" . $this->Session->read('insert_id'),
						"link"=>"http://neda.ly/posts/set_type/" . $this->Session->read('insert_id'),
						"name"=>"ソーシャルおねだりプラットフォーム【neda.ly】",
					);
        			$this->facebook->api('/' . $data_id . '/feed', 'POST', $attachment);
                    $this->redirect(array('controller' => 'users', 'action' => 'thankyou'));
            	}
            }
    	}
        $this->set('errors', $this->User->validationErrors);
        
        $this->set('friendIds', $friendIds);  
    }
	
    public function thankyou() {
    	
    }

	
    public function give() {
        $postId = $this->request->params['pass'][0];
        $type = $this->request->params['pass'][1];
        
        $this->Post->id = $postId;
        $this->Post->saveField('type', $type);        
        
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
            
        }
        
        // check that we are the right person
        $this->loadModel("Post");
        $this->Post->findById($postId);
        
        // successful login
        $this->login_success($user, false);
        
        $this->redirect("/payment/index/" . $postId);
    }   

/*
    public function facebook() {
        $this->log('facebook() called', LOG_DEBUG);
        
        $url = $this->fb->getLoginUrl(array('redirect_uri' => 
            'http://kazumax.kamiya.com/users/facebook_callback', 
            'req_perms' => 'email'));  
        $this->redirect($url);  
    }
*/

/*
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
*/
}

?>

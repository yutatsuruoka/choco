<?php
class PostsController extends AppController {
    public $name = 'Posts';
    public $helpers = array('Html', 'Form');
    public $components = array('OauthConsumer');
    var $uses = array('User', 'Post', 'Payment'); 
	
    /*
public function index() {
        $this->set('posts', $this->Post->find('all'));
    }
*/
    
    public function view($id = null) {
    	$this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }
    
    public function user($id = null) {
    	$this->Post->id = $id;
        $this->set('post', $this->Post->read());
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

    public function fix_avatar() {
        $girls = $this->Post->find('all', array(
            'conditions' => array(
                'Post.deleted' => null
                , 'length(Post.girl_avatar)'=> 0)
        ));
        
        $count = 0;
        foreach ($girls as $girl) {
            $this->Post->id = $girl['Post']['id'];
            
            $girl_id = $girl['Post']['girl_id'];
            $fc = substr($girl_id, 0, 1);
            while ($fc == '@'
                    || $fc == ' ') {
                $girl_id = substr($girl_id, 1);                    
                $fc = substr($girl_id, 0, 1);
            }
            if (strcmp($girl_id, $girl['Post']['girl_id']) != 0) {
                $this->Post->savefield('girl_id', $girl_id);                
            }
            
            if (strlen($girl['Post']['girl_avatar']) == 0) {
                $avatar_api_url = 'https://api.twitter.com/1/users/profile_image?'
                    . 'screen_name=' . $girl_id
                    . '&size=bigger';
                $avatar_url = $this->get_redirect_url($avatar_api_url);
                
                if (strlen($avatar_url) == 0) {
                    $this->Post->savefield('deleted', date('Y/m/d H:i:s'));
                }
                else {
                    $this->Post->savefield('girl_avatar', $avatar_url);
                }
            }
            
            $count ++;
            if ($count == 200) {
                break;
            }
        }
    }
    
    public function add() {
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->__sanitize();
                
                // remove @ mark
                $girl_id = $this->request->data['Post']['girl_id'];
                $fc = substr($girl_id, 0, 1);
                while ($fc == '@'
                        || $fc == ' ') {
                    $girl_id = substr($girl_id, 1);                    
                    $fc = substr($girl_id, 0, 1);
                }
                $this->request->data['Post']['girl_id'] = $girl_id;
                
                $avatar_url = 'https://api.twitter.com/1/users/profile_image?'
                    . 'screen_name=' . $girl_id
                    . '&size=bigger';
                
                $this->request->data['Post']['girl_avatar'] 
                        = $this->get_redirect_url($avatar_url);
                
                if ($this->Post->save($this->request->data)) {
                    $this->Session->write('girl_id', $girl_id);
                    $this->Session->write('insert_id', $this->Post->getInsertID());
                    $this->Session->setFlash('');
                    $this->redirect(array('controller' => 'users', 'action' => 'beg'));
                }                
            }
    	}
        
        // get count of payments
        $condition = array("status" => 1, "is_delete" => 0);
        $paid = $this->Payment->find('count', array('conditions' => $condition));
        if ($paid > 2000) {
            $paid = 2000;
        }
        $this->set('remaining', 2000 - $paid);
        
        // get count of begs
        $condition = array("deleted" => null);
        $begs = $this->Post->find('count', array('conditions' => $condition));
        $this->set('begs', $begs);
        
        $this->set('errors', $this->Post->validationErrors);
    }
    
    function edit($id = null) {
        $this->Post->id = $id;
    	if ($this->request->is('get')) {
        	$this->request->data = $this->Post->read();
  		} else {
        	if ($this->Post->save($this->request->data)) {
          	  	$this->Session->setFlash('Your post has been updated.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('Unable to update your post.');
        	}
    	}
    }

    function set_type($id = null) {
        $this->Post->id = $id;
        $p = $this->Post->find('first', array(
            'conditions' => array('Post.id' => $id)
            ));
        
        if ($p) {
            $u = $this->User->find('first', array(
                'conditions' => array('User.id' => $p['Post']['boy_id'])
                ));
            
            $this->set('post_id', $id);
            $this->set('screen_name', $u['User']['screen_name']);
            $this->set('girl_id', $p['Post']['girl_id']);
            $this->set('avatar', $p['Post']['girl_avatar']);
        }
    }

    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('add', 'index', 'set_type', 'fix_avatar');
    }
	
    function delete($id) {
    	if ($this->request->is('get')) {
        	throw new MethodNotAllowedException();
    	}
    	if ($this->Post->delete($id)) {
        	$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
        	$this->redirect(array('action' => 'index'));
    	}
    }

}

/*
App::import('Vendor', 'Oauth', array('file'=>'OAuth'.DS.'oauth_consumer.php'));
class BotController extends AppController
{
    var $name = 'Bot';
    var $uses = array();
    // Consumer key の値
    var $consumerKey = 'kTWupQLy38Xsv1jwt2bA';
    // Consumer secret の値
    var $consumerSecret = 'N9bqMdrvWNpYu0VFMPK3Ixk75ChAkQLiH3TUox38';
    // Access Token の値
    var $accessToken = '140490501-ZlmrzXfBzE57Ym1U9hAUmvZK8kL8hGzGI00x3nOwn';
    // Access Token Secret の値
    var $accessTokenSecret = 'hrfY1pEscVaDDkm1Ipi7x3AvW17p4Q8dyHES0EZAM';
 
    function update() {
        $consumer = new OAuth_Consumer($this->consumerKey, $this->consumerSecret);
 
        $tweet = $consumer->post(
            $this->accessToken,
            $this->accessTokenSecret,
            'http://twitter.com/statuses/update.xml',
            array('status'=>'つぶやけ')
        );
 
        pr($tweet);
        exit();
    }
}
*/
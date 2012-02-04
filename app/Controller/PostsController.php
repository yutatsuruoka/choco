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
                
            	if ($this->Post->save($this->request->data)) {
                	$this->Session->write('girl_id', $girl_id);
                	$this->Session->write('insert_id', $this->Post->getInsertID());
        	        $this->Session->setFlash('');
	                $this->redirect(array('controller' => 'users', 'action' => 'beg'));
    	        } else {
        	        $this->Session->setFlash('Unable to add your post.');
            	}
            }
    	}
        
        // get count of payments
        $condition = array("status" => 1, "is_delete" => 0);
        $count = $this->Payment->find('count', array('conditions' => $condition));
        if ($count > 2000) {
            $count = 2000;
        }
        $this->set('remaining', 2000 - $count);
        
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
        }
    }

    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('add', 'index', 'set_type');
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
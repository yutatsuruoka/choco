<?php
class UsersController extends AppController {
    public $name = 'Users';
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('users', $this->User->find('all'));
    }
    
    public function view($id = null) {
    	$this->User->id = $id;
        $this->set('user', $this->User->read());
    }
}
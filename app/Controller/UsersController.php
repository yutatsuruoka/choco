<?php
class UsersController extends AppController {
    public $name = 'Users';
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('Users', $this->User->find('all'));
    }
 
}
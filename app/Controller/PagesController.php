<?php
class PagesController extends AppController {
	
	function display() {}
	
	function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('display', 'index');
   
    }
}
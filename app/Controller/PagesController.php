<?php
class PagesController extends AppController {
	
	/* var $components = array('Qdmail'); */
	
    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('index', 'no');
   
    }

    function index() {
    	
    }

    function no() {}
    
    function mailtest() {
    	$this->set('test', 'TEST');
    	/*
$this->Qdmail->to('yuta@tsuruoka.me', '');
    	$this->Qdmail->from('thankyou@chocokure.com');
    	$this->Qdmail->subject('testTitle');
    	$this->Qdmail->text( '本文をここにかきます' );
		$this->Qdmail -> send();
*/
    }

    
    
}
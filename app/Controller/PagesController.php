<?php
class PagesController extends AppController {
	
    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('index', 'no');
   
    }

    function index() {}

    function no() {}
}
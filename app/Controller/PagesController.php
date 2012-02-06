<?php
class PagesController extends AppController {
	
	var $components = array('Qdmail');
	
    function beforeFilter() {
        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('index', 'no');
   
    }

    function index() {}

    function no() {}
    
    function mailtest() {
    	$mail = new QdmailComponent();
   		$mail -> smtp(true);
    　	$param = array(
        'host'=>'mail42.heteml.jp',
        'port'=> 25 , //これはSMTPAuthの例。認証が必要ないなら　25　でＯＫ。
        'from'=>'thankyou@chocokure.com',//　Return-path: になります。
        'protocol'=>'SMTP',// 認証が必要ないなら、'SMTP'
        'user'=>'thankyou@chocokure.com', //SMTPサーバーのユーザーID
        'pass' => 'choco1228', //SMTPサーバーの認証パスワード
        );
    
    	$this->Qdmail->to('yuta@tsuruoka.me', '');
    	$this->Qdmail->from('thankyou@chocokure.com');
    	$this->Qdmail->subject('testTitle');
    	$this->Qdmail->text( '本文をここにかきます' );
		$this->Qdmail -> send();
    }

    
    
}
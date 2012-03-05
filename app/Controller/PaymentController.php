<?php

class PaymentController extends AppController {

	var $name = 'Payment';
	var $uses = array('Payment','User','Post');
	public $theme = '';

	function beforeFilter(){

		parent::beforeFilter();

                // Tell the Auth controller that the 'create' action is accessible 
                // without being logged in.
                $this->Auth->allow('index','paypal_success', 'paypal_failure', 'bank', 'paypal','test');
                
		$this->set("title_for_layout", "Paypal Payment");

		//$this->logger->debug('Start debugging payment controller.');
		
		// Include the paypal library
		include_once (APP.'/Vendor/payment/Paypal.php');
	}
        
	function test($user_id, $post_id) {
            $u =  $this->User->find('first', array(
                'conditions' => array('id' => $user_id)));
            $this->current_user = $u['User'];

            $this->Auth->login(array('id' => $this->current_user['id']
                    , 'email' => $this->current_user['email']
                    , 'type' => $this->current_user['type']
                    , 'name' => $this->current_user['name']));

            $this->set("user_id", $user_id);
            
            $this->redirect('/payment/index/' . $post_id);
        }
	
	function index($post_id=null) {
           	$this->set("post_id", $post_id);
            
            $this->Post->id = $post_id;
        	$p = $this->Post->find('first', array(
          		'conditions' => array('Post.id' => $post_id)
            ));
        
    	    if ($p) {
        	    $u = $this->User->find('first', array(
            	    'conditions' => array('User.id' => $p['Post']['boy_id'])
                ));
            
            $this->set('screen_name', $u['User']['screen_name']);
            $this->set('girl_id', $p['Post']['girl_id']);
            $this->set('avatar', $p['Post']['girl_avatar']);
        }
    }
        
	function paypal($post_id=null) {

            $user_id = $this->current_user['id'];

            if (!empty($post_id) && !empty($user_id)) {

                $post = $this->Post->read(null, $post_id);

                if (empty($post)) {

                    $this->Session->setFlash("post($post_id) not found.");
                    $this->logger->info("post($post_id) not found.");
                    $this->redirect('/');
                } else {

                    //if post is already paid, never go to payment.
                    $payment = $this->Payment->find("first", array("conditions" => array("Payment.post_id" => $post_id, 'Payment.status' => 1)));
                    if (!empty($payment)) {
                        $this->Session->setFlash("post($post_id) already paid.");
                        $this->logger->info("post($post_id) already paid.");
                        $this->redirect('/');
                    }

                    // Create an instance of the paypal library
                    $myPaypal = new Paypal();

                    // Specify your paypal email
                    $myPaypal->addField('business', PAYMENT_RECIPIENT);

                    // Specify the currency
                    $myPaypal->addField('currency_code', 'JPY');

                    // Specify the url where paypal will send the user on success/failure
                    $root_path = rtrim($this->currentURL(), "/index/$post_id");
                    $myPaypal->addField('return', "$root_path/paypal_success/?uid=$user_id&pid=$post_id");
                    $myPaypal->addField('cancel_return', "$root_path/paypal_failure/?uid=$user_id&pid=$post_id");
                    $myPaypal->addField('notify_url', "$root_path/paypal_failure/?uid=$user_id&pid=$post_id");

                    // Specify the product information
                    $myPaypal->addField('item_name', ITEM_NAME);
                    $myPaypal->addField('amount', ITEM_PRICE);
                    $myPaypal->addField('item_number', 1);

                    // Specify any custom value
                    $myPaypal->addField('custom', $post_id);

                    // fill in checkout page
                    $myPaypal->addField('country', "JP");
                    $myPaypal->addField('lc', "JP");
                    $myPaypal->addField('email', "test@test.com");

                    // Enable test mode if needed
                    if (PAYMENT_USESANDBOX) {
                        $myPaypal->enableTestMode();
                    }
                    
                    $this->set('fields', $myPaypal->fields);
                    $this->set('gatewayUrl', $myPaypal->gatewayUrl);
                }
            } else {
                $this->Session->setFlash('Invalid parameter.');
                $this->logger->info('Invalid parameter.');
                $this->redirect('/');
            }
        }

	function paypal_success(){
		//$this->logger->debug("paypal_success() ".print_r($_REQUEST,true));
		
		$user_id = @$_REQUEST['uid'];
		$post_id = @$_REQUEST['pid'];
		
		$this->logger->info("payment succeed. uid=$user_id pid=$post_id");
		
		if(!empty($post_id)){
			$post = $this->Post->read(null,$post_id);
			if(empty($post)){
				$this->Session->setFlash("post($post_id) not found.");
	          	$this->logger->info("post($post_id) not found.");
	            $this->redirect(array('controller'=>'payment','action'=>'paypal_failure'));				
			}else{
				$payment['Payment']['user_id'] = $user_id;
				$payment['Payment']['post_id'] = $post_id;
				$payment['Payment']['amount'] = @$_REQUEST['mc_gross'];
				$payment['Payment']['status'] = 0;				
				if(isset($_REQUEST['payment_status']) && preg_match('/completed/i',$_REQUEST['payment_status'])){
					$payment['Payment']['status'] = 1;				
				}else{
					$payment['Payment']['status'] = 2;				
				}
				$this->Payment->save($payment);
			}
		}else{
          	$this->Session->setFlash('Invalid parameter.');
	        $this->logger->info('Invalid parameter.');
                $this->redirect(array('controller'=>'payment','action'=>'paypal_failure'));				
            }
	}
	
	function paypal_failure(){
            $this->redirect(array('controller'=>'Pages','action'=>'no'));				
	}
	
	function bank(){
	}
}

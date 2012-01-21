<?php

class PaymentController extends AppController {

	var $name = 'Payment';
	var $uses = array('Payment','User','Post');

	function beforeFilter(){

		parent::beforeFilter();

		$this->set("title_for_layout", "Paypal Payment");

		//$this->logger->debug('Start debugging payment controller.');
		
		// Include the paypal library
		include_once (APP.'/Vendor/payment/Paypal.php');
	}
	
	/**
	 * Displays a view
	 *
	 * @param <string> $url URl
	 * @access public
	 */
	function index($post_id=null) {

		$user_id = $this->current_user['id'];
                var_dump($this->current_user);
		
		if(!empty($post_id)&&!empty($user_id)){
						
			$post = $this->Post->read(null,$post_id);
			
			if(empty($post)){
	          	
				$this->Session->setFlash("post($post_id) not found.");
	          	$this->logger->info("post($post_id) not found.");
	            $this->redirect('/');				
	            
			}else{
				
				//if post is already paid, never go to payment.
				$payment = $this->Payment->find("first",array( "conditions" => array("Payment.post_id"=>$post_id,'Payment.status' => 1));				
				if(!empty($payment)){
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
				$root_path = rtrim($this->currentURL(),"/index/$post_id");
				$myPaypal->addField('return', "$root_path/paypal_success/?uid=$user_id&pid=$post_id");
				$myPaypal->addField('cancel_return', "$root_path/paypal_failure/?uid=$user_id&pid=$post_id");
							
				// Specify the product information
				$myPaypal->addField('item_name', ITEM_NAME);
				$myPaypal->addField('amount', ITEM_PRICE);
				$myPaypal->addField('item_number', 1);
				
				// Specify any custom value
				$myPaypal->addField('custom', PAYMENT_SUBJECT);
				
				// Enable test mode if needed
				$myPaypal->enableTestMode();
				
				// Let's start the train!
				$myPaypal->submitPayment();		
					
			}
			
		}else{
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
		$this->logger->debug("paypal failure.  ".print_r($_REQUEST,true));		
	}
}


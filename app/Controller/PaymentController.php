<?php

class PaymentController extends AppController {

	var $name = 'Payment';
	var $uses = array('Payment','User');

	function beforeFilter(){

		parent::beforeFilter();

		$this->set("title_for_layout", "Paypal Payment");

		$this->logger->debug('Start debugging payment controller.');
		
		// Include the paypal library
		include_once (APP.'/Vendor/payment/Paypal.php');
	}
	
	/**
	 * Displays a view
	 *
	 * @param <string> $url URl
	 * @access public
	 */
	function index($user_id=null) {
		
		$user_id = $this->current_user['id'];
		
		if($user_id){
						
			// Create an instance of the paypal library
			$myPaypal = new Paypal();
			
			// Specify your paypal email
			$myPaypal->addField('business', PAYMENT_RECIPIENT);
			
			// Specify the currency
			$myPaypal->addField('currency_code', 'JPY');
			
			// Specify the url where paypal will send the user on success/failure
			$current_url = $this->currentURL();
			$myPaypal->addField('return', $current_url.'/paypal_success/?uid='.$user_id);
			$myPaypal->addField('cancel_return', $current_url.'/paypal_failure?uid='.$user_id);
			
			// Specify the url where paypal will send the IPN
			//$myPaypal->addField('notify_url', $current_url.'/paypal_ipn?uid='.$user_id);
			
			// Specify the product information
			$myPaypal->addField('item_name', ITEM_NAME);
			$myPaypal->addField('amount', ITEM_PRICE);
			$myPaypal->addField('item_number', 1);
			
			// Specify any custom value
			$myPaypal->addField('custom', 'muri-khao');
			
			// Enable test mode if needed
			$myPaypal->enableTestMode();
			
			// Let's start the train!
			$myPaypal->submitPayment();		
			
		}else{
          	$this->Session->setFlash('Invalid user id.');
            $this->redirect(array('controller'=>'posts','action' => 'index'));
		}
	}
/*	
	function paypal_ipn(){
		
		$this->logger->debug("called paypal_ipn() ".print_r($_REQUEST,true));
		
		// Create an instance of the paypal library
		$myPaypal = new Paypal();
		
		// Log the IPN results
		$myPaypal->ipnLog = TRUE;
		
		// Enable test mode if needed
		$myPaypal->enableTestMode();
		
		// Check validity and write down it
		if ($myPaypal->validateIpn())
		{
		    if ($myPaypal->ipnData['payment_status'] == 'Completed')
		    {
		         file_put_contents('paypal.txt', 'SUCCESS');
		    }
		    else
		    {
		         file_put_contents('paypal.txt', "FAILURE\n\n" . $myPaypal->ipnData);
		    }
		}		
	}
*/	
	function paypal_success(){
		$this->logger->debug("paypal_success() ".print_r($_REQUEST,true));
	}
	function paypal_failure(){
		var_dump($_REQUEST);
		
	}
}


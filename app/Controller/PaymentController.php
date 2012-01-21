<?php

class PaymentController extends AppController {

	var $name = 'Payment';
	var $uses = array('Payment');

	function beforeFilter(){

		parent::beforeFilter();

		$this->set("title_for_layout", "Paypal Payment");

	}
	
	/**
	 * Displays a view
	 *
	 * @param <string> $url URl
	 * @access public
	 */
	function index($id=null) {

			// Include the paypal library
			include_once (APP.'/Vendor/payment/Paypal.php');
			
			// Create an instance of the paypal library
			$myPaypal = new Paypal();
			
			// Specify your paypal email
			$myPaypal->addField('business', 'sell_1327123636_biz@gmail.com');
			
			// Specify the currency
			$myPaypal->addField('currency_code', 'JPY');
			
			// Specify the url where paypal will send the user on success/failure
			$myPaypal->addField('return', 'http://localhost/choco/payment/paypal_success');
			$myPaypal->addField('cancel_return', 'http://localhost/choco/payment/paypal_failure');
			
			// Specify the url where paypal will send the IPN
			$myPaypal->addField('notify_url', 'http://localhost/choco/payment/paypal_ipn');
			
			// Specify the product information
			$myPaypal->addField('item_name', 'T-Shirt');
			$myPaypal->addField('amount', '999');
			$myPaypal->addField('item_number', '001');
			
			// Specify any custom value
			$myPaypal->addField('custom', 'muri-khao');
			
			// Enable test mode if needed
			$myPaypal->enableTestMode();
			
			// Let's start the train!
			$myPaypal->submitPayment();		
	}
	
	function paypal_ipn(){
		
	}
	function paypal_success(){
		
	}
	function paypal_failure(){
		
	}
}


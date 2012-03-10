<?php

class PaymentController extends AppController {

    var $name = 'Payment';
    var $uses = array('Payment', 'User', 'Post', 'Paypal2', 'Product');
    public $theme = '';

    function beforeFilter() {

        parent::beforeFilter();

        // Tell the Auth controller that the 'create' action is accessible 
        // without being logged in.
        $this->Auth->allow('index', 'paypal_ec_success', 'paypal_failure', 'bank', 
                'paypal', 'test', 'paypal_wps_success');

        $this->set("title_for_layout", "Paypal Payment");

        //$this->logger->debug('Start debugging payment controller.');
        // Include the paypal library
        include_once (APP . '/Vendor/payment/Paypal.php');
    }

    
    function test($user_id, $post_id) {
        $u = $this->User->find('first', array(
            'conditions' => array('id' => $user_id)));
        $this->current_user = $u['User'];

        $this->Auth->login(array('id' => $this->current_user['id']
            , 'email' => $this->current_user['email']
            , 'type' => $this->current_user['type']
            , 'name' => $this->current_user['name']));

        $this->set("user_id", $user_id);

        $this->redirect('/payment/index/' . $post_id);
    }

    function index($post_id = null) {
        // display payment information page
        $this->set("post_id", $post_id);

        $p = $this->Post->find('first', array(
            'conditions' => array('Post.id' => $post_id)
        ));

        if ($p) {
            $u = $this->User->find('first', array(
                'conditions' => array('User.id' => $p['Post']['boy_id'])
                    ));

            if ($u['User']['type'] === 1) {
                $this->redirect(array('controller' => 'users', 'action' => 'beg'));
            }

            $this->set('screen_name', $u['User']['screen_name']);
            $this->set('girl_id', $p['Post']['girl_id']);
            $this->set('avatar', $p['Post']['girl_avatar']);
        }
    }
    
    function paypal($post_id = null) {
        $this->paypal_ec($post_id);
    }
    
    function paypal_ec($post_id = null) {
        $user_id = $this->current_user['id'];
        if (empty($user_id)) {
            $this->set('ppErrors', array(1 => 'user_id is null'));
            return;
        }
        
        // get post info
        if (empty($post_id)) {
            $this->set('ppErrors', array(1 => 'post_id is null'));
            return;
        }
        $post = $this->Post->find('first', array(
            'conditions' => array('Post.id' => $post_id)
        ));
        if ($post == null) {
            $this->set('ppErrors', array(1 => "invalid post_id: $post_id"));
            return;
        }
        
        $this->logger->info("post.type = " . $post['Post']["type"]);
        
        // get product info
        if (empty($post['Post']['type'])) {
            $this->set('ppErrors', array(1 => 'product_id is null'));
            return;
        }
        $product = $this->Product->find('first', array(
            'conditions' => array('Product.id' => $post['Post']['type'])
        ));
        if ($product == null) {
            $this->set('ppErrors', array(1 => "invalid product_id: " . $post['Post']['type']));
            return;
        }

        $amount = $product['Product']['price'];
        
        $setOptions = array(
            'NOSHIPPING' => '1',
            'ALLOWNOTE' => '0',
            'L_PAYMENTREQUEST_0_NAME0' => $product['Product']['name'],
            'L_PAYMENTREQUEST_0_DESC0' => '',
            'L_PAYMENTREQUEST_0_AMT0' => $amount,
            'RETURNURL' => FULL_BASE_URL . "/Payment/paypal_ec_success?uid=$user_id&pid=$post_id",
            'CANCELURL' => FULL_BASE_URL . "/Payment/paypal_failre?uid=$user_id&pid=$post_id"
        );

        $setResult = $this->Paypal2->setExpressCheckout($amount, 'Sale', $setOptions);
        if (empty($setResult)) {
            $this->set('ppErrors', $this->Paypal2->errorMsg);
        }
        else {
            $this->redirect($this->Paypal2->expressCheckoutUrl);
        }
    }
    
    function paypal_ec_success($user_id = null, $post_id = null) {

        if (!empty($post_id) && !empty($user_id)) {
            $data = array();
            
            // get post
            $post = $this->Post->read(null, $post_id);
            if (empty($post)) {
                $this->Session->setFlash("post($post_id) not found.");
                $this->logger->info("post($post_id) not found.");
                $this->redirect('/');
            }
            
            // get checkout data
            $getResult = $this->Paypal2->getExpressCheckoutDetails(
                    $this->params['url']['token']);
            if (empty($getResult)) {
                // エラー
                $this->Session->setFlash('getExpressCheckoutDetails() returned error');
                $this->logger->info('getExpressCheckoutDetails() returned error');
                $this->redirect('/');
            }
            
            // save checkout data
            $data['Post']['pp_name'] = $getResult['FIRSTNAME'] . ' '
                    . $getResult['LASTNAME'];
            $data['Post']['pp_email'] = $getResult['EMAIL'];
            $data['Post']['pp_amt'] = $getResult['AMT'];

            // return token
            $doResult = $this->Paypal->doExpressCheckout($getResult['TOKEN'], 
                    $getResult['PAYERID'], $getResult['AMT']);
            if (empty($doResult)) {    
                // エラー
                $this->Session->setFlash('doExpressCheckout() returned error');
                $this->logger->info('doExpressCheckout() returned error');
                $this->redirect('/');
            }
            
            // transaction successful: save to db
            $data['Post']['transaction_id'] 
                = $doResult['PAYMENTINFO_0_TRANSACTIONID'];
        }
    }    

    function paypal_failure() {
        $this->redirect(array('controller' => 'Pages', 'action' => 'no'));
    }

    function bank() {
    }
   
    function paypal_wps($post_id = null) {

        $user_id = $this->current_user['id'];

        if (!empty($post_id) && !empty($user_id)) {

            $post = $this->Post->read(null, $post_id);

            if (empty($post)) {

                $this->Session->setFlash("post($post_id) not found.");
                $this->logger->info("post($post_id) not found.");
                $this->redirect('/');
            } else {

                //if post is already paid, never go to payment.
                $payment = $this->Payment->find("first", 
                        array("conditions" 
                            => array("Payment.post_id" => $post_id, 
                                 'Payment.status' => 1)));
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
                $myPaypal->addField('return', "$root_path/paypal_wps_success/?uid=$user_id&pid=$post_id");
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

    function paypal_wps_success() {
        //$this->logger->debug("paypal_success() ".print_r($_REQUEST,true));

        $user_id = @$_REQUEST['uid'];
        $post_id = @$_REQUEST['pid'];

        $this->logger->info("payment succeed. uid=$user_id pid=$post_id");

        if (!empty($post_id)) {
            $post = $this->Post->read(null, $post_id);
            if (empty($post)) {
                $this->Session->setFlash("post($post_id) not found.");
                $this->logger->info("post($post_id) not found.");
                $this->redirect(array('controller' => 'payment', 'action' => 'paypal_failure'));
            } else {
                $payment['Payment']['user_id'] = $user_id;
                $payment['Payment']['post_id'] = $post_id;
                $payment['Payment']['amount'] = @$_REQUEST['mc_gross'];
                $payment['Payment']['status'] = 0;
                if (isset($_REQUEST['payment_status']) && preg_match('/completed/i', $_REQUEST['payment_status'])) {
                    $payment['Payment']['status'] = 1;
                } else {
                    $payment['Payment']['status'] = 2;
                }
                $this->Payment->save($payment);
            }
        } else {
            $this->Session->setFlash('Invalid parameter.');
            $this->logger->info('Invalid parameter.');
            $this->redirect(array('controller' => 'payment', 'action' => 'paypal_failure'));
        }
    }
}

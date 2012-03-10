<?php
class Paypal2 extends AppModel {
 
    var $name = 'Paypal2';
    var $useTable = false;
 
    var $apiServer = PAYPAL_API_SERVER;
    var $expressCheckoutUrl = PAYPAL_EXPRESS_CHECKOUT_URL;
 
    var $version = '87.0';
    var $username = PAYPAL_API_USERNAME;
    var $password = PAYPAL_API_PASSWORD;
    var $signature = PAYPAL_API_SIGNATURE;
    var $returnURL;
    var $cancelURL;
 
 
    var $errorMsg = array();
 
    function __construct() {
        App::import('vendor', 'HTTP_Request', array('file' => 'HTTP/Request.php'));
        
        $this->returnURL = FULL_BASE_URL.'/Payment/paypal_ec_success';
        $this->cancelURL = FULL_BASE_URL.'/Payment/paypal_failure';
    }
 
    function setExpressCheckout ($item_amount, $request='Sale', $options=array()) {
        $params = array(
            'METHOD' => 'SetExpressCheckout',
            'VERSION' => $this->version,
            'USER' => $this->username,
            'PWD' =>$this->password,
            'SIGNATURE' => $this->signature,
            'PAYMENTREQUEST_0_AMT' => $item_amount,
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'JPY',
            'PAYMENTREQUEST_0_ITEMAMT' => $item_amount,
            'PAYMENTREQUEST_0_PAYMENTACTION' => $request,
            'LOCALECODE' => 'JP'
        );
 
        $params = am($params, $options);
        foreach ($params as &$p) $p = h($p);
        $nvpStr = http_build_query($params);
        $req = new HTTP_Request($this->apiServer.'?'.$nvpStr);
        $req->setMethod(HTTP_REQUEST_METHOD_GET);
 
        if (!PEAR::isError($req->sendRequest())) {
            $rawResult = $req->getResponseBody();
            parse_str($rawResult, $result);
 
            if ($result['ACK'] == 'Success') {
                $this->expressCheckoutUrl .= "&token={$result['TOKEN']}";
                $this->expressCheckoutUrl .= '&useraction=commit';
                return $result;
            } else {
                for ($i=0; $i<=9; $i++) {
                    if (!empty($result['L_ERRORCODE'.$i])) {
                        $this->errorMsg[$i] = $result['L_LONGMESSAGE'.$i];
                        $this->log("Set - {$result['CORRELATIONID']} - {$result['L_ERRORCODE'.$i]}", 'paypal');
                    }
                }
                return false;
            }
        }
 
    }
 
    function getExpressCheckoutDetails($token=null, $options=array()) {
        $params = array(
            'METHOD' => 'GetExpressCheckoutDetails',
            'VERSION' => $this->version,
            'USER' => $this->username,
            'PWD' =>$this->password,
            'SIGNATURE' => $this->signature,
            'TOKEN' => $token
        );
 
        $params = am($params, $options);
        foreach ($params as &$p) $p = h($p);
        $nvpStr = http_build_query($params);
 
        $req = new HTTP_Request($this->apiServer.'?'.$nvpStr);
        $req->setMethod(HTTP_REQUEST_METHOD_GET);
 
        if (!PEAR::isError($req->sendRequest())) {
            $rawResult = $req->getResponseBody();
            parse_str($rawResult, $result);
            if ($result['ACK'] == 'Success') {
                return $result;
            } else {
                for ($i=0; $i<=9; $i++) {
                    if (!empty($result['L_ERRORCODE'.$i])) {
                        $this->errorMsg[$i] = $result['L_LONGMESSAGE'.$i];
                        $this->log("Get - {$result['CORRELATIONID']} - {$result['L_ERRORCODE'.$i]}", 'paypal');
                    }
                }
                return false;
            }
        }
    }
 
    function doExpressCheckout($token, $payerId, $amount, $request='Sale', $options=array()) {
        $params = array(
            'METHOD' => 'DoExpressCheckoutPayment',
            'VERSION' => $this->version,
            'USER' => $this->username,
            'PWD' =>$this->password,
            'SIGNATURE' => $this->signature,
            'TOKEN' => $token,
            'PAYERID' => $payerId,
            'PAYMENTREQUEST_0_AMT' => $amount,
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'JPY',
            'PAYMENTREQUEST_0_PAYMENTACTION' => $request
        );
 
        $params = am($params, $options);
        foreach ($params as &$p) $p = h($p);
        $nvpStr = http_build_query($params);
 
        $req = new HTTP_Request($this->apiServer.'?'.$nvpStr);
        $req->setMethod(HTTP_REQUEST_METHOD_GET);
 
        if (!PEAR::isError($req->sendRequest())) {
            $rawResult = $req->getResponseBody();
            parse_str($rawResult, $result);
            if ($result['ACK'] == 'Success') {
 
                return $result;
            } else {
                for ($i=0; $i<=9; $i++) {
                    if (!empty($result['L_ERRORCODE'.$i])) {
                        $this->errorMsg[$i] = $result['L_LONGMESSAGE'.$i];
                        $this->log("Do - {$params['PAYERID']} - {$result['CORRELATIONID']} - {$result['L_ERRORCODE'.$i]}", 'paypal');
                    }
                }
                return false;
            }
        }
    }
 
    function doCapture($transactionId, $amount=0, $complete=false, $options=array()) {
        $params = array(
            'METHOD' => 'DoCapture',
            'VERSION' => $this->version,
            'USER' => $this->username,
            'PWD' =>$this->password,
            'SIGNATURE' => $this->signature,
            'AUTHORIZATIONID' => $transactionId,
            'AMT' => $amount,
            'CURRENCYCODE' => 'JPY',
            'COMPLETETYPE' => ($complete) ? 'Complete' : 'NotComplete'
        );
 
        $params = am($params, $options);
        foreach ($params as &$p) $p = h($p);
        $nvpStr = http_build_query($params);
 
        $req = new HTTP_Request($this->apiServer.'?'.$nvpStr);
        $req->setMethod(HTTP_REQUEST_METHOD_GET);
 
        if (!PEAR::isError($req->sendRequest())) {
            $rawResult = $req->getResponseBody();
            parse_str($rawResult, $result);
            if ($result['ACK'] == 'Success') {
                return $result;
            } else {
                for ($i=0; $i<=9; $i++) {
                    if (!empty($result['L_ERRORCODE'.$i])) {
                        $this->errorMsg[$i] = $result['L_LONGMESSAGE'.$i];
                        $this->log('DoCap - '.$result['CORRELATIONID'].' - '.$result['L_ERRORCODE'.$i], 'paypal');
                    }
                }
                return false;
            }
        }
    }
 
    function doVoid($transactionId, $options=array()) {
        $params = array(
            'METHOD' => 'DoVoid',
            'VERSION' => $this->version,
            'USER' => $this->username,
            'PWD' =>$this->password,
            'SIGNATURE' => $this->signature,
            'AUTHORIZATIONID' => $transactionId,
            'CURRENCYCODE' => 'JPY',
        );
 
        $params = am($params, $options);
        foreach ($params as &$p) $p = h($p);
        $nvpStr = http_build_query($params);
 
        $req = new HTTP_Request($this->apiServer.'?'.$nvpStr);
        $req->setMethod(HTTP_REQUEST_METHOD_GET);
 
        if (!PEAR::isError($req->sendRequest())) {
            $rawResult = $req->getResponseBody();
            parse_str($rawResult, $result);
            if ($result['ACK'] == 'Success') {
                return $result;
            } else {
                for ($i=0; $i<=9; $i++) {
                    if (!empty($result['L_ERRORCODE'.$i])) {
                        $this->errorMsg[$i] = $result['L_LONGMESSAGE'.$i];
                        $this->log('DoVoid - '.$params['AUTHORIZATIONID'].' - '.$result['L_ERRORCODE'.$i], 'paypal');
                    }
                }
                return false;
            }
        }
    }
 
}
?>
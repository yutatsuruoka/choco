<?php

App::import('Vendor', 'OAuth/OAuthClient');

include_once "oauthapp.inc.php";
var_dump($access_tokens);

class BlastShell extends Shell {

	var $isDebug = false;
	var $isTweet = true;

	public $uses = array();

	var $curtime;
	var $dateTimeZoneJapan;
	var $dateTimeJapan;

	var $toolroot = "";
	var $logfilename = "";

	var $consumer;
	var $access_token = "";
	var $access_token_secret = "";

	function __construct() {
		parent::__construct();

		$this->out( "---------------------------------------------------------------");
		$this->out( "START: " . __CLASS__ . " at " . date('Y-m-d H:i:s') );

		$this->curtime = time();
		$this->curtime = intval($this->curtime / 60 ) * 60;

		$this->dateTimeZoneJapan = new DateTimeZone("Asia/Tokyo");
		$this->dateTimeJapan = new DateTime("now", $this->dateTimeZoneJapan);

		$this->consumer = $this->createConsumer();
		
		$this->client_id = 1;
		$this->access_token = "";
		$this->access_token_secret = "";
		if ( count($this->args) == 1 ) {
			$this->client_id = $this->args[0];
		}
		if ( isset($this->params["debug"]) ) {
			$this->isDebug = true;
		}
		if ( isset($this->params["notweet"]) ) {
			$this->isTweet = false;
			$this->isDebug = true;
		}

		if ( $this->isDebug ) {
			$this->out( "---------------------------------------------------------------");
			$this->out( "-- params --");
			$this->out( var_export($this->params,true) );
			$this->out( "-- args --");
			$this->out( var_export($this->args,true) );
			$this->out( "---------------------------------------------------------------");
		}
	}

	function main() {
		global $access_tokens;		
		
		$this->out("TEST: " . date('Y-m-d H:i:s') );
		$this->out( "-- params --");
		$this->out( var_export($this->params,true) );
		$this->out( "-- args --");
		$this->out( var_export($this->args,true) );

		$client_id = 1;
		$access_token = "";
		$access_token_secret = "";
		if ( count($this->args) == 1 ) {
			$client_id = $this->args[0];
		}
		$access_token = $access_tokens['chocokure' . $client_id]['key'];
		$access_token_secret = $access_tokens['chocokure' . $client_id]['secret'];

		$this->twitter_post($access_token,$access_token_secret,'hello worldddd!'." TEST:" . date('Y-m-d H:i:s'));

	}

	function twitter_post($access_token=null,$access_token_secret=null,$message="") {
		$access_token = empty($access_token) ? $this->access_token : $access_token;
		$access_token_secret = empty($access_token_secret) ? $this->access_token_secret : $access_token_secret;

		$this->out("message =");
		$this->out("{$message}");
		if ( $this->isTweet ) {
			$ret = $this->consumer->post($access_token, $access_token_secret, 'http://twitter.com/statuses/update.json', array('status' => $message ));
			$ret = json_decode($ret);
		} else {
			$ret = "-- do not tweet by params --";
		}
		if ( isset($ret->error) ) {
			// ERROR
			$this->out( var_export("!!! error !!!",true) );
			$this->out( var_export($ret->error,true) );
		}
		if ( $this->isDebug ) {
			$this->out("result =");
			$this->out( var_export($ret,true) );
		}
		return $ret;
	}

	function createConsumer() {
		return new OAuthClient(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
	}

}
?>
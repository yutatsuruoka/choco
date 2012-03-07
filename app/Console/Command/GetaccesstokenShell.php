<?php
App::import('Controller', 'OauthConsumerComponent');

include_once "oauthapp.inc.php";

class GetaccesstokenShell extends Shell {
	function main() {
		$this->out("TEST: " . date('Y-m-d H:i:s'));

		$token = "";
		$token_secret = "";
		$pin = "";

		$requestToken = $this->showAuthURL();

		$token = $requestToken->key;
		$token_secret = $requestToken->secret;
		$url = "http://twitter.com/oauth/authorize?oauth_token={$requestToken->key}";

		$this->out("Get PIN in this page:");
		$this->out("{$url}");
		$this->out( "" );

		$pin = $this->in("PIN?");
		$this->out("Pin: {$pin}");

		$accessToken = $this->getAccessToken($token,$token_secret,$pin);
		if ( $accessToken ) {
			$this->out( "access_token        = {$accessToken->key}" );
			$this->out( "access_token_secret = {$accessToken->secret}" );
		} else {
		}

	}

	public $uses = array();

	function showAuthURL() {
		$consumer = $this->createConsumer();
		$requestToken = $consumer->getRequestToken('http://twitter.com/oauth/request_token', 'oob');

		$url = "http://twitter.com/oauth/authorize?oauth_token={$requestToken->key}";
		$this->out( "DEBUG:token        = {$requestToken->key}" );
		$this->out( "DEBUG:token_secret = {$requestToken->secret}" );
		$this->out( "DEBUG:{$url}" );

		return $requestToken;
	}

	function getAccessToken($token,$token_secret,$pin) {
		if ( empty($token) || empty($token_secret) ) {
			$this->out("");
			$this->out("-----------------------------------------------------");
			$this->out("--- Error: no TOKEN or TOKEN_SECRET               ---");
			$this->out("--- Usage: cake getaccesstoken TOKEN TOKEN_SECRET ---");
			$this->out("-----------------------------------------------------");
			$this->out("");
			return;
		}

		$consumer = $this->createConsumer();
		$requestToken = $consumer->getRequestToken('http://twitter.com/oauth/request_token', 'oob');

		$requestToken->key=$token;
		$requestToken->secret=$token_secret;
		$requestToken->oauth_token=$requestToken->key;
		$requestToken->oauth_token_secret=$requestToken->secret;
		$requestToken->oauth_verifier=$pin;

		$accessToken = $consumer->getAccessToken('http://twitter.com/oauth/access_token', $requestToken, "POST");
		if ( $accessToken ) {
			echo var_export($accessToken, false) . "\n";

			return $accessToken;
		} else {
			$this->out("could not get the access token.\n");
		}
	}

	function createConsumer() {
		return new OauthConsumer(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
	}

}
?>
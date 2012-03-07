<?php

App::import('Vendor', 'OAuth/OAuthClient');

include_once "oauthapp.inc.php";

class BlastShell extends Shell {

	var $isDebug = false;
	var $isTweet = true;

	public $uses = array('Post', 'User');

	var $curtime;
	var $dateTimeZoneJapan;
	var $dateTimeJapan;

	var $toolroot = "";
	var $logfilename = "";

	var $consumer;
	
	var $screen_names = array();
	var $tweeted = array();
	
	public function getOptionParser() {
		$parser = parent::getOptionParser();
		
		$parser->addOption('notweet', array('boolean' => true));		
		
		return $parser;
	}

	function __construct() {
		parent::__construct();

		$this->out( "---------------------------------------------------------------");
		$this->out( "START: " . __CLASS__ . " at " . date('Y-m-d H:i:s') );

		$this->curtime = time();
		$this->curtime = intval($this->curtime / 60 ) * 60;

		$this->dateTimeZoneJapan = new DateTimeZone("Asia/Tokyo");
		$this->dateTimeJapan = new DateTime("now", $this->dateTimeZoneJapan);

		$this->isTweet = false;
		$this->isDebug = true;

		$this->consumer = $this->createConsumer();		
	}

	function main() {
		$this->out("TEST: " . date('Y-m-d H:i:s') );

		if ( isset($this->params["debug"]) ) {
			$this->isDebug = true;
		}
		if ( isset($this->params["notweet"]) ) {
			$this->isTweet = !$this->params["notweet"];
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

		$client_id = 0;
		
		$all_posts = $this->Post->find('all', array(
			'conditions' => 'deleted is null'
			, 'fields' => array(
				'boy_id'
				, 'girl_id'
			)
			, 'group' => array(
				'boy_id'
				, 'girl_id'
			)
		));
		
		$c = 0;
		foreach ($all_posts as $post) {			
			// get girl screen_name
			$girl_id = trim($post['Post']['girl_id']);
			if (substr($girl_id, 0, 1) == '@') {
				$girl_id = substr($girl_id, 1);
			}
			
			$boy_user_id = $post['Post']['boy_id'];
			if ($boy_user_id == null) {
				continue;
			}
			
			// get email of boy
			$boy = $this->User->find('first', array(
				'conditions' => array('id', $boy_user_id)
			));
			if ($boy == null) {
				continue;
			}
			$boy_email = $boy['User']['email'];
			
			// get boy twitter id
			$at_pos = strpos($boy_email, '@');
			$boy_twitter_id = substr($boy_email, 0, $at_pos);
			
			if (!array_key_exists($boy_twitter_id, $this->screen_names)) {
			
				// get boy screen name
				$json = file_get_contents(
					"https://api.twitter.com/1/users/show.json?user_id=" . $boy_twitter_id . "&include_entities=true"
					, true
				); 
				$decode = json_decode($json, true); //getting the file content as array
				$boy_id = $decode['screen_name'];
				
				$this->screen_names[$boy_twitter_id] = $boy_id;
			}
			else {
				$boy_id = $this->screen_names[$boy_twitter_id];
			}
			
			// send reply only if not tweeted
			$replied = false;
			if (array_key_exists($boy_id, $this->tweeted)) {
				if (strcmp($this->tweeted[$boy_id], $girl_id) == 0) {
					$replied = true;
				}
			}
			
			global $access_tokens;		
			if (!$replied) {
				$msg = "@$boy_id クンにチョコをねだられた@$girl_id さん！3月14日に向けて正々堂々おねだり仕返しちゃおう。URLからnedaly(ネダリー)へアクセス！http://nedaly.com" ;
				
				$client_id = $c % 5 + 1;
				$access_token
					= $access_tokens['chocokure' . $client_id]['key'];
				$access_token_secret 
					= $access_tokens['chocokure' . $client_id]['secret'];
				
				echo "client_id: $client_id\n";
				if ($this->isTweet) {
					$this->twitter_post($access_token,$access_token_secret, 
						$msg);
				}
				else {
					echo $msg . "\n";
				}
				
				$this->tweeted[$boy_id] = $girl_id;
				
				$c ++;
			}
		}
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
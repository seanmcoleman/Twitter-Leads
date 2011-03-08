<?php

require_once('twitteroauth/twitteroauth.php');

$message = $_POST['twitter_leads_message'];
$phone = $_POST['twitter_leads_phone'];
process_message($message, $phone);

function process_message($message, $phone) {
  $full_message = $message . " - " . $phone;
  // 130 chars gives room for e.g. 1/2 text
  $tweet_length = 130;
	$current_tweet = 1;
	$total_length = strlen($full_message);
	$total_tweets = ceil($total_length / $tweet_length);
	$index = 0;
		
  while ($index < $total_length) {
    send_tweet("$current_tweet/$total_tweets " . substr($full_message, $index, $index + $tweet_length));
		$index += 140;
		$current_tweet++;
  }
}

function send_tweet($tweet) {
  $consumer_key = "aFvnBCs9aquCW6e4yIBCFQ";
  $consumer_secret = "8XiBwNj7Bt4RO16Gld5h7w6Cr9Otjacfr2iSOgT6kQ";
  $oauth_token = "262316750-MIxCJUQw1rkysYNu7w9fzK08mNO8XXzTc2CGDSNi";
  $oauth_token_secret = "zDPW0shznHl7XPVad4AoXyXAxvSX6IPnOEqL7M4";
  
  $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
  $connection->post('statuses/update', array('status' => $tweet));
  
	}
?>
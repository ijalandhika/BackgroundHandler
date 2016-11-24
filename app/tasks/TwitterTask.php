<?php 

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterTask extends \Phalcon\CLI\Task
{
	private $connection;
	private $CONSUMER_KEY;
	private $CONSUMER_SECRET;
	private $ACCESS_TOKEN;
	private $ACCESS_TOKEN_SECRET;

	public function InitializeConnection(){

		if(!isset($this->connection)){
			$this->CONSUMER_KEY 			= $this->config->twitter->consumer_key;
			$this->CONSUMER_SECRET 		= $this->config->twitter->consumer_secret;
			$this->ACCESS_TOKEN 			= $this->config->twitter->access_token;
			$this->ACCESS_TOKEN_SECRET 	= $this->config->twitter->access_token_secret; 
			$this->connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $this->ACCESS_TOKEN, $this->ACCESS_TOKEN_SECRET);
			
		}

		return $this->connection;
	}

	public function TwitterUser($username){

		$statuses = $this->connection->get("users/search", ["q" => $username, "count" => 3]);
		print_r($statuses);

	}

	protected function DefinedDataUsed(){
		// to do defined detail data who want to insert into db
	}
}
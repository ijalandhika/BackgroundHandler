<?php 

class InstagramTask extends \Phalcon\CLI\Task
{
	/*
	*
	*/
	private $userId;

	private $userName;

	private $instagram;

	// public function initialize($username){
	// 	$this->userName = $username;
	// 	if(is_null($this->userId)){
	// 		$this->InstagramUser($this->userName);
	// 	}
	// }

	public function InstagramUser($userName){
		if(is_null($userName) || empty($userName)) throw new Exception("Username must be filled", 1);

		$url = $this->config->instagram->api_url.'users/search?q='.$userName.'&access_token='.$this->config->instagram->access_token;		
		$users = (new CommonFunc())->CurlLink($url);

		if($users['status'] == '1'){
			foreach ($users['data'] as $key => $value) {
				$this->InstagramMedia($value['id']);
			}	

			return;
		}

		// to do handle invalid token
	}

	protected function InstagramMedia($id){
		if(is_null($id) || empty($id)) throw new Exception("id must be filled", 1);
		$url = $this->config->instagram->api_url.'users/'.$id.'/media/recent?count=10&access_token='.$this->config->instagram->access_token;	
		$medias = (new CommonFunc())->CurlLink($url);

		// to do insert to databases
		print_r($medias);
	}	

	protected function DefinedDataUsed(){
		// to do defined detail data who want to insert into db
	}
}
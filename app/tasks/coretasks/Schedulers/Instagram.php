<?php 
namespace CoreTasks\Schedulers;
/**
 * Scheduler to get data from instagram
 *
 * php cli.php scheduler main task=instagram username=ijalandhika
 */
use CoreTasks\CoreTask;

class Instagram extends CoreTask
{
	private $username;


	public function Invoke()
	{
		$this->InitializeParams();
		$this->InstagramUser();
		
	}

	private function InstagramUser()
	{
		$url = $this->config->instagram->api_url.'users/search?q='.$this->username.'&access_token='.$this->config->instagram->access_token;		
		$users = $this->CurlLink($url);

		if($users['status'] == '1'){
			foreach ($users['data'] as $key => $value) {
				$this->InstagramMedia($value['id']);
			}	

			return;
		}
	}

	private function InstagramMedia($userid)
	{
		$url = $this->config->instagram->api_url.'users/'.$userid.'/media/recent?count=10&access_token='.$this->config->instagram->access_token;	
		$medias = $this->CurlLink($url);

		// to do insert to databases
		$x = new NsqPublisher();
		$x->PushToNsq($medias);
		//print_r($this->composer);//die;
	}

	protected function DefinedDataUsed($data){
		// to do defined detail data who want to insert into db
		
	}

	private function InitializeParams()
	{
		if(count($this->params) > 0)
		{
			foreach ($this->params as $key => $value) {
				if(strtoupper($key) =='USERNAME'){$this->username = $value;}
			}
		}
	}
}
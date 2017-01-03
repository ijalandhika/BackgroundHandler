<?php 
namespace CoreTasks\Process;
/**
 * Scheduler to get data from instagram
 *
 * php cli.php scheduler main task=instagram username=ijalandhika
 */
use CoreTasks\CoreTask;
use CoreTasks\Models;
use \Elasticsearch\ClientBuilder;

class ElasticSearch extends CoreTask
{	
	public function Invoke()
	{
		$dataModel = (new \CoreTasks\Models\InstagramModel())->SetPayload($this->params['detail']);
		$client = ClientBuilder::create()->build();
		$params = [
		    'index' => 'jalanjalan',
		    'type' => 'instagramcrawler',
		    'id' => $dataModel['id'],
		    'body' => $dataModel
		];

		$response = $client->index($params);
		print_r($response);
	}
}
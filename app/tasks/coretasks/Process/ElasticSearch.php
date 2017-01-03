<?php 
namespace CoreTasks\Process;
/**
 * Scheduler to get data from instagram
 *
 * php cli.php scheduler main task=instagram username=ijalandhika
 */
use CoreTasks\CoreTask;
use CoreTasks\Models;

class ElasticSearch extends CoreTask
{	
	public function Invoke()
	{
		$model = (new \CoreTasks\Models\InstagramModel())->SetPayload($this->params['detail']);
		print_r($model);
	}
}
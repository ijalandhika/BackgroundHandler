<?php 
namespace CoreTasks\Schedulers;

use CoreTasks\CoreTask;

/***
* Publisher to NSQ
***/
class NsqPublisher extends CoreTask
{
	public function Invoke(){}

	public function PushToNsq($message){
		$message = json_encode($message);
		$nsq = new \nsqphp\nsqphp;
    	$nsq->publishTo(array('nsqserver1'))
	        ->publish('mytopic', new \nsqphp\Message\Message($message));
	}
}
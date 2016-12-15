<?php 
namespace CoreTasks\Schedulers;
/**
 * Subsriber for NSQ
 *
 * php cli.php scheduler main task=nsq.subscriber
 */
use CoreTasks\CoreTask;


class NsqSubscriber extends CoreTask
{
	public function Invoke()
	{
		$lookup = new \nsqphp\Lookup\Nsqlookupd;
	    $nsq = new \nsqphp\nsqphp($lookup);
	    $nsq->subscribe('mytopic', 'somechannel', function ($msg){	    	
        	// to do process to db
        	print_r($msg->getPayload());
        	echo "\n";

	    })->run();
	}
}
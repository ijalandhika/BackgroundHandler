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
        	$payload = json_decode($msg->getPayload(),true);
        	$this->Process($payload);
        	
	    })->run();
	}

	private function Process($payload)
	{
    	$studly = function($str){
            $str = ucwords(str_replace('.', ' ', trim($str)));
            return str_replace(' ', '', $str);
        };

        $coreTask = 'CoreTasks\Process\\'.$studly($payload['task']);
        if (!class_exists($coreTask))
        {
            echo " ~> undefined task {$coreTask}\n";
            return 1;
        }
        $coreTask = new $coreTask();
        if (!$coreTask instanceof \CoreTasks\CoreTask) {
            echo " ~> task must be instance of CoreTasks\\CoreTask\n";
            return 1;
        }
        $coreTask->_setParams($payload);
        return $coreTask->Invoke();
	}
}
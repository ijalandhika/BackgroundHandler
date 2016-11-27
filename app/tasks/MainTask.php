<?php

class MainTask extends \Phalcon\CLI\Task
{
    public function mainAction() {
         echo "\nThis is the default task and the default action \n";
    }

    public function grabInstagramAction(array $params){
    	$instagram = new InstagramTask();
    	$instagram->InstagramUser($params[0]);
    }

    public function grabTwitterAction(array $params){
    	$twitter = new TwitterTask();
    	$twitter->InitializeConnection();
    	$twitter->TwitterUser($params[0]);
    }

    public function postToElasticAction(){

    }

    public function PublishNSQAction(){
    	 $nsq = new nsqphp\nsqphp;
    	 $nsq->publishTo(array('nsqserver1'))
	        ->publish('mytopic', new nsqphp\Message\Message('some message payload'));
    }

    public function SubscriberAction(){
    	$lookup = new nsqphp\Lookup\Nsqlookupd;
	    $nsq = new nsqphp\nsqphp($lookup);
	    $nsq->subscribe('mytopic', 'somechannel', function($msg) {
        	print_r($msg->getPayload());
        	echo "\n";
        })->run();
    }

    private function msgCallback($msg)
    {
        print_r($msg->getId());
        echo "\n" ;
    }
}
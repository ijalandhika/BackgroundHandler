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
}
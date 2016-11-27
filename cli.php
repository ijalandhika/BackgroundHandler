<?php 
use Phalcon\CLI\Console as ConsoleApp;

const APP_DIR = __DIR__;

$composer = require('vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(APP_DIR);
$dotenv->load();

//$config = include(APP_DIR . "/config/config.php");
require_once APP_DIR . "/config/loader.php";


//Create a console application
$console = new ConsoleApp();
$console->setDI($di);


/**
 * Process the console arguments
*/
$arguments = array();
foreach($argv as $k => $arg) {
    if($k == 1) {
        $arguments['task'] = $arg;
    } elseif($k == 2) {
        $arguments['action'] = $arg;
    } elseif($k >= 3) {
       $arguments[] = $arg;
    }
}

try {
    // handle incoming arguments
    $console->handle($arguments);
}
catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
    exit(255);
}
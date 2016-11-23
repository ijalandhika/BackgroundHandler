<?php 

use Phalcon\DI\FactoryDefault\CLI as CliDI,
     Phalcon\CLI\Console as ConsoleApp;

$di = new CliDI();



/**
  * Register the autoloader and tell it to register the tasks directory
  */
 $loader = new \Phalcon\Loader();
 $loader->registerDirs(
     array(
     	realpath(__DIR__ . "/../app/tasks/"),
     	realpath(__DIR__ . "/../app/libraries/"),
     	realpath(__DIR__ . "/../app/models/")
     )
 );
 $loader->register();


 // Load the configuration file (if any)
 if(is_readable(__DIR__ . '/../config/config.php')) {
     $config = include __DIR__ . '/../config/config.php';
     $di->set('config', $config);
 }
<?php 

return new \Phalcon\Config(array(
	'environment' => getenv('ENVIRONMENT'),
	'version' 	=> getenv('VERSION'),
	'instagram' => array(
		'api_url' 		=> getenv('API_URL'),
		'access_token' 	=> getenv('ACCESS_TOKEN')
	) 
));
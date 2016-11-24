<?php 

return new \Phalcon\Config(array(
	'environment' => getenv('ENVIRONMENT'),
	'version' 	=> getenv('VERSION'),
	'instagram' => array(
		'api_url' 		=> getenv('API_URL'),
		'access_token' 	=> getenv('ACCESS_TOKEN')
	),
	'twitter'	=> array(
		'consumer_key' 		=> getenv('CONSUMER_KEY'),
		'consumer_secret'	=> getenv('CONSUMER_SECRET'),
		'access_token'		=> getenv('ACCESS_TOKEN_T'),
		'access_token_secret' => getenv('ACCESS_TOKEN_SECRET')
	) 
));
<?php 
	//Define server
	DEFINE('HOST', 'localhost');
	DEFINE('NAME_DB', 'rack_models');
	DEFINE('USER', 'root');
	DEFINE('PASS', '12345678');

	//Define status
	DEFINE('FAIL', 'FAIL');
	DEFINE('SUCCESS', 'SUCCESS');

	//Define message
	DEFINE('MESS_DATA', 'Load data successful.');
	DEFINE('MESS_UPDATE', 'Update data successful.');

	DEFINE('MESS_ERR_DATA', 'Load data fail.');
	DEFINE('MESS_ERR_UPDATE', 'Update data fail');
	DEFINE('MESS_ERR_ID', 'ID Not working');

	//Value param
	DEFINE('ADAPTER', 'adapter');
	DEFINE('DOCUMENT', 'document');


	$url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	$index = strpos($url, '?');
	if($index > 0){
		$url = substr($url, 0, $index);
	}
	DEFINE('DOMAIN', $url);

?>
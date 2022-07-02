<?php 

$db['db_host'] = getenv('DB_HOST');
$db['db_user'] = getenv('DB_USER');
$db['db_pass'] = getenv('DB_PASS');
$db['db_name'] = getenv('DB_NAME');

foreach($db as $key => $value){ // looping variables
	define(strtoupper ($key), $value);
}
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connect){
	die("error=>402".mysqli_connect($connect));
}

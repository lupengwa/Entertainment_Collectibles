<?php
$db_username = 'root';
$db_password = '900125';
$db_name = 'websale';
$db_host = 'cs-server.usc.edu:9580';
$con=mysql_connect($db_host,$db_username,$db_password);
if(!$con) {
		die ("unable to connect the server");
	}
$db=mysql_select_db('websale',$con);
if(!$db){
	die ("unable to select the database");
}

?>
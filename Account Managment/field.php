<?php
session_start();
$time = time();
if(!isset($_SESSION['username']) && !isset($_SESSION['usertype'])) {
	require 'prelogin.html';
	echo '<p style="color:red"> Please Login First</p>';
	require 'postlogin.html';
	
} elseif($_SESSION['usertype'] != "Manager") {
	require 'prelogin.html';
	echo '<p style="color:red"> Wrong UserType!</p>';
	require 'postlogin.html';
}elseif(($time - $_SESSION['start']) > 500) {
	require 'prelogin.html';
	echo '<p style="color:red"> Timeout</p>';
	require 'postlogin.html';
	session_destroy();
} 
$field = $_GET['field'];
$_SESSION['field']=$field;

$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
if(!$con) {
		die ("unable to connect the server");
	}
mysql_select_db('websale',$con);
$sql="select ".$field." from ".$_SESSION['table'];
$res = mysql_query($sql);
echo "<select name= 'item' onChange=showItem(this.value)>";
$counter=0;
while($row=mysql_fetch_assoc($res)){
	if($counter==0) {
		echo "<option value=''>Select a field</option>";
		$counter=$counter+1;
	}else {
		echo "<option value=".$row[$field].">".$row[$field]."</option>";
	}
}
echo "</select>";


?>
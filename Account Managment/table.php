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

$q = $_GET['q'];
$_SESSION['table']=$q;

$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
if(!$con) {
		die ("unable to connect the server");
	}
mysql_select_db('websale',$con);

$sql="show columns in $q";
$res = mysql_query($sql);
echo "<select name= 'field' onChange=showField(this.value)>";
$counter=0;
while($row=mysql_fetch_assoc($res)){
	if($counter==0) {
		echo "<option value=''>Select a Field</option>;";
		$counter=$counter+1;
	}
	echo "<option value='".$row['Field']."'>".$row['Field']."</option>;";
}
echo "</select>";


?>
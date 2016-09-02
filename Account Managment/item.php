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
$Item = $_GET['Item'];
$table=$_SESSION['table'];
$field=$_SESSION['field'];

$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
if(!$con) {
		die ("unable to connect the server");
	}
mysql_select_db('websale',$con);
$sql="show columns in $table";
$res=mysql_query($sql);
echo "<table id=table style='width:100%'>
	  <tr>";
$counter=0;
while($th=mysql_fetch_assoc($res)) {
	echo "<th>".$th['Field']."</th>";
	$array[$counter]=$th['Field']; 
	$counter = $counter+1;
}
echo "</tr>";

$size=count($array);
$sql="select * from ".$table." where ".$field." like '%".$Item."%'";
echo $sql;
$res=mysql_query($sql);
$row = mysql_fetch_assoc($res);	
echo "<tr>";
for($x=0; $x<$size; $x++){
	echo "<th>".$row[$array[$x]]."</th>";
}
echo "</tr>";





?>
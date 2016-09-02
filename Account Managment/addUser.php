<?php
session_start();
require "pre.html";
$time = time();
if(!isset($_SESSION['username']) && !isset($_SESSION['usertype'])) {
	require 'prelogin.html';
	echo '<p style="color:red"> Please Login First</p>';
	require 'postlogin.html';
	
} elseif($_SESSION['usertype'] != "Admin") {
	require 'prelogin.html';
	echo '<p style="color:red"> Wrong UserType!</p>';
	require 'postlogin.html';
}elseif(($time - $_SESSION['start']) > 500) {
	require 'prelogin.html';
	echo '<p style="color:red" id="error"> Timeout</p>';
	require 'postlogin.html';
	session_destroy();
} 

//check completed
else {
$un=$_POST['username'];
$pw=$_POST['password'];
$type=$_POST['usertype'];
$message="";
if(strlen($un)==0 && strlen($pw)==0 && strlen($type)==0){
	require 'addUser.html';
} else {
	$sql ="insert into user (usertype, username,password) values('".$type."','".$un."','".$pw."');";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	$res = mysql_query($sql);
	if(!$res) {
		echo "Error in inserting";
	}
   require 'addUser.html';
}
echo "<form  id='admin' action='Admin.php'>
		<input type='submit' value='Admin Page'>
		</form>";

}
require "post.html";
?>
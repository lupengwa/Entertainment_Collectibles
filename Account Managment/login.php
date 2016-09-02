<?php
session_start();
if(isset($_POST['submit'])) {
	session_destroy();
	session_start();
}
$_SESSION['start']=time();
$un=$_POST['username'];
$pw=$_POST['password'];
$errmsg= "";
if(strlen($un) == 0) {
	$errmsg = "Invalid login";
}
if(strlen($pw) == 0) {
	$errmsg ="Invalid login";
}
if(strlen($un)==0 && strlen($pw)==0) {
	$errmsg = "";
}
$usertype="";
if(strlen($un)>0 && strlen($pw)>0) {
	$sql ="select usertype from user where username='".$un."' and password='".$pw."' ;";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	$res = mysql_query($sql);
	if(!($row = mysql_fetch_assoc($res))){
		$errmsg = "No matched user information found";
	} else {
		$usertype = $row['usertype'];
	}
}

if(strlen($errmsg)>0) {
	require 'prelogin.html';
	echo '<p id="error" style="color:red" position >'.$errmsg.'</p>';
	require 'postlogin.html';
}elseif(!$res) {
	require 'prelogin.html';
	require 'postlogin.html';
}else {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['usertype'] = $usertype;
	if($usertype === "Admin") {
		require 'Admin.php';
	} elseif( $usertype === 'Employee') {
		require 'Employee.php';
	}else {
		require 'Manager.html';
	}	
}
?>  



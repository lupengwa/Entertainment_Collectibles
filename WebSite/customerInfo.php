<?php
session_start();
$time = time();
require "config.php";
$sql="select * from customer where username='".$_SESSION['username']."' AND password='".$_SESSION['password']."';";
$res=mysql_query($sql);
if(!$res){
	require 'Pre_saleWeb.html';
	echo '<p style="color:red"> Please Login First</p>';
	require 'Post_saleWeb.html';
	session_destroy();
}	
 elseif(($time - $_SESSION['start']) > 500) {
	require 'prelogin.html';
	echo '<p style="color:red" id="error"> Timeout</p>';
	require 'postlogin.html';
	session_destroy();
} 

else {
	if($row=mysql_fetch_array($res)){
		echo "First Name: ".$row['firstName']."<br>Last Name: ".$row['lastName']."<br> Billing Address: ".$row['billStreetNum']." ".$row['billStreet'].
		" Apt:".$row['billAPT'].",".$row['billCity']." ".$row['billState']." ".$row['billZip']."<br> Shipping Address: ".$row['shipStreetNum']." ".$row['shipStreet'].
		" Apt:".$row['shipAPT'].",".$row['shipCity']." ".$row['shipState']." ".$row['shipZip']."<br>Email: ".$row['email']."<br>Phone: ".$row['phone']."<br>username: ".
		$row['username']."<br>password: ".$row['password']."<br>Card Information<br>Card Number: ".$row['cardNumber']." Month: ".$row['cardMonth'].
		" Year: ".$row['cardYear']." Security Number: ".$row['security'];
	}

}

?>

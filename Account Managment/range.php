<?php
session_start();

require "preManager.html";
$from=$_POST['priceFrom'];
$to=$_POST['priceTo'];
$submit=$_POST['submit'];
$payFrom=$_POST['payFrom'];
$payTo=$_POST['payTo'];

$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
if($submit=="price"){
	$sql="show columns in Product";
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
	$sql ="select * from Product where productPrice between ".$from." AND ".$to;
	$res = mysql_query($sql);
	echo "<tr>";
	while($row=mysql_fetch_assoc($res)){
		for($x=0; $x< $size; $x++){
			echo "<th>".$row[$array[$x]]."</th>";
		}
		echo "</tr>";
	}
} 

if($submit=="pay") {
	$sql="show columns in Employee";
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
	$sql ="select * from Employee where Pay between ".$payFrom." AND ".$payTo;
	$res = mysql_query($sql);
	echo "<tr>";
	while($row=mysql_fetch_assoc($res)){
		for($x=0; $x< $size; $x++){
			echo "<th>".$row[$array[$x]]."</th>";
		}
		echo "</tr>";
	}

}
		
	

require 'postManager.html';




?>
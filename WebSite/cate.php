<?php
session_start();


require "config.php";
$sql="select * from ProductCategory";
$res=mysql_query($sql);
$count=0;
while($row=mysql_fetch_array($res)){
	$array[$count]=$row['proCateId'];
 	$count++;
 	$array[$count]=$row['proCateName'];
 	$count++;
}
echo json_encode($array);
?>
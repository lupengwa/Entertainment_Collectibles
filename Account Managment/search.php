<?php
session_start();
$time = time();
require "config.php";
$sql="select * from customer where username='".$_SESSION['username']."' AND password='".$_SESSION['password']."';";
$res=mysql_query($sql);
if(!$res){
	require 'Pre_saleWeb.html';
	echo '<p style="color:red"> Please Login </p>';
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

$content=$_GET['content'];
$cate=str_replace('"',"",$_GET['cate']);

require "config.php";

if(!isset($content) && !isset($cate)){
	echo "Please select a category or enter the items in search field"; 
} else if(!isset($content) && isset($cate)){
	$sql="select * from Product where productCategoryId like '%".$cate."%';";
	$res=mysql_query($sql);
	if(!$res){
		die("The sql command has error");
	} else{
		while($row=mysql_fetch_array($res))
        {
			echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
			echo '<div class="product-thumb"><img src='.$row['productImage'].'"></div>';
            echo '<div class="product-content"><h3>'.$row['productName'].'</h3>';
            echo '<div class="product-desc">'.$row['productDescription'].'</div>';
            echo '<div class="product-info">';
			echo 'Price '.$row['productPrice'].' | ';
            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
			echo '<button class="add_to_cart">Add To Cart</button>';
			echo '</div></div>';
            echo '</form>';
            echo '</div>';
        }
	}
}else {
	$sql="select * from Product where productName like '%".$content."%';";
	$res=mysql_query($sql);
	if(!$res){
		die("The sql command has error");
	} else{
       $row=mysql_fetch_array($res);
		if (!$row){
			echo "Sorry, we didn't find any product matched";
		} else {
			echo $row['productName'];
		}
	}
}
}

?>
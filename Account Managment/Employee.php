<?php

session_start();
// veryfy time and user information
$time = time();
require "pre.html";
if(!isset($_SESSION['username']) && !isset($_SESSION['usertype'])) {
	require 'prelogin.html';
	echo '<p style="color:red"> Please Login First</p>';
	require 'postlogin.html';
	
} elseif($_SESSION['usertype'] != "Employee") {
	require 'prelogin.html';
	echo '<p style="color:red"> Wrong UserType!</p>';
	require 'postlogin.html';
}elseif(($time - $_SESSION['start']) > 500) {
	require 'prelogin.html';
	echo '<p style="color:red"> Timeout</p>';
	require 'postlogin.html';
	session_destroy();
} 
// Main Admin Page
else {
	echo "Edit Product Table:<br>
	<form id= 'product' action='addProduct.php' method='POST'>
	<input type='submit' name='submit' value='add'>
	</form>
	<form id='delete_change' action='change_delete_product.php' method='POST'>
	<input type='submit' name='submit' value='change'>
	<input type='submit' name ='submit' value='delete'>
	</form><br>";

	echo "Edit Product Category Table:<br>
	<form id= 'productCate' action='addCategory.php' method='POST'>
	<input type='submit' name='submit' value='add'>
	</form>
	<form id='delete_change' action='change_delete_Category.php' method='POST'>
	<input type='submit' name='submit' value='change'>
	<input type='submit' name ='submit' value='delete'>
	</form><br>";

	echo " Edit Special Sale Table:<br>
	<form id= 'specialSale' action='addSpecial.php' method='POST'>
	<input type='submit' name='submit' value='add'>
	</form>
	<form id='delete_change' action='change_delete_special.php' method='POST'>
	<input type='submit' name='submit' value='change'>
	<input type='submit' name ='submit' value='delete'>
	</form><br><br>";

	echo "<form id= 'logout' action='login.php' method='POST'>
		<input type='submit' name='submit' value='logout'>
	</form>";
	
	
}
require "post.html";

?>
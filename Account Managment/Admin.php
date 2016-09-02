<?php

session_start();
// veryfy time and user information

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
	echo '<p style="color:red"> Timeout</p>';
	require 'postlogin.html';
	session_destroy();
} 
// Main Admin Page
else {
	echo "Edit User Table:
	<form id= 'add' action='addUser.php' method='POST'>
	<input type='submit' name='submit' value='add'>
	</form>
	<form id='delete_change' action='change_delete_user.php' method='POST'>
	<input type='submit' name='submit' value='change'>
	<input type='submit' name ='submit' value='delete'>
	</form><br>";

	echo "Edit Employee Table:
	<form id= 'add' action='addEmployee.php' method='POST'>
	<input type='submit' name='submit' value='add'>
	</form>
	<form id='delete_change' action='change_delete_employee.php' method='POST'>
	<input type='submit' name='submit' value='change'>
	<input type='submit' name ='submit' value='delete'>
	</form><br><br>";

	
	echo "<form id= 'logout' action='login.php' method='POST'>
		<input type='submit' name='submit' value='logout'>
	</form>";

require "post.html";
	
}


?>




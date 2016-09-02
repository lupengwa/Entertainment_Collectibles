<?php
session_start();
$time = time();
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

//check completed
else {
	echo "<form  action='Employee.php' method='POST'>
	<input type='submit' value='Employee Page'>
	</form>";
$name=$_POST['proCateName'];
$des=$_POST['proCateDes'];

if(strlen($name)==0 && strlen($des)==0) {
	require 'addCategory.html';
} else {
	$sql ="insert into ProductCategory (proCateName,proCateDes) values('".$name."','".$des."');";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	$res = mysql_query($sql);
	if(!$res) {
		echo "Error in inserting";
	}
   require 'addCategory.html';
}

}
?>
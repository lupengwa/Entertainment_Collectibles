<?php
session_start();
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

//check completed
else {
	echo "<form  action='Employee.php'>
		<input type='submit' value='Employee Page'>
		</form>";

	$proId=$_POST['proId'];
	$dateStart=$_POST['dateStart'];
	$dateEnd=$_POST['dateEnd'];
	$perOff=$_POST['perOff'];
	$fix =$_POST['fix'];

	
    $con = mysql_connect('cs-server.usc.edu:9580','root','900125');
    if(!$con) {
		die ("unable to connect the server");
    }
	mysql_select_db('websale',$con);
	
	if(strlen($proId)==0 && strlen($dateStart)==0 && strlen($dateEnd)==0 && strlen($perOff)==0 && strlen($fix)==0) {
		$sql="select * from Product;";
		$res = mysql_query($sql);
		if(!$res) {
		echo "Error in inserting";
		}

		echo "<form id='user' action='addSpecial.php' method='POST' onsubmit='return checkSpecial(this)' >
		<h1> Add a Special Sale</h1>
		Select a product:<br>
		<select name='proId'>";
		while($row = mysql_fetch_assoc($res)) {
			echo $row['productId'];
			echo "<option value='".$row['productId']."'>".$row['productName']."</option>";
		}
		echo "</select><br><br>
		Start Date: 
		<input type='date' class='adduser_input' name ='dateStart' required> <br>
		End Date: 
		<input type='date' class='adduser_input' name='dateEnd' required> <br>
		Percentage Off(%):
		<input type='number' class='adduser_input' name='perOff' required> <br>
		Fixed Amount Off:
		<input type='number' class='adduser_input' name='fix' required> <br>
		<input type='submit' class='adduser_input' value = 'Submit'>
		</form>	";
} else {
	$sql ="insert into specialSale (proId,dateStart,dateEnd,PercentageOff,FixedOff) values('".$proId."','".$dateStart."','".$dateEnd."','".$perOff."','".$fix."');";
	$res = mysql_query($sql);
	if(!$res) {
		echo "product already exist";
	}

	$sql="select * from Product;";
		$res = mysql_query($sql);
		if(!$res) {
		echo "Error in inserting";
		}

   	echo "<form id='user' action='addSpecial.php' method='POST' onsubmit='return checkSpecial(this)'>
	<h1> Add a Special Sale</h1>
	Select a product:<br>
	<select name='proId'>";
	while($row = mysql_fetch_assoc($res)) {
		echo "<option value='".$row['productId']."'>".$row['productName']."</option>";
	}
	echo "</select><br><br>
	Start Date: 
	<input type='date' class='adduser_input' name ='dateStart' required> <br>
	End Date: 
	<input type='date' class='adduser_input' name='dateEnd' required> <br>
	Percentage Off(%):
	<input type='number' class='adduser_input' name='perOff' required> <br>
	Fixed Amount Off:
	<input type='number' class='adduser_input' name='fix' required> <br>
	<input type='submit' class='adduser_input' value = 'Submit'>
	</form>	";
}

}
require "post.html";
?>
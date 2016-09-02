<?php
session_start();
// veryfy time and user information
echo "<form action='Admin.php' method='POST'>
		<input type='submit' value='Admin Page'>
		</form>"; 
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

else {
//check completed

// variable passed	
$type=$_POST['type'];
$pay=$_POST['pay'];
$first=$_POST['first'];
$last=$_POST['last'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$userid=$_POST['userid'];


//connect to the database

$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
if(!$con) {
		die ("unable to connect the server");
}
mysql_select_db('websale',$con);



//First time login
if(strlen($type)==0 && strlen($pay)==0 && strlen($first)==0 && strlen($last)==0 && strlen($phone)==0 && strlen($email)==0 && strlen($userid)==0) {

	 $sql="select * from user;";
		 $res = mysql_query($sql);
		 if(!$res) {
		echo "Error in inserting";
		}


	echo "<form id='user' action='addEmployee.php' method='POST' enctype='multipart/form-data'>
	<h1> Add an Employee</h1>
	Select a userid:<br>
	<select name='userid'>";
	while($row = mysql_fetch_assoc($res)) {
			echo "<option value='".$row['userId']."'>".$row['username']."</option>";
	}
	echo "</select><br><br>
	Employee Type:
	<select name='type'>
	<option value='entry'>Entry</option>
	<option value='sophomore'>Sophomore</option>
	<option value='junior'>Junior</option>
	<option value='senior'>Senior</option>
	<option value='manager'>Manager</option>
	</select><br><br>
	First Name: <input type='text' class='adduser_input' name ='first'> <br><br>
	Last Name: <input type='text' class='adduser_input' name ='last'> <br><br>
	Pay:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type='number' class='adduser_input' name='pay'> <br><br>
	Phone:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type='text' class='adduser_input' name ='phone'> <br><br>
	Email:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type='text' class='adduser_input' name ='email'> <br><br>
    <input type='submit' value='submit' name='submit'>
    </form>";
   
	}
	else if($_POST['submit'] == "submit") {
    	$sql="insert into Employee (EmployeeType,Pay,FirstName,LastName,Phone,Email,userId1) values('".$type."','".$pay."','".$first."','".$last."','".$phone."','".$email."','".$userid."');";
		 $res = mysql_query($sql);
		 if(!$res) {
			echo "Error in inserting";
		 }

		 $sql="select * from user;";
		 $res = mysql_query($sql);
		 if(!$res) {
		echo "Error in inserting";
		}
		 //Show insert interface
		echo "<form id='user' action='addEmployee.php' method='POST' enctype='multipart/form-data'>
		<h1> Add an Employee</h1>
		Select a userid:<br>
		<select name='userid'>";
		while($row = mysql_fetch_assoc($res)) {
			echo "<option value='".$row['userId']."'>".$row['username']."</option>";
		}
		echo "</select><br><br>
		Employee Type:
		<select name='type'>
		<option value='entry'>Entry</option>
		<option value='sophomore'>Sophomore</option>
		<option value='junior'>Junior</option>
		<option value='senior'>Senior</option>
		<option value='manager'>Manager</option>
		</select><br><br>
		First Name: <input type='text' class='adduser_input' name ='first'> <br><br>
		Last Name: <input type='text' class='adduser_input' name ='last'> <br><br>
		Pay:<input type='number' class='adduser_input' name='pay'> <br><br>
		Phone:<input type='text' class='adduser_input' name ='phone'> <br><br>
		Email:<input type='text' class='adduser_input' name ='email'> <br><br>
    	<input type='submit' value='submit' name='submit'>
    	</form>";
  		}
    	  

    	  else {

    	  	 $sql="select * from user;";
		 	$res = mysql_query($sql);
		 	if(!$res) {
				echo "Error in inserting";
			}



    	 	echo "<form id='user' action='addEmployee.php' method='POST' enctype='multipart/form-data'>
	<h1> Add an Employee</h1>
	Select a userid:<br>
	<select name='userid'>";
	while($row = mysql_fetch_assoc($res)) {
			echo "<option value='".$row['userId']."'>".$row['username']."</option>";
	}
	echo "</select><br><br>
	Employee Type:
	<select name='type'>
	<option value='entry'>Entry</option>
	<option value='sophomore'>Sophomore</option>
	<option value='junior'>Junior</option>
	<option value='senior'>Senior</option>
	<option value='manager'>Manager</option>
	</select><br><br>
	First Name: <input type='text' class='adduser_input' name ='first'> <br><br>
	Last Name: <input type='text' class='adduser_input' name ='last'> <br><br>
	Pay:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type='number' class='adduser_input' name='pay'> <br><br>
	Phone:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type='text' class='adduser_input' name ='phone'> <br><br>
	Email:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type='text' class='adduser_input' name ='email'> <br><br>
    <input type='submit' value='submit' name='submit'>
    </form>";
    	}
    	 
	
	
}
require "post.html";
?>
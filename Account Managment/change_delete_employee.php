<?php
session_start();
require "pre.html";
echo "<form action='Admin.php' method='POST'>
		<input type='submit' value='Admin Page'>
		</form>"; 
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
	$command=$_POST['submit'];
	$c_or_d=$_POST['delete_change'];
	$change_submit =$_POST['change_submit'];
	$type=$_POST['type'];
	$pay=$_POST['pay'];
	$first=$_POST['first'];
	$last=$_POST['last'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$userid=$_POST['userid'];
	$employee=$_POST['employee'];

	$sql ="select * from Employee";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	echo "<form action='change_delete_employee.php' method='POST'>";
	$res = mysql_query($sql);

	if($command == "delete") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='employee[]'  value=".$row['employeeId']."> Type: ".$row['EmployeeType']." Name: ".$row['FirstName']." ".$row['LastName']." Pay($): ".$row['Pay']."<br>";
		
		}
		echo "<input type='submit' name='delete_change' value='delete'>";
		echo "</form>";
		unset($_POST['submit']);

	} else if($command == "change") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='radio' name ='employee'  value=".$row['employeeId']."> Type: ".$row['EmployeeType']." Name: ".$row['FirstName']." ".$row['LastName']." Pay($): ".$row['Pay']."<br>";
		}
		echo "<input type='submit' name='delete_change' value='change'>";
		echo "</form";
		unset($_POST['submit']);
		echo "<form action='Admin.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		
	} else if($c_or_d == "delete"){
		if(isset($_POST['employee'])) {
			$employeeid = $_POST['employee'];
			foreach($employeeid as $id) {
				$sql="delete from Employee where employeeId=".$id.";";
				$res=mysql_query($sql);
			}
		} else {
			echo'<p style="color:red"> Please select at least one user!</p>';
		  }
		  $_POST=array();
		  echo "<form action='change_delete_employee.php' method='POST'>";
		  $sql ="select * from Employee";
		  $res=mysql_query($sql);
		  while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='employee[]'  value=".$row['employeeId']."> Type: ".$row['EmployeeType']." Name: ".$row['FirstName']." ".$row['LastName']." Pay($): ".$row['Pay']."<br>";
		
			}
			echo "<input type='submit' name='delete_change' value='delete'>";
			echo "</form>";
		  	echo "<form action='Admin.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} 
		else if($c_or_d == "change") {
			if(isset($_POST['employee'])){


				$sql="select * from Employee where employeeId=".$employee.";";
				$res=mysql_query($sql);
				if(!$res) {
					echo "Error in inserting";
				}
				if($row = mysql_fetch_assoc($res)){
					$userId=$row['userId1'];
				}
				$sql="select * from user;";
				$res=mysql_query($sql);
				echo "<form id='user' action='change_delete_employee.php' method='POST' enctype='multipart/form-data'>
				<h1> Change Employee Information</h1>
				Select a userid:<br>
				<select name='userid'>";
				while($row = mysql_fetch_assoc($res)) {
					if($row['userId'] == $userId){
						echo "<option value='".$row['userId']." selected'>".$row['username']."</option>";
					} else {
						echo "<option value='".$row['userId']."'>".$row['username']."</option>";
					}
					
				}

				$sql="select * from Employee where employeeId=".$employee.";";
				$res=mysql_query($sql);
				if(!$res) {
					echo "Error in inserting";
				}
				$row = mysql_fetch_assoc($res);
				echo "</select><br><br>
				Employee Type:
				<select name='type' required>";
				if($row['EmployeeType'] == "entry") {
					echo "<option value='entry' selected>Entry</option>
					<option value='sophomore'>Sophomore</option>
					<option value='junior'>Junior</option>
					<option value='senior'>Senior</option>
					<option value='manager'>Manager</option>";
				}
				if($row['EmployeeType'] == "sophomore") {
					echo "<option value='entry'>Entry</option>
					<option value='sophomore' selected>Sophomore</option>
					<option value='junior'>Junior</option>
					<option value='senior'>Senior</option>
					<option value='manager'>Manager</option>";
				}
				if($row['EmployeeType'] == "junior") {
					echo "<option value='entry'>Entry</option>
					<option value='sophomore'>Sophomore</option>
					<option value='junior' selected>Junior</option>
					<option value='senior'>Senior</option>
					<option value='manager'>Manager</option>";
				}
				if($row['EmployeeType'] == "senior") {
					echo "<option value='entry'>Entry</option>
					<option value='sophomore'>Sophomore</option>
					<option value='junior'>Junior</option>
					<option value='senior'selected>Senior</option>
					<option value='manager'>Manager</option>";
				}
				if($row['EmployeeType'] == "manager") {
					echo "<option value='entry'>Entry</option>
					<option value='sophomore'>Sophomore</option>
					<option value='junior'>Junior</option>
					<option value='senior'>Senior</option>
					<option value='manager' selected>Manager</option>";
				}	
				echo "</select><br><br>
				First Name: <input type='text' class='adduser_input' name ='first' value='".$row['FirstName']."'required> <br><br>
				Last Name: <input type='text' class='adduser_input' name ='last' value='".$row['LastName']."'required> <br><br>
				Pay:<input type='number' class='adduser_input' name='pay' value='".$row['Pay']."'> <br><br>
				Phone:<input type='text' class='adduser_input' name ='phone' value='".$row['Phone']."'required> <br><br>
				Email: <input type='text' class='adduser_input' name ='email' value='".$row['Email']."'required> <br><br>
				<input type='hidden' value='$employee' name='employee'>
    			<input type='submit' value='submit' name='change_submit'>
    			</form>";
			} else {
				echo "<p style='color:red'>Please choose one user</p>";
			}
			unset($_POST['change_submit']);
			echo "<form action='Admin.php'>
			<input type='hidden' value='Admin Page'>
			</form>";
		} elseif($change_submit == "submit" ) {
			$sql ="update Employee set EmployeeType='".$type."',Pay='".$pay."',FirstName='".$first."',LastName='".$last."',Phone='".$phone."',Email='".$email."',userId1='".$userid."'where employeeId ='".$employee."';";
			$res=mysql_query($sql);
			$sql="select * from Employee;";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
			echo "<input type='radio' name ='employee'  value=".$row['employeeId']."> Type: ".$row['EmployeeType']." Name: ".$row['FirstName']." ".$row['LastName']." Pay($): ".$row['Pay']."<br>";
			}
			echo "<input type='submit' name='delete_change' value='change'>";
			echo "</form";
			unset($_POST['delete_change']);
			echo "<form action='Admin.php'>
			<input type='hidden' value='Admin Page'>
			</form>";
		} 
		else {
			echo "<form action='Admin.php'>
			<input type='hidden' value='Admin Page'>
			</form>";
		}
		
}
require "post.html";
?>
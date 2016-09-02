<?php
session_start();
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

//start to change or delete data;

else {
	echo "<form action='Admin.php' method='POST'>
		<input type='submit' value='Admin Page'>
		</form>";
	$command=$_POST['submit'];
	$c_or_d=$_POST['delete_change'];
	$change_submit =$_POST['change_submit'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$usertype=$_POST['usertype'];
	$userid=$_POST['user'];

	$sql ="select * from user";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	echo "<form action='change_delete_user.php' method='POST'>";
	$res = mysql_query($sql);
	if($command == "delete") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='user[]'  value=".$row['userId']." >Id: ".$row['userId']." Type: ".$row['usertype']." username: ".$row['username']."<br>";
		
		}
		echo "<input type='submit' name='delete_change' value='delete'>";
		echo "</form>";
		unset($_POST['submit']);
		echo "<form action='Admin.php'>
			<input type='hidden' value='Admin Page'>
			</form>";

	} else if($command == "change") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='radio' name ='user'  value=".$row['userId'].">Id: ".$row['userId']." Type: ".$row['usertype']." username: ".$row['username']."<br>";
		}
		echo "<input type='submit' name='delete_change' value='change'>";
		echo "</form";
		unset($_POST['submit']);
		echo "<form action='Admin.php'>
			<input type='hidden' value='Admin Page'>
			</form>";
		
	} else if($c_or_d == "delete"){
		if(isset($_POST['user'])) {
			$userid = $_POST['user'];
			foreach($userid as $id) {
				$sql="delete from user where userId=".$id.";";
				$res=mysql_query($sql);
			}
		} else {
			echo'<p style="color:red"> Please select at least one user!</p>';
			}
			$_POST=array();
			echo "<form action='change_delete_user.php' method='POST'>";
			$sql ="select * from user";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
				echo "<input type='checkbox' name ='user[]'  value=".$row['userId'].">Id: ".$row['userId']." Type: ".$row['usertype']." username: ".$row['username']."<br>";
			}
			echo "<input type='submit' name='delete_change' value='delete'>";
			echo "</form>";
			echo "<form action='Admin.php'>
			<input type='hidden' value='Admin Page'>
			</form>";
		}
		else if($c_or_d == "change") {
			
			echo "<form action='change_delete_user.php' method='POST'>";
			$sql ="select * from user";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
				echo "<input type='radio' name ='user'  value=".$row['userId'].">Id: ".$row['userId']." Type: ".$row['usertype']." username: ".$row['username']."<br>";
		
			}
			echo "<input type='submit' name='delete_change' value='change'>";
			echo "</form>";
			if(isset($_POST['user'])) {
				$sql ="select * from user where userId=".$userid.";";
				$res=mysql_query($sql);
				if($row=mysql_fetch_assoc($res)) {
					echo "<form id = 'user' action='change_delete_user.php' method='POST'>
						<h1> Change User Information </h1>
						<select name='usertype'>";

						if($row['usertype'] == "Admin") {
							echo "<option value='0'>select user type</option>
							<option value='Admin' selected='selected'>administrator</option>
							<option value='Employee'>employee</option>
							<option value='Manager'>manager</option>
							</select><br><br>";
						} elseif($row['usertype'] == "Employee"){
							echo "<option value='0'>select user type</option>
							<option value='Admin'>administrator</option>
							<option value='Employee' selected='selected'>employee</option>
							<option value='Manager'>manager</option>
							</select><br><br>";
						} elseif($row['usertype'] == "Manager") {
							echo "<option value='0'>select user type</option>
							<option value='Admin'>administrator</option>
							<option value='Employee'>employee</option>
							<option value='Manager' selected='selected'>manager</option>
							</select><br><br>";
						} else {

						}
						echo "username: <input type='text' class='adduser_input' name ='username' value='".$row['username']."'required><br>"."password: <input type='text' class='adduser_input' name='password' value='".$row['password']."'required><br>"."
						<input type='submit' class='adduser_input' name='change_submit' value = 'submit'>
						<input type='hidden' name='user' value='".$userid."'>
						</form>";
				}

			} else {
				echo "<p style='color:red'>Please choose one user</p>";

			}
			unset($_POST['change_submit']);
			echo "<form action='Admin.php'>
			<input type='hidden' value='Admin Page'>
			</form>";
		}
		elseif($change_submit == "submit" ) {
			$sql ="update user set username='".$username."',usertype='".$usertype."',password='".$password."' where userId ='".$userid."'";
			$res=mysql_query($sql);	
			$sql ="select * from user";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
				echo "<input type='radio' name ='user'  value=".$row['userId'].">Id: ".$row['userId']." Type: ".$row['usertype']." username: ".$row['username']."<br>";
		
			}
			echo "<input type='submit' name='delete_change' value='change'>";
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
require 'post.html';
?>
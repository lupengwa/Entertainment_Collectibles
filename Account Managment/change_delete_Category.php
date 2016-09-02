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

//start to change or delete data;

else {

	echo "<form action='Employee.php'>
		<input type='submit' value='Employee Page'>
		</form>";
	$command=$_POST['submit'];
	$c_or_d=$_POST['delete_change'];
	$change_submit =$_POST['change_submit'];
	$name=$_POST['proCateName'];
	$des=$_POST['proCateDes'];
	$cateid=$_POST['category'];

	$sql ="select * from ProductCategory";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	echo "<form action='change_delete_Category.php' method='POST'>";
	$res = mysql_query($sql);
	if($command == "delete") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='category[]'  value=".$row['proCateId'].">".$row['proCateId']." ".$row['proCateName']." ".$row['proCateDes']."<br>";
		
		}
		echo "<input type='submit' name='delete_change' value='delete'>";
		echo "</form>";
		unset($_POST['submit']);

	} else if($command == "change") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='radio' name ='category'  value=".$row['proCateId'].">".$row['proCateId']." ".$row['proCateName']." ".$row['proCateDes']."<br>";
		}
		echo "<input type='submit' name='delete_change' value='change'>";
		echo "</form";
		unset($_POST['submit']);
		echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
	} else if($c_or_d == "delete"){
		if(isset($_POST['category'])) {
			$cateid = $_POST['category'];
			foreach($cateid as $id) {
				$sql="delete from ProductCategory where proCateId=".$id.";";
				$res=mysql_query($sql);
			}
		} else {
			echo'<p style="color:red"> Please select at least one Category!</p>';
			}
			$_POST=array();
			echo "<form action='change_delete_Category.php' method='POST'>";
			$sql ="select * from ProductCategory";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
				echo "<input type='checkbox' name ='category[]'  value=".$row['proCateId'].">".$row['proCateId']." ".$row['proCateName']." ".$row['proCateDes']."<br>";
			}
			echo "<input type='submit' name='delete_change' value='delete'>";
			echo "</form>";
		}
		else if($c_or_d == "change") {
			
			echo "<form action='change_delete_Category.php' method='POST'>";
			$sql ="select * from ProductCategory";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
				echo "<input type='radio' name ='category'  value=".$row['proCateId'].">".$row['proCateId']." ".$row['proCateName']." ".$row['proCateDes']."<br>";
			}
			echo "<input type='submit' name='delete_change' value='change'>";
			echo "</form>";
			if(isset($_POST['category'])) {
				$sql ="select * from ProductCategory where proCateId=".$cateid.";";
				echo $sql;
				$res=mysql_query($sql);
				if($row=mysql_fetch_assoc($res)) {
					echo "<form id = 'user' action='change_delete_Category.php' method='POST'>
						<h1> Change Category Information </h1>";
						
						echo "Category: <input type='text' class='adduser_input' name ='proCateName' value='".$row['proCateName']."' required><br>"."Description: <textarea rows='4' cols='50' class=adduser_input required>".$row['proCateDes']."</textarea><br>
						<input type='submit' class='adduser_input' name='change_submit' value = 'submit'>
						<input type='hidden' name='user' value='".$cateid."'>
						</form>";
				}

			} else {
				echo "<p style='color:red'>Please choose anuser information</p>";
			}
			unset($_POST['change_submit']);
			echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		}
		elseif($change_submit == "submit" ) {
			$sql ="update ProductCategory set proCateId='".$name."',proCateDes='".$des."'where proCateId ='".$cateid."'";
			$res=mysql_query($sql);	
			$sql ="select * from ProductCategory";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
				echo "<input type='radio' name ='category'  value=".$row['proCateId'].">".$row['proCateName']." ".$row['proCateDes']."<br>";
		
			}
			echo "<input type='submit' name='delete_change' value='change'>";
			unset($_POST['delete_change']);
			echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} 
		else {
			echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} 

	

} 
require "post.html";
?>
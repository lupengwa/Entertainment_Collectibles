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

else {
	echo "<form action='Employee.php' method='POST'>
	<input type='submit' value='Employee Page'>
	</form>";
	$command=$_POST['submit'];
	$c_or_d=$_POST['delete_change'];
	$change_submit =$_POST['change_submit'];
	$cateId=$_POST['cateId'];
	$name=$_POST['proName'];
	$des=$_POST['proDes'];
	$img=$_POST['proImage'];
	$price=$_POST['proPrice'];
	$amount=$_POST['proAmount'];
	$proId=$_POST['pro'];

	$sql ="select * from Product";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	echo "<form action='change_delete_product.php' method='POST'>";
	$res = mysql_query($sql);

	if($command == "delete") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='pro[]'  value=".$row['productId'].">Name: ".$row['productName']." Description:".$row['productDescription']." $".$row['productPrice']."<br>";
		
		}
		echo "<input type='submit' name='delete_change' value='delete'>";
		echo "</form>";
		unset($_POST['submit']);

	} else if($command == "change") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='radio' name ='pro'  value=".$row['productId'].">Name: ".$row['productName']." Description:".$row['productDescription']." $".$row['productPrice']."<br>";
		}
		echo "<input type='submit' name='delete_change' value='change'>";
		echo "</form";
		unset($_POST['submit']);
		echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		
	} else if($c_or_d == "delete"){
		if(isset($_POST['pro'])) {
			$proid = $_POST['pro'];
			foreach($proid as $id) {
				$sql="delete from Product where productId=".$id.";";
				$res=mysql_query($sql);
			}
		} else {
			echo'<p style="color:red"> Please select at least one user!</p>';
		  }
		  $_POST=array();
		  echo "<form action='change_delete_user.php' method='POST'>";
		  $sql ="select * from Product";
		  $res=mysql_query($sql);
		  while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='pro[]' value=".$row['productId'].">Name: ".$row['productName']." Description:".$row['productDescription']." $".$row['productPrice']."<br>";
		  }
		  echo "<input type='submit' name='delete_change' value='delete'>";
		  echo "</form>";
		  echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} 
		else if($c_or_d == "change") {
			include 'change_product.php';
			unset($_POST['change_submit']);
			echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} elseif($change_submit == "submit" ) {
			$fileName = $_FILES["fileToUpload"]["name"];
    	 	$fileTmpLoc = $_FILES["fileToUpload"]["tmp_name"];
		 	$pathAndName = "images/".$fileName;
		 	$uploadOk = 1;
		 	if (file_exists($pathAndName)) {
    			echo "Sorry, file already exists.";
    			$uploadOk = 0;
    		}
    	 	if($uploadOk== 1 && $result=move_uploaded_file($fileTmpLoc, $pathAndName)) {
    	 		$url ="http://cs-server.usc.edu:15500/hw2/images/".$fileName;
    	 		$sql ="update Product set productName='".$name."',productCategoryId='".$cateId."',productDescription='".$des."',productImage='".$url."',productPrice='".$price."',productAmount='".$amount."' where productId ='".$proId."';";
				$res=mysql_query($sql);	
    	 		$sql ="select * from Product";
				$res=mysql_query($sql);
				while($row = mysql_fetch_assoc($res)) {
					echo "<input type='radio' name ='pro'  value=".$row['productId'].">Name: ".$row['productName']." Description:".$row['productDescription']." $".$row['productPrice']."<br>";
				}
				echo "<input type='submit' name='delete_change' value='change'>";
				echo "</form>";
    	 	}
    	  	else {
    	  		$url=$img;
    	 		echo "<p style= color:red>File Uploading Error </p>";
    	 		include 'change_product.php';

    	 	}
			unset($_POST['delete_change']);
			echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} 
		else {
			echo "<form action='Employee.php'>
			<input type='hidden' value='Admin Page'>
			</form>";
		}
	 
}
require "post.html";
?>
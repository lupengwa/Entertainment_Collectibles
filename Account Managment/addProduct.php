<?php
session_start();
require "pre.html";
// veryfy time and user information
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

else {
//check completed
echo "<form action='Employee.php' method='POST'>
		<input type='submit' value='Employee Page'>
		</form>";
// variable passed	
$cateId=$_POST['cateId'];
$name=$_POST['proName'];
$des=$_POST['proDes'];
$img=$_POST['proImage'];
$price=$_POST['proPrice'];
$amount=$_POST['proAmount'];


//connect to the database

$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
if(!$con) {
		die ("unable to connect the server");
}
	mysql_select_db('websale',$con);



//First time login
if(strlen($cateId)==0 && strlen($name)==0 && strlen($des)==0 && strlen($img)==0 && strlen($price)==0 && strlen($amount)==0) {
	$sql="select * from ProductCategory;";
	$res = mysql_query($sql);
	if(!$res) {
		echo "Error in inserting";
	}
	echo "<form id='user' action='addProduct.php' method='POST' enctype='multipart/form-data'>
	<h1> Add a Product</h1>
	Select a Category:<br>
	<select name='cateId'>";
	while($row = mysql_fetch_assoc($res)) {
			echo "<option value='".$row['proCateId']."'>".$row['proCateName']."</option>";
	}
	echo "</select><br><br>
	Product Name: <input type='text' class='adduser_input' name ='proName' required> <br><br>
	Product Price: <input type='text' class='adduser_input' name ='proPrice'required> <br><br>
	Product Amount: <input type='text' class='adduser_input' name ='proAmount' required> <br><br>
	Product Description:<br>
	<textarea rows='4' cols='50' class='adduser_input' name='proDes' required> </textarea><br><br> 
	Select image to upload:<br>
    <input type='file' name='fileToUpload' id='fileToUpload' required><br>
    <input type='submit' value='submit' name='submit'>
    </form>";
   
	}
	else if($_POST['submit'] == "submit") {
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
    	 		$sql="insert into Product (productCategoryId,productName, productDescription,productImage, productPrice,productAmount) values('".$cateId."','".$name."','".$des."','".$url."','".$price."','".$amount."');";
		 		$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
		 		$res = mysql_query($sql);
		 		if(!$res) {
					echo "Error in inserting";
		 	}


		 //Show insert interface
		 $sql="select * from ProductCategory;";
		 $res = mysql_query($sql);
		 if(!$res) {
		 echo "Error in inserting";
	     }
		 echo "<form id='user' action='addProduct.php' method='POST' enctype='multipart/form-data'>
		<h1> Add a Product</h1>
		Select a Category:<br>
		<select name='cateId'>";
		while($row = mysql_fetch_assoc($res)) {
			echo "<option value='".$row['proCateId']."'>".$row['proCateName']."</option>";
		}
		echo "</select><br><br>
		Product Name: <input type='text' class='adduser_input' name ='proName' required> <br><br>
		Product Price: <input type='text' class='adduser_input' name ='proPrice' required> <br><br>
		Product Amount: <input type='text' class='adduser_input' name ='proAmount' required> <br><br>
		Product Description:<br>
		<textarea rows='4' cols='50' class='adduser_input' name='proDes' required> </textarea><br><br> 
		Select image to upload:<br>
    	<input type='file' name='fileToUpload' id='fileToUpload' required><br>
    	<input type='submit' value='submit' name='submit'>
    	</form>";
  

    	 	}
    	  else {
    	 	echo "<p style= color:red>File Uploading Error </p>";
    	 	echo "<form id='user' action='addProduct.php' method='POST' enctype='multipart/form-data'>
			<h1> Add a Product</h1>
			Select a Category:<br>
			<select name='cateId'>";
			while($row = mysql_fetch_assoc($res)) {
				echo "<option value='".$row['proCateId']."'>".$row['proCateName']."</option>";
			}
			echo "</select><br><br>
			Product Name: <input type='text' class='adduser_input' name ='proName' required> <br><br>
			Product Price: <input type='text' class='adduser_input' name ='proPrice' required> <br><br>
			Product Amount: <input type='text' class='adduser_input' name ='proAmount' required> <br><br>
			Product Description:<br>
			<textarea rows='4' cols='50' class='adduser_input' name='proDes' required> </textarea><br><br> 
			Select image to upload:<br>
    		<input type='file' name='fileToUpload' id='fileToUpload' required><br>
    		<input type='submit' value='submit' name='submit'>
    		</form>";
    	}
    	 
	}
	 
}

require "post.html";


?>
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
	echo "<form action='Employee.php' method='POST' >
	<input type='submit' value='Employee Page'>
	</form>"; 
	$command=$_POST['submit'];
	$c_or_d=$_POST['delete_change'];
	$change_submit =$_POST['change_submit'];
	$proId=$_POST['proId'];
	$dateStart=$_POST['dateStart'];
	$dateEnd=$_POST['dateEnd'];
	$perOff=$_POST['perOff'];
	$fix =$_POST['fix'];
	$special=$_POST['special'];

	$sql ="select * from specialSale";
	$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
	if(!$con) {
		die ("unable to connect the server");
	}
	mysql_select_db('websale',$con);
	echo "<form action='change_delete_special.php' method='POST'>";
	$res = mysql_query($sql);

	if($command == "delete") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='special[]'  value=".$row['proId'].">".$row['proId']." start date:".$row['dateStart']." end date:".$row['dateEnd']." percentageOff:".$row['PercentageOff']." FixedOff: ".$row['FixedOff']."<br>";
		
		}
		echo "<input type='submit' name='delete_change' value='delete'>";
		echo "</form>";
		unset($_POST['submit']);

	} else if($command == "change") {
		while($row = mysql_fetch_assoc($res)) {
			echo "<input type='radio' name ='special'  value=".$row['proId'].">".$row['proId']." start date:".$row['dateStart']." end date:".$row['dateEnd']." percentageOff:".$row['PercentageOff']." FixedOff: ".$row['FixedOff']."<br>";
		}
		echo "<input type='submit' name='delete_change' value='change'>";
		echo "</form";
		unset($_POST['submit']);
		echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		
	} else if($c_or_d == "delete"){
		if(isset($_POST['special'])) {
			$proid = $_POST['special'];
			foreach($proid as $id) {
				$sql="delete from specialSale where proId=".$id.";";
				$res=mysql_query($sql);
			}
		} else {
			echo'<p style="color:red"> Please select at least one user!</p>';
		  }
		  $_POST=array();
		  echo "<form action='change_delete_special.php' method='POST'>";
		  $sql ="select * from specialSale";
		  $res=mysql_query($sql);
		  while($row = mysql_fetch_assoc($res)) {
			echo "<input type='checkbox' name ='special[]'  value=".$row['proId'].">".$row['proId']." start date:".$row['dateStart']." end date:".$row['dateEnd']." percentageOff:".$row['PercentageOff']." FixedOff: ".$row['FixedOff']."<br>";
		  }
		  echo "<input type='submit' name='delete_change' value='delete'>";
		  echo "</form>";
		  echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} 
		else if($c_or_d == "change") {
			echo "<form action='change_delete_special.php' method='POST'>";
		  	$sql ="select * from specialSale";
		  	$res=mysql_query($sql);
		  	while($row = mysql_fetch_assoc($res)) {
			echo "<input type='radio' name ='special'  value=".$row['proId'].">".$row['proId']." start date:".$row['dateStart']." end date:".$row['dateEnd']." percentageOff:".$row['PercentageOff']." FixedOff: ".$row['FixedOff']."<br>";
			}
			echo "<input type='submit' name='delete_change' value='change'>";
			echo "</form";

			if(isset($_POST['special'])) {
				$sql = "select * from specialSale where proId=".$_POST['special'].";";
				$res=mysql_query($sql);
				$row = mysql_fetch_assoc($res);
				echo "<form id='user' action='change_delete_special.php' method='POST' onsubmit='return checkSpecial(this)'>
				<h1> Change a Special Sale</h1>
				ProductId:".$special."<br>
				Start Date: 
				<input type='date' class='adduser_input' name ='dateStart' value='".$row['dateStart']."' required> <br>
				End Date: 
				<input type='date' class='adduser_input' name='dateEnd' value='".$row['dateEnd']."' required> <br>
				Percentage Off(%):
				<input type='number' class='adduser_input' name='perOff' value='".$row['PercentageOff']."' required> <br>
				Fixed Amount Off:
				<input type='number' class='adduser_input' name='fix' value='".$row['FixedOff']."' required> <br>
				<input type='hidden' name='special' value='".$special."'><br>
				<input type='submit' class='adduser_input' 	name='change_submit' value = 'submit'>
				</form>	";
    		}
				
				else {
					echo "<p style='color:red'>Please choose one user</p>";

			}
			unset($_POST['change_submit']);
			echo "<form action='Employee.php'>
			<input type='hidden' value='Employee Page'>
			</form>";
		} elseif($change_submit == "submit" ) {
			
			$sql ="update specialSale set dateStart='".$dateStart."',dateEnd='".$dateEnd."',PercentageOff='".$perOff."',FixedOff='".$fix."'where proId=".$special.";";
			$res=mysql_query($sql);	
			$sql ="select * from specialSale";
		  	$res=mysql_query($sql);
		  	while($row = mysql_fetch_assoc($res)) {
				echo "<input type='radio' name ='special'  value=".$row['proId'].">".$row['proId']." start date:".$row['dateStart']." end date:".$row['dateEnd']." percentageOff:".$row['PercentageOff']." FixedOff: ".$row['FixedOff']."<br>";
			}
			echo "<input type='submit' name='delete_change' value='change'>";
			echo "</form";
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
<?php
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$bstreetNum=$_POST['bstreetNumber'];
$bstreetName=$_POST['bstreetName'];
$bapt=$_POST['bapt'];
$bcity=$_POST['bcity'];
$bstate=$_POST['bState'];
$bzip=$_POST['bzip'];
$streetNum=$_POST['streetNumber'];
$streetName=$_POST['streetName'];
$apt=$_POST['apt'];
$city=$_POST['city'];
$state=$_POST['State'];
$zip=$_POST['zip'];
$cardnumber=$_POST['cardnumber'];
$security=$_POST['security'];
$month=$_POST['month'];
$year=$_POST['year'];
$username=$_POST['username'];
$password=$_POST['password'];
$submit=$_POST['submit'];
$errmsg="";

if( strlen($submit)!=0 && $submit=="submit" && strlen($firstName)!=0 && strlen($lastName)!=0 && strlen($email)!=0 && strlen($phone)!=0 && strlen($bstreetNum)!=0 && 
	strlen($bstreetName)!=0 && strlen($bapt)!=0 && strlen($bapt)!=0 && strlen($bstate)!=0 && strlen($bzip)!=0 && strlen($streetNum)!=0 && strlen($streetName)!=0 
	&& strlen($apt)!=0 && strlen($state)!=0 && strlen($zip)!=0 && strlen($cardnumber)!=0 && strlen($security)!=0 && strlen($month)!=0 && strlen($year)!=0 
	&& strlen($username)!=0 && strlen($password)!=0) {
  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
	if(!is_numeric($phone) || strlen($phone)!=10  || !is_numeric($bstreetNum) 
		|| !is_numeric($bapt) || !is_numeric($bzip) || !is_numeric($streetNum) || !preg_match($regex, $email) || !is_numeric($apt) || !is_numeric($zip) || 
		!is_numeric($cardnumber) || strlen($cardnumber)!=16 || $month<1 || $month>12 || strlen($year)!=4) {
		$errmsg="Invalid Input";
	} else {
		require "config.php";
		$sql="insert into customer (firstName,lastName,billStreetNum,billStreet,billAPT,billState,billZip,shipStreetNum,shipStreet,
			shipAPT,shipState,shipZip,email,phone,username,password,cardNumber,cardMonth,cardYear,security) values('".$firstName."','".$lastName."','".$bstreetNum."','".$bstreetName."','".$bapt."','".$bstate."','".$bzip."','".$streetNum."','".$streetName."','".$apt."','".$state."','".$zip."','".$email."','".$phone."','".$username."','".$password."','".$cardnumber."','".$month."','".$year."','".$security."');";
        $res=mysql_query($sql);
        if(!$res) {
        	echo "Error in inserting";
        } else {
        	echo "user information update successfully";
        }
	} 
	
} else if($submit=="signUp"){
	require "Pre_customer_register.html";
    require "Post_customer_register.html";
 
} else{
  $errmsg=" invalid input";
  require "prelogin.html";
  echo $streetNum." ".$streetName." ".$apt." ".$state." ".$zip." ".$cardnumber." ".$security." ".$month." ".$year." ".$username." ".$password."<br>";
  if( strlen($submit)!=0 && $submit=="submit"){
  	echo "bug";
  }
  echo '<p id="error" style="color:red" position >'.$errmsg.'</p>';
  require "postlogin.html";
}












?>
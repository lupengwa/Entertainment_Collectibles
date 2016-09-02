<?php
session_start();
$time = time();
require "config.php";
$sql="select * from customer where username='".$_SESSION['username']."' AND password='".$_SESSION['password']."';";
$res=mysql_query($sql);
?>
<?php
session_start();
if(isset($_POST['submit'])) {
	session_destroy();
	session_start();
}
$_SESSION['start']=time();

$un=$_POST['username'];
$pw=$_POST['password'];
$errmsg= "";
if(strlen($un) == 0) {
	$errmsg = "Invalid login";
}
if(strlen($pw) == 0) {
	$errmsg ="Invalid login";
}
if(strlen($un)==0 && strlen($pw)==0) {
	$errmsg = "";
}
if(strlen($un)>0 && strlen($pw)>0) {
	$sql ="select * from customer where username='".$un."' and password='".$pw."' ;";
	require "config.php";
	$res = mysql_query($sql);
	if(!($row = mysql_fetch_assoc($res))){
		$errmsg = "No matched user information found";
	} 
	
}
?>
<!DOCTYPE html>
<html>
<head>
<script
src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<script>

//Category List
$(document).ready(createOption);
function createOption(){
       if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        		var length=xmlhttp.responseText.length;
            	var tmp=xmlhttp.responseText.substring(1,length-2);
                var content=tmp.split(",");
                var x=document.getElementById("category");
                for(i=0;i<content.length;i++){
                	y=document.createElement("option");
                	y.value=content[i++];
                	y.text=content[i];
                	x.appendChild(y);
                }
               
                
            }
        }
        xmlhttp.open("GET","/HW3/cate.php",true);
        xmlhttp.send();
}

//SEARCH function
$(document).ready(job);
function job(){
  $(".search").click(searchItem);
  function searchItem(){
    document.getElementById("shopping").style.display="block";
    var cate=document.getElementById("category").value;
    var content=webInput.searchContent.value;
    
     
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
            // code for IE6, IE5
         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if(cate=="" && content==""){
        document.getElementById("error").innerHTML="Please select a category or enter the items in search field";
        document.getElementById("Items").innerHTML=""; 
    }else if(cate!="" && content==""){  
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Items").innerHTML=xmlhttp.responseText;
                document.getElementById("error").innerHTML="";
                
            }
            
        }
        xmlhttp.open("GET","/HW3/search.php?cate="+cate,true);
        xmlhttp.send(); 
    }else{
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Items").innerHTML=xmlhttp.responseText;
                document.getElementById("error").innerHTML="";
                
            }
            
        }
        xmlhttp.open("GET","/HW3/search.php?content="+content,true);
        xmlhttp.send(); 
    }
  }
}

function CustomerInfor(){
    document.getElementById("webInput").style.display="none";
    document.getElementById("change").style.display="inline";
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
            // code for IE6, IE5
         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
     xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("cusInfor").innerHTML=xmlhttp.responseText;
            }
            
        }
        xmlhttp.open("GET","/HW3/customerInfo.php",true);
        xmlhttp.send();    
}


</script>
<style>
#webInput{
 position:relative;
	left:4in;
	top:0.5in;	
}

#customerLogin {
    position:relative;
    left:4in;
    top:0.5in;    
}
#profile {
 
    display:inline;
}
#orderInfo {
  
    display:inline;
}
#cusInfor {
    position:relative;
    left:5in;
    top:0.5in;
}


.shopping-cart{
	width: 25%;
	position:absolute;
	top:1in;
	left:10.6in;
	float:right;
	background: #F0F0F0;
	padding: 10px;	
	border: 1px solid #DDD;
	border-radius: 5px;
	display:none;

}
.shopping-cart h2 {
	background: #E2E2E2;
	padding: 4px;
	font-size: 14px;
	margin: -10px -10px 5px;
	color: #707070;
	display:none;
}


</style>
</head>
<body>



<?php
if(!$res){
	require 'Pre_saleWeb.html';
	echo '<p style="color:red"> Please Login </p>';
	require 'Post_saleWeb.html';
	session_destroy();
}	
 elseif(($time - $_SESSION['start']) > 500) {
	require 'prelogin.html';
	echo '<p style="color:red" id="error"> Timeout</p>';
	require 'postlogin.html';
	session_destroy();
} else {
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
$change=$_POST['change'];


	if($change=="change") {
		if($row=mysql_fetch_array($res)){
		require "Pre_customer_register.html";
				echo '<form id="reg" action="changeCustomer.php" method="POST" onSubmit="return checkField(this)">
<fieldset>
<legend>Customer Information</legend>
First Name:<br>
<input type="text" name="firstName" value="'.$row['firstName'].'" required ><br>
Last Name:<br>
<input type="text" name="lastName" value="'.$row['lastName'].'" required><br>
Email:<br>
<input type="email" name="email" value="'.$row['email'].'" required><br>
Phone:<br>
<input type=number name="phone" value="'.$row['phone'].'" required><br>
Billing Address:<br>
Street Number:
<input type="number" name="bstreetNumber" style="width:50px;"size="50" value="'.$row['billStreetNum'].'" required>
Steet Name:<input type="text" name="bstreetName" style="width:150px;" size="50" value="'.$row['billStreet'].'" required><br>
APT:<input type="number" name="bapt" size="50" style="width:40px;" value="'.$row['billAPT'].'" required><br>
City:<input type="text" name="bcity" style="width:100px;" class="isstate" value= "'.$row['billCity'].'" required>
STATE:<input type="text" name="bState" style="width:40px;" class="isstate" value= "'.$row['billState'].'" required>
ZIPCODE:<input type="text" name="bzip" style="width:60px;" size="50" value= "'.$row['billZip'].'" required><br>
Shipping Address:<br>
Street Number:
<input type="number" name="streetNumber" style="width:50px;"size="50" value= "'.$row['shipStreetNum'].'" required>
Steet Name:<input type="text" name="streetName" style="width:150px;" size="50" value= "'.$row['shipStreet'].'"  required><br>
APT:<input type="number" name="apt" size="50" style="width:40px;" value= "'.$row['shipAPT'].'" required><br>
City:<input type="text" name="city" style="width:100px;" class="isstate" value= "'.$row['shipCity'].'" required>
STATE:<input type="text" name="State" style="width:40px;" class="isstate" value= "'.$row['shipState'].'" required>
ZIPCODE:<input type="text" name="zip" style="width:60px;" size="50" value= "'.$row['shipZip'].'" required><br>
Credit Card Number:<br>
<input type="number" name="cardnumber" style="width:120px;" value= "'.$row['cardNumber'].'" required><br>
Secutiry Number:<br>
<input type="number" maxlength="4" size="4" name="security" style="width:40px;" value= "'.$row['security'].'" required><br>
Expiration Date:<br>
Month:<input type="number" name="month" size="2" maxlength="2" style="width:30px;" min="1" max="12" value= "'.$row['cardMonth'].'" required> 
Year:<input type="number" name="year" maxlength="4" style="width:40px;" value= "'.$row['cardYear'].'" required><br>
Username: <br>
<input type="text" name="username" onChange="checkExistence(this.value)" value= "'.$row['username'].'" required><div id="user"></div><br>
Password:<br>
<input type="text" name="password" value= "'.$row['password'].'" required><br>
<input type="submit" name="change" value="submit">
</fieldset>
</form>

</body>
</html>';
     unset($_POST['change']);
		     
 	}
  	else {
  		echo "<p style='color:red;'> invalid user input </p>";
  		unset($_POST['change']);
  	}

	} else if($change=="submit"){
  		$sql="update customer set firstName='".$firstName."', lastName='".$lastName."', BillStreetNum='".$bstreetNum."', billStreet='".$bstreetName.
  		"', billAPT='".$bapt."', billCity='".$bcity."', billZip='".$bzip."', shipStreetNum='".$streetNum."', shipStreet='".$streetName."', shipAPT='"
  		.$apt."', shipCity='".$city."', shipState='".$state."', shipZip='".$zip."', cardNumber='".$cardnumber."', cardMonth='".$month."', cardYear='".
  		$year."', security='".$security."', username='".$username."', password='".$password."' where username='".$_SESSION['username']."' 
  		AND password='".$_SESSION['password']."';";
  		$res=mysql_query($sql);
  		$_SESSION['username']=$username;
  		$_SESSION['password']=$password;
		if(!$res){
			require 'Pre_saleWeb.html';
			echo '<p style="color:red"> Unable to update</p>';
			echo $sql;
			require 'Post_saleWeb.html';
			session_destroy();
			unset($_POST['change']);
		} else {
			require 'saleWeb.html';
			echo '<p style="color:green"> Update successfully</p>';
			require 'saleWeb2.html';
			unset($_POST['change']);
		}	 
	}
}
?>
</body>
</html>
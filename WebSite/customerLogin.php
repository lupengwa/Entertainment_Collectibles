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
		document.getElementById("shopping-cart").style.display="none";

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
    document.getElementById("shopping-cart").style.display="none";
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

}
.shopping-cart h2 {
	background: #E2E2E2;
	padding: 4px;
	font-size: 14px;
	margin: -10px -10px 5px;
	color: #707070;
}


</style>
</head>
<body>


<?php
if(strlen($errmsg)>0) {
	require 'Pre_saleWeb.html';
	echo '<p id="error" style="color:red" position >'.$errmsg.'</p>';
	require 'Post_saleWeb.html';
	echo "</form>";
}elseif(!$res) {
	require 'Pre_saleWeb.html';
	require 'Post_saleWeb.html';
	echo "</form>";
}else {
	$_SESSION['username'] = $un;
	$_SESSION['password'] = $pw;
	require 'saleWeb.html';
	require 'saleWeb2.html';
	echo "</form>";
}
?> 
<div class="shopping-cart" id="shopping-cart">
<h2>Your Shopping Cart</h2>
<?php
if(isset($_SESSION["products"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">Check-out!</a></span>';
	echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
}else{
    echo 'Your Cart is empty';
}
?>
</div>
    


</body>
</html>




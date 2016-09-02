<!DOCTYPE html>
<html>
<head>
    <link href="/CodeIgniter/application/style/style.css" rel="stylesheet" type="text/css">
    <meta name=""viewport" content="width=device-width,initial-scale=1.0">
    <script>
        /*
        function checkCart(){
            var x='<?php echo $_SESSION['cart']; ?>';
            if(x.length==0 || !(typeof x != 'undefined' && x instanceof Array)){
                document.getElementById("check").innerHTML= x.length;
                return false;
            }
            return true;
        }*/
        function check(x) {
            if(/[^a-zA-Z0-9]/.test(x.username.value)){
                alert("User Name only can have letters or numbers");
                return false;
            } else if(/[^a-zA-Z0-9]/.test(x.password.value)){
                alert("Password only can have letters or numbers");
                return false;
            } else {
                return true;
            }

        }

    </script>
    <link href="/CodeIgniter/application/style/style.css" rel="stylesheet" type="text/css">
</head>
<body background="back2.jpg">
<form id="back" action="/CodeIgniter/index.php/Saleweb/index" method="POST">
    <input type="submit" name="back" value="back">
</form>
<form class="checkout" action="/CodeIgniter/index.php/Checkout_control" method="POST" >
    <input type="submit" name="checkout" value="checkout">
</form>
<form id="checkout" action="/CodeIgniter/index.php/View_cart_control" method="POST" >
    <input type="hidden" name="view_cart" value="empty_cart" >
    <input type="submit"  value="empty_cart">
</form>
<div id="check"></div>

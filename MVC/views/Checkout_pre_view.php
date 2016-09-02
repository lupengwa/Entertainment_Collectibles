<!DOCTYPE html >
<html >
<head >
    <link href="/CodeIgniter/application/style/style.css" rel="stylesheet" type="text/css">
    <meta name=""viewport" content="width=device-width,initial-scale=1.0">
    <script >
        function checkField(x){
            var
                current = new Date();
            if (x . cardNum . value . toString() . length != 16) {
                alert("card number must be 16 digits");
            } else if (x . security . value . toString() . length != 3 ) {
                alert("card security digits must be 3");
                return false;

            } else if (x . year . value == current . getFullYear() && x . month . value < (current . getMonth() + 1)) {
                alert("your card has expired");
                return false;
            }
            else {
                return true;

            }

        }

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




    </script >
</head >
<body background = "back2.jpg" >
<form id="back" action="/CodeIgniter/index.php/Saleweb/index" method="POST">
    <input type="submit" name="back" value="back">
</form>
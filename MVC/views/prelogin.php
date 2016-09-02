<!DOCTYPE html>
<html>
<head>
    <link href="/CodeIgniter/application/style/style.css" rel="stylesheet" type="text/css">
    <meta name=""viewport" content="width=device-width,initial-scale=1.0">
    <script>
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


</head>
<body>

<h1 id="Web" style="position:relative;left:5in;">Customer Login</h1>

<br>








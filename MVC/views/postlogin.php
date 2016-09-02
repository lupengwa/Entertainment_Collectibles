
<form id="user" action="/CodeIgniter/index.php/Customer_login/index" method="POST"  onsubmit="return check(this)" style="position:relative;left:5in;">
Username:     
<input type="text" name="username">
<br><br>
Password:        
<input type="text"  name="password">
<br>
<input type="submit" name="login"  value="login">
</form>
<form id="user" action="/CodeIgniter/index.php/Customersign_control/index" method="POST" style="position:relative;left:5in;">
<input type="hidden" name="submit_type" value="signUp">
<input type="submit" name="submit" value="signUp" >
</form>




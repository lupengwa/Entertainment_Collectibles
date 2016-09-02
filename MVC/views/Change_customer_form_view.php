<?php
echo '<form id="reg" action="/CodeIgniter/index.php/Change_customer_control" method="POST" onSubmit="return checkField(this)">
<fieldset>
<legend>Customer Information</legend>
First Name:<br>
<input type="text" name="firstName"  value="' . $row['firstName'] . '" required ><br>
Last Name:<br>
<input type="text" name="lastName" value="' . $row['lastName'] . '" required><br>
Email:<br>
<input type="email" name="email" value="' . $row['email'] . '" required><br>
Phone:<br>
<input type=number name="phone" value="' . $row['phone'] . '" required><br>
Billing Address:<br>
Street Number:
<input type="number" name="bstreetNumber" style="width:50px;"size="50" value="' . $row['billStreetNum'] . '" required>
Steet Name:<input type="text" name="bstreetName" style="width:150px;" size="50" value="' . $row['billStreet'] . '" required><br>
APT:<input type="number" name="bapt" size="50" style="width:40px;" value="' . $row['billAPT'] . '" min="0"><br>
City:<input type="text" name="bcity" style="width:100px;" class="isstate" value= "' . $row['billCity'] . '" required>
STATE:<input type="text" name="bState" style="width:40px;" class="isstate" value= "' . $row['billState'] . '" required>
ZIPCODE:<input type="text" name="bzip" style="width:60px;" size="50" value= "' . $row['billZip'] . '" required><br>
Shipping Address:<br>
Street Number:
<input type="number" name="streetNumber" style="width:50px;"size="50" value= "' . $row['shipStreetNum'] . '" required>
Steet Name:<input type="text" name="streetName" style="width:150px;" size="50" value= "' . $row['shipStreet'] . '"  required><br>
APT:<input type="number" name="apt" size="50" style="width:40px;" value= "' . $row['shipAPT'] . '" min="0" ><br>
City:<input type="text" name="city" style="width:100px;" class="isstate" value= "' . $row['shipCity'] . '" required>
STATE:<input type="text" name="State" style="width:40px;" class="isstate" value= "' . $row['shipState'] . '" required>
ZIPCODE:<input type="text" name="zip" style="width:60px;" size="50" value= "' . $row['shipZip'] . '" required><br>
Credit Card Number:<br>
<input type="number" name="cardnumber" style="width:120px;" value= "' . $row['cardNumber'] . '" required><br>
Secutiry Number:<br>
<input type="number" maxlength="4" size="4" name="security" style="width:40px;" value= "' . $row['security'] . '" required><br>
Expiration Date:<br>
Month:<input type="number" name="month" size="2" maxlength="2" style="width:30px;" min="1" max="12" value= "' . $row['cardMonth'] . '" required>
Year:<input type="number" name="year" maxlength="4" style="width:40px;" value= "' . $row['cardYear'] . '" min="2015" required><br>
Username: <br>
<input type="text" name="username"  value= "' . $row['username'] . '" readonly><div id="user"></div><br>
Password:<br>
<input type="text" name="password" value= "' . $row['password'] . '" required><br>
<input type"hidden" name="change" value="submit" readonly style="display:none;">
<input type="submit" value="submit">
</fieldset>
</form>

</body>
</html>';
?>
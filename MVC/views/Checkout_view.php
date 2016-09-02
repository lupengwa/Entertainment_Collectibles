<?php
echo '<div id="check_wraper">';
echo '<form id="check_out" action="/CodeIgniter/index.php/Checkout_control" onsubmit="return checkField(this)" method="POST">';
echo '<div id="Address">Shipping Address:<input type="text" style="width:300px" name="shipAddress" value="' . $shipAddress . '" required><br>';
echo 'Billing Address:<input type="text" name="billAddress" style="width:300px" value="' . $billAddress . '"required><br></div>';
echo '<div id=card>';
echo 'Card Number:<input type="number" name="cardNum" style="width:150px" value="' . $row['cardNumber'] . '" required><br>';
echo 'Month:<input type="number" name="month" style="width:30px" min="1" max="12" value="' . $row['cardMonth'] . '"required> Year: <input type="number" name="year" style="width:40px" min="2014" value="' . $row['cardYear'] . '"required><br>';
echo 'Security Number:<input type=number" style="width:40px" size="4" name="security" value="' . $row['security'] . '"required>';
echo '</div><input type="submit" name="checkout" value="submit"></form></div>';

?>
<?php


echo "First Name: " . $row['firstName'] . "<br>Last Name: " . $row['lastName'] . "<br> Billing Address: " . $row['billStreetNum'] . " " . $row['billStreet'] .
    " Apt:" . $row['billAPT'] . "," . $row['billCity'] . " " . $row['billState'] . " " . $row['billZip'] . "<br> Shipping Address: " . $row['shipStreetNum'] . " " . $row['shipStreet'] .
    " Apt:" . $row['shipAPT'] . "," . $row['shipCity'] . " " . $row['shipState'] . " " . $row['shipZip'] . "<br>Email: " . $row['email'] . "<br>Phone: " . $row['phone'] . "<br>username: " .
    $row['username'] . "<br>password: " . $row['password'] . "<br>Card Information<br>Card Number: " . $row['cardNumber'] . " Month: " . $row['cardMonth'] .
    " Year: " . $row['cardYear'] . " Security Number: " . $row['security'];


?>
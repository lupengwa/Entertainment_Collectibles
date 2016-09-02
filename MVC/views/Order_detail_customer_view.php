<?php
echo "</ul></div>
<div id='others'>Shipping Address: " . $row['shippingAddress'] . "<br>
    Billing Address:" . $row['billingAddress'] . "<br>
    Paying Card:" . $row['paymentCard'] . "<br>
    <div id='sale''> Total Price: " . $row['totalPrice'] . " Total Quantity: " . $row['totalQuantity'] . "</div>";
echo "<input type='hidden' name='customerId' value='" . $row['customerId'] . "'>
<input type='hidden' name='orderId' value='" . $row['orderId'] . "'>";
?>
<?php
echo "<div id='order_wrapper1'>
              <form id='order_detail' action='/CodeIgniter/index.php/Order_detail_control' method='POST'>
              <div id='orderInfor'>Date:" . $row['orderDate'] . "
              Total Price: " . $row['totalPrice'] . " Total Quantity: " . $row['totalQuantity'];
echo "<input type='hidden' name='orderId' value='" . $row['orderId'] . "'>
                  <input type='submit' name='detail' value='detail'></form></div></div><br>";
?>
<?php

echo '<div class="product">';
$price = $row['productPrice'] * (100 - $special['PercentageOff']) / 100;
echo '<form method="post" action="/CodeIgniter/index.php/Cart_update_control">';
echo '<div class="product-thumb" ><img src="' . $row['productImage'] . '" style="width:100px;height:100px;"></div>';
echo '<div class="product-content"><h3>' . $row['productName'] . '</h3>';
echo '<div class="product-desc">' . $row['productDescription'] . '</div>';
echo '<div class="product-info">';
echo 'Original Price $' . $row['productPrice'] . ' | ';
echo "<p style='color:red;'>Discount: " . $special['PercentageOff'] . "%off</p>";
echo 'Your Price: ' . $price;
echo '<br>Qty <input type="text" name="product_qty" value="1" size="3" />';
echo '<input type="hidden" name="productId" value="' . $row['productId'] . '" />';
echo '<input type="hidden" name="productPrice" value="' . $price . '" />';
echo '<input type="hidden" name="cart" value="add"/>';
echo '<input type="submit"  value="add">';
echo '</div></div>';
echo '</form>';

?>
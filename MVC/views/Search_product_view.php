<?php
echo '<div class="product">';
echo '<form method="post" action="/CodeIgniter/index.php/Cart_update_control">';
echo '<div class="product-thumb" ><img src="' . $row['productImage'] . '" style="width:100px;height:100px;"></div>';
echo '<div class="product-content"><h3>' . $row['productName'] . '</h3>';
echo '<div class="product-info">';
echo 'Price ' . $row['productPrice'] . ' ';
echo '<input type="hidden" name="productId" value="' . $row['productId'] . '" />';
echo '<input type="hidden" name="cart" value="detail"/>';
echo '<input type="submit"  value="detail">';
echo '</div></div>';
echo '</form>';
echo '</div>';

?>
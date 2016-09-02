<?php

echo '<div class="product">';
echo '<form method="post" action="/CodeIgniter/index.php/View_cart_control"/>';
echo '<div class="product-thumb" ><img src="' . $row['productImage'] . '" style="width:100px;height:100px;"></div>';
echo '<div class="product-content"><h3>' . $row['productName'] . '</h3>';
echo '<div class="product-desc">' . $row['productDescription'] . '</div>';
echo '<div class="product-info">';
echo 'Price ' . $cartItem['proPrice'] . ' | ';
echo 'Qty <input type="text" name="product_qty" value="' . $cartItem['qty'] . '" size="3" />';
echo '<input type="hidden" name="productId" value="' . $cartItem['proId'] . '"/>';
echo '<input type="hidden" name="productPrice" value="' . $cartItem['proPrice'] . '" />';
//echo '<input type="hidden" name="view_cart" value="update" />';
echo '<input type= "submit" name="view_cart"  id="todelete" value="delete"/>';
echo '<input type="submit" name="view_cart" value="update"/>';
echo '</div></div>';
echo '</form>';
//echo '<form method="post" action="/CodeIgniter/index.php/View_cart_control"/>';
//echo '<input type="hidden" name="view_cart" value="delete" />';
//echo '<input type="hidden" name="productId" value="' . $cartItem['proId'] . '"/>';
//echo '<input type= "submit"  id="todelete" value="delete"/>';
//echo '</form>';
echo '</div>';


?>
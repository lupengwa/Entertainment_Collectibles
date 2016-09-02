<?php

echo '<li><div class="Order_product">';
echo '<div class="product-thumb" ><img src="' . $itemInfo['productImage'] . '" style="width:100px;height:100px;"></div>';
echo '<div class="product-content"><h3>' . $itemInfo['productName'] . '</h3>';
echo '<div class="product-desc">' . $itemInfo['productDescription'] . '</div>';
echo '<div class="product-info">';
echo 'Price ' . $item['productPrice'] . ' | ';
echo 'Qty: ' . $item['productQty'];
echo '</div></div>';
echo '</div>';

?>
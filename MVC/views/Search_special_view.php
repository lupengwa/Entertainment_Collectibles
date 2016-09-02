<?php

                echo '<div class="product">';
                $price = $row['productPrice'] * (100 - $special['PercentageOff']) / 100;
                echo '<form method="post" action="/CodeIgniter/index.php/Cart_update_control">';
                echo '<div class="product-thumb" ><img src="' . $row['productImage'] . '" style="width:100px;height:100px;"></div>';
                echo '<div class="product-content"><h3>' . $row['productName'] . '</h3>';
                echo '<div class="product-info">';
                echo 'Original Price $' . $row['productPrice'];
                echo "<p style='color:red;'>Special Discount: " . $special['PercentageOff'] . "%off</p>";
                echo 'Your Price: ' . $price;
                echo '<input type="hidden" name="productId" value="' . $row['productId'] . '" />';
                echo '<input type="hidden" name="cart" value="detail"/>';
                echo '<input type="submit" value="detail">';
                echo '</div></div>';
                echo '</form>';
                echo '</div></div>';

?>
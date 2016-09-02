<?php


        echo '<div class="product">';
        $price = $product[0]['productPrice'] * (100 - $special['PercentageOff']) / 100;
        echo '<form method="post">';
        echo '<div class="product-thumb" ><img src="' . $product[0]['productImage'] . '" style="width:100px;height:100px;"></div>';
        echo '<div class="product-content"><h3>' . $product[0]['productName'] . '</h3>';
        echo '<div class="product-info">';
        echo 'Original Price $' . $product[0]['productPrice'] . ' | ';
        echo "<p style='color:red;'>Discount: " . $special['PercentageOff'] . "</p>";
        echo 'Your Price: ' . $price;
        echo '<input type="hidden" name="productId" value="' . $product[0]['productId'] . '" />';
        echo '</div></div>';
        echo '</form>';
        echo '</div>';

?>
<?php
echo "<form action='change_delete_product.php' method='POST'>";
			$sql ="select * from Product";
			$res=mysql_query($sql);
			while($row = mysql_fetch_assoc($res)) {
				echo "<input type='radio' name ='pro'  value=".$row['productId'].">Name: ".$row['productName']." Description:".$row['productDescription']." $".$row['productPrice']."<br>";
			}
			echo "<input type='submit' name='delete_change' value='change'>";
			echo "</form>";
			if(isset($_POST['pro'])) {
				$sql= "select * from ProductCategory;";
				$res=mysql_query($sql);
				while($row=mysql_fetch_assoc($res)){
					$array[$row['proCateId']]=$row['proCateName'];
				}
				$size = count($array);
				$sql ="select * from Product where productId=".$proId.";";
				$res=mysql_query($sql);
				if($row=mysql_fetch_assoc($res)) {
					echo "<form id ='user' action='change_delete_product.php' method='POST' enctype='multipart/form-data'>
						<h1> Change Product Information </h1>
						<select name='cateId'>";
						foreach($array as $x => $x_value){
							if($row['productCategoryId'] == $x) {
								echo "<option value='".$x."' selected='selected'>".$x_value."</option>";
							} else {
								echo "<option value='".$x."'>".$x_value."</option>";
							}
						}
						echo "</select><br><br>
						Product Name: <input type='text' class='adduser_input' name ='proName' value='".$row['productName']."' required> <br><br>
						Product Price: &nbsp;&nbsp;&nbsp;&nbsp;      <input type='text' class='adduser_input' name ='proPrice' value='".$row['productPrice']."'required> <br><br>
						Product Amount: <input type='text' class='adduser_input' name ='proAmount' value='".$row['productAmount']."'required> <br><br>
						Product Description:<br>
						<textarea rows='4' cols='50' class='adduser_input' name='proDes' required>".$row['productDescription']."</textarea><br><br> 
						Select image to upload:<br>
    					<input type='file' name='fileToUpload' id='fileToUpload' required><br>
    					<input type='hidden' name='pro' value='".$proId."'>
    					<input type='submit' value='submit' name='change_submit'>
    					</form>";

    				}
				}
				else {
					echo "<p style='color:red'>Please choose one user</p>";

			}


?>
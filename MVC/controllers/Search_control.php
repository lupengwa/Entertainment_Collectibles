<?php
class Search_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();

    }

    public function index()
    {
        /*$time = time();
        require "config.php";*/
        if(isset($_POST['content'])) {
            $content = $_POST['content'];
        }
        if(isset($_POST['cate'])) {
            $cate = $_POST['cate'];
        }

        if (!isset($content) && !isset($cate)) {
            $this->load->view('Search_error_view');
        } else if (!isset($content) && isset($cate)) {
            $this->load->model('Search_model');
            $res=$this->Search_model->getcate($cate);
            $this->load->view('Item_head');
            foreach($res as $item){
                if(count($item) == 1){
                    //echo "1";
                    $data=array("row"=>$item['product']);
                    $this->load->view("Search_product_view",$data);

                } else if(count($item)==2) {
                    //echo "2";
                    $data=array("row"=>$item['product'],"special"=>$item['special']);
                    $this->load->view("Search_special_view",$data);
                }
            }


        } else {

            $this->load->model('Search_model');
            $res=$this->Search_model->getcontent($content);
            $this->load->view('Item_head');
            foreach($res as $item){
                if(count($item) == 1){
                    //echo "1";
                    $data=array("row"=>$item['product']);
                    $this->load->view("Search_product_view",$data);

                } else if(count($item)==2) {
                    //echo "2";
                    $data=array("row"=>$item['product'],"special"=>$item['special']);
                    $this->load->view("Search_special_view",$data);
                }
            }


           /* $sql = "select * from Product where productName like '%" . $content . "%';";
            $res = mysql_query($sql);
            if (!$res) {
                die("The sql command has error");
            } else {
                echo "<h1>Products</h1>";
                while ($row = mysql_fetch_assoc($res)) {
                    $sql = "select * from specialSale where proId='" . $row['productId'] . "';";
                    $special_res = mysql_query($sql);
                    if ($special_res != false) {
                        $special = mysql_fetch_assoc($special_res);
                        date_default_timezone_set('America/Los_Angeles');
                        $date = date("Y-m-d");
                        if ($special['dateStart'] <= $date && $special['dateEnd'] >= $date) {
                            echo '<div class="product">';
                            $price = $row['productPrice'] * (100 - $special['PercentageOff']) / 100;
                            echo '<form method="post" action="cart_update.php">';
                            echo '<div class="product-thumb" ><img src="' . $row['productImage'] . '" style="width:100px;height:100px;"></div>';
                            echo '<div class="product-content"><h3>' . $row['productName'] . '</h3>';
                            echo '<div class="product-info">';
                            echo 'Original Price $' . $row['productPrice'] . ' | ';
                            echo "<p style='color:red;'>Special Discount: " . $special['PercentageOff'] . "%off</p>";
                            echo 'Your Price: ' . $price;
                            echo '<input type="hidden" name="productId" value="' . $row['productId'] . '" />';
                            echo '<input type="submit" name="cart" value="detail">';
                            echo '</div></div>';
                            echo '</form>';
                            echo '</div></div>';
                        } else {
                            echo '<div class="product">';
                            echo '<form method="post" action="cart_update.php">';
                            echo '<div class="product-thumb" ><img src="' . $row['productImage'] . '" style="width:100px;height:100px;"></div>';
                            echo '<div class="product-content"><h3>' . $row['productName'] . '</h3>';
                            echo '<div class="product-info">';
                            echo 'Price ' . $row['productPrice'] . ' ';
                            echo '<input type="hidden" name="productId" value="' . $row['productId'] . '" />';
                            echo '<input type="submit" name="cart" value="detail">';
                            echo '</div></div>';
                            echo '</form>';
                            echo '</div>';
                        }

                    } else {
                        echo '<div class="product">';
                        echo '<form method="post" action="cart_update.php">';
                        echo '<div class="product-thumb" ><img src="' . $row['productImage'] . '" style="width:100px;height:100px;"></div>';
                        echo '<div class="product-content"><h3>' . $row['productName'] . '</h3>';
                        echo '<div class="product-info">';
                        echo 'Price ' . $row['productPrice'] . '  ';
                        echo '<input type="hidden" name="productId" value="' . $row['productId'] . '" />';
                        echo '<input type="submit" name="cart" value="detail">';
                        echo '</div></div>';
                        echo '</form>';
                        echo '</div>';
                    }


                }


            }*/

        }

    }
}


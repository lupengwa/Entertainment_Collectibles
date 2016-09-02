<?php
class View_cart_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();

    }

    public function index()
    {

        $time = time();
       /* require "config.php";
        $sql = "select * from customer where username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "';";
        $res = mysql_query($sql);*/
        $this->load->model("Saleweb_model");
        $res=$this->Saleweb_model->checkuser($_SESSION['username'],$_SESSION['password']);

        $this->load->view("View_cart_pre_view");


        if ($res=="right") {

            if ($_POST['view_cart'] == "view_cart") {
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $this->load->model("Search_model");
                        $res=$this->Search_model->getproid($cartItem['proId']);
                        foreach($res as $item){
                            $data=array("row"=>$item['product'],"cartItem"=>$cartItem);
                            $this->load->view("View_cart_view",$data);
                        }
                    }
                    /*
                    echo '<div id="PeopleAlsoBuy">
                  <h2>People also buy</h2>';
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $sql = "select * from OrderDetail where productId='" . $cartItem['proId'] . "';";
                        $res = mysql_query($sql);
                        if ($res != false) {
                            while ($row = mysql_fetch_assoc($res)) {
                                $sql2 = "select * from OrderDetail where orderId='" . $row['orderId'] . "';";
                                $res2 = mysql_query($sql2);
                                if ($res2 != false) {
                                    while ($row2 = mysql_fetch_assoc($res2)) {
                                        if ($row2['productId'] != $row['productId']) {
                                            $sql = "select * from specialSale where proId='" . $row2['productId'] . "';";
                                            $special_res = mysql_query($sql);
                                            $sql = "select * from Product where productId='" . $row2['productId'] . "';";
                                            $res3 = mysql_query($sql);
                                            $row3 = mysql_fetch_assoc($res3);
                                            if ($special_res != false) {
                                                $special = mysql_fetch_assoc($special_res);
                                                date_default_timezone_set('America/Los_Angeles');
                                                $date = date("Y-m-d");
                                                if ($special['dateStart'] <= $date && $special['dateEnd'] >= $date) {
                                                    echo '<div class="product">';
                                                    $price = $row2['productPrice'] * (100 - $special['PercentageOff']) / 100;
                                                    echo '<form method="post" action="cart_update.php">';
                                                    echo '<div class="product-thumb" ><img src="' . $row3['productImage'] . '" style="width:100px;height:100px;"></div>';
                                                    echo '<div class="product-content"><h3>' . $row3['productName'] . '</h3>';
                                                    echo '<div class="product-info">';
                                                    echo 'Original Price $' . $row3['productPrice'] . ' | ';
                                                    echo "<p style='color:red;'>Special Discount: " . $special['PercentageOff'] . "</p>";
                                                    echo 'Your Price: ' . $price;
                                                    echo '<input type="hidden" name="productId" value="' . $row3['productId'] . '" />';
                                                    echo '<input type="submit" name="cart" value="detail">';
                                                    echo '</div></div>';
                                                    echo '</form>';
                                                    echo '</div></div>';
                                                } else {
                                                    echo '<div class="product">';
                                                    echo '<form method="post" action="cart_update.php">';
                                                    echo '<div class="product-thumb" ><img src="' . $row3['productImage'] . '" style="width:100px;height:100px;"></div>';
                                                    echo '<div class="product-content"><h3>' . $row3['productName'] . '</h3>';
                                                    echo '<div class="product-info">';
                                                    echo 'Price ' . $row2['productPrice'] . ' | ';
                                                    echo '<input type="hidden" name="productId" value="' . $row3['productId'] . '" />';
                                                    echo '<input type="submit" name="cart" value="detail">';
                                                    echo '</div></div>';
                                                    echo '</form>';
                                                    echo '</div>';
                                                }

                                            } else {
                                                echo '<div class="product">';
                                                echo '<form method="post" action="cart_update.php">';
                                                echo '<div class="product-thumb" ><img src="' . $row3['productImage'] . '" style="width:100px;height:100px;"></div>';
                                                echo '<div class="product-content"><h3>' . $row3['productName'] . '</h3>';
                                                echo '<div class="product-info">';
                                                echo 'Price ' . $row3['productPrice'] . ' | ';
                                                echo '<input type="hidden" name="productId" value="' . $row3s['productId'] . '" />';
                                                echo '<input type="submit" name="cart" value="detail">';
                                                echo '</div></div>';
                                                echo '</form>';
                                                echo '</div>';
                                            }

                                        }
                                    }
                                }
                            }
                        }

                    }
                    echo "</div>";*/
                } else {
                    $this->load->view("View_cart_empty_view");
                }
            } else if (isset($_POST['update']) && $_POST['update'] == "update") {
                $qty = $_POST["product_qty"];
                $proId = $_POST["productId"];
                $_SESSION['cart'][$proId]['qty'] = $qty;
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $this->load->model("Search_model");
                        $res=$this->Search_model->getproid($cartItem['proId']);
                        foreach($res as $item){
                            $data=array("row"=>$item['product'],"cartItem"=>$cartItem);
                            $this->load->view("View_cart_view",$data);
                        }
                    }
                }else {
                    $this->load->view("View_cart_empty_view");
                }
                unset($_POST['update']);

            } else if ($_POST['view_cart'] == "delete") {
                $proId = $_POST["productId"];
                unset($_SESSION['cart'][$proId]);
                if (count($_SESSION['cart']) == 0) {
                    unset($_SESSION['cart']);
                }
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $this->load->model("Search_model");
                        $res=$this->Search_model->getproid($cartItem['proId']);
                        foreach($res as $item){
                            $data=array("row"=>$item['product'],"cartItem"=>$cartItem);
                            $this->load->view("View_cart_view",$data);
                        }
                    }
                }
                else {
                    $this->load->view("View_cart_empty_view");
                }
            } else if ($_POST['view_cart'] == "empty_cart") {
                unset($_SESSION['cart']);
                $this->load->view("View_cart_empty_view");

            }

        } elseif (($time - $_SESSION['start']) > 500) {
            $data=array("errmsg"=>"Time Out");
            $this->load->view('prelogin_start');
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            session_destroy();
        } else {
            $data=array("errmsg"=>"Please Login");
            $this->load->view('prelogin');
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            session_destroy();

        }
        $this->load->view("postlogin_end");
    }
}



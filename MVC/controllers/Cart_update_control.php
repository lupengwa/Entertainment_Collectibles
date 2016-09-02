<?php

class Cart_update_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();

    }

    public function index()
    {

        $time = time();
        $this->load->model("Saleweb_model");
        $res=$this->Saleweb_model->checkuser($_SESSION['username'],$_SESSION['password']);
        /*require "config.php";
        $sql = "select * from customer where username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "';";
        $res = mysql_query($sql);*/

        $this->load->view("Cart_update_pre_view");
        if ($res=="right") {
            $name = $_POST['productId'];
            $this->load->model("Search_model");
            $res=$this->Search_model->getproid($name);
            if ($_POST['cart'] == "detail") {
                foreach($res as $item){
                    if(count($item) == 1){
                        $data=array("row"=>$item['product']);
                        $this->load->view("Cart_update_product_view",$data);

                    } else if(count($item)==2) {
                        $data=array("row"=>$item['product'],"special"=>$item['special']);
                        $this->load->view("Cart_update_special_view",$data);
                    }
                }


            } else if ($_POST['cart'] == "add") {
                $qty = $_POST["product_qty"];
                $proId = $_POST["productId"];
                $proPrice = $_POST['productPrice'];
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                    $_SESSION['cart'][$proId] = array("qty" => $qty, "proId" => $proId, "proPrice" => $proPrice);
                    $this->load->view('Cart_update_sucess_view');

                } else {
                    $_SESSION['cart'][$proId] = array("qty" => $qty, "proId" => $proId, "proPrice" => $proPrice);
                    $this->load->view('Cart_update_sucess_view');

                }


            }
        } elseif (($time - $_SESSION['start']) > 500) {
            $data=array("errmsg"=>"Time Out");
            $this->load->view('prelogin_start');
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            session_destroy();
        } else {
            $data=array("errmsg"=>"Please Login");
            $this->load->view('prelogin_start');
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            session_destroy();

        }

        $this->load->view("postlogin_end");
    }
}


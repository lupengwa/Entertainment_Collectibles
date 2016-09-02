<?php

class Checkout_control extends CI_Controller
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



$this->load->view("Checkout_pre_view");

if ($res=="right") {
    $this->load->model("Customer_infor_model");
    $row=$this->Customer_infor_model->getCustomer($_SESSION['username'],$_SESSION['password']);
    if (isset($_POST['checkout']) && $_POST['checkout'] == "checkout") {
        if (isset($_SESSION['cart']) && count($_SESSION['cart'] > 0)) {
            if($row != "wrong") {
                    $shipAddress = $row['shipStreetNum'] . " " . $row['shipStreet'] . "   APT: " . $row['shipAPT'] . ", " . $row['shipCity'] . " " . $row['shipState'] . " " . $row['shipZip'];
                    $billAddress = $row['billStreetNum'] . " " . $row['billStreet'] . "   APT: " . $row['billAPT'] . ",  " . $row['billCity'] . " " . $row['billState'] . " " . $row['billZip'];
                    $data=array("shipAddress"=>$shipAddress, "billAddress"=>$billAddress,"row"=>$row);
                    $this->load->view("Checkout_view",$data);
            }
        } else {
            $msg= "There is no item in your cart";
            $data=array("msg"=>$msg);
            $this->load->view('Checkout_view',$data);

        }
    } else if (isset($_POST['checkout']) && $_POST['checkout'] == "submit") {

        $shipAddress = $_POST['shipAddress'];
        $billAddress = $_POST['billAddress'];
        $card = $_POST['cardNum'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $CVS = $_POST['security'];
        $totalQty = 0;
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $cartItem) {
            $totalQty += $cartItem['qty'];
            $totalPrice += $cartItem['qty'] * $cartItem['proPrice'];
        }

        $customerId = $row['customerId'];
        date_default_timezone_set('America/Los_Angeles');
        $date = date("Y-m-d");
        $data=array("customerId"=>$customerId,
            "shipAddress"=>$shipAddress,
            "billAddress"=>$billAddress,
            "card"=>$card,
            "month"=>$month,
            "year"=>$year,
            "CVS"=>$CVS,
            "totalQty"=>$totalQty,
            "totalPrice"=>$totalPrice,
            "date"=>$date
        );
        $this->load->model("Checkout_model");
        $res=$this->Checkout_model->insert($data);

        /*$sql = "insert into OrderTable (orderDate,totalQuantity,totalPrice,paymentCard,CVS,cardMonth,cardYear,
shippingAddress,billingAddress,customerId) values('" . $date . "','" . $totalQty . "','" . $totalPrice . "','" . $card . "','"
            . $CVS . "','" . $month . "','" . $year . "','" . $shipAddress . "','" . $billAddress . "','" . $customerId . "');";

        $res = mysql_query($sql);*/
        if ($res=="success") {
            /*
            $sql = "select last_insert_id() from OrderTable";
            $res = mysql_query($sql);
            $row = mysql_fetch_assoc($res);
            $orderId = $row['last_insert_id()'];
            foreach ($_SESSION['cart'] as $cartItem) {
                $sql = "insert into OrderDetail (orderId,productID,productPrice,productQty) values('" . $orderId . "','" . $cartItem['proId']
                    . "','" . $cartItem['proPrice'] . "','" . $cartItem['qty'] . "');";
                $res = mysql_query($sql);
                if (!$res) {
                    echo $sql;
                }
            }
            unset($_SESSION['cart']);
            */
            $msg= "Order has been created successfully";
            $data=array("msg"=>$msg);
            $this->load->view('Checkout_message_view',$data);
            unset($_SESSION['cart']);

        } else {
            echo $res;
            $msg="Unable to submit Order";
            $data=array("msg"=>$msg);
            $this->load->view('Checkout_message_view',$data);
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
        $this->load->view('postlogin_end');

    }

}



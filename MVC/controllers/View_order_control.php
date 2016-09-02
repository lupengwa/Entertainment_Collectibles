<?php

class View_order_control extends CI_Controller
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
        $this->load->view('View_order_pre_view');


if ($res== "right") {
    $this->load->model("View_order_model");
    $res=$this->View_order_model->getOrders();
    foreach($res as $row){
        $data=array("row"=>$row);
        $this->load->view('View_order_view',$data);

    }




   /* $customerId = $row['customerId'];
    $sql = "select * from OrderTable where customerId='" . $customerId . "';";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $sql = "select * from OrderDetail where orderId='" . $row['orderId'] . "';";
        $detail_res = mysql_query($sql);
        echo "<div id='order_wrapper1'>
              <form id='order_detail' action='order_detail.php' method='POST'>
              <div id='orderInfor'>Date:" . $row['orderDate'] . "
              Total Price: " . $row['totalPrice'] . " Total Quantity: " . $row['totalQuantity'];
        echo "<input type='hidden' name='orderId' value='" . $row['orderId'] . "'>
                  <input type='submit' name='detail' value='detail'></form></div></div><br>";
    }*/


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


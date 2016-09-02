<?php
class Order_detail_control extends CI_Controller
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
        $orderId = $_POST['orderId'];
if ($res=="right") {
    $this->load->model("Customer_Infor_model");
    $row=$this->Customer_Infor_model->getCustomer($_SESSION['username'],$_SESSION['password']);
    $customerId = $row['customerId'];


    $this->load->model('Order_detail_model');
    $order=$this->Order_detail_model->getOrders($orderId);

    $itemlist=$this->Order_detail_model->getOrderlist($orderId);

    $data=array("row"=>$order);
    /*$sql = "select * from OrderTable where orderId='" . $orderId . "';";
    $res = mysql_query($sql);
    if ($row = mysql_fetch_assoc($res)) {
        $sql = "select * from OrderDetail where orderId='" . $orderId . "';";
        $detail_res = mysql_query($sql);*/

        /*
        echo "<div id='order_wrapper1'>
              <form id='order_detail' action='order_detail.php' method='POST'>
              <div id='orderDate'>Date: " . $row['orderDate'] . "</div>
              <div id='orderInfor'>
              <div id='orderItem''>
              <ul>";*/
        $this->load->view('Order_detail_table_view',$data);


      foreach($itemlist as $itemInfo){

          $productId=$itemInfo['productId'];
          $this->load->model('Order_detail_model');
          $item=$this->Order_detail_model->getProduct($productId);
          $data=array("itemInfo"=>$item,"item"=>$itemInfo);
          $this->load->view('Order_detail_item_view',$data);
      }
        $data=array("row"=>$order);
        $this->load->view('Order_detail_customer_view',$data);
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

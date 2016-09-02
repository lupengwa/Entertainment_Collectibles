<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Checkout_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function insert($data)
    {
        $sql = "insert into OrderTable (orderDate,totalQuantity,totalPrice,paymentCard,CVS,cardMonth,cardYear,
shippingAddress,billingAddress,customerId) values(?,?,?,?,?,?,?,?,?,?)";

        $this->db->trans_start();
        $this->db->query($sql,array($data["date"], $data["totalQty"], $data["totalPrice"],
            $data["card"],$data["CVS"],$data["month"], $data["year"],$data["shipAddress"], $data["billAddress"],
            $data["customerId"]));

        /*$sql="select $this->db->insert_id() from OrderTable";
        $query=$this->db->$query($sql);
            $sql = "select last_insert_id() from OrderTable";
            $res = mysql_query($sql);
            $row = mysql_fetch_assoc($res);
            $orderId = $row['last_insert_id()'];*/

        $orderId=$this->db->insert_id();
            foreach ($_SESSION['cart'] as $cartItem) {
                $sql = "insert into OrderDetail (orderId,productID,productPrice,productQty) values('" . $orderId . "','" . $cartItem['proId']
                    . "','" . $cartItem['proPrice'] . "','" . $cartItem['qty'] . "');";
                $this->db->query($sql);

            }
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            return "$sql";

        } else {
            return "success";
        }


    }

}
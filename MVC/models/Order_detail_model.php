<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Order_detail_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->database();

    }

    public function getOrders($orderId){
        $sql='select * from OrderTable where orderId=?';
        $query=$this->db->query($sql,array($orderId));
        foreach($query->result_array() as $row) {
            return $row;

        }

    }

    public function getOrderlist($orderId){
        $sql="select * from OrderDetail where orderId=?";
        $query=$this->db->query($sql,array($orderId));
        $data=[];
        $count=0;
        foreach($query->result_array() as $item){
            $data[$count]=$item;
            $count++;
        }
        return $data;
    }

    public function getProduct($productId){
        $sql="select * from Product where productId=?";
        $query=$this->db->query($sql,array($productId));
        foreach($query->result_array() as $product){
           return $product;
        }

    }


}
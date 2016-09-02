<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class SaleWeb_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->database();

    }

    public function checkuser($un,$pw){
        $sql='select * from customer where username = ? AND password = ?';
        $query=$this->db->query($sql,array($un,$pw));
        if($query->num_rows() == 1){
            return "right";
        } else {
            return "wrong";
        }

    }

    public function getSpecial(){
        date_default_timezone_set("America/Los_Angeles");
        $time=date("Y-m-d");
        $sql='select * from specialSale';
        $query=$this->db->query($sql);
        $count=0;
        foreach ($query->result_array() as $row){
            if($row['dateEnd']>$time){
                $sql='select * from Product where productId="'.$row['proId'].'"';
                $query_pro=$this->db->query($sql);
                $proInfor=$query_pro->result_array();
                $data[$count]=array("special"=>$row,"product"=>$proInfor);
                $count++;
            }
        }
        return $data;


    }

}
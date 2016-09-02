<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->database();

    }

    public function getcate($cate){
        $sql = "select * from Product where productCategoryId like ?";
        $query=$this->db->query($sql,array($cate));
        $count=0;
        date_default_timezone_set("America/Los_Angeles");
        $time=date("Y-m-d");
        foreach($query->result_array() as $row){
            $sql = "select * from specialSale where proId='" . $row['productId']."'";
            $query2=$this->db->query($sql);
            if($query2->num_rows() == 1){
                $data[$count]['product']=$row;
                $special=$query2->row();
                if($special->dateEnd >= $time && $special->dateStart<= $time) {
                    foreach ($query2->result_array() as $row2) {
                        $data[$count]['special'] = $row2;
                    }
                }

            } else {
                $data[$count]['product']=$row;
            }
            $count++;
        }

        return $data;

    }

    public function getcontent($content) {
        $data=[];
        $sql = "select * from Product where productName like ?";
        $query=$this->db->query($sql,array($content));
        $count=0;
        date_default_timezone_set("America/Los_Angeles");
        $time=date("Y-m-d");
        foreach($query->result_array() as $row){
            $sql = "select * from specialSale where proId='" . $row['productId']."'";
            $query2=$this->db->query($sql);
            if($query2->num_rows() == 1){
                $data[$count]['product']=$row;
                $special=$query2->row();
                if($special->dateEnd >= $time && $special->dateStart<= $time) {
                    foreach ($query2->result_array() as $row2) {
                        $data[$count]['special'] = $row2;
                    }
                }

            } else {
                $data[$count]['product']=$row;
            }
            $count++;
        }

        return $data;

    }

    public function getproid($content) {
        $data=[];
        $sql = "select * from Product where productId like ?";
        $query=$this->db->query($sql,array($content));
        $count=0;
        date_default_timezone_set("America/Los_Angeles");
        $time=date("Y-m-d");
        foreach($query->result_array() as $row){
            $sql = "select * from specialSale where proId='" . $row['productId']."'";
            $query2=$this->db->query($sql);
            if($query2->num_rows() == 1){
                $data[$count]['product']=$row;
                $special=$query2->row();
                if($special->dateEnd >= $time && $special->dateStart<= $time) {
                    foreach ($query2->result_array() as $row2) {
                        $data[$count]['special'] = $row2;
                    }
                }

            } else {
                $data[$count]['product']=$row;
            }
            $count++;
        }

        return $data;

    }



}

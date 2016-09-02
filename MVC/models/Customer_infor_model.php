<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Customer_infor_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->database();

    }

    public function getCustomer($un,$pw){
        $sql='select * from customer where username = ? AND password = ?';
        $query=$this->db->query($sql,array($un,$pw));
        if($query->num_rows() == 1){
            foreach($query->result_array() as $row) {
                return $row;
            }
        } else {
            return "wrong";
        }

    }


}
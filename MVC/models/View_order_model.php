<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class View_order_model extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->load->database();

    }

    public function getOrders(){
        $sql='select * from OrderTable';
        $query=$this->db->query($sql);
            $count=0;
            foreach($query->result_array() as $row) {
                $data[$count]=$row;
                $count++;
        }
        return $data;

    }


}
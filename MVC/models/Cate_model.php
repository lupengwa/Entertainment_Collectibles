<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Cate_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function getCate()
    {
        $sql="select * from ProductCategory";
        $count=0;
        $query=$this->db->query($sql);
        foreach($query->result_array() as $row){
        $array[$count]=$row['proCateId'];
        $count++;
        $array[$count]=$row['proCateName'];
        $count++;
    }
        return $array;
    }
}
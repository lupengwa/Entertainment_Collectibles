<?php
/**
 * Created by PhpStorm.
 * User: lupengwa
 * Date: 7/20/15
 * Time: 5:28 PM
 */

class Cate_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();

    }

    public function index()
    {
        $this->load->model("Cate_model");
        $array=$this->Cate_model->getCate();
        $data=array("cate"=>$array);
        $this->load->view("Cate_view",$data);


    }
}
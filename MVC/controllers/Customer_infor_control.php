<?php

class Customer_Infor_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();

    }

    public function index()
    {
        $time = time();
        $this->load->model('Customer_infor_model');
        $res=$this->Customer_infor_model->getCustomer($_SESSION['username'],$_SESSION['password']);



        //require "config.php";
        //$sql = "select * from customer where username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "';";
        //$res = mysql_query($sql);
        if ($res != "wrong") {
            $data=array("row"=>$res);
           $this->load->view("Customer_infor_view",$data);

        } elseif (($time - $_SESSION['start']) > 500) {
            $errmsg="Time Out";
            $this->load->view('prelogin');
            $data=array("errmsg"=>$errmsg);
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            $this->load->view('postlogin_end');
            session_destroy();
        } else {
            $errmsg="Please Login First";
            $this->load->view('prelogin');
            $data=array("errmsg"=>$errmsg);
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            $this->load->view('postlogin_end');
            session_destroy();

        }

    }
}

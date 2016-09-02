<?php

class Saleweb extends CI_Controller
{
    public function __construct(){
        parent::__construct();

        session_start();

    }

    public function index()
    {
        $time = time();


        //require "config.php";
        //$sql = "select * from customer where username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "';";
        //$res = mysql_query($sql);
        $this->load->model("Saleweb_model");
        $res=$this->Saleweb_model->checkuser($_SESSION['username'],$_SESSION['password']);

        $this->load->view('Pre_Saleweb');

       if ($res == "right") {
           $this->load->view('saleWeb.html');
           $this->load->view('saleWeb2.html');
        } elseif (($time - $_SESSION['start']) > 500) {
           $data=array("errmsg"=>"Time Out");
           $this->load->view('prelogin');
           $this->load->view('errormsg',$data);
           $this->load->view('postlogin');
            session_destroy();
        } else {
           $data=array("errmsg"=>"Please Login");
           $this->load->view('prelogin');
           $this->load->view('errormsg',$data);
           $this->load->view('postlogin');
            session_destroy();
        }
        $this->load->view("postlogin_end");


    }
}
<?php

class Customer_login extends CI_Controller
{
    public function __construct(){
        parent::__construct();

        session_start();

    }

    public function index()
    {
        if (isset($_POST['logout']) && $_POST['logout'] == "logout") {
            session_destroy();
            session_start();
        }

        $_SESSION['start'] = time();
        $res="";
        $un="";
        $pw="";

         if(isset($_POST['username'])) {
            $un=$_POST['username'];
         }
        if(isset($_POST['username'])) {
            $pw = $_POST['password'];
        }

        $errmsg = "";
        if (strlen($un) == 0) {
            $errmsg = "Invalid login";
        }
        if (strlen($pw) == 0) {
            $errmsg = "Invalid login";
        }
        if (strlen($un) == 0 && strlen($pw) == 0) {
            $errmsg = "";
        }
        if (strlen($un) > 0 && strlen($pw) > 0) {
            $this->load->model("Login_model");
                $res=$this->Login_model->getunpw($un,$pw);
                if($res=="wrong") {
                    $errmsg = "No matched user information found";
                }
        }



        if (strlen($errmsg) > 0) {
            $this->load->view('prelogin');
            $data=array("errmsg"=>$errmsg);
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            //require 'postlogin.html';
            //echo "</form>";
            //$sql = "select * from specialSale;";
           // $query = $this->db->query($sql);
            $this->load->model("Login_model");
            $row=$this->Login_model->getSpecial();
            if (isset($row) && !empty($row)) {
                $this->load->view('specialSaleHead_view');
                foreach($row as $item) {
                    $this->load->view('specialSale_view',$item);
                }
                $this->load->view('specialSaleTail_view');


            }
        } elseif ($res=="") {
            $this->load->view('prelogin');
            $this->load->view('postlogin');
            $this->load->model("Login_model");
            $row=$this->Login_model->getSpecial();
            if (isset($row) && !empty($row)) {
                $this->load->view('specialSaleHead_view');
                foreach($row as $item) {
                    $this->load->view('specialSale_view',$item);
                }
                $this->load->view('specialSaleTail_view');


            }
        } else {
            $_SESSION['username'] = $un;
            $_SESSION['password'] = $pw;
            $this->load->helper('url');
            redirect('Saleweb');
        }
    }
}


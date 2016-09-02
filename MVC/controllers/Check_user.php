<?php

class Check_user extends CI_Controller
{
    public function __construct(){
        parent::__construct();


    }

    public function index()
    {
        $username = $_POST['str'];

        $this->load->model("Login_model");
        $res = $this->Login_model->getuser($username);


        if ($res == "right") {
            $data = array("msg" => "Existed");
            $this->load->view('Checkout_message_view', $data);
        } else {
            $data = array("msg" => "OK");
            $this->load->view('Checkout_message_view', $data);
        }

    }
}




<?php
class Change_customer_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();

    }

    public function index()
    {

        $time = time();
        //require "config.php";
        //$sql = "select * from customer where username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "';";
        //$res = mysql_query($sql);
        $this->load->model("Login_model");
        $res=$this->Login_model->getunpw($_SESSION['username'],$_SESSION['password']);

        $this->load->view("Change_customer_pre_view");

        if ($res=="wrong") {
            $errmsg="Please Login First";
            $this->load->view('prelogin_start');
            $data=array("errmsg"=>$errmsg);
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            $this->load->view('postlogin_end');
            session_destroy();
        } elseif (($time - $_SESSION['start']) > 500) {
            $errmsg="Time Out";
            $this->load->view('prelogin');
            $data=array("errmsg"=>$errmsg);
            $this->load->view('errormsg',$data);
            $this->load->view('postlogin');
            $this->load->view('postlogin_end');
            session_destroy();
        } else {

            $change = $_POST['change'];

            if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email'])
                && isset($_POST['phone']) && isset($_POST['bstreetNumber']) && isset($_POST['bstreetName'])
                && isset($_POST['bapt']) && isset($_POST['bcity']) && isset($_POST['bState']) && isset($_POST['bzip'])
                && isset($_POST['streetNumber']) && isset($_POST['streetName'])
                && isset($_POST['apt']) && isset($_POST['city']) && isset($_POST['State']) && isset($_POST['zip'])
                && isset($_POST['cardnumber']) && isset($_POST['security']) && isset($_POST['month'])
                && isset($_POST['year']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['change'])
            ) {

                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $bstreetNum = $_POST['bstreetNumber'];
                $bstreetName = $_POST['bstreetName'];
                $bapt = $_POST['bapt'];
                $bcity = $_POST['bcity'];
                $bstate = $_POST['bState'];
                $bzip = $_POST['bzip'];
                $streetNum = $_POST['streetNumber'];
                $streetName = $_POST['streetName'];
                $apt = $_POST['apt'];
                $city = $_POST['city'];
                $state = $_POST['State'];
                $zip = $_POST['zip'];
                $cardnumber = $_POST['cardnumber'];
                $security = $_POST['security'];
                $month = $_POST['month'];
                $year = $_POST['year'];
                $username = $_POST['username'];
                $password = $_POST['password'];

            }


            if ($change == "change") {
                 $this->load->model('Customer_infor_model');
                $res=$this->Customer_infor_model->getCustomer($_SESSION['username'],$_SESSION['password']);
                if ($res != "wrong") {
                    $data = array("row" => $res);
                    //echo $data['row']['firstName'];
                    $this->load->view('Change_customer_form_view', $data);
                    unset($_POST['change']);
                } else {
                    $errmsg = "invalid user input";
                    $data = array("errmsg" => $errmsg);
                    $this->load->view('errormsg', $data);
                    //echo "<p style='color:red;'> invalid user input </p>";
                    unset($_POST['change']);
                }

            } else if ($change == "submit") {

                 $this->load->model('Change_customer_model');
                $data=array("firstName"=>$firstName,
                    "lastName"=>$lastName,
                    "email"=>$email,
                    "phone"=>$phone,
                    'bstreetNum'=> $bstreetNum,
                    'bstreetName'=> $bstreetName,
                    'bapt' => $bapt,
                    'bcity' => $bcity,
                    'bstate' => $bstate,
                    'bzip' => $bzip,
                    'streetNum'=> $streetNum,
                    'streetName'=> $streetName,
                    'apt' => $apt,
                    'city' => $city,
                    'state' => $state,
                    'zip' => $zip,
                    'cardnumber' => $cardnumber,
                    'security' => $security,
                    'month' => $month,
                    'year' => $year,
                    'username' => $username,
                    'password' => $password,
                    );

                $res=$this->Change_customer_model->change($data);
                $_SESSION['password']=$password;

               /* $sql = "update customer set firstName='" . $firstName . "', lastName='" . $lastName . "', BillStreetNum='" . $bstreetNum . "', billStreet='" . $bstreetName .
                    "', billAPT='" . $bapt . "', billCity='" . $bcity . "', billState=''" . $bstate . ", billZip='" . $bzip . "', shipStreetNum='" . $streetNum . "', shipStreet='" . $streetName . "', shipAPT='"
                    . $apt . "', shipCity='" . $city . "', shipState='" . $state . "', shipZip='" . $zip . "', cardNumber='" . $cardnumber . "', cardMonth='" . $month . "', cardYear='" .
                    $year . "'email='" . $email . "', phone='" . $phone . "', security='" . $security . "', username='" . $username . "', password='" . $password . "' where username='" . $_SESSION['username'] . "'
  		AND password='" . $_SESSION['password'] . "';";
                $res = mysql_query($sql);*/



                if ($res=="failure") {
                    $errmsg = "Error in changing";
                    $this->load->view('Change_customer_home_view');
                    $message=array("errmsg"=>$errmsg);
                    $this->load->view('Customersign_error_view',$message);
                    unset($_POST['change']);

                } else {
                    $errmsg = "user information update successfully";
                    $this->load->view('Change_customer_home_view');
                    $message=array("errmsg"=>$errmsg);
                    $this->load->view('Customersign_error_view',$message);
                    unset($_POST['change']);
                }

                /*if (!$res) {
                    require 'prelogin.html';
                    echo '<p style="color:red"> Unable to update</p>';
                    echo $sql;
                    require 'postlogin.html';
                    session_destroy();
                    unset($_POST['change']);
                } else {
                    echo '<p style="color:green"> Update successfully,please click back to the main page</p>';
                    unset($_POST['change']);
                }*/

            }
        $this->load->view('Change_customer_end_view');
        }
    }


}
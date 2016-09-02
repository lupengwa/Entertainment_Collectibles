<?php
class Customersign_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        session_start();

    }

    public function index()
    {

        $type = $_POST['submit_type'];
       if ( isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email'])
       && isset($_POST['phone']) && isset( $_POST['bstreetNumber']) && isset( $_POST['bstreetName'])
       && isset($_POST['bapt']) && isset($_POST['bcity']) && isset($_POST['bState']) && isset($_POST['bzip'])
       && isset( $_POST['streetNumber']) && isset( $_POST['streetName'])
           && isset($_POST['apt']) && isset($_POST['city']) && isset($_POST['State']) && isset($_POST['zip'])
           && isset($_POST['cardnumber']) && isset($_POST['security']) && isset($_POST['month'])
           && isset($_POST['year']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['submit_type'])) {

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

           /*$this->load->helper('security');

           $this->load->helper(array('form', 'url','email'));

           $check_array = array(
               'firstName'=>$firstName,
               'lastName'=> $lastName,
               'email'=>$email,
               'phone'=>$phone,
               'bstreetNum'=>$bstreetNum,
               'bstreetName'=>$bstreetName,
               'bapt'=>$bapt,
               'bcity'=>$bcity,
               "bstate"=>$bstate,
               "bzip"=>$bzip,
               'streetNum'=>$streetNum,
               'streetName'=>$streetName,
               'apt'=>$apt,
               'city'=>$city,
               "state"=>$state,
               "zip"=>$zip,
               'cardnumber'=>$cardnumber,
               'security'=>$security,
               'month'=>$month,
               'year'=>$year ,
               'username' =>$username,
               'password'=>$password
           );


           $this->form_validation->set_rules('username','Username','required|encode_php_tags|trim|alpha_numeric');

           $this->form_validation->set_rules('password','Password','required|encode_php_tags|trim|alpha_numeric');

           $this->form_validation->set_rules('firstName','First name','required|encode_php_tags|trim|alpha');

           $this->form_validation->set_rules('lastName','Last name','required|encode_php_tags|trim|alpha');

           $this->form_validation->set_rules('state','State','required|encode_php_tags|trim|alpha');

           $this->form_validation->set_rules('bstate','State','required|encode_php_tags|trim|alpha');

           $this->form_validation->set_rules('city','City','required|encode_php_tags|trim|alpha');

           $this->form_validation->set_rules('bcity','City','required|encode_php_tags|trim|alpha');


           $this->form_validation->set_rules('streetNum','Street','required|encode_php_tags|trim|numeric');

           $this->form_validation->set_rules('bstreetNum','Street','required|encode_php_tags|trim|numeric');

           $this->form_validation->set_rules('streetName','Street','required|encode_php_tags|trim|alpha_numeric');

           $this->form_validation->set_rules('bstreetName','Street','required|encode_php_tags|trim|alpha_numeric');

           $this->form_validation->set_rules('zip','Street','required|encode_php_tags|trim|is_natural|exact_length[5]');

           $this->form_validation->set_rules('bzip','Street','required|encode_php_tags|trim|is_natural|exact_length[5]');


           $this->form_validation->set_rules('phone','Phone number','required|encode_php_tags|trim|is_natural|exact_length[10]');

          // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

           $this->form_validation->set_rules('cardnumber','Card Number','required|encode_php_tags|trim|is_natural|exact_length[16]');

           $this->form_validation->set_rules('year','Card year','required|encode_php_tags|trim|is_natural|greater_than[2014]|less_than[2100]');

           $this->form_validation->set_rules('month','Card month','required|encode_php_tags|trim|is_natural|greater_than[0]|less_than[13]');

           $this->form_validation->set_rules('security','Secure code','required|encode_php_tags|trim|is_natural|exact_length[3]');*/
       }






        //else {


            if (strlen($type) != 0 && $type == "submit" && strlen($firstName) != 0 && strlen($lastName) != 0 && strlen($email) != 0 && strlen($phone) != 0 && strlen($bstreetNum) != 0 &&
                strlen($bstreetName) != 0 && strlen($bapt) != 0 && strlen($bapt) != 0 && strlen($bstate) != 0 && strlen($bzip) != 0 && strlen($streetNum) != 0 && strlen($streetName) != 0
                && strlen($apt) != 0 && strlen($state) != 0 && strlen($zip) != 0 && strlen($cardnumber) != 0 && strlen($security) != 0 && strlen($month) != 0 && strlen($year) != 0
                && strlen($username) != 0 && strlen($password) != 0
            ) {
                $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
                if (!is_numeric($phone) || strlen($phone) != 10 || !is_numeric($bstreetNum)
                    || !is_numeric($bapt) || !is_numeric($bzip) || !is_numeric($streetNum) || !preg_match($regex, $email) || !is_numeric($apt) || !is_numeric($zip) ||
                    !is_numeric($cardnumber) || strlen($cardnumber) != 16 || $month < 1 || $month > 12 || strlen($year) != 4
                ) {
                    $errmsg = "There is error in the input information";
                    $this->load->view('Customersign_back_view');
                    $message = array("errmsg" => $errmsg);
                    $this->load->view('Customersign_error_view', $message);

                }/* else if($this->form_validation->run()==FALSE) {
                    $errmsg = "There is error in the input information";
                    $this->load->view('Customersign_back_view');
                    $message = array("errmsg" => $errmsg);
                    $this->load->view('Customersign_error_view', $message);

                }*/
                else {
                    $this->load->model("Customersign_model");

                    $data = array("firstName" => $firstName,
                        "lastName" => $lastName,
                        "email" => $email,
                        "phone" => $phone,
                        'bstreetNum' => $bstreetNum,
                        'bstreetName' => $bstreetName,
                        'bapt' => $bapt,
                        'bcity' => $bcity,
                        'bstate' => $bstate,
                        'bzip' => $bzip,
                        'streetNum' => $streetNum,
                        'streetName' => $streetName,
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
                        'submit' => $type);

                    $res = $this->Customersign_model->insert($data);

                    //require "config.php";
                    // $sql = "insert into customer (firstName,lastName,billStreetNum,billStreet,billAPT,billState,billZip,shipStreetNum,shipStreet,
                    //shipAPT,shipState,shipZip,email,phone,username,password,cardNumber,cardMonth,cardYear,security) values('" . $firstName . "','" . $lastName . "','" . $bstreetNum . "','" . $bstreetName . "','" . $bapt . "','" . $bstate . "','" . $bzip . "','" . $streetNum . "','" . $streetName . "','" . $apt . "','" . $state . "','" . $zip . "','" . $email . "','" . $phone . "','" . $username . "','" . $password . "','" . $cardnumber . "','" . $month . "','" . $year . "','" . $security . "');";
                    // $res = mysql_query($sql);
                    if ($res == "failure") {
                        $errmsg = "Error in inserting";
                        $this->load->view('Customersign_back_view');
                        $message = array("errmsg" => $errmsg);
                        $this->load->view('Customersign_error_view', $message);

                    } else {
                        $errmsg = "user information update successfully";
                        $this->load->view('Customersign_back_view');
                        $message = array("errmsg" => $errmsg);
                        $this->load->view('Customersign_error_view', $message);
                    }
                }

            } else if ($type == "signUp") {
                $this->load->view('Pre_customer_register.html');
                $this->load->view("Post_customer_register.html");

            } else {
                $errmsg = " invalid user";
                $this->load->view('Customersign_back_view');


            }
       // }

    }
}
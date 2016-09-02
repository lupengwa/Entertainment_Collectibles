<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Customersign_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function insert($data)
    {
        $sql = "insert into customer (firstName,lastName,billStreetNum,billStreet,billAPT,billCity,billState,billZip,shipStreetNum,shipStreet,
			shipAPT,shipCity,shipState,shipZip,email,phone,username,password,cardNumber,cardMonth,cardYear,security) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        //$sql = "insert into customer (firstName,lastName,billStreetNum,billStreet,billAPT,billState,billZip,shipStreetNum,shipStreet,
		//	shipAPT,shipState,shipZip,email,phone,username,password,cardNumber,cardMonth,cardYear,security) values('" . $firstName . "','" . $lastName . "','" . $bstreetNum . "','" . $bstreetName . "','" . $bapt . "','" . $bstate . "','" . $bzip . "','" . $streetNum . "','" . $streetName . "','" . $apt . "','" . $state . "','" . $zip . "','" . $email . "','" . $phone . "','" . $username . "','" . $password . "','" . $cardnumber . "','" . $month . "','" . $year . "','" . $security . "');";

        $query=$this->db->query($sql,array($data["firstName"], $data["lastName"], $data["bstreetNum"],
            $data["bstreetName"],$data["bapt"],$data["bcity"], $data["bstate"],$data["bzip"], $data["streetNum"],
            $data["streetName"],$data["apt"],$data["city"], $data["state"],$data["zip"], $data["email"],$data["phone"],
            $data["username"], $data["password"],$data["cardnumber"], $data["month"],  $data["year"],
            $data["security"]));

        if($this->db->affected_rows()!=1){
            return "failure";

        } else {
            return "success";
        }


    }

}
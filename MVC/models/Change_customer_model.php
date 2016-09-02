<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Change_customer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function change($data)
    {
        $sql = "update customer set firstName=?, lastName=?, BillStreetNum=?, billStreet=?,
 billAPT=?, billCity=?, billState=?, billZip=?, shipStreetNum=?, shipStreet=?, shipAPT=?,
  shipCity=?, shipState=?, shipZip=?, cardNumber=?, cardMonth=?, cardYear=?,email=?, phone=?, security=?, username=?, password=? where username=?";

        $this->db->trans_start();
        $query=$this->db->query($sql,array($data["firstName"], $data["lastName"], $data["bstreetNum"],
            $data["bstreetName"],$data["bapt"],$data["bcity"], $data["bstate"],$data["bzip"], $data["streetNum"],
            $data["streetName"],$data["apt"],$data["city"], $data["state"],$data["zip"],
            $data["cardnumber"], $data["month"],  $data["year"],$data["email"],$data["phone"],
            $data["security"],$data["username"], $data["password"],$data["username"]));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            return "failure";

        } else {
            return "success";
        }


    }

}
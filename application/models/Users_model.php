<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model
{
 
    
  public function getUserActive()
  {
      
      $query=$this->db->select
                        (
                        "full_name,
                         username,
                         branch_code,
                         subbranch,
                         last_time_login,
                         full_name_kh,                        
                         counterrorlogin")
                    ->where('status',1)
                    ->where('flag',1)
                    ->from("users")
                    ->get();
      return $query->result();
  }
   
 public function getUsername()
 {
     
      $result=$this->db->query("Call sp_send_emailalert()");
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
 }
public function getupdatestatussendmail($sendstatus,$userid)
{
    $result=$this->db->query("Call sp_CheckalreadySend('".$sendstatus."','".$userid."')");
    if($result==true)
    {
        return true;
    }else
    {
        return false;
    }
    
}
    
}
?>
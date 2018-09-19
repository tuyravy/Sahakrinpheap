<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class dailyloanhistory_model extends CI_Model
{
 
    
   public function  getDailyloanhistory($brcode,$reportdate)
   {
       $result=$this->db->query("CALL sp_getDailyloanhistory('".$brcode."','".$reportdate."')");
        $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
       
   }
  
    
}
?>
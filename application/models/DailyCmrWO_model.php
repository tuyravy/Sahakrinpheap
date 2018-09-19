<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class DailyCmrWo_model extends CI_Model
{
 
    
   public function getWO($start,$end,$role,$brcode,$key,$systemid)
   {
       $result=$this->db->query("Call sp_getNPLWO('".$start."','".$end."','".$role."','".$brcode."','".$key."','".$systemid."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
       
   }

   
    
}
?>
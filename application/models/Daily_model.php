<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Daily_model extends CI_Model
{
 
    
   public function getReportingset()
   {
       $result=$this->db->select(
                        'id,reportname,status,icon,iconhide'
                        )
           ->from('reportsetting')
           ->where('status',1)
           ->where('flag',1)
           ->get();
       return $result->result();
       
   }
   public function getBrcodeEmployee()
   {
       
       $result=$this->db->select('tbl_branch.brName,employee.brcode')
            ->distinct('employee.brcode')
            ->from('employee')
            ->join('tbl_branch','tbl_branch.brcode=employee.brcode')
            ->get();
       return $result->result();
   }
   public function getPositionEmployee($brcode)
   {
       $result=$this->db->from('title_employee')
                        ->join('employee','title_employee.id=employee.ti_employeeid')
                        ->where('employee.brcode',$brcode)
                        ->get();
       return $result->result();
   }
   
    
}
?>
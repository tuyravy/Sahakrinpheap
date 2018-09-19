
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class setting_model extends CI_Model
{
   public function getEOM($reportdate)
   {
       
       $result=$this->db->query("Call sp_EOM('".$reportdate."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
       
       
   }
   public function getChecking($reportdate)
   {
       
       $result=$this->db->query("select 
                                    tb.brNameKh,
                                    tb.brCode,
                                    'Please Checking' as Checking,
                                    
                                    count(d.brcode)
                                    from daily_loanhistory d 
                                    inner join tbl_branch tb on d.brcode=tb.brcode
                                    where d.reportdate='".$reportdate."'
                                    group by 
                                    tb.brNameKh,
                                    tb.brCode,
                                    d.brcode
                                    having count(d.brcode)>1
                                    "
                               );
      
       return $result->result();
   }
   public function getCheckLoandetail($reportdate)
   {
       $result=$this->db->query("
                                select tb.brNamekh,l.brcode,l.idClient,'Please Checking' as Checking,count(l.idClient) as Number
                                from loandetail l
                                inner join tbl_branch tb on l.brcode=tb.brcode
                                where l.reportdate='".$reportdate."'
                                group by l.brcode,l.idClient,tb.brNamekh
                                having count(l.idClient)>1
                                ");
         return $result->result();
   }
   public function getDataLoanDuplicate($reportdate)
   {
       $start=date('Y-m-01',strtotime($reportdate));
       $result=$this->db->query("
                                select 
                                    brname,
                                    brcode,
                                    Acc,
                                    count(Acc) as total
                                from loandetail 
                                where reportdate between '".$start."' and '".date('Y-m-01',strtotime($reportdate))."'
                                    group by Acc,brcode
                                having count(Acc)>1
                                ");
         return $result->result();
   }
   public function getDateCheckingByLoan($reportdate)
   {

       $start=date('Y-m-01',strtotime($reportdate));
       $result=$this->db->query("
                                    call sp_getDateCheckingByLoan('".$start."','".date('Y-m-d',strtotime($reportdate))."');
                                    "
                               );
      
                               $res= $result->result();
                               $result->next_result(); 
                               $result->free_result();
                               return $res;
   }
}
?>
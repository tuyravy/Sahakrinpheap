<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Function_model extends CI_Model
{ 
    protected $role;
    protected $brcode;
    protected $subbrcode;
    public function __construct(){
    $this->role =$this->session->userdata('role');
    $this->brcode =$this->session->userdata('branch_code');
    $this->subbrcode =$this->session->userdata('subbranch');
    }
    public function GetPreReportDate($reportdate)
    {
        $reportdate=date('Y-m-d',strtotime($reportdate));
        $re=$this->db->query("
                        SELECT MAX(dateworking) AS dateworking
                        FROM workingday
                        WHERE flag=1
                        AND STATUS=1
                        AND dateworking<'".$reportdate."';
                        "
        );
        foreach($re->result() as $row)
        {
            return $row->dateworking;
        }
    }
    public function GetPreMonthCurrRundate()
    {
        
        $re=$this->db->query("
                            select LAST_DAY(NOW() - INTERVAL 1 MONTH) as dateworking;");
        foreach($re->result() as $row)
        {
            return $row->dateworking;
        }
    }
    
    public function status($role,$brcode,$subbrcode)
    {
            $sid=$this->session->userdata('system_id');
            $datenow=date("Y-m-d");
            switch($role)
            {
                case 1:
                break;
                case 2:
                    $result=$this->db->query
                     (
                         "select 
                            count(*) as Upload 
                            from upload_history where ReportDate='".$datenow."' and brcode in('".$brcode."','".$subbrcode."')"
                     );
                     if($result->num_rows()>0){
                        foreach($result->result() as $row)
                        {
                            return $row->Upload;
                        }
                    }
                    return 0;
                break;
                case 3:
                        $result=$this->db->query
                        (
                            "select 
                            count(*) as Upload 
                            from upload_history where ReportDate='".$datenow."' and brcode in('".$this->GetBrCodebyRm($sid)."')"
                        );
                        if($result->num_rows()>0){
                            foreach($result->result() as $row)
                            {
                                return $row->Upload;
                            }
                        }
                    return 0;
                break;
                case 4:
                break;
                case 5:
                break;
                case 6:
                break;
            }
    }
   
    
    public function GetCurrRunDate()
    {
        $status=$this->status($this->role,$this->brcode,$this->subbrcode);
        $datenow=date("Y-m-d");
        if($status>=1)
        {
            $result=$this->db->query("
                select max(dateworking) as dateworking
                from workingday
                where flag=1
                and status=1
                AND dateworking>='".$datenow."'"
            );
            foreach($result->result() as $row)
            {
                return $row->dateworking;
            }
        }else
        {
            $result=$this->db->query("
                select max(dateworking) as dateworking
                from workingday
                where flag=1
                and status=1
                AND dateworking<'".$datenow."'"
            );
            foreach($result->result() as $row)
            {
                return $row->dateworking;
            }
        }
        
    }
    
    public function GetBrCodebyRm($sid)
    {
        $result=$this->db->query("select branch_control from rm where flag=1 and sid='".$sid."'");
        foreach($result->result() as $row)
        {
            return $row->branch_control;
        }
    }
    public function GetRMname($sid)
    {
        
         $result=$this->db->query("select * from tbl_branch where flage=1 and brcode in(".$this->Function_model->GetBrCodebyRm($sid).")");     
         return $result->result();
        
    }
}
?>
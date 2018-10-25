<?php

class imports_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        
    }
    
    function insertadd_csv($data) {
        $this->db->insert('attendance', $data);
    }
    function insert_csv($data) {
        $this->db->insert('staff', $data);
    }
    public function get_all_header() {
        $query = $this->db
                ->select('COLUMN_NAME')
                ->from('INFORMATION_SCHEMA.COLUMNS')
                ->where('table_name', 'parvalues')
                ->get();
        return $query->result();
    }
    public function getImportfiles()
    {
        $result=$this->db->select(
                        'upload_history.modified_by,
                         upload_history.ReportDate,
                         upload_history.file_name,
                         upload_history.pc_name,
                         upload_history.created_date,
                         users.full_name,
                         users.user_id
                        ')
                        ->from('upload_history')
                        ->join('users','users.user_id=upload_history.modified_by')
                        ->where('upload_history.flag',1)
                        ->order_by('upload_history.ReportDate','DESC')
                        ->get();
        return $result->result();
    }
    public function endoffmonth()
    {
        $reportdate=date("Y-m-28");
        $result=$this->db->select('system_ID,dpt_id,brCode')
                    ->from('staff')
                    ->where('flag',1)
                    ->get();
        foreach($result->result() as $row)
        {
            $this->runeom($row->system_ID,$row->dpt_id,$reportdate);
        }
                       
    }
    public function runeom($sid,$dtp,$reportdate)
    {
            $res=$this->db->query("CALL st_checkdate('".$sid."','".$dtp."','".$reportdate."')");
    }
    public function totalovertime()
    {
        $results=$this->db->from('eomsystem')
                        ->where('flag',1)
                        ->get();
        foreach($results->result() as $row)
        {
            $overtime=$this->overtimeamount($row->dpt_id,$row->level);
            $overtimehours=$this->overtimehours($row->dpt_id,$row->level);
            $bonus_ot=($overtime/$overtimehours)*(round($row->number_ot,2));
        
            $data=array
                  (
                    'bonus_ot'=>$bonus_ot,
                    'bonus_other'=>0,
                    'bast_salary'=>0
                  ); 
            $this->db->where('staff_id',$row->staff_id);
            $this->db->update('eomsystem',$data);
            
        }
    }
    public function overtimeamount($dpt,$leave)
    {
        $result=$this->db->from('overtime')
                        ->where('dpt_id',$dpt)
                        ->where('level',$leave)
                        ->where('flag',1)
                        ->get();
        foreach($result->result() as $res)
        {
            return $res->bouns_amount;
        }
    }
    public function overtimehours($dpt,$leave)
    {
        $result=$this->db->from('overtime')
                        ->where('dpt_id',$dpt)
                        ->where('level',$leave)
                        ->where('flag',1)
                        ->get();
        foreach($result->result() as $res)
        {
            return $res->hours;
        }
    }
   /* public function checkdate()
    {
        $result=$this->db->from('departments')
                        ->join('')
                        ->
    }
*/
}
/*END OF FILE*/

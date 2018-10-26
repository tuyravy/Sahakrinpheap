<?php
class FN_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        
    }   
    PUBLIC FUNCTION INTERBRANCH($startdate,$enddate,$brcode)
    {
        $result=$this->db->query("CALL FN_cashinterbranch_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
       
    }
    
    PUBLIC FUNCTION CASHINFLOW($startdate,$enddate,$brcode)
    {
        $result=$this->db->query("CALL FN_cashinflow_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION CASHOUTFLOW($startdate,$enddate,$brcode)
    {
        $result=$this->db->query("CALL FN_cashoutflow_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION GETBRANCH()
    {
        $result=$this->db->get("tbl_branch");
        return $result->result();
    }
    PUBLIC FUNCTION DONLOADCASHINTERBRANCH($startdate,$enddate,$brcode)
    {

        $result=$this->db->query("CALL FN_cashinterbranch_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
        
    }
    PUBLIC FUNCTION GETSUMMARYDETAIL($startdate,$enddate,$brname,$page)
    {
        $result=$this->db->query("CALL FN_dailycashmovement_summary('".$startdate."','".$enddate."','".$brname."','".$page."');");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION TOTALSUMMARYDETAIL($startdate,$enddate)
    {
        $result=$this->db->query("select count(distinct(postdate)) as total from dailycashmovement where postdate between '".$startdate."' and '".$enddate."'");
        foreach($result->result() as $row){
            return $row->total;
        }
    }
    PUBLIC FUNCTION DOWNLOADSUMMARYCASHDETAIL($datestart,$dateend,$brcode)
    {
        $result=$this->db->query("CALL FN_dailycashmovement_donwloadsummary('".$datestart."','".$dateend."','".$brcode."');");
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION CASHBYTRANSITION($startdate,$enddate,$brcode,$page)
    {
        if ($brcode=='All')
        {
            $result=$this->db->query("select * from dailycashmovement where postdate between '".$startdate."' and '".$enddate."'");
            return $result->result();

        }else{
            $result=$this->db->query("select * from dailycashmovement where postdate between '".$startdate."' and '".$enddate."' and BrCode='".$brcode."' limit 10 offset ".$page."");
            return $result->result();
        }
       
    }
    PUBLIC FUNCTION DOWNLOADCASHBYTRANSITION($startdate,$enddate,$brcode)
    {
        if ($brcode=='All'){
            $result=$this->db->query("select id,GLAcc,FullTitle,DrAmt,CrAmt,Begining,Ending,PostDate,Note_ContraACC,BrCode,BrShort,NameDate,ReportDate from dailycashmovement where postdate between '".$startdate."' and '".$enddate."'");
            return $result->result();
        }else{
            $result=$this->db->query("select * from dailycashmovement where postdate between '".$startdate."' and '".$enddate."' and BrCode='".$brcode."'");
            return $result->result();
        }
        
    }
    PUBLIC FUNCTION TOTALCASHBYTRANSITON($startdate,$enddate,$brcode)
    {
        $result=$this->db->query("select count(*) total from dailycashmovement where postdate between '".$startdate."' and '".$enddate."' and BrCode='".$brcode."'");
        foreach($result->result() as $row)
        {
            return $row->total;
        }
        
    }
    public function GetBrByUsers(){
        $sid=$this->session->userdata('system_id');
        $result=$this->db->from('rm')
                    ->where('sid',$sid)
                    ->where('flag',1)->get();
        $brlist=array();
       
        foreach($result->result() as $k=>$val){
           
             $brlist=explode(",",$val->branch_control);             
        }
        //print_r($brlist);
        $arraylist=array();
        foreach ($brlist as $value) {          
            $brcodelist=(int)$value;
            $result1 =$this->db->from('tbl_branch')
                            ->where('brCode',$brcodelist)
                            ->where('flage', 1)
                            ->get();
            foreach($result1->result() as $vl)
            {
                array_push($arraylist,$vl);    
            }
        }
        return  $arraylist;
    }
    public function GetBrByUser(){
        $userid=$this->session->userdata('user_id');
        $result=$this->db->from('users')
                    ->where('user_id',$userid)
                    ->where('flag',1)->get();
        $brlist=array();
       
        foreach($result->result() as $k=>$val){
           
             $brlist=explode(",",$val->subbranch);             
        }
        //print_r($brlist);
        $arraylist=array();
        foreach ($brlist as $value) {          
            $brcodelist=(int)$value;
            $result1 =$this->db->from('tbl_branch')
                            ->where('brCode',$brcodelist)
                            ->where('flage', 1)
                            ->get();
            foreach($result1->result() as $vl)
            {
                array_push($arraylist,$vl);    
            }
        }
        return  $arraylist;
    }
    PUBLIC FUNCTION FULLTRIALBALANCE($stardate,$brcode){

        if($brcode=='All')
        {
            $result=$this->db->query("select * from fn_fulltrialbalance where reportdate='".$stardate."'");
            //$this->output->enable_profiler(TRUE); 
           return $result->result();
        }else{

            $result=$this->db->query("select * from fn_fulltrialbalance where reportdate='".$stardate."' and brcode='".$brcode."'");
            //$this->output->enable_profiler(TRUE); 
           return $result->result();
        }
        

    }
}
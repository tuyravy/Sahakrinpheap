<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class DCEO_model extends CI_Model
{
    protected $Reportdate;
    protected $role;
    protected $brcode;
    protected $subbrcode;   
    public function __construct()
    {
         parent::__construct();  
         $this->load->model("Function_model"); 
         $this->Reportdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));   
         $this->role =$this->session->userdata('role');
         $this->brcode =$this->session->userdata('branch_code');
         $this->subbrcode =$this->session->userdata('subbranch'); 
         $this->sid=$this->session->userdata('system_id'); 
    }
    public function CheckUpload(){
        $result=$this->db->query(" CALL Cmr_CheckDataUpload('".$this->Reportdate."','".$this->sid."','".$this->role."')");        
        $res= $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        foreach($res as $row){
            
            return $row->counts;
        }
        return 0;
        
       
    }
    public function download_disb_byCo(){
        $db=$this->db->query("select 
                            sc1.IdCo,
                            sc1.COName as COName,
                            sum(sc1.Balance) as Balance,
                            sum(sc1.Clients) as Clients,
                            sum(sc1.PAR1Days) as PAR1Days,
                            sum(sc1.PAR7Days) as PAR7Days,
                            sum(sc1.PAR30Days) as PAR30Days,	
                            sum(sc1.DisbAmt) as DisbAmt,				 
                            tbl.shortcode as shortcode,
                            sc1.BrCode as BrCode,
                            '".$this->Reportdate."' as Reportdate
                        from summary_coperformant sc1 				
                        inner join tbl_branch tbl on tbl.brcode=sc1.brcode
                        where sc1.Reportdate='".$this->Reportdate."'
                        group by sc1.IdCo,sc1.COName
                        order by tbl.brcode
                    ");
        return $db->result();
    }
    public function gethistorydetailbyDECO($Reportdate,$type)
    {
         $result=$this->db->query("Call sp_GetHistorydetailbyDECO(".$Reportdate.",".$type.")");     
         $res      = $result->result();
          //add this two line 
          $result->next_result(); 
          $result->free_result(); 
         //end of new code
  
          return $res;
    }
    /*=================Loan Active and Portfolio=======*/
    
    public function loanActiveBorrowerByProduct($offset,$role)
    {       
        $sid=$this->db->select('sid')
                      ->from('rm')
                      ->where('flag',1)
                      ->where('rid',1)
                      ->get()->row();        
        $result=$this->db->query("Call Cmr_loanActiveBorrowerByProductDCEO('".$this->Reportdate."','".$sid->sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;     
    }
    public function overloaded_method($sid,$reportdate,$role)
    {  
        $result=$this->db->query("Call Cmr_loanActiveBorrowerByProductDCEO('".$reportdate."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;     
    }
    public function overloaded_loanPortfolioByProduct($sid,$reportdate,$role)
    {       
        $result=$this->db->query("Call Cmr_loanActiveBorrowerByProductDCEO('".$reportdate."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;    
    }
    
    public function loanPortfolioByProduct($offset,$role)
    {       
        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row();        
        $result=$this->db->query("Call Cmr_loanActiveBorrowerByProductDCEO('".$this->Reportdate."','".$sid->sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;     
    }
    /*====================End Active Borrower and Portfolio=====*/




    /*====================DisbInMonth===================*/
    public function LoanDisbInmonth(){

        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row();        
        $result=$this->db->query("Call Cmr_LoanDisbInmonthDCEO('".$this->Reportdate."','".$sid->sid."','1');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
    public function overloaded_LoanDisbInmonth($sid,$reportdate,$role){
        $result=$this->db->query("Call Cmr_LoanDisbInmonthDCEO('".$reportdate."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
   
    /*=======================End DisbInmoth=============*/

    /*============Loan Disb Daily====*/
    public function LoanDisbDaily(){

        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row();  
        $result=$this->db->query("Call Cmr_LoanDisbDaily('".$this->Reportdate."','".$this->Reportdate."','".$sid->sid."','1');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;

    }
    public function overloaded_LoanDisbDaily($reportdate,$reportend,$sid,$role){

        $result=$this->db->query("Call Cmr_LoanDisbDaily('".$reportdate."','".$reportend."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;

    }
    
    /*================End DisbDaily=======*/
    /*
        role=1 filter by curr reportdate and curr brcode
        role=2 filter by branch name and coname base on reportdate
        role=3 filter all branch for control
        role=4 filter all branch all co
    */
    public function RepaymentMonthly(){
        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row(); 
        $result=$this->db->query("Call Cmr_RepaymentDCEO('".$this->Reportdate."','".$this->Reportdate."','".$sid->sid."','1');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_RepaymentMonthly($sid,$reportdate,$reportend,$role){
        $result=$this->db->query("Call Cmr_RepaymentDCEO('".$reportdate."','".$reportend."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }

    public function RepaymentDaily(){
        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row(); 
        $result=$this->db->query("Call Cmr_RepaymentDCEO('".$this->Reportdate."','".$this->Reportdate."','".$sid->sid."','1');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_RepaymentDaily($sid,$reportdate,$reportend,$role){
        
        $result=$this->db->query("Call Cmr_RepaymentDCEO('".$reportdate."','".$reportend."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
   
    public function PortfolioQualitybyProductDaily(){
        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row(); 
        $result=$this->db->query("Call Cmr_PortfolioQualitybyProductDailyDCEO('".$this->Reportdate."','".$this->Reportdate."','".$sid->sid."','1');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_PortfolioQualitybyProductDaily($sid,$reportdate,$reportend,$role){
        
        $result=$this->db->query("Call Cmr_PortfolioQualitybyProductDailyDCEO('".$reportdate."','".$reportend."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }

    public function PortfolioQualtiyRationsDaily(){
        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row(); 
        $result=$this->db->query("Call Cmr_PortfolioQualtiyRationsDailyDCEO('".$this->Reportdate."','".$this->Reportdate."','".$sid->sid."','1');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_PortfolioQualtiyRationsDaily($sid,$reportdate,$reportend,$role){
        $result=$this->db->query("Call Cmr_PortfolioQualtiyRationsDailyDCEO('".$reportdate."','".$reportend."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }



    
    public function DailyCoPerforment()
    {
        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row(); 
        $result=$this->db->query("Call Cmr_DailyCoperformentDCEO('".$this->Reportdate."','".$this->Reportdate."','".$sid->sid."','1','0');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
    public function overloaded_DailyCoPerforment($sid,$reportdate,$reportend,$role,$brcode)
    {
        $result=$this->db->query("Call Cmr_DailyCoperformentDCEO('".$reportdate."','".$reportend."','".$sid."','".$role."','".$brcode."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
    public function DailyBrPerforment()
    {
        $sid=$this->db->select('sid')
        ->from('rm')
        ->where('flag',1)
        ->where('rid',1)
        ->get()->row(); 
       
        $result=$this->db->query("Call Cmr_DailyBranchPerformentDCEO('".$this->Reportdate."','".$this->Reportdate."','".$sid->sid."','1');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res; 
    }
    public function overloaded_DailyBrPerforment($sid,$reportdate,$reportend,$role)
    {
        $result=$this->db->query("Call Cmr_DailyBranchPerformentDCEO('".$reportdate."','".$reportend."','".$sid."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
    public function GetBrByUser(){
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
    public function GetRMBYSID($sid){
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
    public function getcmrsummRMCEO($rmid,$reportdate,$type)
    {
       $result=$this->db->query("Call Cmr_SummaryCMRByRM('".$rmid."','".$reportdate."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       foreach($res as $row){
        return $row;
       }
      
    }
    public function SummaryCEO($reportdate)
    {
       $result=$this->db->query("Call Cmr_SummaryCEO('".$reportdate."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       foreach($res as $row){
        return $row;
       }
      
    }
         public function getsumary($reportdate)
        {
             
            $result=$this->db->query("Call Cmr_SummaryCEO('".$reportdate."')");     
            $res= $result->result();
            $result->next_result(); 
            $result->free_result();
            foreach($res as $row){
                return $row;
            }
        }
    public function GetRM(){
        $result=$this->db->select("branch_control,name,sid,rid")
                         ->from("rm")
                         ->where('flag',1)
                         ->get();
        return $result->result();
    }
    
    public function GetCoName($brcode)
    {
        $re=$this->db->select("distinct(IdCo) as IdCo,CoName")
                     ->from('par_values')
                     ->where('brcode',$brcode)
                     ->where('reportdate',$this->Reportdate)->get();
        return $re->result();
    }
    public function TotalCobyproduct(){
        $re=$this->db->select("count(*) as totalrow")
        ->from('par_values')
        ->where('brcode',$this->brcode)
        ->where('reportdate',$this->Reportdate)->get()->row();
        return $re->totalrow;
    }


    public function getdcmrsahakrinpheaceo()
  {
      $type=$this->session->userdata('types');
       $result=$this->db->query("Call sp_dcmrsahakrinpheaceo('".$this->Reportdate."','".$type."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       
       foreach($res as $rows)
       {
           return $rows;
       }
  }
  public function getRmNamebySID($sid){

        if($sid==1){
                $result=$this->db->select("branch_control,name,sid,rid")
                ->from("rm")
                ->where('flag',1)
                ->get()->row();
                return $result->name;
        }
        else{
            $result=$this->db->select("branch_control,name,sid,rid")
            ->from("rm")
            ->where('flag',1)
            ->where('sid',$sid)
            ->get()->row();
            return $result->name;
        }
  }


}
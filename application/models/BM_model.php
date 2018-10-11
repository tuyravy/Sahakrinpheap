<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class BM_model extends CI_Model
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
    public function  getDailyloanhistory($brcode,$reportdate)
    {
<<<<<<< .merge_file_a15400
       $result=$this->db->query("CALL Cmr_getDailyloanhistory('".$brcode."','".$reportdate."')");
=======
       $result=$this->db->query("CALL sp_getDailyloanhistory('".$brcode."','".$reportdate."')");
>>>>>>> .merge_file_a10264
        $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
       
   }
    /*=================Loan Active and Portfolio=======*/

    public function loanActiveBorrowerByProduct($offset)
    {       
        $result=$this->db->select('IdCo,CoName,BalAmt,Acc,PrName,tbl_branch.brcode,shortcode')
                        ->from('par_values')
                        ->join('tbl_branch','tbl_branch.brCode=par_values.brcode')
                        ->where('tbl_branch.brcode',$this->brcode)
                        ->where('Reportdate',$this->Reportdate)
                        ->limit(10,$offset)
                        ->get();  
                            
        return $result->result();
    }
    public function overloaded_method($brcode,$idco,$reportdate)
    {       
        $result=$this->db->select('IdCo,CoName,BalAmt,Acc,PrName,tbl_branch.brcode,shortcode')
                        ->from('par_values')
                        ->join('tbl_branch','tbl_branch.brcode=par_values.brcode')
                        ->where('idCo',$idco)
                        ->where('tbl_branch.brcode',$brcode)
                        ->where('Reportdate',$reportdate)                        
                        ->get();  
        //$this->output->enable_profiler(TRUE);                   
        return $result->result();
    }
    public function overloaded_loanPortfolioByProduct($brcode,$reportdate)
    {       
        $result=$this->db->select('IdCo,CoName,BalAmt,Acc,PrName,tbl_branch.brcode,shortcode')
                        ->from('par_values')
                        ->join('tbl_branch','tbl_branch.brcode=par_values.brcode')
                        ->where('tbl_branch.brcode',$brcode)                       
                        ->where('Reportdate',$reportdate)                        
                        ->get();  
        //$this->output->enable_profiler(TRUE);                   
        return $result->result();
    }
    public function overloaded_loanPortfolioByProductbycontrol($reportdate)
    {       
        $brControl=$this->GetBrByUser();
        $arraylist=array();
        foreach($brControl as $key=>$re){
            array_push($arraylist,$re->brCode);
        }
        
        $result=$this->db->select('IdCo,CoName,BalAmt,Acc,PrName,tbl_branch.brcode,shortcode')
                        ->from('par_values')
                        ->join('tbl_branch','tbl_branch.brcode=par_values.brcode')
                        ->where_in('tbl_branch.brcode',$arraylist)                       
                        ->where('Reportdate',$reportdate)                        
                        ->get();  
        //$this->output->enable_profiler(TRUE); 
                          
        return $result->result();
    }
    public function loanPortfolioByProduct($offset)
    {       
        $result=$this->db->select('IdCo,CoName,BalAmt,Acc,PrName,tbl_branch.brcode,shortcode')
                        ->from('par_values')
                        ->join('tbl_branch','tbl_branch.brcode=par_values.brcode')
                        ->where('tbl_branch.brcode',$this->brcode)
                        ->where('Reportdate',$this->Reportdate)
                        ->limit(10,$offset)
                        ->get();  
                            
        return $result->result();
    }
    /*====================End Active Borrower and Portfolio=====*/




    /*====================DisbInMonth===================*/
    public function LoanDisbInmonth($offset){

        $result=$this->db->select('IdCo,CoName,DisbAccMonth,DisbAmtMonth,PrName,tbl_branch.brcode,shortcode')
        ->from('dis_values')
        ->join("prtype","prtype.PrCode=dis_values.PrType")    
        ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode")     
        ->where('tbl_branch.brcode',$this->brcode)
        ->where('Reportdate',$this->Reportdate)
        ->limit(10,$offset)
        ->get(); 
        return $result->result();
    }
    public function overloaded_LoanDisbInmonth($brcode,$idco,$reportdate){

           
            $result=$this->db->select('IdCo,CoName,DisbAccMonth,DisbAmtMonth,PrName,dis_values.brcode,shortcode')
            ->from('dis_values')
            ->join("prtype","prtype.PrCode=dis_values.PrType")
            ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode")     
            ->where('dis_values.brcode',$brcode)
            ->where('idCo',$idco)
            ->where('Reportdate',$reportdate)           
            ->get(); 
            return $result->result();
    }
    public function overloaded_LoanDisbInmonthbyBrCode($brcode,$reportdate){

        $result=$this->db->select('IdCo,CoName,DisbAccMonth,DisbAmtMonth,PrName,dis_values.brcode,shortcode')
        ->from('dis_values')
        ->join("prtype","prtype.PrCode=dis_values.PrType")
        ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode") 
        ->where('dis_values.brcode',$brcode)        
        ->where('Reportdate',$reportdate)           
        ->get(); 
        return $result->result();
    }
    public function overloaded_LoanDisbInmonthbyReportdate($reportdate){

        $brControl=$this->GetBrByUser();
        $arraylist=array();
        foreach($brControl as $key=>$re){
            array_push($arraylist,$re->brCode);
        }
        $result=$this->db->select('IdCo,CoName,DisbAccMonth,DisbAmtMonth,PrName,dis_values.brcode,shortcode')
        ->from('dis_values')
        ->join("prtype","prtype.PrCode=dis_values.PrType")
        ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode") 
        ->where_in('dis_values.brcode',$arraylist)        
        ->where('Reportdate',$reportdate)           
        ->get(); 
        return $result->result();
    }
    /*=======================End DisbInmoth=============*/

    /*============Loan Disb Daily====*/
    public function LoanDisbDaily($offset){

        $result=$this->db->select('IdCo,CoName,DisbAccDaily,DisbAmtDaily,PrName,dis_values.brcode,shortcode')
        ->from('dis_values')
        ->join("prtype","prtype.PrCode=dis_values.PrType")
        ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode") 
        ->where('dis_values.brcode',$this->brcode)
        ->where('Reportdate',$this->Reportdate)
        ->limit(10,$offset)
        ->get(); 
        return $result->result();

    }
    public function overloaded_LoanDisbDaily($brcode,$idco,$reportdate,$reportend){

        $result=$this->db->select('IdCo,CoName,sum(DisbAccDaily) as DisbAccDaily,sum(DisbAmtDaily) as DisbAmtDaily,PrName,dis_values.brcode,shortcode')
        ->from('dis_values')
        ->join("prtype","prtype.PrCode=dis_values.PrType")
        ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode")
        ->where('dis_values.brcode',$brcode)
        ->where('IdCo',$idco)
        ->where('Reportdate>=',$reportdate)  
        ->where('Reportdate<=',$reportend)  
        ->group_by("PrType")    
        ->get(); 
        return $result->result();

    }
    public function overloaded_LoanDisbDailyBrCode($brcode,$reportdate,$reportend){

        $result=$this->db->select('IdCo,CoName,sum(DisbAccDaily) as DisbAccDaily,sum(DisbAmtDaily) as DisbAmtDaily,PrName,dis_values.brcode,shortcode')
        ->from('dis_values')
        ->join("prtype","prtype.PrCode=dis_values.PrType")
        ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode")
        ->where('dis_values.brcode',$brcode)
        ->where('Reportdate>=',$reportdate)  
        ->where('Reportdate<=',$reportend)   
        ->group_by('IdCo,PrType')   
        ->get(); 
        return $result->result();

    }
    public function overloaded_LoanDisbDailybyReportdate($reportdate,$reportend){
        $brControl=$this->GetBrByUser();
        $arraylist=array();
        foreach($brControl as $key=>$re){
            array_push($arraylist,$re->brCode);
        }
        $result=$this->db->select('IdCo,CoName,DisbAccDaily,DisbAmtDaily,PrName,dis_values.brcode,shortcode')
        ->from('dis_values')
        ->join("prtype","prtype.PrCode=dis_values.PrType")
        ->join("tbl_branch","tbl_branch.brCode=dis_values.brcode")
        ->where_in('dis_values.brcode',$arraylist)
        ->where('Reportdate>=',$reportdate)  
        ->where('Reportdate<=',$reportend) 
        ->group_by("brcode,IdCo,PrType") 
        ->order_by("brCode","DESC")    
        ->get(); 
        return $result->result();

    }

    /*================End DisbDaily=======*/
    /*
        role=1 filter by curr reportdate and curr brcode
        role=2 filter by branch name and coname base on reportdate
        role=3 filter all branch for control
        role=4 filter all branch all co
    */
    public function RepaymentMonthly($role){
        $result=$this->db->query("Call Cmr_RepaymentBM('".$this->Reportdate."','".$this->Reportdate."','".$this->brcode."','0','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_RepaymentMonthly($brcode,$idco,$reportdate,$reportend,$role){
        $result=$this->db->query("Call Cmr_RepaymentBM('".$reportdate."','".$reportend."','".$brcode."','".$idco."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }

    public function RepaymentDaily($role){
        $result=$this->db->query("Call Cmr_RepaymentDailyBM('".$this->Reportdate."','".$this->Reportdate."','".$this->brcode."','0','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_RepaymentDaily($brcode,$idco,$reportdate,$reportend,$role){
        $result=$this->db->query("Call Cmr_RepaymentDailyBM('".$reportdate."','".$reportend."','".$brcode."','".$idco."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
   
    public function PortfolioQualitybyProductDaily($role){
        $result=$this->db->query("Call Cmr_PortfolioQualitybyProductDaily('".$this->Reportdate."','".$this->Reportdate."','".$this->brcode."','0','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_PortfolioQualitybyProductDaily($brcode,$idco,$reportdate,$reportend,$role){
        $result=$this->db->query("Call Cmr_PortfolioQualitybyProductDaily('".$reportdate."','".$reportend."','".$brcode."','".$idco."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }

    public function PortfolioQualtiyRationsDaily($role){
        $result=$this->db->query("Call Cmr_PortfolioQualtiyRationsDaily('".$this->Reportdate."','".$this->Reportdate."','".$this->brcode."','0','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }
    public function overloaded_PortfolioQualtiyRationsDaily($brcode,$idco,$reportdate,$reportend,$role){
        $result=$this->db->query("Call Cmr_PortfolioQualtiyRationsDaily('".$reportdate."','".$reportend."','".$brcode."','".$idco."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;        
    }



    
    public function DailyCoPerforment($role)
    {
        $result=$this->db->query("Call Cmr_DailyCoperformentBM('".$this->Reportdate."','".$this->Reportdate."','".$this->brcode."','0','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
    public function overloaded_DailyCoPerforment($brcode,$idco,$reportdate,$reportend,$role)
    {
        $result=$this->db->query("Call Cmr_DailyCoperformentBM('".$reportdate."','".$reportend."','".$brcode."','".$idco."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
    public function DailyBrPerforment($role)
    {
        $result=$this->db->query("Call Cmr_DailyBranchPerformentBM('".$this->Reportdate."','".$this->Reportdate."','".$this->brcode."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
    }
    public function overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,$role)
    {
        $result=$this->db->query("Call Cmr_DailyBranchPerformentBM('".$reportdate."','".$reportend."','".$brcode."','".$role."');");     
        $res= $result->result(); 
        $result->next_result(); 
        $result->free_result(); 
        //$this->output->enable_profiler(TRUE);       
        return $res;   
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

}
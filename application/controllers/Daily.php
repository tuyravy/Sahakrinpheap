<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daily extends CI_Controller {
     public function __construct()
    {
         parent::__construct();       
         $this->load->model('Menu_model');        
         $this->load->model('DailyCmr_model');
         $this->load->library("pagination");
         $this->load->library('Excel');    
         $this->load->model('Function_model');
         $this->load->model('BM_model');
         include('Utility.php');
        if(!$this->session->userdata('user_id'))
        {              
               redirect(site_url('Login'));
        }    
        if($this->Menu_model->UserAccURL()==0){

            redirect(site_url('logout'));
        }
        
    }    

	
      
    public function activeBorrower()
    {
        $this->load->helper('url');
         $this->load->helper('form');
        $Utility=new Utility();
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['types']=$this->session->userdata('types');
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/activeBorrower';         
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['brlist']=$this->BM_model->GetBrByUser();
            if(isset($_GET['per_page']))
            {
                $page=$_GET['per_page'];
            }else
            {
                $page=0;
                $this->session->unset_tempdata(array("datestart","brname","idCo"));
            }
            $data['total_rows'] = $this->BM_model->TotalCobyproduct();       
            $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
            $base_url= base_url()."index.php/daily/activeBorrower";
            $total_rows=$this->BM_model->TotalCobyproduct();
            if(isset($_POST['brname']) || isset($_POST['coname']))
            {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){                   
                    $data['LoanActivebyProduct']=$this->BM_model->overloaded_loanPortfolioByProductbycontrol($reportdate);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['LoanActivebyProduct']=$this->BM_model->overloaded_loanPortfolioByProduct($brcode,$reportdate);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }
                                        
                    $data['LoanActivebyProduct']=$this->BM_model->overloaded_method($brcode,$idco,$reportdate);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['LoanActivebyProduct']=$this->BM_model->loanActiveBorrowerByProduct($page);
            }
            $Utility->pagination_config($total_rows,$base_url);
            $this->load->view('master_page',$data);
        
    }
    public function DownloadactiveBorrower($brcode=null,$idco=null,$reportdate)
    {
       
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));             
                    if($brcode=='All' && $idco=='All'){                   
                        $data=$this->BM_model->overloaded_loanPortfolioByProductbycontrol($reportdate);
                        $this->excel->stream($idco."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_loanPortfolioByProduct($brcode,$reportdate);
                        $this->excel->stream($idco."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_method($brcode,$idco,$reportdate);
                        $this->excel->stream($idco."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->loanActiveBorrowerByProduct(1);
                    $this->excel->stream($idco."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                }
            
    }
    public function GetCoName()
    {
        $brcode=$this->input->post("brcode");
        $msg = "Configer has been changed.";     
        $CoName=$this->BM_model->GetCoName($brcode);
        $opt="";
        $opt.="<option value=><< Select CoName >></option>";
        foreach($CoName as $re){
            $opt.="<option value='$re->IdCo'>";
            $opt.=$re->CoName;
            $opt.="</option>";          
        }
        $opt.="<option value=All>All</option>";
        echo $opt;
       
    }
    public function loanPortfolio()
    {
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['types']=$this->session->userdata('types');
        $data['title'] = lang('system_titel');    
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['total_rows'] = $this->BM_model->TotalCobyproduct();   
        $data['brlist']=$this->BM_model->GetBrByUser();    
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","brname","idCo"));
        }
        $base_url= base_url()."index.php/daily/loanPortfolio";
        $total_rows=$this->BM_model->TotalCobyproduct();      
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){                   
                    $data['LoanActivebyProduct']=$this->BM_model->overloaded_loanPortfolioByProductbycontrol($reportdate);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['LoanActivebyProduct']=$this->BM_model->overloaded_loanPortfolioByProduct($brcode,$reportdate);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }
                                        
                    $data['LoanActivebyProduct']=$this->BM_model->overloaded_method($brcode,$idco,$reportdate);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['LoanActivebyProduct']=$this->BM_model->loanPortfolioByProduct($page);
            } 
         
        
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/LoanPortfolio'; 
        $this->load->view('master_page',$data);
        
    }
    public function loanDisbInMonth()
    {           
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');    
        $data['types']=$this->session->userdata('types');
        $data['brlist']=$this->BM_model->GetBrByUser(); 
        $data['total_rows'] = $this->BM_model->TotalCobyproduct();   
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","brname","idCo"));
        }
        $base_url= base_url()."index.php/daily/loanDisbInMonth";
        $total_rows=$this->BM_model->TotalCobyproduct();
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){                   
                    $data['loanDisbInMonth']=$this->BM_model->overloaded_LoanDisbInmonthbyReportdate($reportdate);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['loanDisbInMonth']=$this->BM_model->overloaded_LoanDisbInmonthbyBrCode($brcode,$reportdate);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }                                       
                    $data['loanDisbInMonth']=$this->BM_model->overloaded_LoanDisbInmonth($brcode,$idco,$reportdate);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['loanDisbInMonth']=$this->BM_model->LoanDisbInmonth($page);
            } 
        
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/LoanDisbInMonth.php'; 
		$this->load->view('master_page',$data);
    }

    public function DownloadloanDisbInMonth($brcode=null,$idco=null,$reportdate)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));             
                    if($brcode=='All' && $idco=='All'){                   
                        $data=$this->BM_model->overloaded_LoanDisbInmonthbyReportdate($reportdate);
                        $this->excel->stream($idco."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_LoanDisbInmonthbyBrCode($brcode,$reportdate);
                        $this->excel->stream($idco."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_LoanDisbInmonth($brcode,$idco,$reportdate);
                        $this->excel->stream($idco."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->LoanDisbInmonth(1);
                    $this->excel->stream($idco."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                }


    }
    

    public function loanDisbDaily()
    {           
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel'); 
        $data['types']=$this->session->userdata('types');   
        $data['brlist']=$this->BM_model->GetBrByUser(); 
        $data['total_rows'] = $this->BM_model->TotalCobyproduct();   
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","dateend","brname","idCo"));
        }
        $base_url= base_url()."index.php/daily/loanDisbDaily";
        $total_rows=$this->BM_model->TotalCobyproduct();
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){                   
                    $data['loanDisbDaily']=$this->BM_model->overloaded_LoanDisbDailybyReportdate($reportdate,$reportend);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['loanDisbDaily']=$this->BM_model->overloaded_LoanDisbDailyBrCode($brcode,$reportdate,$reportend);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }                                       
                    $data['loanDisbDaily']=$this->BM_model->overloaded_LoanDisbDaily($brcode,$idco,$reportdate,$reportend);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['loanDisbDaily']=$this->BM_model->LoanDisbDaily($page);
            } 
       
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/LoanDisbDaily.php'; 
		$this->load->view('master_page',$data);
    }

    public function DownloadloanDisbDaily($brcode=null,$idco=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All' && $idco=='All'){                   
                        $data=$this->BM_model->overloaded_LoanDisbDailybyReportdate($reportdate,$reportend);
                        $this->excel->stream($idco."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_LoanDisbDailyBrCode($brcode,$reportdate,$reportend);
                        $this->excel->stream($idco."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_LoanDisbDaily($brcode,$idco,$reportdate,$reportend);
                        $this->excel->stream($idco."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->LoanDisbDaily(1);
                    $this->excel->stream($idco."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                }


    }


    public function repaymentinmonth()
    {
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');   
        $data['types']=$this->session->userdata('types');   
        $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
        $data['total_rows'] = $this->BM_model->TotalCobyproduct();   
        $data['brlist']=$this->BM_model->GetBrByUser();     
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $base_url= base_url()."index.php/daily/repaymentinmonth";
        $total_rows=$this->BM_model->TotalCobyproduct();   
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){     
                    $brcode=$this->session->userdata('system_id');                
                    $data['Repayment']=$this->BM_model->overloaded_RepaymentMonthly($brcode,$idco,$reportdate,$reportend,4);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['Repayment']=$this->BM_model->overloaded_RepaymentMonthly($brcode,$idco,$reportdate,$reportend,3);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }                                       
                    $data['Repayment']=$this->BM_model->overloaded_RepaymentMonthly($brcode,$idco,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['Repayment']=$this->BM_model->RepaymentMonthly(1);
            }     
        
        $Utility->pagination_config($total_rows,$base_url);        
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/Repaymentinmonth.php'; 
        $this->load->view('master_page',$data);
        
    }

    public function Downloadrepaymentinmonth($brcode=null,$idco=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All' && $idco=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->BM_model->overloaded_RepaymentMonthly($brcode,$idco,$reportdate,$reportend,4);
                        $this->excel->stream($idco."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_RepaymentMonthly($brcode,$idco,$reportdate,$reportend,3);
                        $this->excel->stream($idco."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_RepaymentMonthly($brcode,$idco,$reportdate,$reportend,2);
                        $this->excel->stream($idco."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->RepaymentMonthly(1);
                    $this->excel->stream($idco."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }



    public function repaymentdaily()
    {
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');   
        $data['brlist']=$this->BM_model->GetBrByUser();  
        $data['types']=$this->session->userdata('types');  
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));      
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){     
                    $brcode=$this->session->userdata('system_id');                
                    $data['Repayment']=$this->BM_model->overloaded_RepaymentDaily($brcode,$idco,$reportdate,$reportend,4);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['Repayment']=$this->BM_model->overloaded_RepaymentDaily($brcode,$idco,$reportdate,$reportend,3);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }                                       
                    $data['Repayment']=$this->BM_model->overloaded_RepaymentDaily($brcode,$idco,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['Repayment']=$this->BM_model->RepaymentDaily(1);
            }               
                      
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/repaymentdaily.php'; 
        $this->load->view('master_page',$data);       

    }
    public function Downloadrepaymentdaily($brcode=null,$idco=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All' && $idco=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->BM_model->overloaded_RepaymentDaily($brcode,$idco,$reportdate,$reportend,4);
                        $this->excel->stream($idco."_repayment_daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_RepaymentDaily($brcode,$idco,$reportdate,$reportend,3);
                        $this->excel->stream($idco."_repayment_daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_RepaymentDaily($brcode,$idco,$reportdate,$reportend,2);
                        $this->excel->stream($idco."_repayment_daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->RepaymentDaily(1);
                    $this->excel->stream($idco."_repayment_daily_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }

    public function PortfolioQualitybyProductDaily()
    {
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');              
        $data['brlist']=$this->BM_model->GetBrByUser();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){     
                    $brcode=$this->session->userdata('system_id');                
                    $data['quality']=$this->BM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$idco,$reportdate,$reportend,4);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['quality']=$this->BM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$idco,$reportdate,$reportend,3);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }                                       
                    $data['quality']=$this->BM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$idco,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['quality']=$this->BM_model->PortfolioQualitybyProductDaily(1);
            }
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/PortfolioQualitybyProductDaily.php'; 
        $this->load->view('master_page',$data);        
    }

    public function DownloadPortfolioQualitybyProductDaily($brcode=null,$idco=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All' && $idco=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->BM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$idco,$reportdate,$reportend,4);
                        $this->excel->stream($idco."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$idco,$reportdate,$reportend,3);
                        $this->excel->stream($idco."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$idco,$reportdate,$reportend,2);
                        $this->excel->stream($idco."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->PortfolioQualitybyProductDaily(1);
                    $this->excel->stream($idco."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }

    public function PortfolioQualtiyRationsDaily()
    {
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');      
        $data['brlist']=$this->BM_model->GetBrByUser();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){     
                    $brcode=$this->session->userdata('system_id');                
                    $data['Ratios']=$this->BM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$idco,$reportdate,$reportend,4);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['Ratios']=$this->BM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$idco,$reportdate,$reportend,3);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }                                       
                    $data['Ratios']=$this->BM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$idco,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['Ratios']=$this->BM_model->PortfolioQualtiyRationsDaily(1);
            }
                 
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/PortfolioQualtiyRatiosDaily.php'; 
        $this->load->view('master_page',$data);        
    }

    public function DownloadPortfolioQualtiyRationsDaily($brcode=null,$idco=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All' && $idco=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->BM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$idco,$reportdate,$reportend,4);
                        $this->excel->stream($idco."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$idco,$reportdate,$reportend,3);
                        $this->excel->stream($idco."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$idco,$reportdate,$reportend,2);
                        $this->excel->stream($idco."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->PortfolioQualtiyRationsDaily(1);
                    $this->excel->stream($idco."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }


    public function performentbyco()
    {
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');      
       
        $data['brlist']=$this->BM_model->GetBrByUser();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_POST['brname']) || isset($_POST['coname']))
        {
                $brcode=$this->input->post('brname');
                $idco=$this->input->post('coname');
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['brname']=$brcode;
                $data['idCo']=$idco;
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                $data['CoName']=$this->BM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"brname"=>$brcode,'idCo'=>$idco),null,300);
                if($brcode=='All' && $idco=='All'){     
                    $brcode=$this->session->userdata('system_id');                
                    $data['coperforment']=$this->BM_model->overloaded_DailyCoPerforment($brcode,$idco,$reportdate,$reportend,4);
                }   
                else if($idco=='All' && $brcode!='All')
                {
                    if($brcode==''){
                        $brcode=$this->session->userdata('branch_code');
                     } 
                    $data['coperforment']=$this->BM_model->overloaded_DailyCoPerforment($brcode,$idco,$reportdate,$reportend,3);
                }else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->BM_model->GetCoName($brcode);
                    }                                       
                    $data['coperforment']=$this->BM_model->overloaded_DailyCoPerforment($brcode,$idco,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->BM_model->GetCoName($this->session->userdata('branch_code'));
                $data['coperforment']=$this->BM_model->DailyCoPerforment(1);
            }
              
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/Performentbyco.php'; 
        $this->load->view('master_page',$data);        
    }

    public function Downloadperformentbyco($brcode=null,$idco=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All' && $idco=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->BM_model->overloaded_DailyCoPerforment($brcode,$idco,$reportdate,$reportend,4);
                        $this->excel->stream($idco."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else if($idco=='All' && $brcode!='All')
                    {
                        if($brcode==null){
                            $brcode=$this->session->userdata('branch_code');
                        } 
                        $data=$this->BM_model->overloaded_DailyCoPerforment($brcode,$idco,$reportdate,$reportend,3);
                        $this->excel->stream($idco."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_DailyCoPerforment($brcode,$idco,$reportdate,$reportend,2);
                        $this->excel->stream($idco."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->DailyCoPerforment(1);
                    $this->excel->stream($idco."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }

    public function brancPer()
    {
        $Utility=new Utility();      
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['title'] = lang('system_titel');
        $data['brlist']=$this->BM_model->GetBrByUser();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));  
        if(isset($_POST['brname']))
        {
                $brcode=$this->input->post('brname');
              
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['brname']=$brcode;               
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"brname"=>$brcode),null,300);
                if($brcode=='All'){     
                    $brcode=$this->session->userdata('system_id');                
                    $data['brperforment']=$this->BM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,3);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');                       
                    }                                       
                    $data['brperforment']=$this->BM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
                }else{
                
                    $data['brperforment']=$this->BM_model->DailyBrPerforment(1);
                }
                        
                $data['title'] = lang('system_titel');
                $data['viewpage']='daily/BranchPerforment.php'; 
                $this->load->view('master_page',$data);        
    }
    public function DownloadbrancPer($brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->BM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,3);
                        $this->excel->stream($brcode."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                   else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->BM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($brcode."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->BM_model->DailyBrPerforment(1);
                    $this->excel->stream($brcode."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }
    public function writtenoff()
    {
            $data['mlist']=$this->Menu_model->MainiManu();  
            $data['title'] = lang('system_titel');
            $data['viewpage']='daily/writtenoff.php'; 
            $this->load->view('master_page',$data);
    }
}

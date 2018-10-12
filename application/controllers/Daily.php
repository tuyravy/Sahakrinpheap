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
         $this->load->helper('url');
         $this->load->helper('form');    
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

    public function cmrbybranch()
    {
        $this->load->helper('url');
        $this->load->helper('form'); 
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/cmrbybranch.php'; 
		$this->load->view('master_page',$data);
        
    }
    //---------------------Controller RM-----------------//
    
   public function  active()
   {
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/active";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =4;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='rmdaily/activeBorrower.php'; 
		$this->load->view('master_page',$data);
   } 
  public function loanPort()
  {
         $this->load->helper('url');
        $this->load->helper('form');  
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='rmdaily/loanPortfolio.php'; 
		$this->load->view('master_page',$data);
      
  }
  public function loanDisb()
  {
         $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='rmdaily/loanDisbinMonth.php'; 
		$this->load->view('master_page',$data);
      
  }
  public function repayment()
  {
         $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='rmdaily/repaymentinmonth.php'; 
		$this->load->view('master_page',$data);
      
  }
//-----------------------------Role dceo-------------//
    
  public function consolidate()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/consolidate.php'; 
		$this->load->view('master_page',$data);
  }
  public function actived()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/actived";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);
              
       
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/activeBorrower.php'; 
		$this->load->view('master_page',$data);
        
  }
  public function loanPortd()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/loanPortd";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/loanPortfolio.php'; 
		$this->load->view('master_page',$data);
  }
  public function loanDisbd()
{
         $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
                                    $config["base_url"] = base_url() ."daily/loanDisbd";
                                    $config["total_rows"] = $this->DailyCmr_model->record_count();
                                    $config["per_page"] = 10;
                                    //$config["uri_segment"] =2;

                                    $config['full_tag_open'] = '<div class="pagination">';
                                    $config['full_tag_close'] = '</ul></div><!--pagination-->';
                                    $config['first_link'] = '&laquo; First';
                                    $config['first_tag_open'] = '<li class="prev page">';
                                    $config['first_tag_close'] = '</li>';
                                    $config['last_link'] = 'Last &raquo;';
                                    $config['last_tag_open'] = '<li class="next page">';
                                    $config['last_tag_close'] = '</li>';
                                    $config['next_link'] = 'Next';
                                    $config['next_tag_open'] = '<li class="next page">';
                                    $config['next_tag_close'] = '</li>';
                                    //$config['prev_link'] = '&larr; Previous';
                                    $config['prev_tag_open'] = '<li class="prev page">';
                                    $config['prev_tag_close'] = '</li>';
                                    $config['cur_tag_open'] = '<li class="active"><a href="">';
                                    $config['cur_tag_close'] = '</a></li>';
                                    $config['num_tag_open'] = '<li class="page">';
                                    $config['num_tag_close'] = '</li>';
                                    $config['display_pages'] = true;
                                    // 
                                    //$config['anchor_class'] = 'follow_link';
                                    $this->pagination->initialize($config);

        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/loanDisbInMonth.php'; 
		$this->load->view('master_page',$data);
  }
  public function numberofloandisbdaily()
  {
       $this->load->helper('url');
            $this->load->helper('form');
            $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
            $config = array();
            $config["base_url"] = base_url() ."daily/numberofloandisbdaily";
            $config["total_rows"] = $this->DailyCmr_model->record_count();
            $config["per_page"] = 10;
                                    //$config["uri_segment"] =2;

            $config['full_tag_open'] = '<div class="pagination">';
            $config['full_tag_close'] = '</ul></div><!--pagination-->';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
                                    //$config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            $config['display_pages'] = true;
                                    // 
                                    //$config['anchor_class'] = 'follow_link';
            $this->pagination->initialize($config);
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/numofLoandisbdaliy.php'; 
		$this->load->view('master_page',$data);
  }
    public function balamtofloandisbdaily()
  {
       $this->load->helper('url');
            $this->load->helper('form');
            $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
            $config = array();
            $config["base_url"] = base_url() ."daily/balamtofloandisbDaily";
            $config["total_rows"] = $this->DailyCmr_model->record_count();
            $config["per_page"] = 10;
                                    //$config["uri_segment"] =2;

            $config['full_tag_open'] = '<div class="pagination">';
            $config['full_tag_close'] = '</ul></div><!--pagination-->';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
                                    //$config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            $config['display_pages'] = true;
                                    // 
                                    //$config['anchor_class'] = 'follow_link';
            $this->pagination->initialize($config);
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/balamtofloandisbDaily.php'; 
		$this->load->view('master_page',$data);
  }
  public function loanDisbdbalamt()
{
            $this->load->helper('url');
            $this->load->helper('form');
            $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
            $config = array();
            $config["base_url"] = base_url() ."daily/loanDisbdbalamt";
            $config["total_rows"] = $this->DailyCmr_model->record_count();
            $config["per_page"] = 10;
                                    //$config["uri_segment"] =2;

            $config['full_tag_open'] = '<div class="pagination">';
            $config['full_tag_close'] = '</ul></div><!--pagination-->';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
                                    //$config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            $config['display_pages'] = true;
                                    // 
                                    //$config['anchor_class'] = 'follow_link';
            $this->pagination->initialize($config);
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/balofloandisbinmonth.php'; 
		$this->load->view('master_page',$data);
  }
public function loanDisbdlimit($page)
  {
                        
                                        $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                        $active=$this->DailyCmr_model->getDailyLoansdisbursementDCEO(10,$page,$datereports);
                                        foreach($active as $row){
                                  
                               echo "<tr>
                                  <td>$row->shortcode                            
                                  </td>
                                  <td>$row->Totalacc</td>
                                  <td>".number_format($row->ILD,0)."</td>
                                  <td>".number_format($row->ILF,0)."</td>
                                  <td>".number_format($row->GLD,0)."</td>
                                  <td>".number_format($row->GLF,0)."</td>
                                  <td>".number_format($row->ALI,0)."</td>
                                  <td>".number_format($row->ALG,0)."</td>
                                  <td>".number_format($row->MELI,0)."</td>
                                  <td>".number_format($row->MELG,0)."</td>
                                  <td>".number_format($row->SEL,0)."</td>
                                  <td>".number_format($row->PL,0)."</td>
                                  <td>".number_format($row->HRL,0)."</td>  
                                  <td>".number_format($row->EL,0)."</td>  
                                </tr>";
                               }
       
  }

public function valueloanDisbdlimit($page)
  {
                        
                       
                                        $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                        $active=$this->DailyCmr_model->getValueofLoansdisbursementinMonthDCEO($page,$datereports);
                                        foreach($active as $row){
                                  
                               echo "<tr>
                                  <td>";
                               echo $row->shortcode;                            
                               echo "</td><td>";
                               echo $row->Balance;
                               echo "</td>
                                  <td>".number_format($row->ILD,0)."</td>
                                  <td>".number_format($row->ILF,0)."</td>
                                  <td>".number_format($row->GLD,0)."</td>
                                  <td>".number_format($row->GLF,0)."</td>
                                  <td>".number_format($row->ALI,0)."</td>
                                  <td>".number_format($row->ALG,0)."</td>
                                  <td>".number_format($row->MELI,0)."</td>
                                  <td>".number_format($row->MELG,0)."</td>
                                  <td>".number_format($row->SEL,0)."</td>
                                  <td>".number_format($row->PL,0)."</td>
                                  <td>".number_format($row->HRL,0)."</td>  
                                  <td>".number_format($row->EL,0)."</td>  
                                </tr>";
                               }
       
  }
public function DailyvalueloanDisbdlimit($page)
  {
                        
                       
                                        $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                        $active=$this->DailyCmr_model->getValueofDailyLoansdisbursementinDCEO($page,$datereports);
                                        foreach($active as $row){
                                  
                               echo "<tr>
                                  <td>$row->shortcode                            
                                  </td>
                                  <td>$row->Balance</td>
                                  <td>".number_format($row->ILD,0)."</td>
                                  <td>".number_format($row->ILF,0)."</td>
                                  <td>".number_format($row->GLD,0)."</td>
                                  <td>".number_format($row->GLF,0)."</td>
                                  <td>".number_format($row->ALI,0)."</td>
                                  <td>".number_format($row->ALG,0)."</td>
                                  <td>".number_format($row->MELI,0)."</td>
                                  <td>".number_format($row->MELG,0)."</td>
                                  <td>".number_format($row->SEL,0)."</td>
                                  <td>".number_format($row->PL,0)."</td>
                                  <td>".number_format($row->HRL,0)."</td>  
                                  <td>".number_format($row->EL,0)."</td>  
                                </tr>";
                               }
       
  }
    
    
 public function repaymentd()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/repaymentd";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);       
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/repaymentinmonth.php'; 
		$this->load->view('master_page',$data);
  }
//   public function repaymentdaily()
//   {
//        $this->load->helper('url');
//         $this->load->helper('form');
//         $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
//         $config = array();
//         $config["base_url"] = base_url() ."daily/repaymentdaily";
//         $config["total_rows"] = $this->DailyCmr_model->record_count();
//         $config["per_page"] = 10;
//         //$config["uri_segment"] =2;
      
//         $config['full_tag_open'] = '<div class="pagination">';
//         $config['full_tag_close'] = '</ul></div><!--pagination-->';
//         $config['first_link'] = '&laquo; First';
//         $config['first_tag_open'] = '<li class="prev page">';
//         $config['first_tag_close'] = '</li>';
//         $config['last_link'] = 'Last &raquo;';
//         $config['last_tag_open'] = '<li class="next page">';
//         $config['last_tag_close'] = '</li>';
//         $config['next_link'] = 'Next';
//         $config['next_tag_open'] = '<li class="next page">';
//         $config['next_tag_close'] = '</li>';
//         //$config['prev_link'] = '&larr; Previous';
//         $config['prev_tag_open'] = '<li class="prev page">';
//         $config['prev_tag_close'] = '</li>';
//         $config['cur_tag_open'] = '<li class="active"><a href="">';
//         $config['cur_tag_close'] = '</a></li>';
//         $config['num_tag_open'] = '<li class="page">';
//         $config['num_tag_close'] = '</li>';
//         $config['display_pages'] = true;
//         // 
//         //$config['anchor_class'] = 'follow_link';
//         $this->pagination->initialize($config);       
//         $data['menulist']=$this->Menu_model->getUsermenu();
//         $data['submenu']=$this->Menu_model->getsubMenu();
//         $data['title'] = lang('system_titel');
//         $data['viewpage']='dceodaily/repaymentdaily.php'; 
// 		$this->load->view('master_page',$data);
      
//   }
  public function portfoliorationdaily()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/portfoliorationdaily";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);       
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/portfoliorationdaily.php'; 
		$this->load->view('master_page',$data);
  }
  public function portfoliobyproduct()
  {
      $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/portfoliobyproduct";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);       
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/portfoliobyproduct.php'; 
		$this->load->view('master_page',$data);
  }
  public function repaymentValue1($page)
  {
                                $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                $active=$this->DailyCmr_model->getRepaymentInMonthDCEO($page,$datereports);
                                foreach($active as $row){
                                  
                               echo "<tr style='text-align:right'>
                                  <td style='text-align:left'>$row->shortcode                            
                                  </td>
                                  <td>".number_format($row->Principle,0)."</td>
                                  <td>".number_format($row->Interest,0)."</td>
                                  <td>".number_format($row->Penalty,0)."</td>
                                  <td>".number_format($row->AdminFee,0)."</td>
                                  <td>".number_format($row->Principle1,0)."</td>
                                  <td>".number_format($row->Interest1,0)."</td>
                                  <td>".number_format($row->Penalty1,0)."</td>
                                  <td>".number_format($row->AdminFee1,0)."</td>                                 
                                 
                                </tr>";
                               }
     
  }
public function repaymentValue2($page)
  {
                                $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                $active=$this->DailyCmr_model->getDailyRepaymentDCEO($page,$datereports);
                                foreach($active as $row){
                                  
                               echo "<tr style='text-align:right'>
                                  <td style='text-align:left'>$row->shortcode                            
                                  </td>
                                  <td style='text-align:right'>".number_format($row->Principle,0)."</td>
                                  <td style='text-align:right'>".number_format($row->Interest,0)."</td>
                                  <td style='text-align:right'>".number_format($row->Penalty,0)."</td>
                                  <td style='text-align:right'>".number_format($row->AdminFee,0)."</td>
                                  <td style='text-align:right'>".number_format($row->Principle1,0)."</td>
                                  <td style='text-align:right'>".number_format($row->Interest1,0)."</td>
                                  <td style='text-align:right'>".number_format($row->Penalty1,0)."</td>
                                  <td style='text-align:right'>".number_format($row->AdminFee1,0)."</td>                                 
                                 
                                </tr>";
                               }
     
  }
  public function PortfolioDCEO($page)
  {     
                            $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                            $active=$this->DailyCmr_model->getPortfolioQualtiyRatiosDailyDCEO($page,$datereports);
                                foreach($active as $row){
                                  
                               echo "<tr style='text-align:right'>
                                  <td style='text-align:left'>$row->shortcode                            
                                  </td>
                                  <td style='text-align:right'>".number_format($row->BalAmt,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR1,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR7,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR30,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR1_Amt,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR7_Amt,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR30_Amt,0)."</td>
                                  <td style='text-align:right'>".(number_format($row->ParRatio1day,0)*100)."</td>                                 
                                  <td style='text-align:right'>".(number_format($row->ParRatio7day,0)*100)."</td>
                                  <td style='text-align:right'>".(number_format($row->ParRatio30day,0)*100)."</td>
                                </tr>";
                                }
  }
public function PortfolioProductDCEO($page)
                            {
                            $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                            $active=$this->DailyCmr_model->getPortfolioQualitybyProductDailyDCEO($page,$datereports);
                                foreach($active as $row){
                                  
                               echo "<tr style='text-align:right'>
                                  <td style='text-align:left'>$row->shortcode                            
                                  </td>
                                  <td style='text-align:right'>".number_format($row->PAR1EX,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR1NE,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR7EX,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR7NE,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR30EX,0)."</td>
                                  <td style='text-align:right'>".number_format($row->PAR30NE,0)."</td>
                                 
                                </tr>";
                                    
                              
                                }
                        }
 public function DailyBranchPerformentvalues($page)
 {
                                $brcode=$this->session->userdata('branch_code');
                                $role=$this->session->userdata('role');   
                                $sid=$this->session->userdata('system_id');
                                $active=$this->DailyCmr_model->DailyBranchPerforment($brcode,$role,'2017-06-30',$page);
                                $i=1;
                                $a=0;
                                foreach($active as $row){
                                $i=$a++;
                                     echo "<tr style='text-align:right'>
                                      <td>$a</td>
                                      <td style='text-align:left'>$row->shortcode                            
                                      </td>
                                      <td style='text-align:right'>".number_format($row->OS,0)."</td>
                                      <td style='text-align:right'>".$row->Cilent."</td>
                                      <td style='text-align:right'>".number_format($row->PAR1_Amt,0)."</td>
                                      <td style='text-align:right'>".number_format($row->PAR7_Amt,0)."</td>
                                      <td style='text-align:right'>".number_format($row->PAR30_Amt,0)."</td>
                                      <td style='text-align:right'>".number_format($row->Ratio1day,0)."</td>
                                      <td style='text-align:right'>".number_format($row->DisbAmtDaily,0)."</td>
                                      <td style='text-align:right'>".$row->DisbAccDaily."</td>
                                    </tr>";

                             
                                }
 }
   
  public function dcmrsahakrinpheaceo()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/dcmrsahakrinceo.php'; 
		$this->load->view('master_page',$data);
  } 
  public function cmrSummRMCEO()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/cmrSummRMCEO.php'; 
		$this->load->view('master_page',$data);
  } 
 public function dcmrPlanVsResult()
  {
       
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/dcmrPlanVsResult.php'; 
		$this->load->view('master_page',$data);
  } 
  public function dcmrResultAugVsSep()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/dcmrResultAugVsSep.php'; 
		$this->load->view('master_page',$data);
  } 
  public function dcmrResultDailyDisburse()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/dcmrResultDailyDisburse.php'; 
		$this->load->view('master_page',$data);
  } 
  public function dailycoperforment()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/dailycoperforment";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);      
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/dailycoperforment.php'; 
		$this->load->view('master_page',$data);
  } 
 public function brancPerforment()
  {
        
         $this->load->helper('url');
         $this->load->helper('form');
       
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/brancPerforment";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);    
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/brancPerforment.php'; 
        $this->load->view('master_page',$data);
  } 
PUBLIC FUNCTION DONWLOADBRANCHPERFORMENT($REPORTDATESTART,$REPORTDATEEND,$SID)
{
        $this->excel->setActiveSheetIndex(0);
        $data=$this->DailyCmr_model->DONWLOADBRANCHPERFORMENT($REPORTDATESTART,$REPORTDATEEND,$SID);        
        $this->excel->stream("DAILY_BRANCH_PERFOMENT_".$REPORTDATESTART."_AND_".$REPORTDATEEND.".xls",$data);
}
PUBLIC FUNCTION DONWLOADCOPERFORMENT($REPORTDATESTART,$REPORTDATEEND,$BRCODE)
{
        $this->excel->setActiveSheetIndex(0);
        $data=$this->DailyCmr_model->DONWLOADBRANCOCHPERFORMENT($REPORTDATESTART,$REPORTDATEEND,$BRCODE);        
        $this->excel->stream($BRCODE."_DAILY_CO_PERFOMENT_".$REPORTDATESTART."_AND_".$REPORTDATEEND.".xls",$data);
}
public function AllbranchPerforment()
  {
        
         $this->load->helper('url');
        $this->load->helper('form');
       
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/viewallbranchBranchPerforment.php'; 
        $this->load->view('master_page',$data);
  } 
public function daillyloan()
{
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/daillyloan";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);
    
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/dailyloan90.php'; 
        $this->load->view('master_page',$data);
}
public function loandisbbyinterest()
{
         $this->load->helper('url');
        $this->load->helper('form');
        $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
        
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/daillydisbursebyinterest.php'; 
        $this->load->view('master_page',$data);
}


public function daillydisbursebyinterestTest()
{
         $this->load->helper('url');
        $this->load->helper('form');
        $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
        
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/daillydisbursebyinterest_bak.php'; 
        $this->load->view('master_page',$data);
}

public function writtenoffcollection()
{
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/writtenoffcollection";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);
        $this->load->helper('url');
        $this->load->helper('form');
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='dceodaily/writtenoffcollection.php'; 
        $this->load->view('master_page',$data);
    
}
/*----------------BM roles---------------*/
public function writtenoff()
{
        $data['mlist']=$this->Menu_model->MainiManu();  
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/writtenoff.php'; 
        $this->load->view('master_page',$data);
}
/*-------------RM Role----------------*/
public function writtenoffrm()
{
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
        $config = array();
        $config["base_url"] = base_url() ."daily/writtenoffcollection";
        $config["total_rows"] = $this->DailyCmr_model->record_count();
        $config["per_page"] = 10;
        //$config["uri_segment"] =2;
      
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        //$config['anchor_class'] = 'follow_link';
        $this->pagination->initialize($config);
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='rmdaily/writtenoff.php'; 
        $this->load->view('master_page',$data);
}
    

}

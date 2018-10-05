<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DailyRm extends CI_Controller {
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
         $this->load->model('RM_model');
         include('Utility.php');
        if(!$this->session->userdata('user_id'))
        {              
               redirect(site_url('Login'));
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
        $data['viewpage']='daily/RM/activeBorrower';         
        $data['brlist']=$this->RM_model->GetBrByUser();
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
 
            if(isset($_GET['per_page']))
            {
                $page=$_GET['per_page'];
            }else
            {
                $page=0;
                $this->session->unset_tempdata(array("datestart","brname"));
            }
            $data['total_rows'] = $this->RM_model->TotalCobyproduct();       
            $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
            $base_url= base_url()."index.php/dailyrm/activeBorrower";
            $total_rows=$this->RM_model->TotalCobyproduct();
            if(isset($_POST['brname']))
            {
                $brcode=$this->input->post('brname');                
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $data['brname']=$brcode;                
                $data['reportdate']=$reportdate;               
                $this->session->set_tempdata(array("datestart"=>$reportdate,"brname"=>$brcode),null,300);
                if($brcode=='All'){                   
                    $data['LoanActivebyProduct']=$this->RM_model->overloaded_loanPortfolioByProductbycontrol($reportdate);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                      
                    }
                                        
                    $data['LoanActivebyProduct']=$this->RM_model->overloaded_method($brcode,$reportdate);
                }                   
                $data['total_rows'] = 1; 
            }else{
                
                $data['LoanActivebyProduct']=$this->RM_model->loanActiveBorrowerByProduct($page);
            }
            $Utility->pagination_config($total_rows,$base_url);
            $this->load->view('master_page',$data);
        
    }
    public function DownloadactiveBorrower($brcode=null,$reportdate)
    {
       
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));             
                    if($brcode=='All'){                   
                        $data=$this->RM_model->overloaded_loanPortfolioByProductbycontrol($reportdate);
                        $this->excel->stream($brcode."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                    }   
                    else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_method($brcode,$reportdate);
                        $this->excel->stream($brcode."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->loanActiveBorrowerByProduct(1);
                    $this->excel->stream($brcode."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                }
            
    }
    public function GetCoName()
    {
        $brcode=$this->input->post("brcode");
        $msg = "Configer has been changed.";     
        $CoName=$this->RM_model->GetCoName($brcode);
        $opt="";
        $opt.="<option value=>Select CoName</option>";
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
        $data['total_rows'] = $this->RM_model->TotalCobyproduct();   
        $data['brlist']=$this->RM_model->GetBrByUser();    
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","brname"));
        }
        $base_url= base_url()."index.php/dailyrm/loanPortfolio";
        $total_rows=$this->RM_model->TotalCobyproduct();      
        if(isset($_POST['brname']))
        {
                $brcode=$this->input->post('brname');
                
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $data['brname']=$brcode;               
                $data['reportdate']=$reportdate;
                $data['CoName']=$this->RM_model->GetCoName($brcode);
                $this->session->set_tempdata(array("datestart"=>$reportdate,"brname"=>$brcode),null,300);
                if($brcode=='All'){                   
                    $data['LoanActivebyProduct']=$this->RM_model->overloaded_loanPortfolioByProductbycontrol($reportdate);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       $data['CoName']=$this->RM_model->GetCoName($brcode);
                    }
                                        
                    $data['LoanActivebyProduct']=$this->RM_model->overloaded_method($brcode,$reportdate);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['CoName']=$this->RM_model->GetCoName($this->session->userdata('branch_code'));
                $data['LoanActivebyProduct']=$this->RM_model->loanPortfolioByProduct($page);
            } 
         
        
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/RM/LoanPortfolio'; 
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
        $data['brlist']=$this->RM_model->GetBrByUser(); 
        $data['total_rows'] = $this->RM_model->TotalCobyproduct();       
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","brname"));
        }
        $base_url= base_url()."index.php/dailyrm/loanDisbInMonth";
        $total_rows=$this->RM_model->TotalCobyproduct();
        if(isset($_POST['brname']))
        {
                $brcode=$this->input->post('brname');                
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $data['brname']=$brcode;               
                $data['reportdate']=$reportdate;                
                $this->session->set_tempdata(array("datestart"=>$reportdate,"brname"=>$brcode),null,300);
                if($brcode=='All'){                   
                    $data['loanDisbInMonth']=$this->RM_model->overloaded_LoanDisbInmonthbyReportdate($reportdate);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');                      
                    }                                       
                    $data['loanDisbInMonth']=$this->RM_model->overloaded_LoanDisbInmonth($brcode,$reportdate);
                }                   
                $data['total_rows'] = 1; 
            }else{
                
                $data['loanDisbInMonth']=$this->RM_model->LoanDisbInmonth($page);
            } 
        
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/RM/LoanDisbInMonth.php'; 
		$this->load->view('master_page',$data);
    }

    public function DownloadloanDisbInMonth($brcode=null,$reportdate)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));             
                    if($brcode=='All'){                   
                        $data=$this->RM_model->overloaded_LoanDisbInmonthbyReportdate($reportdate);
                        $this->excel->stream($idco."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                    }   
                   else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_LoanDisbInmonth($brcode,$reportdate);
                        $this->excel->stream($brcode."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->LoanDisbInmonth(1);
                    $this->excel->stream($brcode."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
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
        $data['brlist']=$this->RM_model->GetBrByUser(); 
        $data['total_rows'] = $this->RM_model->TotalCobyproduct();       
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","dateend","brname"));
        }
        $base_url= base_url()."index.php/dailyrm/loanDisbDaily";
        $total_rows=$this->RM_model->TotalCobyproduct();
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
                    $data['loanDisbDaily']=$this->RM_model->overloaded_LoanDisbDailybyReportdate($reportdate,$reportend);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');                       
                    }                                       
                    $data['loanDisbDaily']=$this->RM_model->overloaded_LoanDisbDaily($brcode,$reportdate,$reportend);
                }                   
                $data['total_rows'] = 1; 
            }else{
               
                $data['loanDisbDaily']=$this->RM_model->LoanDisbDaily($page);
            } 
       
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/RM/LoanDisbDaily.php'; 
		$this->load->view('master_page',$data);
    }

    public function DownloadloanDisbDaily($brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All'){                   
                        $data=$this->RM_model->overloaded_LoanDisbDailybyReportdate($reportdate,$reportend);
                        $this->excel->stream($brcode."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_LoanDisbDaily($brcode,$reportdate,$reportend);
                        $this->excel->stream($brcode."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->LoanDisbDaily(1);
                    $this->excel->stream($brcode."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['total_rows'] = $this->RM_model->TotalCobyproduct();   
        $data['brlist']=$this->RM_model->GetBrByUser();    
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
        $base_url= base_url()."index.php/dailyrm/repaymentinmonth";
        $total_rows=$this->RM_model->TotalCobyproduct();   
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
                    $data['Repayment']=$this->RM_model->overloaded_RepaymentMonthly($brcode,$reportdate,$reportend,3);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                       
                    }                                       
                    $data['Repayment']=$this->RM_model->overloaded_RepaymentMonthly($brcode,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
               
                $data['Repayment']=$this->RM_model->RepaymentMonthly(1);
            }     
        
        $Utility->pagination_config($total_rows,$base_url);        
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/RM/Repaymentinmonth.php'; 
        $this->load->view('master_page',$data);
        
    }

    public function Downloadrepaymentinmonth($brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->RM_model->overloaded_RepaymentMonthly($brcode,$reportdate,$reportend,3);
                        $this->excel->stream($brcode."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                   else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_RepaymentMonthly($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($brcode."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->RepaymentMonthly(1);
                    $this->excel->stream($brcode."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['brlist']=$this->RM_model->GetBrByUser();  
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
                    $data['Repayment']=$this->RM_model->overloaded_RepaymentDaily($brcode,$reportdate,$reportend,3);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                     
                    }                                       
                    $data['Repayment']=$this->RM_model->overloaded_RepaymentDaily($brcode,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
               
                $data['Repayment']=$this->RM_model->RepaymentDaily(1);
            }               
                      
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/RM/repaymentdaily.php'; 
        $this->load->view('master_page',$data);       

    }
    public function Downloadrepaymentdaily($brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null || $idco!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->RM_model->overloaded_RepaymentDaily($brcode,$reportdate,$reportend,3);
                        $this->excel->stream($brcode."_repayment_daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                   else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_RepaymentDaily($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($brcode."_repayment_daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->RepaymentDaily(1);
                    $this->excel->stream($brcode."_repayment_daily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['brlist']=$this->RM_model->GetBrByUser();
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
                    $data['quality']=$this->RM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$reportdate,$reportend,3);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');
                      
                    }                                       
                    $data['quality']=$this->RM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
               
                $data['quality']=$this->RM_model->PortfolioQualitybyProductDaily(1);
            }
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/RM/PortfolioQualitybyProductDaily.php'; 
        $this->load->view('master_page',$data);        
    }

    public function DownloadPortfolioQualitybyProductDaily($brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->RM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$reportdate,$reportend,3);
                        $this->excel->stream($brcode."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                   else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_PortfolioQualitybyProductDaily($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($brcode."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->PortfolioQualitybyProductDaily(1);
                    $this->excel->stream($brcode."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['brlist']=$this->RM_model->GetBrByUser();
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
                    $data['Ratios']=$this->RM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$reportdate,$reportend,3);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');                       
                    }                                       
                    $data['Ratios']=$this->RM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
               
                $data['Ratios']=$this->RM_model->PortfolioQualtiyRationsDaily(1);
            }                 
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/RM/PortfolioQualtiyRatiosDaily.php'; 
        $this->load->view('master_page',$data);        
    }

    public function DownloadPortfolioQualtiyRationsDaily($brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->RM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$reportdate,$reportend,3);
                        $this->excel->stream($brcode."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_PortfolioQualtiyRationsDaily($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($brcode."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->PortfolioQualtiyRationsDaily(1);
                    $this->excel->stream($brcode."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['brlist']=$this->RM_model->GetBrByUser();
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
                    $data['coperforment']=$this->RM_model->overloaded_DailyCoPerforment($brcode,$reportdate,$reportend,3);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');                       
                    }                                       
                    $data['coperforment']=$this->RM_model->overloaded_DailyCoPerforment($brcode,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
                
                $data['coperforment']=$this->RM_model->DailyCoPerforment(1);
            }
              
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/RM/Performentbyco.php'; 
        $this->load->view('master_page',$data);        
    }

    public function Downloadperformentbyco($brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($brcode=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->RM_model->overloaded_DailyCoPerforment($brcode,$reportdate,$reportend,4);
                        $this->excel->stream($brcode."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_DailyCoPerforment($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($brcode."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->DailyCoPerforment(1);
                    $this->excel->stream($brcode."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['brlist']=$this->RM_model->GetBrByUser();
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
                    $data['brperforment']=$this->RM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,3);
                }   
                else{
                    
                    if($brcode==''){
                       $brcode=$this->session->userdata('branch_code');                       
                    }                                       
                    $data['brperforment']=$this->RM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,2);
                }                   
                $data['total_rows'] = 1; 
                }else{
                
                    $data['brperforment']=$this->RM_model->DailyBrPerforment(1);
                }
                        
                $data['title'] = lang('system_titel');
                $data['viewpage']='daily/RM/BranchPerforment.php'; 
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
                        $data=$this->RM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,3);
                        $this->excel->stream($brcode."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                   else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->RM_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($brcode."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->RM_model->DailyBrPerforment(1);
                    $this->excel->stream($brcode."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }
    public function writtenoff()
{
        $data['mlist']=$this->Menu_model->MainiManu();  
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/RM/writtenoff.php'; 
        $this->load->view('master_page',$data);
}
}

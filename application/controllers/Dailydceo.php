<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dailydceo extends CI_Controller {
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
         $this->load->model('DCEO_model');
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
        $data['viewpage']='daily/DCEO/ActiveBorrower';         
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        $data['datestart']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     

        $base_url= base_url()."index.php/dailydceo/activeBorrower";
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","systemid"));
        }
            
            if(isset($_POST['systemid']))
            {
                $systemid=$this->input->post('systemid');
                $datestart=date('Y-m-d',strtotime($this->input->post('datestart')));                              
                $this->session->set_tempdata(array("datestart"=>$datestart,"systemid"=>$systemid),null,300);
                $data['systemid']=$this->session->tempdata('systemid');               
                $data['datestart']=$this->session->tempdata('datestart'); 
                $systemid=$this->session->tempdata('systemid'); 
                $datestart=$this->session->tempdata('datestart');               
                if($systemid=='All')
                {    
                    $data['total_rows'] =count($this->DCEO_model->overloaded_method($systemid,$datestart,2));
                    $total_rows=count($this->DCEO_model->overloaded_method($systemid,$datestart,2));               
                    $data['LoanActivebyProduct']=$this->DCEO_model->overloaded_method($systemid,$datestart,2);
                }   
                else{                    
                    $data['total_rows'] =count($this->DCEO_model->overloaded_method($systemid,$datestart,3));
                    $total_rows=count($this->DCEO_model->overloaded_method($systemid,$datestart,3));               
                    $data['LoanActivebyProduct']=$this->DCEO_model->overloaded_method($systemid,$datestart,1);
                }                   
                }else{
                    $data['total_rows'] =count($this->DCEO_model->loanActiveBorrowerByProduct($page,3));
                    $total_rows=count($this->DCEO_model->loanActiveBorrowerByProduct($page,3));
                    $data['LoanActivebyProduct']=$this->DCEO_model->loanActiveBorrowerByProduct($page,1);
                }
            $Utility->pagination_config($total_rows,$base_url);
            $this->load->view('master_page',$data);

    }
    public function DownloadactiveBorrower($sid=null,$reportdate)
    {
       
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));             
                    if($sid=='All'){                   
                        $data=$this->DCEO_model->overloaded_method($sid,$reportdate,2);
                        $this->excel->stream($sid."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                    }   
                   else{
                        
                        if($brcode==null){
                         $brcode=$this->session->userdata('branch_code');                         
                        } 
                        $data=$this->DCEO_model->overloaded_method($sid,$reportdate,1);
                        $this->excel->stream($sid."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->loanActiveBorrowerByProduct(1);
                    $this->excel->stream($sid."_ActiveBorrowerbyProductType_".$reportdate."_.xls",$data);
                }
            
    }
    public function GetBrName()
    {
        $sid=$this->input->post("sid");       
        $rmlist=$this->DCEO_model->GetRMBYSID($sid);
        $opt="";
        $opt.="<option value=>Select BranchName</option>";
        foreach($rmlist as $re){
            $opt.="<option value=$re->brCode>";
            $opt.=$re->shortcode;
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     

        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","systemid"));
        }
            $base_url= base_url()."index.php/dailydceo/loanPortfolio";
            if(isset($_POST['systemid']))
            {
                $systemid=$this->input->post('systemid');
                $datestart=date('Y-m-d',strtotime($this->input->post('datestart')));                              
                $this->session->set_tempdata(array("datestart"=>$datestart,"systemid"=>$systemid),null,300);
                $data['systemid']=$this->session->tempdata('systemid');               
                $data['reportdate']=$this->session->tempdata('datestart'); 
                $systemid=$this->session->tempdata('systemid'); 
                $reportdate=$this->session->tempdata('datestart'); 
                if($systemid=='All'){ 
                    $data['total_rows'] =count($this->DCEO_model->overloaded_method($systemid,$datestart,2));
                    $total_rows=count($this->DCEO_model->overloaded_method($systemid,$datestart,2));                               
                    $data['LoanActivebyProduct']=$this->DCEO_model->overloaded_loanPortfolioByProduct($sid,$reportdate,2);
                }   
                else{
                    $data['total_rows'] =count($this->DCEO_model->overloaded_method($systemid,$datestart,2));
                    $total_rows=count($this->DCEO_model->overloaded_method($systemid,$datestart,2));                                                    
                    $data['LoanActivebyProduct']=$this->DCEO_model->overloaded_loanPortfolioByProduct($systemid,$reportdate,1);
                }                   
                $data['total_rows'] = 1; 
            }else{
                   
                        $data['total_rows'] =count($this->DCEO_model->loanActiveBorrowerByProduct($page,3));
                        $total_rows=count($this->DCEO_model->loanActiveBorrowerByProduct($page,3));               
                        $data['LoanActivebyProduct']=$this->DCEO_model->loanPortfolioByProduct($page,1);
                    } 
                    $Utility->pagination_config($total_rows,$base_url);
                    $data['viewpage']='daily/DCEO/LoanPortfolio'; 
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $data['total_rows'] = $this->DCEO_model->TotalCobyproduct();       
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
        $base_url= base_url()."index.php/dailydceo/loanDisbInMonth";
        $total_rows=$this->DCEO_model->TotalCobyproduct();
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');               
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $data['sid']=$sid;              
                $data['reportdate']=$reportdate;               
                $this->session->set_tempdata(array("datestart"=>$reportdate,"systemid"=>$sid),null,300);
                if($sid=='All'){                   
                    $data['loanDisbInMonth']=$this->DCEO_model->overloaded_LoanDisbInmonth($sid,$reportdate,1);
                }   
                else{                                                   
                    $data['loanDisbInMonth']=$this->DCEO_model->overloaded_LoanDisbInmonth($sid,$reportdate,2);
                }                   
                $data['total_rows'] = 1; 
            }else{
                
                $data['loanDisbInMonth']=$this->DCEO_model->LoanDisbInmonth();
            } 
        
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/DCEO/LoanDisbInMonth.php'; 
		$this->load->view('master_page',$data);
    }

    public function DownloadloanDisbInMonth($sid=null,$reportdate)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));             
                    if($sid=='All'){                   
                        $data=$this->DCEO_model->overloaded_LoanDisbInmonth($sid,$reportdate,1);
                        $this->excel->stream($sid."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                    }   
                    else{                        
                       
                        $data=$this->DCEO_model->overloaded_LoanDisbInmonth($sid,$reportdate,2);
                        $this->excel->stream($sid."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->LoanDisbInmonth();
                    $this->excel->stream($sid."_LoanDisbursement_Inmonth_".$reportdate."_.xls",$data);
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $data['total_rows'] = $this->DCEO_model->TotalCobyproduct();       
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
            $this->session->unset_tempdata(array("datestart","dateend","systemid"));
        }
        $base_url= base_url()."index.php/dailydceo/loanDisbDaily";
        $total_rows=$this->DCEO_model->TotalCobyproduct();
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');                
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['sid']=$sid;               
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;                
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"systemid"=>$sid),null,300);
                if($sid=='All'){                   
                    $data['loanDisbDaily']=$this->DCEO_model->overloaded_LoanDisbDaily($reportdate,$reportend,$sid,2);
                }   
                else{
                                                    
                    $data['loanDisbDaily']=$this->DCEO_model->overloaded_LoanDisbDaily($reportdate,$reportend,$sid,1);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['loanDisbDaily']=$this->DCEO_model->LoanDisbDaily();
            } 
       
        $Utility->pagination_config($total_rows,$base_url);
        $data['viewpage']='daily/DCEO/LoanDisbDaily.php'; 
		$this->load->view('master_page',$data);
    }

    public function DownloadloanDisbDaily($sid=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($sid=='All'){                   
                        $data=$this->DCEO_model->overloaded_LoanDisbDaily($reportdate,$reportend,$sid,2);
                        $this->excel->stream($sid."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{
                        
                     
                        $data=$this->DCEO_model->overloaded_LoanDisbDaily($reportdate,$reportend,$sid,1);
                        $this->excel->stream($sid."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->LoanDisbDaily();
                    $this->excel->stream($sid."_LoanDisbursement_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['total_rows'] = $this->DCEO_model->TotalCobyproduct();   
        $data['controlbyrm']=$this->DCEO_model->GetRM();     
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_GET['per_page']))
        {
            $page=$_GET['per_page'];
        }else
        {
            $page=0;
        }
        $base_url= base_url()."index.php/dailydceo/repaymentinmonth";
        $total_rows=$this->DCEO_model->TotalCobyproduct();   
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');             
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['sid']=$sid;              
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;              
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"systemid"=>$sid),null,300);
                if($sid=='All'){     
                                
                    $data['Repayment']=$this->DCEO_model->overloaded_RepaymentMonthly($sid,$reportdate,$reportend,2);
                }   
                else{                    
                                                         
                    $data['Repayment']=$this->DCEO_model->overloaded_RepaymentMonthly($sid,$reportdate,$reportend,1);
                }                   
                $data['total_rows'] = 1; 
            }else{
               
                $data['Repayment']=$this->DCEO_model->RepaymentMonthly();
            }     
        
        $Utility->pagination_config($total_rows,$base_url);        
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/DCEO/Repaymentinmonth.php'; 
        $this->load->view('master_page',$data);
        
    }

    public function Downloadrepaymentinmonth($sid=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($sid=='All'){                   
                                     
                        $data=$this->DCEO_model->overloaded_RepaymentMonthly($sid,$reportdate,$reportend,2);
                        $this->excel->stream($sid."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{                        
                        
                        $data=$this->DCEO_model->overloaded_RepaymentMonthly($sid,$reportdate,$reportend,1);
                        $this->excel->stream($sid."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->RepaymentMonthly();
                    $this->excel->stream($sid."_repayment_inmonth_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();  
        $data['types']=$this->session->userdata('types'); 
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));       
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');                
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['sid']=$sid;              
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;               
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"systemid"=>$sid),null,300);
                if($sid=='All'){     
                           
                    $data['Repayment']=$this->DCEO_model->overloaded_RepaymentDaily($sid,$reportdate,$reportend,2);
                }   
                else{                    
                                                       
                    $data['Repayment']=$this->DCEO_model->overloaded_RepaymentDaily($sid,$reportdate,$reportend,1);
                }                   
                $data['total_rows'] = 1; 
            }else{
                
                $data['Repayment']=$this->DCEO_model->RepaymentDaily();
            }               
                      
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/DCEO/Repaymentdaily.php'; 
        $this->load->view('master_page',$data);       

    }
    public function Downloadrepaymentdaily($sid=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($sid=='All'){                   
                                     
                        $data=$this->DCEO_model->overloaded_RepaymentMonthly($sid,$reportdate,$reportend,2);
                        $this->excel->stream($sid."_repayment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{                        
                        
                        $data=$this->DCEO_model->overloaded_RepaymentMonthly($sid,$reportdate,$reportend,1);
                        $this->excel->stream($sid."_repayment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->RepaymentMonthly();
                    $this->excel->stream($sid."_repayment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');                
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['sid']=$sid;                
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;               
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"systemid"=>$sid),null,300);
                if($sid=='All'){     
                                  
                    $data['quality']=$this->DCEO_model->overloaded_PortfolioQualitybyProductDaily($sid,$reportdate,$reportend,2);
                }   
                else{
                                                   
                    $data['quality']=$this->DCEO_model->overloaded_PortfolioQualitybyProductDaily($sid,$reportdate,$reportend,1);
                }                   
                $data['total_rows'] = 1; 
            }else{
               
                $data['quality']=$this->DCEO_model->PortfolioQualitybyProductDaily();
            }
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/DCEO/PortfolioQualitybyProductDaily.php'; 
        $this->load->view('master_page',$data);        
    }

    public function DownloadPortfolioQualitybyProductDaily($sid=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($sid=='All'){                   
                                    
                        $data=$this->DCEO_model->overloaded_PortfolioQualitybyProductDaily($sid,$reportdate,$reportend,2);
                        $this->excel->stream($sid."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{
                    
                        $data=$this->DCEO_model->overloaded_PortfolioQualitybyProductDaily($sid,$reportdate,$reportend,1);
                        $this->excel->stream($sid."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->PortfolioQualitybyProductDaily(1);
                    $this->excel->stream($sid."_PortfolioQualitybyProductDaily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');               
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['sid']=$sid;           
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;             
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"systemid"=>$sid),null,300);
                if($sid=='All'){     
                                
                    $data['Ratios']=$this->DCEO_model->overloaded_PortfolioQualtiyRationsDaily($sid,$reportdate,$reportend,2);
                }   
                else{                    
                                                         
                    $data['Ratios']=$this->DCEO_model->overloaded_PortfolioQualtiyRationsDaily($sid,$reportdate,$reportend,1);
                }                   
                $data['total_rows'] = 1; 
            }else{
             
                $data['Ratios']=$this->DCEO_model->PortfolioQualtiyRationsDaily();
            }
                 
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/DCEO/PortfolioQualtiyRatiosDaily.php'; 
        $this->load->view('master_page',$data);        
    }

    public function DownloadPortfolioQualtiyRationsDaily($sid=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($sid=='All'){                   
                                       
                        $data=$this->DCEO_model->overloaded_PortfolioQualtiyRationsDaily($sid,$reportdate,$reportend,2);
                        $this->excel->stream($idco."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else{
                        $data=$this->DCEO_model->overloaded_PortfolioQualtiyRationsDaily($sid,$reportdate,$reportend,1);
                        $this->excel->stream($sid."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->PortfolioQualtiyRationsDaily();
                    $this->excel->stream($sid."_PortfolioQualtiyRationsDaily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');   
                $brcode=$this->input->post('branchname');   
                $data['brlist']=$this->DCEO_model->GetRMBYSID($sid);         
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['sid']=$sid;      
                $data['brcode']=$brcode;
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;                
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"systemid"=>$sid,"branchname"=>$brcode),null,300);
                if($sid=='All' && $brcode=="All"){                                     
                    $data['coperforment']=$this->DCEO_model->overloaded_DailyCoPerforment($sid,$reportdate,$reportend,4,$brcode);
                } 
                else if($sid!='All' && $brcode=='All')
                {
                    $data['coperforment']=$this->DCEO_model->overloaded_DailyCoPerforment($sid,$reportdate,$reportend,3,$brcode);
                }  
                else{
                    $data['coperforment']=$this->DCEO_model->overloaded_DailyCoPerforment($sid,$reportdate,$reportend,2,$brcode);
                }                   
                $data['total_rows'] = 1; 
            }else{
                $data['coperforment']=$this->DCEO_model->DailyCoPerforment();
            }
              
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/DCEO/Performentbyco.php'; 
        $this->load->view('master_page',$data);        
    }

    public function Downloadperformentbyco($sid=null,$brcode=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null && $brcode!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($sid=='All' && $brcode=="All"){                   
                                    
                        $data=$this->DCEO_model->overloaded_DailyCoPerforment($sid,$reportdate,$reportend,4,$brcode);
                        $this->excel->stream($sid."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                    else if($sid!='All' && $brcode=='All')
                    {
                        $data=$this->DCEO_model->overloaded_DailyCoPerforment($sid,$reportdate,$reportend,3,$brcode);
                    } 
                    else{
                        $data=$this->DCEO_model->overloaded_DailyCoPerforment($sid,$reportdate,$reportend,2,$brcode);
                        $this->excel->stream($sid."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->DailyCoPerforment();
                    $this->excel->stream($sid."_COPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
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
        $data['controlbyrm']=$this->DCEO_model->GetRM();
        $data['brlist']=$this->DCEO_model->GetBrByUser();
        $data['types']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $data['reportend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        if(isset($_POST['systemid']))
        {
                $sid=$this->input->post('systemid');
              
                $reportdate=date('Y-m-d',strtotime($this->input->post('datestart')));
                $reportend=date('Y-m-d',strtotime($this->input->post('dateend')));
                $data['sid']=$sid;               
                $data['reportdate']=$reportdate;
                $data['reportend']=$reportend;
                
                $this->session->set_tempdata(array("datestart"=>$reportdate,"dateend"=>$reportend,"systemid"=>$sid),null,300);
                if($sid=='All'){     
                    $data['brperforment']=$this->DCEO_model->overloaded_DailyBrPerforment($sid,$reportdate,$reportend,2);
                }   
                else{
                                                       
                    $data['brperforment']=$this->DCEO_model->overloaded_DailyBrPerforment($sid,$reportdate,$reportend,1);
                }                   
                $data['total_rows'] = 1; 
                }else{
                
                    $data['brperforment']=$this->DCEO_model->DailyBrPerforment();
                }
                        
                $data['title'] = lang('system_titel');
                $data['viewpage']='daily/DCEO/BranchPerforment.php'; 
                $this->load->view('master_page',$data);        
    }
    public function DownloadbrancPer($sid=null,$reportdate,$reportend)
    {
        $this->excel->setActiveSheetIndex(0);
        if($sid!=null)
            {                
                    $reportdate=date('Y-m-d',strtotime($reportdate));     
                    $reportend=date('Y-m-d',strtotime($reportend));        
                    if($sid=='All'){                   
                        $brcode=$this->session->userdata('system_id');                
                        $data=$this->DCEO_model->overloaded_DailyBrPerforment($brcode,$reportdate,$reportend,2);
                        $this->excel->stream($sid."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }   
                   else{
                        
                       
                        $data=$this->DCEO_model->overloaded_DailyBrPerforment($sid,$reportdate,$reportend,1);
                        $this->excel->stream($sid."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                    }                   
                 
                }else{
                    $data=$this->DCEO_model->DailyBrPerforment();
                    $this->excel->stream($sid."_BranchPerforment_Daily_".$reportdate."_and_".$reportend."_.xls",$data);
                }
    }
    public function writtenoff()
    {
            $data['mlist']=$this->Menu_model->MainiManu();  
            $data['title'] = lang('system_titel');
            $data['viewpage']='daily/DCEO/writtenoff.php'; 
            $this->load->view('master_page',$data);
    }
    public function dcmrsahakrinpheaceo()
  {
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['type']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['reportdateend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['mlist']=$this->Menu_model->MainiManu();  
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/DCEO/dcmrsahakrinceo.php'; 
		$this->load->view('master_page',$data);
  } 
  public function cmrSummRMCEO()
  {
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['type']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['reportdateend']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['mlist']=$this->Menu_model->MainiManu();  
        $data['title'] = lang('system_titel');
        $data['bra']=$this->DCEO_model->GetRM();
        $data['viewpage']='daily/DCEO/cmrSummRMCEO.php'; 
		$this->load->view('master_page',$data);
  }
  public function loandisbbyinterest()
{
         
   
        $data['brcode']=$this->session->userdata('branch_code');
        $data['role']=$this->session->userdata('role');   
        $data['sid']=$this->session->userdata('system_id');
        $data['type']=$this->session->userdata('types');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $reportdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['ClientPerFull']=$this->DailyCmr_model->getClientPer($reportdate);
        $data['disbPerFull']=$this->DailyCmr_model->getdisbPer($reportdate);
        $data['conspancolum']=$this->DailyCmr_model->getConspanMonthlyrate($reportdate);
        $data['monthly']=$this->DailyCmr_model->getInteratMonthly($reportdate);
    
        $data['ClientPer']=$this->DailyCmr_model->getClientPer($reportdate);
        $data['disbPer']=$this->DailyCmr_model->getdisbPer($reportdate);
        $data['disbPerPayment']=$this->DailyCmr_model->getdisbPaymentfrequency($reportdate);

        $data['mlist']=$this->Menu_model->MainiManu(); 
        $reportdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $data['title'] = lang('system_titel');
        $data['viewpage']='daily/DCEO/daillydisbursebyinterest.php'; 
        $this->load->view('master_page',$data);
}
}

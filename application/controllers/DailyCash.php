<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyCash extends CI_Controller {
     public function __construct()
    {
         parent::__construct();
         $this->load->model('Menu_model');
         $this->load->model('DailyCmr_model');
         $this->load->library("pagination");
         $this->load->model('Function_model');        
         $this->load->helper('url');
         $this->load->helper('form');
         $this->load->library('Excel');
         $this->load->library('Utility');
         $this->load->model('FN_model');
         if(!$this->session->userdata('user_id'))
            {
                redirect(site_url('Login'));
            }
            if($this->Menu_model->UserAccURL()==0){

                redirect(site_url('logout'));
            }
            $brcode=$this->session->userdata('branch_code');
            $userid=$this->session->userdata('user_id');
            $role=$this->session->userdata('role');
            $subbrcode=$this->session->userdata('subbranch');
            $reportdate=date("Y-m-d",strtotime($this->Function_model->getCurrRundate($role,$brcode,$subbrcode))); 

            if(isset($_GET['mid'])) {
                  $this->Menu_model->setLoginhistory($this->session->userdata('user_id'),$_GET['mid'],date("Y-m-d",strtotime($reportdate)));  
            }
                 
            
    }
    PUBLIC FUNCTION Cashinterbranch()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        if(isset($_POST['brname']))
        {
            $startdate=date("Y-m-d",strtotime($_POST['datestart']));
            $enddate=date("Y-m-d",strtotime($_POST['dateend']));
            $brname=$_POST['brname'];
            $data['datestart']=$startdate;
            $data['dateend']=$enddate;
            $data['brname']=$brname;
            $data['BRANCH']=$this->FN_model->GETBRANCH();
            $data['cashonhand']=$this->FN_model->INTERBRANCH($startdate,$enddate,$brname);
            
        }else{
            $data['BRANCH']=$this->FN_model->GETBRANCH();
            $data['cashonhand']=$this->FN_model->INTERBRANCH(null,null,null);           
           
        }
        $data['role']=$this->session->userdata('role');
        $data['brlist']=$this->FN_model->GetBrByUser();
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='FN/CashInterBranch.php'; 
        $this->load->view('master_page',$data);
    }
        PUBLIC FUNCTION Cashinflow()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        if(isset($_POST['brname']))
        {
            $startdate=date("Y-m-d",strtotime($_POST['datestart']));
            $enddate=date("Y-m-d",strtotime($_POST['dateend']));
            $brname=$_POST['brname'];
            $data['brname']=$brname;
            $data['datestart']=$startdate;
            $data['dateend']=$enddate;
            $data['cashinflow']=$this->FN_model->CASHINFLOW($startdate,$enddate,$brname);
            
        }else
        {
           
            $data['cashinflow']=$this->FN_model->CASHINFLOW(null,null,null);
            
        }
        $data['role']=$this->session->userdata('role');
        $data['brlist']=$this->FN_model->GetBrByUser();
        $data['BRANCH']=$this->FN_model->GETBRANCH();       
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='FN/CashInflow.php'; 
        $this->load->view('master_page',$data);
    }
    PUBLIC FUNCTION Cashoutflow()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        if(isset($_POST['brname']))
        {
            $startdate=date("Y-m-d",strtotime($_POST['datestart']));
            $enddate=date("Y-m-d",strtotime($_POST['dateend']));
            $brname=$_POST['brname'];
            $data['brname']=$brname;
            $data['datestart']=$startdate;
            $data['dateend']=$enddate;
            $data['CASHOUTFLOW']=$this->FN_model->CASHOUTFLOW($startdate,$enddate,$brname);

        }else
        {
            
            $data['CASHOUTFLOW']=$this->FN_model->CASHOUTFLOW(null,null,null);
        }
        $data['role']=$this->session->userdata('role');
        $data['brlist']=$this->FN_model->GetBrByUser();
        $data['BRANCH']=$this->FN_model->GETBRANCH();
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='FN/CashOutflow.php'; 
        $this->load->view('master_page',$data);
    }
    PUBLIC FUNCTION CashSummary()
    {
        $utility=new Utility();
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        if($page==''){ 
            $page=0;
            $this->session->unset_tempdata(array("datestart","dateend","brname"));
        }

        if(isset($_POST['brname']))
        {
            $startdate=date("Y-m-d",strtotime($_POST['datestart']));
            $enddate=date("Y-m-d",strtotime($_POST['dateend']));
            $brname=$_POST['brname'];
            $data['brname']=$brname;
            $data['datestart']=$startdate;
            $data['dateend']=$enddate;
            $this->session->set_tempdata(array("datestart"=>$startdate,"dateend"=>$enddate,"brname"=>$brname),null,300);
            $data['summarydatail']=$this->FN_model->GETSUMMARYDETAIL($startdate,$enddate,$brname,$page);

        }else
        {
            
               
                
                if($this->session->tempdata('datestart'))
                {
                    $startdate=$this->session->tempdata('datestart');
                    $enddate=$this->session->tempdata('dateend');
                    $brname=$this->session->tempdata('brname');
                    $data['brname']=$brname;
                    $data['datestart']=$startdate;
                    $data['dateend']=$enddate;
                    $data['summarydatail']=$this->FN_model->GETSUMMARYDETAIL($startdate,$enddate,$brname,$page);
                }else
                {
                    $startdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
                    $enddate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
                    $brname=$this->session->userdata('branch_code');;
                    $data['brname']=$brname;
                    $data['datestart']=$startdate;
                    $data['dateend']=$enddate;
                    $data['summarydatail']=$this->FN_model->GETSUMMARYDETAIL($startdate,$enddate,$brname,$page);
                
                }
               
            
        }
        $data['role']=$this->session->userdata('role');
        $data['brlist']=$this->FN_model->GetBrByUser();
        $data['total_rows']=$this->FN_model->TOTALSUMMARYDETAIL($startdate,$enddate,$brname);        
        $base_url = base_url()."index.php/DailyCash/CashSummary";
        $total_rows=$this->FN_model->TOTALSUMMARYDETAIL($startdate,$enddate,$brname);
        $utility->pagination_config($total_rows,$base_url);
        $data['BRANCH']=$this->FN_model->GETBRANCH();
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='FN/CashSummary.php'; 
        $this->load->view('master_page',$data);
    }
    PUBLIC FUNCTION Cashbytransition()
    {
        $utility=new Utility();
        $this->load->helper('url');
        $this->load->helper('form');
        $page = $this->uri->segment(3) ? $this->uri->segment(3):0;
        if($page==''){ 
            $page=0;
            $this->session->unset_tempdata(array("datestart","dateend","brname"));
        }

        if(isset($_POST['brname']))
        {
            $startdate=date("Y-m-d",strtotime($_POST['datestart']));
            $enddate=date("Y-m-d",strtotime($_POST['dateend']));
            $brname=$_POST['brname'];
            $data['brname']=$brname;
            $data['datestart']=$startdate;
            $data['dateend']=$enddate;
            $this->session->set_tempdata(array("datestart"=>$startdate,"dateend"=>$enddate,"brname"=>$brname),null,300);
            $data['cashtransition']=$this->FN_model->CASHBYTRANSITION($startdate,$enddate,$brname,$page);

        }else
        {
            if($this->session->tempdata('datestart'))
            {
                $startdate=$this->session->tempdata('datestart');
                $enddate=$this->session->tempdata('dateend');
                $brname=$this->session->tempdata('brname');
                $data['brname']=$brname;
                $data['datestart']=$startdate;
                $data['dateend']=$enddate;
                $data['cashtransition']=$this->FN_model->CASHBYTRANSITION($startdate,$enddate,$brname,$page);
            }else
            {
                $startdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
                $enddate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
                $brname=$this->session->userdata('branch_code');
                $data['brname']=$brname;
                $data['datestart']=$startdate;
                $data['dateend']=$enddate;
                $data['cashtransition']=$this->FN_model->CASHBYTRANSITION($startdate,$enddate,$brname,$page);
            
            }
                   
            
            
        }
        $data['total_rows']=$this->FN_model->TOTALCASHBYTRANSITON($startdate,$enddate,$brname);
        $base_url = base_url()."index.php/DailyCash/Cashbytransition";
        $total_rows=$this->FN_model->TOTALCASHBYTRANSITON($startdate,$enddate,$brname);
        $utility->pagination_config($total_rows,$base_url);
        $data['BRANCH']=$this->FN_model->GETBRANCH();
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='FN/Cashbytransition.php'; 
        $this->load->view('master_page',$data);
    }
    PUBLIC FUNCTION ImportDailyCashMovement()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='FN/ImportDailyCashMovement.php'; 
        $this->load->view('master_page',$data);
    }
    PUBLIC FUNCTION IMPORTEXCEL()
    {
        if(isset($_FILES["file"]["name"]))
        {
            $path=$_FILES["file"]["tmp_name"];
            $object=PHPExcel_IOFactory::load($path);
            $sheetCount = $object->getSheetCount();
            $sheetNames = $object->getSheetNames();  
           
              
            // foreach($object->getActiveSheet->getCellCollection() as $row)
            // {
              
            //     print_r($row);
            // };
                    foreach($object->getWorksheetIterator() as $worksheet)
                    {   
                        
                       
                        $highestRow=$worksheet->getHighestRow();
                        $highestColumn=$worksheet->getHighestColumn();                    
                        for($row=2;$row<=$highestRow;$row++)
                        {
                            $PostDate=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
                            $GLAcc=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
                            $FullTitle=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
                            $DrAmt=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
                            $CrAmt=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
                            $Note_ContraACC=$worksheet->getCellByColumnAndRow(5,$row)->getValue();
                            echo date("Y",strtotime($PostDate));
                            echo "</br>";
                            $data[]=array(
                                'PostDate'=>date("Y-m-d",strtotime($PostDate)),
                                'GLACc'=>$GLAcc,
                                'FullTitle'=>$FullTitle,
                                'DrAmt'=>$DrAmt,
                                'CrAmt'=>$CrAmt,
                                'Note_ContraACC'=>$Note_ContraACC
                            );                           
                            
                        }
                }
                 $this->Imports_model->IMPORTDAILYCASH($data);
               
            
            
        }
    }

    PUBLIC FUNCTION FullTrailBalance(){
        
        $this->load->helper('url');
        $this->load->helper('form');
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        $reportdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
        if(isset($_POST['brname']))
        {
            $startdate=date("Y-m-d",strtotime($_POST['datestart']));
            // $enddate=date("Y-m-d",strtotime($_POST['dateend']));
            $brname=$_POST['brname'];
            $data['brname']=$brname;
            $data['datestart']=$startdate;
            // $data['dateend']=$enddate;
            $data['fulltb']=$this->FN_model->FULLTRIALBALANCE($startdate,$brname);
            
        }else
        {
           
            $data['fulltb']=$this->FN_model->FULLTRIALBALANCE($reportdate,$this->session->userdata('branch_code'));
            
        }
        
        $data['role']=$this->session->userdata('role');
        $data['brlist']=$this->FN_model->GetBrByUser();
        $data['BRANCH']=$this->FN_model->GETBRANCH();       
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='FN/FullTrialBalance.php'; 
        $this->load->view('master_page',$data);

    }

    PUBLIC FUNCTION DONLOADCASHINTERBRANCH($datestart,$dateend,$brcode)
    {
        $this->excel->setActiveSheetIndex(0);
        $data=$this->FN_model->DONLOADCASHINTERBRANCH($datestart,$dateend,$brcode);
        $this->excel->stream($brcode."_Daily_Cash_Interbranch_".$datestart."_and_".$dateend."_.xls",$data);
    }
    PUBLIC FUNCTION DONLOADCASHINFLOW($datestart,$dateend,$brcode)
    {
        $this->excel->setActiveSheetIndex(0);
        $data=$this->FN_model->CASHINFLOW($datestart,$dateend,$brcode);
        $this->excel->stream($brcode."_Daily_Cash_Inflow_".$datestart."_and_".$dateend."_.xls",$data);
    }
    PUBLIC FUNCTION DONLOADCASHOUTFLOW($datestart,$dateend,$brcode)
    {
        $this->excel->setActiveSheetIndex(0);
        $data=$this->FN_model->CASHOUTFLOW($datestart,$dateend,$brcode);        
        $this->excel->stream($brcode."_Daily_Cash_Outflow_".$datestart."_and_".$dateend."_.xls",$data);
    }
    PUBLIC FUNCTION DOWNLOADCASHSUMMARY($datestart,$dateend,$brcode)
    {
        $this->excel->setActiveSheetIndex(0);
        $data=$this->FN_model->DOWNLOADSUMMARYCASHDETAIL($datestart,$dateend,$brcode);        
        $this->excel->stream($brcode."_Daily_Summary_Cashmovement_".$datestart."_and_".$dateend."_.xls",$data);
    }
    PUBLIC FUNCTION DONLOADCASHBYTRANSITION($datestart,$dateend,$brcode)
    {
        $this->excel->setActiveSheetIndex(0);
        $data=$this->FN_model->DOWNLOADCASHBYTRANSITION($datestart,$dateend,$brcode);        
        $this->excel->stream($brcode."_Daily_Cash_byTransition_".$datestart."_and_".$dateend."_.xls",$data);
    }
    PUBLIC FUNCTION DONLOADCASHFULLTRILBALANCE($datestart,$brcode)
    {
        $this->excel->setActiveSheetIndex(0);
        $data=$this->FN_model->FULLTRIALBALANCE($datestart,$brcode);        
        $this->excel->stream($brcode."_Daily_FullTrailBalance_".$datestart."_.xls",$data);
    }
}
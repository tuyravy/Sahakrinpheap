<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class npl extends CI_Controller {
     public function __construct()
    {
         parent::__construct();       
         $this->load->model('Menu_model');        
         $this->load->model('DailyCmr_model');
         $this->load->library("pagination");
         $this->load->library('Excel');    
         $this->load->model('Function_model');
         $this->load->model('BM_model');
         $this->load->model('Npl_model');
         include('Utility.php');

        // if(!$this->session->userdata('user_id'))
        // {              
        //        redirect(site_url('Login'));
        // }    
        // if($this->Menu_model->UserAccURL()==0){

        //     redirect(site_url('logout'));
        // }
        
    } 
    public function nplcollection()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brlist']=$this->Function_model->getBrname();  
        $data['viewpage']='NPL/Npl_View';
        $this->load->view('master_page',$data);
    }
    public function npldetail(){

        if(isset($_POST['submit'])){
             $datestart=date('Y-m-d',strtotime($this->input->post('datestart')));
             $dateend=date('Y-m-d',strtotime($this->input->post('dateend')));
             $brname=$this->input->post('brname');
             $viewnpl_toloan=$this->Npl_model->getnpl_posttoloan($brname,$datestart,$dateend);  
        }
        $this->load->helper('url');
        $this->load->helper('form');
        $mlist=$this->Menu_model->MainiManu();
        $brlist=$this->Function_model->getBrname();   
          
        $viewpage='NPL/Npl_detail';
        $this->load->view('master_page',compact('mlist','brlist','viewpage','viewnpl_toloan','datestart','dateend','brname'));
    }
    public function downloadnpldetail($brcode,$datestart,$dateend){
        

        $datestart=date('Y-m-d',strtotime($datestart));
        $dateend=date('Y-m-d',strtotime($dateend));
        $this->excel->setActiveSheetIndex(0);
        $data=$this->Npl_model->getnpl_posttoloan($brcode,$datestart,$dateend);  
        $this->excel->stream($brcode."_NPL_History Collection to loan_".$datestart."_and_".$dateend."_.xls",$data);

    }
    public function npldeferpaymant(){
        if(isset($_POST['submit'])){
            $datestart=date('Y-m-d',strtotime($this->input->post('datestart')));
            $dateend=date('Y-m-d',strtotime($this->input->post('dateend')));
            $brname=$this->input->post('brname');
            $viewdiff_mb=$this->Npl_model->getpost_differ($brname,$datestart,$dateend);
       }
            $this->load->helper('url');
            $this->load->helper('form');
            $mlist=$this->Menu_model->MainiManu();
            $brlist=$this->Function_model->getBrname();  
           
            $viewpage='NPL/Npl_deferpaymant';
            $this->load->view('master_page',compact('mlist','brlist','viewpage','viewdiff_mb','datestart','dateend','brname'));
    }
  
    public function writtenoffdetail(){
        $this->load->helper('url');
        $this->load->helper('form');
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['viewpage']='NPL/writtenoff_detail';
        $this->load->view('master_page',$data);
    }
    public function writtenoffwithgl(){
        $this->load->helper('url');
        $this->load->helper('form');
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['viewpage']='NPL/Writtenoff_withgl';
        $this->load->view('master_page',$data);
    }
}
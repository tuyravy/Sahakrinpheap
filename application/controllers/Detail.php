<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class detail extends CI_Controller {
     public function __construct()
    {
         parent::__construct();       
         $this->load->model('Menu_model');                
         $this->load->model('DailyCmr_model');
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
    public function detail_notyetupload(){

        $data['title'] = lang('system_titel');
        $data['mlist']=$this->Menu_model->MainiManu();      
        $data['reportdate']=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));     
        $reportdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));   
        $data['checking']=$this->BM_model->CheckUpload();  
        $data['detail']=$this->Menu_model->detailnotyetupload();
        $data['viewpage']='setting/Filenotyetupload';//manager or BM
        $this->load->view('master_page',$data);
                
           
    }
}
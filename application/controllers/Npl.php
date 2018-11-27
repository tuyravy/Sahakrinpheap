<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Npl extends CI_Controller {
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
    public function NplCollection()
    {
         $data['mlist']=$this->Menu_model->MainiManu();
         $data['viewpage']='NPL/Npl_view'; 
         $this->load->view('master_page',$data);
    }  
}
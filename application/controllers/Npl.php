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

        $this->load->helper('url');
        $this->load->helper('form');
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['brlist']=$this->Function_model->getBrname();        
        $data['viewpage']='NPL/Npl_detail';
        $this->load->view('master_page',$data);
    }
    public function npldeferpaymant(){
        $this->load->helper('url');
        $this->load->helper('form');
        $data['mlist']=$this->Menu_model->MainiManu();
        $data['viewpage']='NPL/Npl_deferpaymant';
        $this->load->view('master_page',$data);
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting extends CI_Controller {

	
     public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');
         $this->lang->load('home', $this->session->userdata('language'));
         $this->load->model('Setting_model');
         $this->load->model('Menu_model');
        
         
            if(!$this->session->userdata('user_id'))
            {
                    redirect(site_url('login'));
            }
    }
    
     public function index()
      {
            $this->load->helper('form');
            $this->load->helper('url');
            $data['menulist']=$this->Menu_model->getUsermenu();
            $data['submenu']=$this->Menu_model->getsubMenu();
            $data['title'] = lang('system_titel');
            $data['viewpage']='setting/eom.php'; 
            $this->load->view('master_page',$data);
      } 
    public function setEOM()
    {
        $this->load->helper('form');
        $this->load->helper('url');
         $reportdate=$this->input->post('repordate');
        $res=$this->Setting_model->getEOM($reportdate);
        foreach($res as $row)
        {
            //print_r($row);
            redirect("eom");
        }
        
            redirect("eom");
        
    }
    public function generateCalendar()
    {
            $this->load->helper('form');
            $this->load->helper('url');
            $data['menulist']=$this->Menu_model->getUsermenu();
            $data['submenu']=$this->Menu_model->getsubMenu();
            $data['title'] = lang('system_titel');
            $data['viewpage']='setting/generatedate.php'; 
            $this->load->view('master_page',$data);
    }
    public function dailychecking()
    {
            $this->load->helper('form');
            $this->load->helper('url');
            $reportdate=date('Y-m-d',strtotime($this->Menu_model->getCurrRundate()));
            $data['loandetail']=$this->Setting_model->getCheckLoandetail($reportdate);
            $data['check']=$this->Setting_model->getChecking($reportdate);
            $data['menulist']=$this->Menu_model->getUsermenu();
            $data['submenu']=$this->Menu_model->getsubMenu();
            $data['title'] = lang('system_titel');
            $data['viewpage']='setting/dailychecking.php'; 
            $this->load->view('master_page',$data);
    }
    public function datachecking()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $reportdate=date('Y-m-d',strtotime($this->Menu_model->getCurrRundate()));
        $data['preparedata']=$this->Setting_model->getDateCheckingByLoan($reportdate);
        $data['duplicate']=$this->Setting_model->getDataLoanDuplicate($reportdate);
        
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['viewpage']='setting/datachecking.php'; 
        $this->load->view('master_page',$data);
    }
    public function generateWorkingday($startday,$endday,$year)
    {
        
            
    }
}

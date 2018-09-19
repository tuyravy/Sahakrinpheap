<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class home extends CI_Controller {
     public function __construct()
    {
         parent::__construct();
         $this->load->helper('url');
         $this->load->helper('form');
         $this->load->library('polyglot');
         if($this->session->userdata('language') == FALSE)
         {
             $this->session->set_userdata('language', $this->config->item('language'));
             $this->session->set_userdata('language_code', $this->polyglot->language2code($this->config->item('language')));
         }
         $this->lang->load('session', $this->session->userdata('language'));
         $this->lang->load('global', $this->session->userdata('language'));
	 $this->load->model('menu_model');
    }
    public function index()
    {
	
        $data['title'] = lang('system_titel');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['titlepage']="Home Page";
        $data['views']='master';
        $this->load->view('master_page',$data);
    }
}
?>
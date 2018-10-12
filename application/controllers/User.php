<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');
         if($this->session->userdata('language') == FALSE)
         {
             $this->session->set_userdata('language', $this->config->item('language'));
             $this->session->set_userdata('language_code', $this->polyglot->language2code($this->config->item('language')));
         }
         $this->lang->load('session', $this->session->userdata('language'));
         $this->lang->load('global', $this->session->userdata('language'));
         $this->load->model('login_model');
         $this->load->model('menu_model');
         $this->load->model('users_model');
         if(!$this->session->userdata('user_id'))
         {              
               redirect(site_url('Login'));
         } 
         if($this->Menu_model->UserAccURL()==0){

            redirect(site_url('logout'));
        }
    }
	public function index()
    {
        $data['title'] = lang('session_login_title');
        $this->load->helper('form');
        $this->load->helper('url');
        $data['menulist']=$this->menu_model->getUsermenu();
        $data['submenu']=$this->menu_model->getsubMenu();
        $data['title'] = lang('system_titel');		
        $data['viewpage']='user/user';//manager
        $this->load->view('master_page',$data);
	}
    
}
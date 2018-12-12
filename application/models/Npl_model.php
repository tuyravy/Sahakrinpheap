<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Npl_model extends CI_Model
{
    public function __construct()
    {
         parent::__construct();  
         $this->load->model("Function_model"); 
         $this->Reportdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate()));   
         $this->role =$this->session->userdata('role');
         $this->brcode =$this->session->userdata('branch_code');
         $this->subbrcode =$this->session->userdata('subbranch'); 
         $this->sid=$this->session->userdata('system_id'); 
    }
    public function getnpldetail(){
        
    }
}
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exports extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load the Library
        $this->load->library("excel");
        // Load the Model
        $this->load->model('Menu_model');
        $this->load->model("DailyCmr_model");
    }

    public function index() {
       
        $this->excel->setActiveSheetIndex(0);
        $reportdate=$this->input->post("reportdate");
        $sid=$this->input->post("sid");
        if(empty($reportdate) && empty($sid))
        {
            $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
            $sid=$this->session->userdata('system_id');
            $role=4;
            $data = $this->DailyCmr_model->DailyBranchPerforment($sid,$role,$reportdate,100,0);
        }else
        {
            $role=3;
            $data = $this->DailyCmr_model->DailyBranchPerforment($sid,$role,$reportdate,100,0);
        }
        // Gets all the data using MY_Model.php
       
        $this->excel->stream('BrabchPreforment_'.$reportdate.'.xls', $data);
    }
   

}
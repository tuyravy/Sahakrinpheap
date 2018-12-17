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
    //this function for get loan npl collection post to loan 
    public function getnpl_posttoloan($BrCode,$DateStart,$DateEnd){
        $arraylist=0;
       if($BrCode=="All"){
            $brcontrol=$this->Function_model->getBrname();
            $arraylist=array();
            foreach($brcontrol as $row){
                array_push($arraylist,$row->brCode);
            }
       }
       else{
        $arraylist=$BrCode;
       }
       
        $npl=$this->db->from("nplcollection")
                              ->where_in("BrCode",$arraylist)
                              ->where('TrnDate>=',$DateStart)
                              ->where('TrnDate<=',$DateEnd)
                              ->get();
        //$this->output->enable_profiler(TRUE);
        return $npl->result();
    }
    public function getpost_differ($BrCode,$DateStart,$DateEnd){
        
        $arraylist=0;
        if($BrCode=="All"){
            $brcontrol=$this->Function_model->getBrname();
            $arraylist=array();
            foreach($brcontrol as $row){
                array_push($arraylist,$row->brCode);
            }
        }
        else{
                $arraylist=$BrCode;
        }
        
            $npl=$this->db->from("npl_wo_glcollection")
            ->where_in("BrCode",$arraylist)
            ->where('PostDate>=',$DateStart)
            ->where('PostDate<=',$DateEnd)
            ->get();
            $this->output->enable_profiler(TRUE);
            return $npl->result(); 
        } 
}
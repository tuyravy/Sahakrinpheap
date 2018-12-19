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
            ->where('GlAcc','3898016')
            ->where('TrnType','819')
            ->get();
           // $this->output->enable_profiler(TRUE);
            return $npl->result(); 
        } 
        public function getWO_collection($BrCode,$DateStart,$DateEnd){
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
            $npl=$this->db->from("wocollection")
            ->where_in("BrCode",$arraylist)
            ->where('collectDate>=',$DateStart)
            ->where('collectDate<=',$DateEnd)           
            ->get();
            //$this->output->enable_profiler(TRUE);
            return $npl->result();
            

        }
        public function getWO_gl($BrCode,$DateStart,$DateEnd){

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
                ->where('GlAcc','5744011')                
                ->get();
               // $this->output->enable_profiler(TRUE);
                return $npl->result(); 
            } 
    /**
     * Store in blog NPL model
     * get from table npl_collection,npl_glwo_collection,wocollection
     * return array list to display in npl and wo 
     * @param @Brcode,@startdate,@enddate
     * 
     */
    public function summary_npl_wo($BrCode,$DateStart,$DateEnd){
        
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
        $nplwo=$this->db->query("select 
                                n.BrCode,n.BrName,
                                count(n.IdClient) as NumClient,
                                sum(n.TrnAmt) as TrnAmt,
                                case
                                    when (select sum(gl.CrAmt) from npl_wo_glcollection gl where gl.GLAcc='3898016' and gl.BrCode=n.BrCode) IS NULL then 
                                    0
                                else (select sum(gl.CrAmt) from npl_wo_glcollection gl where gl.GLAcc='3898016' and gl.BrCode=n.BrCode) 
                                end as AmtMB,
                                (select count(AccountNumber) from wocollection wo where wo.BrCode=n.BrCode ) as TotalClient,
                                
                                case
                                    when (select sum(gll.CrAmt) from npl_wo_glcollection gll where gll.GLAcc='5744011' and gll.BrCode=n.BrCode) IS NULL then 
                                    0
                                else (select sum(gll.CrAmt) from npl_wo_glcollection gll where gll.GLAcc='5744011' and gll.BrCode=n.BrCode) 
                                end as AmtWOMB,
                                
                                (select sum(TotalCollectedAmt) from wocollection wo where wo.BrCode=n.BrCode ) as TotalBalWOTools
                                
                                from nplcollection n group by n.BrCode,n.BrName;

                                ");
        return $nplwo->result();
    }
}   
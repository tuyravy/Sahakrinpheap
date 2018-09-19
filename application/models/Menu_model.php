<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_model extends CI_Model
{
    public static function GetMenu()
    {
        $result=DB::table('menu_role')
                    ->where('flage',1)
                    ->where('type',1)
                    ->where('parent_id',0)->get();
        $array=array();
        foreach($result as $key=>$val)
        {
            $result=DB::table('menu_role')           
            ->where('type',2)
            ->where('parent_id',$val->mid)
            ->get();
            array_push($array,[$val,$val=$result]);
        }
        return $array;
    }
    
    public function MainiManu()
    {
        $userid=$this->session->userdata('user_id');
        $result=$this->db->from('users')
                    ->where('user_id',$userid)
                    ->where('flag',1)->get();
        $menulist=array();
        foreach($result->result() as $k=>$val)        {
           
             $menulist=explode(",",$val->m_id);             
        }
        $minmenu=array();      
        foreach ($menulist as $value) {          
            $midm=(int)$value;
            $result1 =$this->db->from('menu_role')
                            ->where('mid',$midm)
                            ->where('type', 1)
                            ->get();
            foreach($result1->result() as $vl)
            {
                array_push($minmenu,$vl);    
            }
                   
            
       }
      /*------------------End GET MinMenu----------------*/

       $submenut=$this->db->from('users')
                    ->where('user_id',$userid)
                    ->where('flag',1)
                    ->get();
        $submenulist=array();
        foreach($submenut->result() as $k=>$val)
        {
            $submenulist=explode(",",$val->sm_id);

        }
        $submen=array();   

        foreach($submenulist as $sub){
            $submid=(int)$sub;                 
                $resultparent =$this->db->from('menu_role')
                            ->where('type', 2)
                            ->where('mid',$submid)                                        
                            ->get();
                foreach($resultparent->result() as $val)
                {
                    array_push($submen,$val);
                }
        
        }
    /*------------------End GET Submenu--------------*/
        $listAA=array();
        $final=array();
       
       foreach($minmenu as $vl)
       {
           $subarray=array();
           foreach($submen as $key=>$subval){

                $sub=$this->db->from('menu_role')
                        ->where('parent_id',$vl->mid)
                        ->where('mid',$subval->mid)
                        ->get();
                if($sub->num_rows()>0)
                {
                    foreach($sub->result() as $vlsub)
                    {
                        array_push($subarray, $vlsub);
                    }
                }
             
           } 
           array_push($final,$vl);
           array_push($listAA,$vl=[$vl->mid=>$subarray]);
           //array()
       }    
       $listofarray=array($final,$listAA);
       //dd($listofarray);
       return $listofarray;
       
    }
public function getstaff($sid)
    {
        $result=$this->db->query("CALL sp_Getallstaff(".$sid.")");
          $res= $result->result(); 
          $result->next_result(); 
          $result->free_result(); 

        foreach($result as $row)
        {
            return $row;
        };
    }
public function setprofile($userid,$sid)
    {
        $sidresult=$this->getstaff($sid);
        if($sidresult==true)
        {
            $row=$this->input->post();
            $data=array
                (
                    'system_id'=>$row['sid'],
                    'full_name'=>$row['fname'],
                    'full_name_kh'=>$row['fnamekhr'],
                    'password'=>$row['password'],
                    'email'=>$row['email'],
                    'phone'=>$row['pnumber'],
                    'profile'=>0
                );
            $this->db->where('user_id',$userid);
            $this->db->update('users',$data);
            return true;
        }
        else
        {
            return false;
        }
        
    }
  function getAutosetProfile($userid)
  {
      $result=$this->db->query("Call sp_AutoSetProfile('".$userid."')");   
       
      if($result==true)
           {
               return true;
           }else
           {
               return false;
           }
          return true;
       
  }
  function getAutoSetlogout()
  {
      $result=$this->db->query("Call sp_AutoSetLogout()");   
       
      if($result==true)
           {
               return true;
           }else
           {
               return false;
           }
          return true;
      
  }
  function getCurrRundate()
  {
       $result=$this->db->query("Call sp_getCurrRunDate()");   
       $res=$result->result();
       $result->next_result(); 
       $result->free_result();  
      
       foreach($res as $row){
           return $row->dateworking;
       }

  }
  function getPreCurrRundate()
  {
       $result=$this->db->query("Call sp_getPreCurrRunDate()");   
       $res=$result->result();
       $result->next_result(); 
       $result->free_result();  
      
       foreach($res as $row){
           return $row->dateworking;
       }
        //add this two line 
       
       //end of new code

      
  }
  function getPreMonthCurrRundate()
  {
       $result=$this->db->query("Call sp_getPreMonthCurrRunDate()");   
       $res=$result->result();
       $result->next_result(); 
       $result->free_result();  
      
       foreach($res as $row){
           return $row->dateworking;
       }
        //add this two line 
       
       //end of new code

      
  }
  function getNotyatupload()
  {
      
      $reportdate=date('Ymd',strtotime($this->Menu_model->getCurrRundate()));
      $systemid=$this->session->userdata('system_id');
      $role=$this->session->userdata('role');
      $brcode=$this->session->userdata('branch_code');
      $result=$this->db->query("Call sp_getNotyatupload(".$reportdate.",".$role.",".$systemid.",".$brcode.")");
      $res      = $result->result();
      $result->next_result(); 
      $result->free_result(); 
      
      foreach($res as $row)
      {
          return $row->counts;
      };
      
  }
  function getNotyetuploadbranch()
  {
      $reportdate=date('Ymd',strtotime($this->Menu_model->getCurrRundate()));
      $systemid=$this->session->userdata('system_id');
      $role=$this->session->userdata('role');
      $brcode=$this->session->userdata('branch_code');
      $result=$this->db->query("Call sp_GetNotYetUpload(".$reportdate.",".$role.",".$systemid.",".$brcode.")");
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
      
  }
  function getbranchname($brcode)
  {
      $result=$this->db->where('brCode',$brcode)
                       ->where('flage',1)                      
                       ->get('tbl_branch');
      foreach($result->result() as $row)
      {
          return $row->shortcode;
      }
      
  }
  function setLoginhistory($userid,$menu_id,$reportdate)
  {
       
        $this->db->where('users_id',$userid);
        $this->db->where('menu_id',$menu_id);
        $this->db->where('computerdate',date('Y-m-d'));
        $query = $this->db->get('history_login');
        
        $count_row = $query->num_rows();
        if ($count_row ==0) {
          
            $data=(
            array
                    ("users_id"=>$userid,
                     "menu_id"=>$menu_id,
                     "reportdate"=>$reportdate,
                     "computerdate"=>date('Y-m-d')
                    )
            );
           $result=$this->db->insert("history_login",$data);
           if($result==true)
           {
               return true;
           }else
           {
               return false;
           }
          return true;
            
         } else 
        {
          
          return false; // And here false to TRUE
        }   
  }
    
}
?>
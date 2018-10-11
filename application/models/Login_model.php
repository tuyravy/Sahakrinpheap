<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model
{
 
    
   function getUsers($login,$password)
   {       
        $hostname=gethostname();
       $this->db->select(
                            "users.user_id as user_id,
                            users.status as status,
                            users.branch_code as branch_code,
                            users.full_name as full_name,
                            users.full_name_kh as full_name_kh,
                            users.username as username,
                            users.phone as phone,
                            users.role_id as role_id,
                            users.role as role,
                            users.brControl as brControl,
                            users.system_id as system_id,
                            users.m_id,
                            users.types as types,
                            users.password as password,
                            users.reset_password as reset_password,
                            users.profile as profile"
                            
                        );
       $this->db->where(trim('users.username'),$login);
       $this->db->where(trim('users.password'),$password);
       $this->db->from('users');
       $query=$this->db->get();        
       if($query->num_rows()>=1)
       {
            foreach($query->result() as $res){  
                $this->session->set_userdata
                (
                array(
                    'user_id'=>$res->user_id,
                    'system_id'=>$res->system_id,
                    'branch_code'=>$res->branch_code,
                    'full_name'=>$res->full_name,
                    'full_name_kh'=>$res->full_name_kh,
                    'username'=>$res->username,
                    'phone'=>$res->phone,
                    'role_id'=>$res->role_id,
                    'm_id'=>$res->m_id,
                    'brControl'=>$res->brControl,
                    'role'=>$res->role,
                    'types'=>$res->types,
                    'password'=>$res->password,
                    'reset_password'=>$res->reset_password,
                    'profile'=>$res->profile
                    )
                );
                    $setstatus=array(
                                    'last_time_login'=>date('Y-m-d h:i:s'),
                                    'time_login'=>date('Y-m-d h:i:s'),
                                    "status"=>1,    
                                    'alreadysend'=>0,
                                    'computerlogin'=>$hostname);
                    $this->db->where("user_id",$res->user_id);
                    $this->db->update('users',$setstatus);
                    $brcode=$this->session->userdata('branch_code');    
                    $getmultibranch=$this->db->select("branch_code,subbranch")
                                             ->from('users')
                                             ->where('branch_code',$brcode)
                                             ->where('flag',1)
                                             ->where('types',2)
                                             ->get();
                    foreach($getmultibranch->result() as $row)
                    {
                        $set=array
                        (
                         "brControl"=>""
                        );
                        $this->db->where('branch_code',$row->branch_code);
                        $this->db->update('users',$set);  
                    }
            return true;
            }
           
           
       }
       else
       {
           return false;
       }
       
   }
   
    
    
}
?>
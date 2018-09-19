<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
public function __construct()
    {
         parent::__construct();             
         $this->load->model('Menu_model');
         $this->load->model('Users_model');
         $this->load->model('Login_model');
         $this->load->model('Function_model');
         $this->load->model('DailyCmr_model');
         $this->load->helper('url');
         $this->load->helper('form');
         if(!$this->session->userdata('user_id'))
        {              
               redirect(site_url('Login'));
        }
    }    
	public function index()
	{              
            $data['title'] = lang('system_titel');
            $data['mlist']=$this->Menu_model->MainiManu();        
            $role=$this->session->userdata('role');
            switch($role)
            {
                case 1:
                    //$data['viewpage']='index'; //administrator or Admin
                break;
                case 2:

                    //$data['viewpage']='general';//general user or BM
                break;
                case 3:
                    //$data['viewpage']='manager';//manager or RM
                break;
                case 4:
                    // $types=$this->session->userdata('types');
                    // $data['history']=$this->DailyCmr_model->gethistorydetailbyDECO($reportdate,$types);
                    //$data['viewpage']='dashboard/manager';//manager or RM
                break;
                case 5:
                break;
                case 6:
                break;
            }         
            
            if($this->session->userdata('reset_password')==1){
                $data['title']="System request change password";
                $this->load->view('login/changepassword',$data);
            }else
            {
                $this->load->view('master_page',$data);
            }
        
	}
    public function setmulitbranch()
{   
        $this->load->helper('url');
        $this->load->helper('form');
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
             "brControl"=>$row->branch_code.",".$row->subbranch,
             "branch_code"=>$row->subbranch,
             "subbranch"=>$row->branch_code
            );
            $this->db->where('branch_code',$row->branch_code);
            $this->db->update('users',$set);  
        }
      $username=$this->session->userdata('username'); 
      $password=$this->session->userdata('password');
      $this->checksession($username,$password);
      $this->load->helper('url');                   
        
}
 public function checksession($username=null,$password=null)
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $error=0;
        $hostname=gethostname();
        if($username==null)
        {
             $login=str_replace(' ','',$this->input->post('username'));
             $password=trim($this->input->post('password'));
        }
        else
        {
             $login=str_replace(' ','',$username);
             $password=trim($password);
        }
        $users=$this->Login_model->getUsers($login,$password);
        if($users==true)
        {
            foreach($users as $res){
            /*if($res->status==1)
            {
                    $error=1;
                    $data['errordevice']='គណនីរបស់លោកអ្នកកំពុងប្រើប្រាស់​!';
                    $data['title'] = lang('session_login_title');
                    $this->load->helper('form');
                    $this->load->helper('url');
                    $this->load->view('Login/index',$data);
                
            }else{
            */    
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
                              'menu_option'=>$res->menu_option,
                              'brControl'=>$res->brControl,
                              'role'=>$res->role,
                              'types'=>$res->types,
                              'password'=>$res->password,
                              'reset_password'=>$res->reset_password
                             )
                        );
                    $setstatus=array(
                                    'last_time_login'=>date('Y-m-d h:i:s'),
                                    "status"=>1,                                    
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
                    redirect(site_url('Login/master'));
            // }
                
            }
                
            
        }else
        {
              
              $result=$this->db->select("replace(username,' ',''),user_id")
                            ->from('users')
                            ->where('username',$login)
                            ->where('flag',1)
                            ->where('status',0)
                            ->get();
              foreach($result->result() as $row)
              {
              $counterid=$this->db->select("counterrorlogin")
                                  ->from('users')
                                  ->where('user_id',$row->user_id)
                                  ->where('flag',1)
                                  ->where('status',0)
                                  ->get();
              foreach($counterid->result() as $counts)
              {
                  $setstatus=array(
                                    'last_time_login'=>date('Y-m-d h:i:s'),
                                    "counterrorlogin"=>$counts->counterrorlogin+1,
                                    'computerlogin'=>$hostname);
                  $this->db->where("user_id",$row->user_id);
                  $this->db->update('users',$setstatus); 
                  if($counts->counterrorlogin==6)
                  {
                      $error=1;
                      $data['errornotAcc']="លេខគណនីរបស់លោកអ្នកត្រូវបានបិទ សូមធ្វើការទំនាក់ទំនងទៅកាន់ផ្នែកប្រព័ន្ធ! សូមអរគុណ!";
                      $data['title'] = lang('session_login_title');
                      $this->load->helper('form');
                      $this->load->helper('url');
                      $this->load->view('login/index',$data);
                  }elseif($counts->counterrorlogin>7)
                  {
                       return redirect(site_url('login/errorslogin')); 
                  }
              }
                                    
              if($error==0){
                  
                  $data['errorlogin']="លេខគណនី និង លេខសម្ងាត់របស់លោក អ្នកមិនត្រឹមត្រូវទេ !";
                  $data['title'] = lang('session_login_title');
                  $this->load->helper('form');
                  $this->load->helper('url');
                  $this->load->view('login/index',$data);
              }               
              
            }
             
          
	    }
        if($error==0){
              $data['errorlogin']="លេខគណនី និង លេខសម្ងាត់របស់លោក អ្នកមិនត្រឹមត្រូវទេ !";
              $data['title'] = lang('session_login_title');
              $this->load->helper('form');
              $this->load->helper('url');
              $this->load->view('login/index',$data);
        
        }
}
    
    public function resetmulitbranch()
{   
        $this->load->helper('url');
        $this->load->helper('form');
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
             "brControl"=>"",
             "branch_code"=>$row->subbranch,
             "subbranch"=>$row->branch_code
            );
            $this->db->where('branch_code',$row->branch_code);
            $this->db->update('users',$set);  
        }
      $this->load->helper('url');
      redirect('http://app.sahakrinpheap.com/skp_reports/');              
        
}
public function changepassword()
{
    $this->load->helper('url');
    $this->load->helper('form');
     $newpassword=trim($this->input->post("newpassword"));
     $oldpassword=trim($this->input->post("repassword"));
    if($newpassword!=$oldpassword)
    {
        $data['msg']="Confrim Password Incorrent";
        $data['title']="System request change password";
        $this->load->view('login/changepassword',$data);
    }else
    {
        $userid=$this->session->userdata('user_id');
        $set=array
            (
             "password"=>$newpassword,
             "reset_password"=>0
            );
            $this->db->where('user_id',$userid);
            $this->db->update('users',$set);  
            $data["succ"]="";
            $data['title']="System request change password";
            $this->load->view('login/changepassword',$data);
            //redirect(site_url('Login/logout'));
        
    }
    $data['msg']="Confrim Password Incorrent";
    $data['title']="System request change password";
    $this->load->view('login/changepassword',$data);
}
public function changeprofile()
{
    
        $this->load->helper('url');
        $this->load->helper('form');
     
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role_id');
        $this->load->model('Dailyloanhistory_model');
        $this->load->model('DailyCmr_model');
        $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
        $data['datahistory']=$this->Dailyloanhistory_model->getDailyloanhistory($brcode,$reportdate);      
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['users']=$this->Menu_model->getusername();
        $data['useractive']=$this->Users_model->getUserActive(); 
        $data['viewpage']='user/profile_user'; //administrator or Admin
        $this->load->view('master_page',$data);
          
      
}
public function errorsprofiles()
  {
        $this->load->helper('url');
        $this->load->helper('form');
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role_id');
        $this->load->model('Dailyloanhistory_model');
        $this->load->model('DailyCmr_model');
        $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
        $data['datahistory']=$this->Dailyloanhistory_model->getDailyloanhistory($brcode,$reportdate);      
        $data['menulist']=$this->Menu_model->getUsermenu();
        $data['submenu']=$this->Menu_model->getsubMenu();
        $data['title'] = lang('system_titel');
        $data['users']=$this->Menu_model->getusername();
        $data['useractive']=$this->Users_model->getUserActive(); 
        $data['viewpage']='user/profile_user'; //administrator or Admin
        $this->load->view('master_page',$data);
  }
public function setprofilesuser()
{
    $userid=$this->session->userdata('user_id');
        $row=$this->input->post();
        $setprofilesid=$this->Menu_model->setprofile($userid,$row['sid']);
       
           if($setprofilesid==true)
           {
                
                $this->Menu_model->setprofile($userid,$row['sid']);
                redirect('logout');
               
           }else
            {
                redirect('errorsprofiles');
           
            }
}
}

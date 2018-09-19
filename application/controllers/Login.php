<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct()
    {
         parent::__construct();                      
         $this->load->model('Login_model');
         $this->load->helper('form');
         $this->load->helper('url');
    }
	public function index()
    {       
        $data['title'] ="Login";       
		$this->load->view('login/index',$data);
    }    
    public function insert()
    {
        echo $this->input->post('userfile');
    }
    public function checksession($username=null,$password=null)
    {
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
            return redirect(site_url('Home'));             
           
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
    public function errorslogin()
    {
        $this->load->view('index.html');
        
    }    
    public function logout()
    {
        $res=$this->session->userdata('user_id');
            $setstatus=array(
                                    'time_logout'=>date('Y-m-d h:i:s'),
                                    "status"=>0,
                                    "counterrorlogin"=>0,
                                    'computerlogin'=>"");
        $this->db->where("user_id",$res);
        $this->db->update('users',$setstatus);
        $this->session->sess_destroy();
        redirect(site_url('Home'));
    }
}

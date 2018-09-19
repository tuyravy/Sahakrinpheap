<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendEmailAlert extends CI_Controller {


     public function __construct()
    {
         parent::__construct();
         $this->load->model('Users_model');
         $this->load->helper('url');
         $this->load->helper('form');
    }
    
    
	public function index()
	{
        $this->load->helper('url');
        $this->load->helper('form');
	    $users=$this->Users_model->getUsername();
        foreach($users as $rows)
        {
            if($rows->alreadysend>3)
            {
                echo "Overflow Send";
               
            }else
            {
                $this->Users_model->getupdatestatussendmail($rows->alreadysend,$rows->user_id);
                $this->sendtoRM($rows->email,$rows->full_name);
            }
            
        }
         
        
	}
     public function sendtoRM($to,$fullname)
    {
        
               
				$tomanager=$to;
                $ccfrom='ravy@sahakrinpheap.com.kh';
                $subject="SKP_Report Alert....";
			    $links=site_url().'public/img/logo_simple.png';
			    $messagemanager="
                            <body>
                            <div style='font-family: 'Hanuman', serif;'>
                               <table style='width:100%;border:1px solid #CCC;'>

                                        
                                        <tr>
                                            <td style='padding:0px;font-size:16px'>
                                                <span style='line-height:20px;'>
                                                    <p>សួរស្ដីលោកគ្រួ-អ្នកគ្រួ $fullname ជាទីគោរព</p>
                                                    <p></p>
                                                    <p>ថ្ងៃនេះលោកគ្រួ-អ្នកគ្រួមិនទាន់បានចូលទៅកាន់ប្រព័ន្ធ SKP_Report ដើម្បីត្រួតពិនិត្យរបាយការណ៍ប្រចាំថ្ងៃរបស់លោកគ្រួ-អ្នកគ្រួនៅឡើយទេ ។ ដើម្បីភាពត្រឹមត្រូវនៃរបាយការណ៍សូមលោកគ្រួ-អ្នកគ្រួធ្វើការផ្ទៀងផ្ទាត់របាយការណ៍ CMR , Indicator ជាមួយប្រព័ន្ធ CMR Online ថ្មីនេះថាវាមានចំណុចខុសគ្នាត្រង់របាយការណ៍មួយណា ហើយសូមលោកគ្រួ-អ្នកគ្រួធ្វើការផ្ដល់ការកែតំរូវតាមរយះ Mail ទៅកាន់លោកគ្រួ រ៉ាវី (ravy@Sahakrinpheap.com.kh ) នូវអ្វីដែលមានបញ្ហា និងតំរូវការបន្ថែមរបស់លោកគ្រួ-អ្នកគ្រួដែលគិតថាវាជួយសម្រូលដល់ការងារប្រចាំថ្ងៃ ។</p>
                                                    <p>អាស្រ័យដូចបានជំរាបខាងលើសូមលោកគ្រួ-អ្នកគ្រួសហការណ៍ដោយក្ដីរីករាយ។</p>
                                                    <p></p>
                                                    
                                                   
                                               </span> 
                                            </td>
                                        </tr>
                                            <tr>
                                                <td>
                                                    
                                                    <p>បញ្ចាក់៖ <p/>
                                                    <p>សូមចុចត្រង់តំននេះដើម្បីចូលទៅក្នុងប្រព័ន្ធSKP_Report <a href='http://www.app.sahakrinpheap.com/skp_reports/'>Click Here....</a></p>
                                                    <p>(<span style='color:#151515;'> 
	                                                   មិនត្រូវ Forward ឬ Reply ឡើយព្រោះវាជាសារផ្ងើរចេញពីប្រព័ន្ធ SKP_Report រៀងរាល់ ៤ ម៉ោងម្ដងប្រសិនបើលោកគ្រួ-អ្នកគ្រួមិនបានចូលទៅកាន់ប្រព័ន្ធនេះ៕
                                                  </span>)</p>
                                                    <p>www.sahakrinpheap.com.kh</p>
                                                </td>
                                            </tr>
                                            
                                        </table>

                            </div></body>";
                
                $this->sendMail($messagemanager,$ccfrom,$tomanager,$subject);
               

    }
    
     public function sendMail($message,$tocc,$toM,$subject)
    {
        $config = Array(
                    'protocol' => 'smtp',
                     'smtp_host' => 'mail.sahakrinpheap.com',
                     'smtp_port' => 587,
                     'smtp_user' => 'skp.report@sahakrinpheap.com',
                     'smtp_pass' => '*_l1lMPDFOMV',
                     'mailtype'  => 'html', 
                     'charset'   => 'utf-8'
                 );
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        $this->email->from('skp.report@sahakrinpheap.com', 'SKP_Report System');
		$this->email->to($toM);
        $this->email->cc($tocc);
		$this->email->subject($subject);
		$this->email->message($message);
		$result = $this->email->send();
        
        
    }
   }

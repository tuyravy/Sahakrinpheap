<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class imports extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
        $this->load->model('Csv_model');
        $this->load->library('csvimport');
    }
	public function index()
	{
       
        $data['viewpage']='csv/userimports';
		$this->load->view('master_page',$data);
	}
   
    function importscsv() {
        
        $column = $this->Csv_model->get_all_header();
        $arr_header = array();
        foreach ($column as $value) {
            array_push($arr_header, $value->COLUMN_NAME);
        }
        //print_r($arr_header);exit;
        $data['error'] = '';    //initialize image upload error array to empty
        $config['upload_path'] = './importsfile/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '10000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
             $data['viewpage']='csv/userimports';
		    $this->load->view('master_page',$data);
        } else {
            $file_data = $this->upload->data();
            $file_path = './importsfile/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path, $arr_header);
                foreach ($csv_array as $row) {
                    $data_insert =array();
                    foreach ($column as $val) {
                        $data_insert[$val->COLUMN_NAME] = $row[$val->COLUMN_NAME];
                    }
                    $this->db->insert('parvalues', $data_insert);
                }
                
                
                
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                 $iname=$file_path;
                  unlink($iname);
                redirect(site_url("imports"));
                //echo $file_path;
            } else
            {
             
             $data['viewpage']='csv/userimports';
		     $this->load->view('master_page',$data);
            }
      }
  }
}

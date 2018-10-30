<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Utility
{
    public function pagination_config($totalrow,$baseurl)
    {
        $CI=& get_instance();
        $CI->load->library("pagination");
        $config = array();
        $config["base_url"] = $baseurl;
        $config["total_rows"] =$totalrow;
        $config["per_page"] =30;
        //$config["uri_segment"] =2;    
        $config['page_query_string']=TRUE;  
        $config['reuse_query_string'] = FALSE;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        //$config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['display_pages'] = true;
        // 
        $config['anchor_class'] = 'follow_link';
        $CI->pagination->initialize($config);
    }
}

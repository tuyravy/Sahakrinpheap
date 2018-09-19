<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Utility
{
    public function Calculatorduration($DateStart,$enddate,$num_datestart,$num_dateend,$Morning,$afternoon)
    {
        
        $dateset='01-01-'.date('Y');
        $count_weekday=0;
        $count_duration=0;
        $resultdate=$num_dateend-$num_datestart;
        $numholiday=$this->FindHoliday($DateStart,$enddate);
        if($Morning=="Morning" && $afternoon=="Morning" && $resultdate==0)
        {
            $count_weekday=($num_dateend-$num_datestart);
            if($count_weekday==0)
            {
                $count_weekday=0.5;
                $count_duration=$count_weekday-$numholiday;
                if($count_duration<0)
                {
                    $count_duration=-$count_duration;
                }
                return $count_duration;
            }
            
        }
        else if($Morning=="Afternoon" && $afternoon=="Afternoon" && $resultdate==0)
        {
            $count_weekday=($num_dateend-$num_datestart);
            if($count_weekday==0)
            {
                $count_weekday=0.5;
                $count_duration=$count_weekday-$numholiday;
                if($count_duration<0)
                {
                    $count_duration=-$count_duration;
                }
                return $count_duration;
            }
        }
        else
        {
            
            if($Morning=="Morning" && $afternoon=="Morning" && $resultdate!=0)
            {
                $resultdate=$num_dateend-$num_datestart;
                $day_short = array();
                for($i=0;$i<=$resultdate;$i++)
                { 
                    $timestamp = strtotime($DateStart);
                    $data=date("z", $timestamp)+$i;
                    $tDay=$data;
                    $tFormat = 'D';
                    $day = (intval( $tDay ) - 1);
                    $day = ( $day == 0 ) ? $day : $day - 1;
                    $offset = intval( intval( $tDay ) * 86400 );
                    $str = date( $tFormat, strtotime($dateset) + $offset );
                    array_push($day_short, $str);
                    //$array=array($i=>$str);

                }
                    print_r($day_short);
                    $count_weekday = 0;
                    foreach ($day_short as $key => $value) 
                    {
                    if ($value == 'Sat' || $value == 'Sun') {

                    } else 
                    {
                    $count_weekday ++;
                    }
                    }
                    $count_weekday=$count_weekday-0.5;
                    $count_duration=$count_weekday-$numholiday;
                    if($count_duration<0)
                    {
                        $count_duration=-$count_duration;
                    }
                    return $count_duration;
            }
            
           else if($Morning=="Afternoon" && $afternoon=="Afternoon" && $resultdate!=0)
            {
                $resultdate=$num_dateend-$num_datestart;
                $day_short = array();
            for($i=0;$i<=$resultdate;$i++)
            { 
                $timestamp = strtotime($DateStart);
                $data=date("z", $timestamp)+$i;
                $tDay=$data;
                $tFormat = 'D';
                $day = (intval( $tDay ) - 1);
                $day = ( $day == 0 ) ? $day : $day - 1;
                $offset = intval( intval( $tDay ) * 86400 );
                $str = date( $tFormat, strtotime($dateset) + $offset );
                array_push($day_short, $str);
                //$array=array($i=>$str);

            }
               
                //print_r($day_short);
                $count_weekday = 0;
                foreach ($day_short as $key => $value) {
                if ($value == 'Sat' || $value == 'Sun') {

                } else {
                $count_weekday ++;
                }
                }
                $count_weekday=$count_weekday-0.5;
                $count_duration=$count_weekday-$numholiday;
                if($count_duration<0)
                {
                    $count_duration=-$count_duration;
                }
                return $count_duration;
            }
          else
          {
              $resultdate=$num_dateend-$num_datestart;
              $day_short = array();
            for($i=0;$i<=$resultdate;$i++)
            { 
                $timestamp = strtotime($DateStart);
                $data=date("z", $timestamp)+$i;
                $tDay=$data;
                $tFormat = 'D';
                $day = (intval( $tDay ) - 1);
                $day = ( $day == 0 ) ? $day : $day - 1;
                $offset = intval( intval( $tDay ) * 86400 );
                $str = date( $tFormat, strtotime($dateset) + $offset );
                array_push($day_short, $str);
                //$array=array($i=>$str);

            }
                //print_r($day_short);
                $count_weekday = 0;
                foreach ($day_short as $key => $value) {
                if ($value == 'Sat' || $value == 'Sun') {

                } else {
                    $count_weekday ++;
                    }
                }
                $count_weekday;                
                $numholiday;
                $count_duration=$count_weekday-$numholiday;
                if($count_duration<0)
                {
                    $count_duration=-$count_duration;
                }
                return $count_duration;
              
          }  
               
        }    
        //Afternoon
    }

    public function FindHoliday($startdate,$enddate)
    {
        $CI =& get_instance();
        $CI->load->Model("Leaves_model");
        $findholiday=$CI->Leaves_model->getholiday($startdate,$enddate);
        return $findholiday;
    }
    public function pagination_config($totalrow,$baseurl)
    {
        $CI=& get_instance();
        $CI->load->library("pagination");
        $config = array();
        $config["base_url"] = $baseurl;
        $config["total_rows"] =$totalrow;
        $config["per_page"] =10;
        //$config["uri_segment"] =2;      
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

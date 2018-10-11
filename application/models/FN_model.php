<?php
class FN_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        
    }   
    PUBLIC FUNCTION INTERBRANCH($startdate,$enddate,$brcode)
    {
<<<<<<< .merge_file_a17552
        $result=$this->db->query("CALL FN_cashinterbranch_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
=======
        $result=$this->db->query("CALL sp_cashinterbranch_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
>>>>>>> .merge_file_a16948
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
       
    }
    
    PUBLIC FUNCTION CASHINFLOW($startdate,$enddate,$brcode)
    {
<<<<<<< .merge_file_a17552
        $result=$this->db->query("CALL FN_cashinflow_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
=======
        $result=$this->db->query("CALL sp_cashinflow_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
>>>>>>> .merge_file_a16948
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION CASHOUTFLOW($startdate,$enddate,$brcode)
    {
<<<<<<< .merge_file_a17552
        $result=$this->db->query("CALL FN_cashoutflow_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
=======
        $result=$this->db->query("CALL sp_cashoutflow_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
>>>>>>> .merge_file_a16948
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION GETBRANCH()
    {
        $result=$this->db->get("tbl_branch");
        return $result->result();
    }
    PUBLIC FUNCTION DONLOADCASHINTERBRANCH($startdate,$enddate,$brcode)
    {

<<<<<<< .merge_file_a17552
        $result=$this->db->query("CALL FN_cashinterbranch_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
=======
        $result=$this->db->query("CALL sp_cashinterbranch_dailycashmovement('".$startdate."','".$enddate."','".$brcode."');");
>>>>>>> .merge_file_a16948
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
        
        // $re=$this->db->query("select 
        // '1111011' as AccNo,
        // 'Cash on Hand' as TitleAcc,
        // case
        // when
        //     sum(DrAmt)=0 then 0 else sum(DrAmt) end as DrAmt,
        // case
        // when sum(CrAmt)=0 then 0 else sum(CrAmt) end as CrAmt,
        // BrCode,BrShort from dailycashmovement where PostDate between '".$startdate."' and '".$enddate."' and 
        // GlAcc in(2965011,2965012,2965013,2965014,2965015) and BrCode='".$brcode."' and Note_ContraACC='1111011'");
        // $result1=array();
        // foreach($re->result() as $row)
        // {
            
        //      array_push($result1,$row);
        // }
        // $re=$this->db->query("select 
        // '1163011' as AccNo,
        // 'Cash on Hand' as TitleAcc,
        // case
        // when 
        // sum(DrAmt)=0 then 0 else sum(DrAmt) end as DrAmt,
        // case
        // when sum(CrAmt)=0 then 0 else sum(CrAmt) end as CrAmt,BrCode,BrShort from dailycashmovement where PostDate between '".$startdate."' and '".$enddate."' and 
        // GlAcc in(2965011,2965012,2965013,2965014,2965015) and BrCode='".$brcode."' and Note_ContraACC='1163011'");
        // $result2=array();
        // foreach($re->result() as $row)
        // {
        //     array_push($result2,$row);
        // }

        $query = array_merge($result1, $result2);
        return $query;
    }
    PUBLIC FUNCTION GETSUMMARYDETAIL($startdate,$enddate,$brname,$page)
    {
<<<<<<< .merge_file_a17552
        $result=$this->db->query("CALL FN_dailycashmovement_summary('".$startdate."','".$enddate."','".$brname."','".$page."');");
=======
        $result=$this->db->query("CALL sp_dailycashmovement_summary('".$startdate."','".$enddate."','".$brname."','".$page."');");
>>>>>>> .merge_file_a16948
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION TOTALSUMMARYDETAIL($startdate,$enddate)
    {
        $result=$this->db->query("select count(distinct(postdate)) as total from dailycashmovement where postdate between '".$startdate."' and '".$enddate."'");
        foreach($result->result() as $row){
            return $row->total;
        }
    }
    PUBLIC FUNCTION DOWNLOADSUMMARYCASHDETAIL($datestart,$dateend,$brcode)
    {
<<<<<<< .merge_file_a17552
        $result=$this->db->query("CALL FN_dailycashmovement_donwloadsummary('".$datestart."','".$dateend."','".$brcode."');");
=======
        $result=$this->db->query("CALL sp_dailycashmovement_donwloadsummary('".$datestart."','".$dateend."','".$brcode."');");
>>>>>>> .merge_file_a16948
        $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code
        return $res;
    }
    PUBLIC FUNCTION CASHBYTRANSITION($startdate,$enddate,$brcode,$page)
    {
        $result=$this->db->query("select * from dailycashmovement where postdate between '".$startdate."' and '".$enddate."' and BrCode='".$brcode."' limit 10 offset ".$page."");
        return $result->result();
    }
    PUBLIC FUNCTION DOWNLOADCASHBYTRANSITION($startdate,$enddate,$brcode)
    {
        $result=$this->db->query("select * from dailycashmovement where postdate between '".$startdate."' and '".$enddate."' and BrCode='".$brcode."'");
        return $result->result();
    }
    PUBLIC FUNCTION TOTALCASHBYTRANSITON($startdate,$enddate,$brcode)
    {
        $result=$this->db->query("select count(*) total from dailycashmovement where postdate between '".$startdate."' and '".$enddate."' and BrCode='".$brcode."'");
        foreach($result->result() as $row)
        {
            return $row->total;
        }
        
    }
<<<<<<< .merge_file_a17552
    public function GetBrByUser(){
        $userid=$this->session->userdata('user_id');
        $result=$this->db->from('users')
                    ->where('user_id',$userid)
                    ->where('flag',1)->get();
        $brlist=array();
       
        foreach($result->result() as $k=>$val){
           
             $brlist=explode(",",$val->subbranch);             
        }
        //print_r($brlist);
        $arraylist=array();
        foreach ($brlist as $value) {          
            $brcodelist=(int)$value;
            $result1 =$this->db->from('tbl_branch')
                            ->where('brCode',$brcodelist)
                            ->where('flage', 1)
                            ->get();
            foreach($result1->result() as $vl)
            {
                array_push($arraylist,$vl);    
            }
        }
        return  $arraylist;
    }
=======
>>>>>>> .merge_file_a16948
}
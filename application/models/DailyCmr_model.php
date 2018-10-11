<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class DailyCmr_model extends CI_Model
{
    public function __construct()
    {
         parent::__construct();
         $this->load->model('Menu_model');
    }
  
  public function getPortfolioQualitybyProductDaily($brcode,$role,$sid,$start,$end)
   {
       $result=$this->db->query("Call Sp_PortfolioQualitybyProductDaily(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
      
       
   }
    
   public function getPortfolioQualtiyRatiosDaily_model($brcode,$role,$sid,$start,$end)
   {
       $result=$this->db->query("Call Sp_PortfolioQualtiyRatiosDaily(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
       
   }
   
  public function getActiveBorrowerbyPro($brcode,$role,$sid,$start,$end,$limit)
  {
      $result=$this->db->query("Call sp_ActiveBorrowerbyPro(".$brcode.",".$role.",".$sid.",".$start.",".$end.",".$limit.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getLoanPortfolio($brcode,$role,$sid,$startdate,$enddate)
  {
      $result=$this->db->query("Call sp_LoanPortfolio(".$brcode.",".$role.",".$sid.",".$startdate.",".$enddate.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getLoansdisbursementInMonth($brcode,$role,$sid,$start,$end)
  {
      $result=$this->db->query("Call sp_LoansdisbursementInMonth(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getDailyLoansdisbursement($brcode,$role,$sid,$start,$end)
  {
      $result=$this->db->query("Call sp_DailyLoansdisbursement(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
 public function getValueofLoansdisbursementinMonth($brcode,$role,$sid,$start,$end)
  {
      $result=$this->db->query("Call sp_ValueofLoansdisbursementinMonth(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getRepaymentInMonth($brcode,$role,$sid,$start,$end)
  {
      $result=$this->db->query("Call sp_RepaymentInMonth(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getDailyRepayment($brcode,$role,$sid,$start,$end)
  {
      $result=$this->db->query("Call sp_DailyRepayment(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
    public function getDailyCMRReports($systemid)
  {
      $result=$this->db->query("Call sp_DailyCMRReports(".$systemid.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
    
  public function getDailyCMRReportsRatio($systemid)
  {
      $result=$this->db->query("Call sp_DailyCMRReportsRatio(".$systemid.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
      
  }
  public function gethistorydetailbyRm($systemid,$Reportdate)
  {
       $result=$this->db->query("Call sp_historydetailbyRm(".$systemid.",".$Reportdate.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function gethistorydetailbyDECO($Reportdate,$type)
  {
       $result=$this->db->query("Call sp_GetHistorydetailbyDECO(".$Reportdate.",".$type.")");     
       $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
   public function getValueofDailyLoansdisbursementinMonth($brcode,$role,$sid,$start,$end)
  {
       $result=$this->db->query("Call sp_ValueofDailyLoansdisbursementinMonth(".$brcode.",".$role.",".$sid.",".$start.",".$end.")");     
       $res      = $result->result();
        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function GetEmployee($sid)
  {
       $result=$this->db->query("Call sp_GetEmployee(".$sid.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getBrcode($sid,$role,$type)
  {
      
      $result=$this->db->query("Call sp_GetBranch(".$sid.",".$role.",".$type.")");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
    public function record_count()
   {
         $systemid=$this->session->userdata('system_id');
         $roid=$this->session->userdata('role');
         $type=$this->session->userdata('types');
         $reportdate=date('Ymd',strtotime($this->Menu_model->getCurrRundate()));
         $result=$this->db->query("Call sp_recordcount(".$systemid.",".$reportdate.",".$reportdate.",".$roid.",".$type.")");
         $res      = $result->result();
         $result->next_result(); 
         $result->free_result(); 
        foreach($res as $row)
        {
            return $row->counts;
        }
       
   }
  
    
    
    
 public function getActiveBorrowerDCEO($limit,$start,$reportdate,$type)
  {
    
        $this->db->limit($limit, $start);
       $result=$this->db->query("Call sp_ActiveBorrowerDCEO('".$start."','".$reportdate."','".$type."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getLoanPortfolioDCEO($limitpage,$limit,$REPORTDATE,$type)
  {
       $result=$this->db->query("Call sp_LoanPortfolioDCEO('".$limit."','".$REPORTDATE."','".$type."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getLoansdisbursementInMonthDCEO($limitpage,$limit,$reportdate,$type)
  {
       $result=$this->db->query("Call sp_LoansdisbursementInMonthDCEO('".$limit."','".$reportdate."','".$type."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getDailyLoansdisbursementDCEO($limitpage,$limit,$reportdate,$type)
  {
       $result=$this->db->query("Call sp_DailyLoansdisbursementDCEO('".$limit."','".$reportdate."','".$type."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
 public function getValueofLoansdisbursementinMonthDCEO($limit,$reportdate,$type)
  {
       $result=$this->db->query("Call sp_ValueofLoansdisbursementinMonthDCEO('".$limit."','".$reportdate."','".$type."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
   public function getValueofDailyLoansdisbursementinDCEO($limit,$datereports,$type)
  {
       $result=$this->db->query("Call sp_ValueofDailyLoansdisbursementinDCEO('".$limit."','".$datereports."','".$type."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  
   public function getRepaymentInMonthDCEO($limit,$datereports)
  {
       $result=$this->db->query("Call sp_RepaymentInMonthDCEO('".$limit."','".$datereports."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
   public function getDailyRepaymentDCEO($limit,$datereports)
  {
       $result=$this->db->query("Call sp_DailyRepaymentDCEO('".$limit."','".$datereports."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
 public function getPortfolioQualtiyRatiosDailyDCEO($limit,$datereports)
  {
       $result=$this->db->query("Call sp_PortfolioQualtiyRatiosDailyDCEO('".$limit."','".$datereports."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getPortfolioQualitybyProductDailyDCEO($limit,$datereports)
  {
       $result=$this->db->query("Call sp_PortfolioQualitybyProductDailyDCEO('".$limit."','".$datereports."')");     
       $res      = $result->result();

        //add this two line 
        $result->next_result(); 
        $result->free_result(); 
       //end of new code

        return $res;
  }
  public function getDailyCoPerforment($brcode,$role,$allsel,$limti,$reportdate,$prereportdate)
  {
      
          $result=$this->db->query("Call sp_DailyCoPerforment(".$brcode.",".$role.",'".$allsel."','".$limti."',".$reportdate.",".$prereportdate.")");     
          $res= $result->result();

            //add this two line 
            $result->next_result(); 
            $result->free_result(); 
           //end of new code

        return $res;
  }
    
  public function DailyBranchPerforment($systemid,$role,$reportdate,$limitrow,$option,$reportdatepre,$type)
  {
       $result=$this->db->query("Call sp_DailyBranchPerforment(".$systemid.",".$role.",".$reportdate.",".$limitrow.",".$option.",".$reportdatepre.",".$type.")");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
  }
  PUBLIC FUNCTION DONWLOADBRANCHPERFORMENT($REPORTDATESTART,$REPORTDATEEND,$RMSID)
  {
        $result=$this->db->query("Call sp_donwload_dailybranchPerforment('".$REPORTDATESTART."','".$REPORTDATEEND."','".$RMSID."')");     
        $res= $result->result();
        $result->next_result(); 
        $result->free_result();
        return $res;
  }
  PUBLIC FUNCTION DONWLOADBRANCOCHPERFORMENT($REPORTDATESTART,$REPORTDATEEND,$BRCODE)
  {
        $result=$this->db->query("Call sp_donwload_dailyCoPerforment('".$REPORTDATESTART."','".$REPORTDATEEND."','".$BRCODE."')");     
        $res= $result->result();
        $result->next_result(); 
        $result->free_result();
        return $res;
  }

  public function getdcmrsahakrinpheaceo($reportdate,$type)
  {
       $result=$this->db->query("Call sp_dcmrsahakrinpheaceo('".$reportdate."','".$type."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       
       foreach($res as $rows)
       {
           return $rows;
       }
  }
  public function GetRMname()
  {
       $type=$this->session->userdata('types');
       $result=$this->db->query("Call sp_GetRMname('".$type."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
  }
  public function getcmrsummRMCEO($rmid,$reportdate,$type)
  {
       $result=$this->db->query("Call sp_cmrsummRMCEO('".$rmid."','".$reportdate."','".$type."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
      
  }
  public function getactionlogin($rmid)
  {
       $result=$this->db->query("Call sp_getAntivelogin($rmid)");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
  }
  public function getEleaves($rmid,$reportdate)
  {
       $result=$this->db->query("Call sp_getEleaves('".$rmid."','".$reportdate."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
      
  }
  public function getInteratMonthly($reportdate)
  {
      $datafrom=date("Y-m-01",strtotime($reportdate));
      $result=$this->db->query("
                                SELECT 
                                distinct(l.IntRate) as monthlyrate
                                FROM loandetail l
                                WHERE l.AccstatusDate 
                                BETWEEN '".$datafrom."' AND '".$reportdate."'
                                AND l.accstatus BETWEEN '11' AND '98'
                                order by l.IntRate;
                              ");
       $res= $result->result();
    
       return $res;
  }
  public function getInteratFullMonth($Prereportdate,$reportdate)
  {
      $start=date("Y-m-01",strtotime($Prereportdate));
      $result=$this->db->query("
                                SELECT 
                                distinct(l.IntRate) as monthlyrate
                                FROM loandetail l
                                WHERE l.accstatusdate between '".$start."' and '".date('Y-m-d',strtotime($reportdate))."'   
                                and l.accstatusdate between '".$start."' AND '".$reportdate."'
                                and l.REPORTDATE between '".$start."' AND '".$reportdate."'                             
                                AND l.accstatus='11'
                                order by l.IntRate;
                              ");
       $res= $result->result();
       return $res;

  }
  public function getInteratFull($Prereportdate,$reportdate)
  {
      $start=date("Y-m-01",strtotime($Prereportdate));
      $result=$this->db->query("
                                SELECT 
                                distinct(l.IntRate) as monthlyrate
                                FROM loandetail l
                                WHERE l.accstatusdate between '".$start."' and '".date('Y-m-d',strtotime($reportdate))."'   
                                and l.accstatusdate between '".$start."' AND '".$reportdate."'
                                and l.REPORTDATE between '".$start."' AND '".$reportdate."'                             
                                AND l.accstatus BETWEEN '11' AND '98'
                                order by l.IntRate;
                              ");
       $res= $result->result();
       return $res;

  }
  public function getConspanMonthlyrate($reportdate)
  {
    $start=date("Y-m-01",strtotime($reportdate));
      $result=$this->db->query("
                                 SELECT 
                                count(distinct(l.IntRate)) as countrate
                                FROM loandetail l
                                WHERE l.AccstatusDate 
                                BETWEEN '".$start."' AND '".$reportdate."'
                                
                                AND l.accstatus BETWEEN '11' AND '98'
                                order by l.IntRate;
                              ");
       foreach($result->result() as $row)
       {
           return $row->countrate;
       }
       
     
  }
  public function getConspanMonthlyrateFull($Prereportdate,$reportdate)
  {
    $start=date("Y-m-01",strtotime($Prereportdate));
      $result=$this->db->query("
                                 SELECT 
                                count(distinct(l.IntRate)) as countrate
                                FROM loandetail l
                                WHERE l.disbdate between '".$start."' and '".$reportdate."'
                                and l.accstatusdate between '".$start."' AND '".$reportdate."'
                                and l.REPORTDATE between '".$start."' AND '".$reportdate."'
                                AND l.accstatus='11'
                                order by l.IntRate;
                              ");
       foreach($result->result() as $row)
       {
           return $row->countrate;
       }
       
     
  }
  public function getConspanMonthlyrateFullMonth($Prereportdate,$reportdate)
  {
    $start=date("Y-m-01",strtotime($Prereportdate));
      $result=$this->db->query("
                                 SELECT 
                                count(distinct(l.IntRate)) as countrate
                                FROM loandetail l
                                WHERE l.disbdate between '".$start."' and '".$reportdate."'                               
                                and l.accstatusdate between '".$start."' AND '".$reportdate."'
                                and l.REPORTDATE between '".$start."' AND '".$reportdate."'                             
                                AND l.accstatus='11'
                                order by l.IntRate;
                              ");
       foreach($result->result() as $row)
       {
           return $row->countrate;
       }
       
     
  }
  public function getClientMonthlyrate($reportdate,$intrate)
  {
      $start=date("Y-m-01",strtotime($reportdate));
      $result=$this->db->query("
                                SELECT 
                                count(l.Acc) as TotalAcc
                                FROM loandetail l
                                WHERE l.disbdate 
                                BETWEEN '".$reportdate."' AND '".$reportdate."'
                                AND l.accstatus BETWEEN '11' AND '98'
                                and l.IntRate='".$intrate."'
                                group by l.IntRate
                                order by l.IntRate;
                              ");
       foreach($result->result() as $row)
       {
        return $row->TotalAcc;
       }
    
      
  }
  public function getClientMonthlyrateFullMonth($reportdate,$rate)
  {

                                $start=date('Y-m-01',strtotime($reportdate));
                                $result=$this->db->query("
                                SELECT 
                                count(l.Acc) as TotalAcc
                                FROM loandetail l
                                WHERE l.disbdate
                                BETWEEN '".$start."' AND '".$reportdate."'
                                and l.accstatusdate between '".$start."' AND '".$reportdate."'
                                and l.REPORTDATE between '".$start."' AND '".$reportdate."'
                                AND l.accstatus='11'
                                and l.IntRate='".$rate."';
                              ");
       foreach($result->result() as $row)
       {
            return $row->TotalAcc;
       }
       
       
  }

  public function getClientMonthlyrateFull($reportdate,$rate)
  {
    $start=date("Y-m-01",strtotime($reportdate));
                                $result=$this->db->query("
                                SELECT 
                                count(l.Acc) as TotalAcc
                                FROM loandetail l
                                WHERE l.disbdate 
                                BETWEEN '".$reportdate."' AND '".$reportdate."'
                                and l.accstatusdate between '".$start."' AND '".$reportdate."'
                                and l.REPORTDATE between '".$start."' AND '".$reportdate."'
                                AND l.accstatus BETWEEN '11' AND '98'
                                and round(l.IntRate,0)=round('".$rate."',0);
                              ");
       foreach($result->result() as $row)
       {
            return $row->TotalAcc;
       }
       
       
  }
    public function getGrantedAmtFullMonth($reportdate,$rate)
    {
        $start=date('Y-m-01',strtotime($reportdate));
        $result=$this->db->query("
                                    SELECT
                                    sum(l.GrantedAmt) as TotalGrantedAmt
                                    FROM loandetail l
                                    WHERE l.disbdate 
                                    BETWEEN '".$start."' AND '".$reportdate."'
                                    and l.accstatusdate between '".$start."' AND '".$reportdate."'
                                    and l.REPORTDATE between '".$start."' AND '".$reportdate."'
                                    AND l.accstatus BETWEEN '11' AND '98'
                                    AND round(l.IntRate,0)=round('".$rate."',0);
                                ");
        foreach($result->result() as $row){
        
            return $row->TotalGrantedAmt;
        }
    }
  public function getGrantedAmtFull($reportdate,$rate)
  {
      
      $result=$this->db->query("
                                SELECT
                                sum(l.GrantedAmt) as TotalGrantedAmt
                                FROM loandetail l
                                WHERE l.disbdate 
                                BETWEEN '".$reportdate."' AND '".$reportdate."'
                                AND l.accstatus BETWEEN '11' AND '98'
                                
                                AND round(l.IntRate,0)=round('".$rate."',0);
                              ");
       foreach($result->result() as $row){
    
        return $row->TotalGrantedAmt;
       }
  }

  public function getGrantedAmt($reportdate,$intrate)
  {
      $result=$this->db->query("
                                SELECT
                                sum(l.GrantedAmt) as TotalGrantedAmt
                                FROM loandetail l
                                WHERE l.disbdate
                                BETWEEN '".$reportdate."' AND '".$reportdate."'
                                AND l.accstatus BETWEEN '11' AND '98'
                                AND l.IntRate='".$intrate."'
                                group by l.IntRate
                                order by l.IntRate;
                              ");
       foreach($result->result() as $row){
    
       return $row->TotalGrantedAmt;
       }
  }
  public function getClientPer($reportdate)
  {
       $result=$this->db->query("
                                SELECT
                                count(l.Acc)/
                                (select count(l1.Acc) from loandetail l1 
                                    where l1.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l1.accstatus BETWEEN '11' AND '98'
                                ) as client
                                FROM loandetail l
                                WHERE l.AccstatusDate 
                                BETWEEN '".$reportdate."' AND '".$reportdate."'                                
                                AND l.accstatus BETWEEN '11' AND '98'                                
                                group by l.IntRate
                                order by l.IntRate;
                              ");
       $res= $result->result();
    
       return $res;
      
  }
    public function getdisbPer($reportdate)
  {
       $result=$this->db->query("
                                SELECT
                                sum(l.GrantedAmt)/
                                (select sum(l1.GrantedAmt) from loandetail l1 
                                    where l1.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                   
                                    AND l1.accstatus BETWEEN '11' AND '98'
                                ) as disbGrantedAmt
                                FROM loandetail l
                                WHERE l.AccstatusDate 
                                BETWEEN '".$reportdate."' AND '".$reportdate."'
                                AND l.accstatus BETWEEN '11' AND '98'                                
                                group by l.IntRate
                                order by l.IntRate;
                              ");
       $res= $result->result();
    
       return $res;
      
  }
 public function getdisbPaymentfrequency($reportdate)
 {
     $result=$this->db->query
                (
                            "SELECT
                               'Client' as tital,
                                  (select format(count(l1.Acc),0) from loandetail l1 
                                    where l1.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l1.accstatus BETWEEN '11' AND '98'
                                    and l1.PaymentFrequency='Monthly'
                                ) as ClientMonthly,
                                (select format(count(l2.Acc),0) from loandetail l2
                                    where l2.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l2.accstatus BETWEEN '11' AND '98'
                                    and l2.PaymentFrequency='2 Week'
                                ) as Client2Week,
                                (select format(count(l3.Acc),0) from loandetail l3 
                                    where l3.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l3.accstatus BETWEEN '11' AND '98'
                                    and l3.PaymentFrequency='Weekly'
                                ) as ClientWeekly

                            FROM loandetail l
                            WHERE l.AccstatusDate 
                            BETWEEN '".$reportdate."' AND '".$reportdate."'
                            AND l.accstatus BETWEEN '11' AND '98'


                            union 

                            SELECT
                                'Amt Disb' as tital,
                                (select format(sum(l1.GrantedAmt),0) from loandetail l1 
                                    where l1.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l1.accstatus BETWEEN '11' AND '98'
                                    and l1.PaymentFrequency='Monthly'
                                ) as ClientMonthly,
                                (select format(sum(l2.GrantedAmt),0) from loandetail l2
                                    where l2.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l2.accstatus BETWEEN '11' AND '98'
                                    and l2.PaymentFrequency='2 Week'
                                ) as Client2Week,
                                (select format(sum(l3.GrantedAmt),0) from loandetail l3 
                                    where l3.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l3.accstatus BETWEEN '11' AND '98'
                                    and l3.PaymentFrequency='Weekly'
                                ) as ClientWeekly

                            FROM loandetail l
                            WHERE l.AccstatusDate 
                            BETWEEN '".$reportdate."' AND '".$reportdate."'
                            AND l.accstatus BETWEEN '11' AND '98'

                            UNION

                            SELECT
                                '% Client' as tital,
                                concat(format((select count(l1.Acc) from loandetail l1 
                                    where l1.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l1.accstatus BETWEEN '11' AND '98'
                                    and l1.PaymentFrequency='Monthly'
                                )/count(l.Acc)*100,2),'%') as perClient,
                                concat(format((select count(l2.Acc) from loandetail l2
                                    where l2.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l2.accstatus BETWEEN '11' AND '98'
                                    and l2.PaymentFrequency='2 Week'
                                )/count(l.Acc)*100,2),'%') as perClient2Week,
                                concat(format((select count(l3.Acc) from loandetail l3 
                                    where l3.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l3.accstatus BETWEEN '11' AND '98'
                                    and l3.PaymentFrequency='Weekly'
                                )/count(l.Acc)*100,2),'%') as perClientWeekly

                            FROM loandetail l
                            WHERE l.AccstatusDate 
                            BETWEEN '".$reportdate."' AND '".$reportdate."'
                            AND l.accstatus BETWEEN '11' AND '98'

                            UNION

                            SELECT
                                '% Disb' as tital,
                                concat(format((select sum(l1.GrantedAmt) from loandetail l1 
                                    where l1.AccstatusDate 
                                   BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l1.accstatus BETWEEN '11' AND '98'
                                    and l1.PaymentFrequency='Monthly'
                                )/sum(l.GrantedAmt)*100,2),'%') as perClient,
                                concat(format((select sum(l2.GrantedAmt) from loandetail l2
                                    where l2.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l2.accstatus BETWEEN '11' AND '98'
                                    and l2.PaymentFrequency='2 Week'
                                )/sum(l.GrantedAmt)*100,2),'%') as perClient2Week,
                                concat(format((select sum(l3.GrantedAmt) from loandetail l3 
                                    where l3.AccstatusDate 
                                    BETWEEN '".$reportdate."' AND '".$reportdate."'
                                    AND l3.accstatus BETWEEN '11' AND '98'
                                    and l3.PaymentFrequency='Weekly'
                                )/sum(l.GrantedAmt)*100,2),'%') as perClientWeekly

                            FROM loandetail l
                            WHERE l.AccstatusDate 
                            BETWEEN '".$reportdate."' AND '".$reportdate."'
                            AND l.accstatus BETWEEN '11' AND '98';
                    "
                );
     $res= $result->result();
     return $res;
 }
  public function getWO($start,$end,$role,$brcode,$key,$systemid,$pagelimit)
   {
       $result=$this->db->query("Call sp_getNPLWO('".$start."','".$end."','".$role."','".$brcode."','".$key."','".$systemid."','".$pagelimit."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
       
   }
  public function getGrandTotalActiveBorrowver($reportdate)
  {
       $type=$this->session->userdata('types');
       $result=$this->db->query("Call sp_GrandTotalActiveBorrowver('".$reportdate."','".$type."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
      
  }
  public function getGrandTotalLoanPortfolio($reportdate)
  {
      $type=$this->session->userdata('types');
      $result=$this->db->query("Call sp_GrandTotalLoanPortfolio('".$reportdate."','".$type."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
      
  }
  public function getGrandTotalLoanDisbursement($role,$reportdate)
  {
       $type=$this->session->userdata('types');
       $result=$this->db->query("Call sp_GrandTotalLoanDisbursement('".$role."','".$reportdate."','".$type."')");     
       $res= $result->result();
       $result->next_result();
       $result->free_result();
       return $res;
      
  }
  public function getGrandTotalAll($role,$reportdate,$roleid=null,$systemid=null,$totalprereportdate=null)
  {
       $type=$this->session->userdata('types');
       $result=$this->db->query("Call sp_GrandTotalAll('".$role."','".$reportdate."','".$roleid."','".$systemid."','".$totalprereportdate."','".$type."')");     
       $res= $result->result();
       $result->next_result(); 
       $result->free_result();
       return $res;
  }
//      public function getsumary($reportdate)
//   {
//         $type=$this->session->userdata('types');
//        $result=$this->db->query("Call sp_summaryByDECO('".$reportdate."','".$type."')");     
//        $res= $result->result();
//        $result->next_result(); 
//        $result->free_result();
//        return $res;
//   }
}
?>
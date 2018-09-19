<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dailyajax extends CI_Controller {
     public function __construct()
    {
         parent::__construct();
         $this->load->library('polyglot');
         $this->lang->load('home', $this->session->userdata('language'));
         $this->load->model('menu_model');
         //$this->load->model('daily_model');
         $this->load->model('dailyloanhistory_model');
         $this->load->model('DailyCmr_model');
         $this->load->library("pagination");
         
    }
    public function getloandisinmonthbrm($start,$end)
    {
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');
        $startdate=date("Ymd",strtotime($start));
        $enddate=date("Ymd",strtotime($end));
        $active=$this->DailyCmr_model->getLoansdisbursementInMonth($brcode,$role,$sid,$startdate,$enddate);
        $sumAcc=0;
        $ILD=0;
        $ILF=0;
        $GLD=0;
        $GLF=0;
        $ALI=0;
        $ALG=0;
        $MELI=0;
        $MELG=0;
        $SEL=0;
        $PL=0;
        $HRL=0;
        $EL=0;
        $tbl="";
        foreach($active as $row)
        {
                    echo "             
                                     <tr style='text-align:right'>
                                     <td style='text-align:left'>";
                    echo              $row->shortcode;                             
                    echo              "</td><td>";
                    echo              $row->Totalacc;$sumAcc+=$row->Totalacc;
                    echo              "</td><td>";
                    echo              number_format($row->ILD,0);$ILD+=$row->ILD;
                    echo              "</td><td>";
                    echo              number_format($row->ILF,0);$ILF+=$row->ILF;
                    echo              "</td><td>";
                    echo              number_format($row->GLD,0);$GLD+=$row->GLD;
                    echo              "</td><td>";
                    echo              number_format($row->GLF,0);$GLF+=$row->GLF;
                    echo              "</td><td>";
                    echo              number_format($row->ALI,0);$ALI+=$row->ALI;
                    echo              "</td><td>";
                    echo              number_format($row->ALG,0);$ALG+=$row->ALG;
                    echo              "</td><td>";
                    echo              number_format($row->MELI,0);$MELI+=$row->MELI;
                    echo              "</td><td>";
                    echo              number_format($row->MELG,0);$MELG+=$row->MELG;
                    echo              "</td><td>";
                    echo              number_format($row->SEL,0);$SEL+=$row->SEL;
                    echo              "</td><td>";
                    echo              number_format($row->PL,0);$PL+=$row->PL;
                    echo              "</td><td>";       
                    echo              number_format($row->HRL,0);$HRL+=$row->HRL;
                    echo              "</td><td>";
                    echo              number_format($row->EL,0);$EL+=$row->EL;
                    echo              "</td></tr>";
        } 
                    echo              "<tr style='text-align:right'>
                                      <td style='text-align:center'>Total:</td>";
                    echo              "<td>";
                    echo              number_format($sumAcc,0);
                    echo              "</td>";
                    echo              "<td>";
                    echo              number_format($ILD,0);
                    echo             "</td><td>";
                    echo              number_format($ILF,0);
                    echo              "</td><td>";
                    echo              number_format($GLD,0);
                    echo              "</td><td>";
                    echo              number_format($GLF,0);
                    echo             "</td><td>";
                    echo              number_format($ALI,0);
                    echo              "</td><td>";
                    echo              number_format($ALG,0);
                    echo              "</td><td>";
                    echo              number_format($MELI,0);
                    echo              "</td><td>";
                    echo              number_format($MELG,0);
                    echo              "</td><td>";
                    echo              number_format($SEL,0);
                    echo              "<td></td>";
                    echo              number_format($PL,0);
                    echo              "</td><td>";                              
                    echo              number_format($HRL,0);
                    echo              "</td><td>";
                    echo              number_format($EL,0);
                    echo            "</td></tr>";
                
        
    }
    public function getdailyloandisbrm($start,$end)
    {
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');
        $startdate=date("Ymd",strtotime($start));
        $enddate=date("Ymd",strtotime($end));
        $active=$this->DailyCmr_model->getDailyLoansdisbursement($brcode,$role,$sid,$startdate,$enddate);
        $sumAcc=0;
        $ILD=0;
        $ILF=0;
        $GLD=0;
        $GLF=0;
        $ALI=0;
        $ALG=0;
        $MELI=0;
        $MELG=0;
        $SEL=0;
        $PL=0;
        $HRL=0;
        $EL=0;
        $tbl="";
        foreach($active as $row)
        {
                    echo "             
                                     <tr style='text-align:right'>
                                     <td style='text-align:left'>";
                    echo              $row->shortcode;                             
                    echo              "</td><td>";
                    echo              $row->Totalacc;$sumAcc+=$row->Totalacc;
                    echo              "</td><td>";
                    echo              number_format($row->ILD,0);$ILD+=$row->ILD;
                    echo              "</td><td>";
                    echo              number_format($row->ILF,0);$ILF+=$row->ILF;
                    echo              "</td><td>";
                    echo              number_format($row->GLD,0);$GLD+=$row->GLD;
                    echo              "</td><td>";
                    echo              number_format($row->GLF,0);$GLF+=$row->GLF;
                    echo              "</td><td>";
                    echo              number_format($row->ALI,0);$ALI+=$row->ALI;
                    echo              "</td><td>";
                    echo              number_format($row->ALG,0);$ALG+=$row->ALG;
                    echo              "</td><td>";
                    echo              number_format($row->MELI,0);$MELI+=$row->MELI;
                    echo              "</td><td>";
                    echo              number_format($row->MELG,0);$MELG+=$row->MELG;
                    echo              "</td><td>";
                    echo              number_format($row->SEL,0);$SEL+=$row->SEL;
                    echo              "</td><td>";
                    echo              number_format($row->PL,0);$PL+=$row->PL;
                    echo              "</td><td>";       
                    echo              number_format($row->HRL,0);$HRL+=$row->HRL;
                    echo              "</td><td>";
                    echo              number_format($row->EL,0);$EL+=$row->EL;
                    echo              "</td></tr>";
        } 
                    echo              "<tr style='text-align:right'>
                                      <td style='text-align:center'>Total:</td>";
                    echo              "<td>";
                    echo              number_format($sumAcc,0);
                    echo              "</td>";
                    echo              "<td>";
                    echo              number_format($ILD,0);
                    echo             "</td><td>";
                    echo              number_format($ILF,0);
                    echo              "</td><td>";
                    echo              number_format($GLD,0);
                    echo              "</td><td>";
                    echo              number_format($GLF,0);
                    echo             "</td><td>";
                    echo              number_format($ALI,0);
                    echo              "</td><td>";
                    echo              number_format($ALG,0);
                    echo              "</td><td>";
                    echo              number_format($MELI,0);
                    echo              "</td><td>";
                    echo              number_format($MELG,0);
                    echo              "</td><td>";
                    echo              number_format($SEL,0);
                    echo              "<td></td>";
                    echo              number_format($PL,0);
                    echo              "</td><td>";                              
                    echo              number_format($HRL,0);
                    echo              "</td><td>";
                    echo              number_format($EL,0);
                    echo            "</td></tr>";
                
        
    }
        
    public function getdailyloandisb($start,$end)
    {
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');
        $startdate=date("Ymd",strtotime($start));
        $enddate=date("Ymd",strtotime($end));
        $active=$this->DailyCmr_model->getDailyLoansdisbursement($brcode,$role,$sid,$startdate,$enddate);
        $sumAcc=0;
        $ILD=0;
        $ILF=0;
        $GLD=0;
        $GLF=0;
        $ALI=0;
        $ALG=0;
        $MELI=0;
        $MELG=0;
        $SEL=0;
        $PL=0;
        $HRL=0;
        $EL=0;
        $tbl="";
        foreach($active as $row)
        {
                    echo "             
                                     <tr style='text-align:right'>
                                     <td style='text-align:left'>";
                    echo              $row->CoName;                             
                    echo              "</td><td>";
                    echo              $row->Totalacc;$sumAcc+=$row->Totalacc;
                    echo              "</td><td>";
                    echo              number_format($row->ILD,0);$ILD+=$row->ILD;
                    echo              "</td><td>";
                    echo              number_format($row->ILF,0);$ILF+=$row->ILF;
                    echo              "</td><td>";
                    echo              number_format($row->GLD,0);$GLD+=$row->GLD;
                    echo              "</td><td>";
                    echo              number_format($row->GLF,0);$GLF+=$row->GLF;
                    echo              "</td><td>";
                    echo              number_format($row->ALI,0);$ALI+=$row->ALI;
                    echo              "</td><td>";
                    echo              number_format($row->ALG,0);$ALG+=$row->ALG;
                    echo              "</td><td>";
                    echo              number_format($row->MELI,0);$MELI+=$row->MELI;
                    echo              "</td><td>";
                    echo              number_format($row->MELG,0);$MELG+=$row->MELG;
                    echo              "</td><td>";
                    echo              number_format($row->SEL,0);$SEL+=$row->SEL;
                    echo              "</td><td>";
                    echo              number_format($row->PL,0);$PL+=$row->PL;
                    echo              "</td><td>";       
                    echo              number_format($row->HRL,0);$HRL+=$row->HRL;
                    echo              "</td><td>";
                    echo              number_format($row->EL,0);$EL+=$row->EL;
                    echo              "</td></tr>";
        } 
                    echo              "<tr style='text-align:right'>
                                      <td style='text-align:center'>Total:</td>";
                    echo              "<td>";
                    echo              number_format($sumAcc,0);
                    echo              "</td>";
                    echo              "<td>";
                    echo              number_format($ILD,0);
                    echo             "</td><td>";
                    echo              number_format($ILF,0);
                    echo              "</td><td>";
                    echo              number_format($GLD,0);
                    echo              "</td><td>";
                    echo              number_format($GLF,0);
                    echo             "</td><td>";
                    echo              number_format($ALI,0);
                    echo              "</td><td>";
                    echo              number_format($ALG,0);
                    echo              "</td><td>";
                    echo              number_format($MELI,0);
                    echo              "</td><td>";
                    echo              number_format($MELG,0);
                    echo              "</td><td>";
                    echo              number_format($SEL,0);
                    echo              "<td></td>";
                    echo              number_format($PL,0);
                    echo              "</td><td>";                              
                    echo              number_format($HRL,0);
                    echo              "</td><td>";
                    echo              number_format($EL,0);
                    echo            "</td></tr>";
                
        
    }
    public function getvaluedisbinmonthrm($start,$end)
{
         $brcode=$this->session->userdata('branch_code');
         $role=$this->session->userdata('role');   
         $sid=$this->session->userdata('system_id');
         $startdate=date("Ymd",strtotime($start));
         $enddate=date("Ymd",strtotime($end));
                                    $active=$this->DailyCmr_model->getValueofLoansdisbursementinMonth($brcode,$role,$sid,$startdate,$enddate);
                                    $sumAcc=0;
                                    $ILD=0;
                                    $ILF=0;
                                    $GLD=0;
                                    $GLF=0;
                                    $ALI=0;
                                    $ALG=0;
                                    $MELI=0;
                                    $MELG=0;
                                    $SEL=0;
                                    $PL=0;
                                    $HRL=0;
                                    $EL=0;
                                    foreach($active as $row){
                              
            echo                "<tr style='text-align:right'>
                                <td style='text-align:left'>";
            echo                $row->shortcode;                              
            echo                "</td><td>";
            echo                number_format($row->Balance,0);$sumAcc+=$row->Balance;
            echo                "</td><td>";
            echo                number_format($row->ILD,0);$ILD+=$row->ILD;
            echo                "</td><td>";
            echo                number_format($row->ILF,0);$ILF+=$row->ILF;
            echo                "</td><td>";
            echo                number_format($row->GLD,0);$GLD+=$row->GLD;
            echo                "</td><td>";
            echo                number_format($row->GLF,0);$GLF+=$row->GLF;
            echo                "</td><td>";
            echo                number_format($row->ALI,0);$ALI+=$row->ALI;
            echo                "</td><td>";
            echo                number_format($row->ALG,0);$ALG+=$row->ALG;
            echo                "</td><td>";
            echo                number_format($row->MELI,0);$MELI+=$row->MELI;
            echo                "</td><td>";
            echo                number_format($row->MELG,0);$MELG+=$row->MELG;
            echo                "</td><td>";
            echo                number_format($row->SEL,0);$SEL+=$row->SEL;
            echo                "</td><td>";
            echo                number_format($row->PL,0);$PL+=$row->PL;
            echo                "</td><td>";
            echo                number_format($row->HRL,0);$HRL+=$row->HRL;
            echo                "</td><td>";
            echo                number_format($row->EL,0);$EL+=$row->EL;
            echo                "</td></tr>";
            }
                              
            echo                 "<tr style='text-align:right'>
                                 <td style='text-align:center'>Total:</td><td>";            
            echo                 number_format(round($sumAcc,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALI,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELI,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($SEL,-2),0);
            echo                "</td><td>";
            echo            	 number_format(round($PL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($HRL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($EL,-2),0);
            echo                "</td></tr>";
        
        }
public function getvaluedisbinmonth($start,$end)
{
         $brcode=$this->session->userdata('branch_code');
         $role=$this->session->userdata('role');   
         $sid=$this->session->userdata('system_id');
         $startdate=date("Ymd",strtotime($start));
         $enddate=date("Ymd",strtotime($end));
                                    $active=$this->DailyCmr_model->getValueofLoansdisbursementinMonth($brcode,$role,$sid,$startdate,$enddate);
                                    $sumAcc=0;
                                    $ILD=0;
                                    $ILF=0;
                                    $GLD=0;
                                    $GLF=0;
                                    $ALI=0;
                                    $ALG=0;
                                    $MELI=0;
                                    $MELG=0;
                                    $SEL=0;
                                    $PL=0;
                                    $HRL=0;
                                    $EL=0;
                                    foreach($active as $row){
                              
            echo                "<tr style='text-align:right'>
                                <td style='text-align:left'>";
            echo                $row->CoName;                              
            echo                "</td><td>";
            echo                number_format($row->Balance,0);$sumAcc+=$row->Balance;
            echo                "</td><td>";
            echo                number_format($row->ILD,0);$ILD+=$row->ILD;
            echo                "</td><td>";
            echo                number_format($row->ILF,0);$ILF+=$row->ILF;
            echo                "</td><td>";
            echo                number_format($row->GLD,0);$GLD+=$row->GLD;
            echo                "</td><td>";
            echo                number_format($row->GLF,0);$GLF+=$row->GLF;
            echo                "</td><td>";
            echo                number_format($row->ALI,0);$ALI+=$row->ALI;
            echo                "</td><td>";
            echo                number_format($row->ALG,0);$ALG+=$row->ALG;
            echo                "</td><td>";
            echo                number_format($row->MELI,0);$MELI+=$row->MELI;
            echo                "</td><td>";
            echo                number_format($row->MELG,0);$MELG+=$row->MELG;
            echo                "</td><td>";
            echo                number_format($row->SEL,0);$SEL+=$row->SEL;
            echo                "</td><td>";
            echo                number_format($row->PL,0);$PL+=$row->PL;
            echo                "</td><td>";
            echo                number_format($row->HRL,0);$HRL+=$row->HRL;
            echo                "</td><td>";
            echo                number_format($row->EL,0);$EL+=$row->EL;
            echo                "</td></tr>";
            }
                              
            echo                 "<tr style='text-align:right'>
                                 <td style='text-align:center'>Total:</td><td>";            
            echo                 number_format(round($sumAcc,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALI,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELI,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($SEL,-2),0);
            echo                "</td><td>";
            echo            	 number_format(round($PL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($HRL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($EL,-2),0);
            echo                "</td></tr>";
        
        }
    public function getvaluedisbdailyrm($start,$end)
    {
         $brcode=$this->session->userdata('branch_code');
         $role=$this->session->userdata('role');   
         $sid=$this->session->userdata('system_id');
         $startdate=date("Ymd",strtotime($start));
         $enddate=date("Ymd",strtotime($end));
                                    $active=$this->DailyCmr_model->getValueofDailyLoansdisbursementinMonth($brcode,$role,$sid,$startdate,$enddate);
                                    $sumAcc=0;
                                    $ILD=0;
                                    $ILF=0;
                                    $GLD=0;
                                    $GLF=0;
                                    $ALI=0;
                                    $ALG=0;
                                    $MELI=0;
                                    $MELG=0;
                                    $SEL=0;
                                    $PL=0;
                                    $HRL=0;
                                    $EL=0;
                                    foreach($active as $row){
                              
            echo                "<tr style='text-align:right'>
                                <td style='text-align:left'>";
            echo                $row->shortcode;                              
            echo                "</td><td>";
            echo                number_format($row->Balance,0);$sumAcc+=$row->Balance;
            echo                "</td><td>";
            echo                number_format($row->ILD,0);$ILD+=$row->ILD;
            echo                "</td><td>";
            echo                number_format($row->ILF,0);$ILF+=$row->ILF;
            echo                "</td><td>";
            echo                number_format($row->GLD,0);$GLD+=$row->GLD;
            echo                "</td><td>";
            echo                number_format($row->GLF,0);$GLF+=$row->GLF;
            echo                "</td><td>";
            echo                number_format($row->ALI,0);$ALI+=$row->ALI;
            echo                "</td><td>";
            echo                number_format($row->ALG,0);$ALG+=$row->ALG;
            echo                "</td><td>";
            echo                number_format($row->MELI,0);$MELI+=$row->MELI;
            echo                "</td><td>";
            echo                number_format($row->MELG,0);$MELG+=$row->MELG;
            echo                "</td><td>";
            echo                number_format($row->SEL,0);$SEL+=$row->SEL;
            echo                "</td><td>";
            echo                number_format($row->PL,0);$PL+=$row->PL;
            echo                "</td><td>";
            echo                number_format($row->HRL,0);$HRL+=$row->HRL;
            echo                "</td><td>";
            echo                number_format($row->EL,0);$EL+=$row->EL;
            echo                "</td></tr>";
            }
                              
            echo                 "<tr style='text-align:right'>
                                 <td style='text-align:center'>Total:</td><td>";            
            echo                 number_format(round($sumAcc,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALI,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELI,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($SEL,-2),0);
            echo                "</td><td>";
            echo            	 number_format(round($PL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($HRL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($EL,-2),0);
            echo                "</td></tr>";
        
    }
    public function getvaluedisbdaily($start,$end)
    {
         $brcode=$this->session->userdata('branch_code');
         $role=$this->session->userdata('role');   
         $sid=$this->session->userdata('system_id');
         $startdate=date("Ymd",strtotime($start));
         $enddate=date("Ymd",strtotime($end));
                                    $active=$this->DailyCmr_model->getValueofDailyLoansdisbursementinMonth($brcode,$role,$sid,$startdate,$enddate);
                                    $sumAcc=0;
                                    $ILD=0;
                                    $ILF=0;
                                    $GLD=0;
                                    $GLF=0;
                                    $ALI=0;
                                    $ALG=0;
                                    $MELI=0;
                                    $MELG=0;
                                    $SEL=0;
                                    $PL=0;
                                    $HRL=0;
                                    $EL=0;
                                    foreach($active as $row){
                              
            echo                "<tr style='text-align:right'>
                                <td style='text-align:left'>";
            echo                $row->CoName;                              
            echo                "</td><td>";
            echo                number_format($row->Balance,0);$sumAcc+=$row->Balance;
            echo                "</td><td>";
            echo                number_format($row->ILD,0);$ILD+=$row->ILD;
            echo                "</td><td>";
            echo                number_format($row->ILF,0);$ILF+=$row->ILF;
            echo                "</td><td>";
            echo                number_format($row->GLD,0);$GLD+=$row->GLD;
            echo                "</td><td>";
            echo                number_format($row->GLF,0);$GLF+=$row->GLF;
            echo                "</td><td>";
            echo                number_format($row->ALI,0);$ALI+=$row->ALI;
            echo                "</td><td>";
            echo                number_format($row->ALG,0);$ALG+=$row->ALG;
            echo                "</td><td>";
            echo                number_format($row->MELI,0);$MELI+=$row->MELI;
            echo                "</td><td>";
            echo                number_format($row->MELG,0);$MELG+=$row->MELG;
            echo                "</td><td>";
            echo                number_format($row->SEL,0);$SEL+=$row->SEL;
            echo                "</td><td>";
            echo                number_format($row->PL,0);$PL+=$row->PL;
            echo                "</td><td>";
            echo                number_format($row->HRL,0);$HRL+=$row->HRL;
            echo                "</td><td>";
            echo                number_format($row->EL,0);$EL+=$row->EL;
            echo                "</td></tr>";
            }
                              
            echo                 "<tr style='text-align:right'>
                                 <td style='text-align:center'>Total:</td><td>";            
            echo                 number_format(round($sumAcc,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ILF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLD,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($GLF,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALI,-2),0);
            echo                 "</td><td>";
            echo                 number_format(round($ALG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELI,-2),0);
            echo                "</td><td>";
            echo                number_format(round($MELG,-2),0);
            echo                "</td><td>";
            echo                number_format(round($SEL,-2),0);
            echo                "</td><td>";
            echo            	 number_format(round($PL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($HRL,-2),0);
            echo                "</td><td>";
            echo                number_format(round($EL,-2),0);
            echo                "</td></tr>";
        
    }
    public function getrepayinmonth($start,$end)
    {
                            
             $brcode=$this->session->userdata('branch_code');
             $role=$this->session->userdata('role');   
             $sid=$this->session->userdata('system_id');       
             $startdate=date("Ymd",strtotime($start));
             $enddate=date("Ymd",strtotime($end));
             $result=$this->DailyCmr_model->getRepaymentInMonth($brcode,$role,$sid,$startdate,$enddate);

                                $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $AdminFee1=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $totalgrand=0;
                                $totalex=0;
                                $totalnew=0;
                                foreach($result as $row){
                                $totalgrand+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1);
                                $totalex+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee);
                                $totalnew+=$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;
                                
            echo              "<tr style='text-align:right'>
                              <td style='text-align:left;white-space: nowrap;overflow: hidden;'>";
            echo              $row->CoName;
            echo              "</td><td style='text-align:right;'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle,0);$Principle+=$row->Principle;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest,0);$Interest+=$row->Interest;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Penalty,0);$Penalty+=$row->Penalty;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->AdminFee,0);$AdminFee+=$row->AdminFee;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1,0);$Principle1+=$row->Principle1;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest1,0);$Interest1+=$row->Interest1;
            echo              "</td><td style='text-align:right'>";
            echo             number_format($row->Penalty1,0);$Penalty1+=$row->Penalty1;
            echo             "</td><td style='text-align:right'>";
            echo             number_format($row->AdminFee1,0);$AdminFee1+=$row->AdminFee1;
            echo             "</td>
                            </tr>";
                                                      
                           
            }
            echo              "<tr style='text-align:right'>
                              <td style='text-align:center'>Total:</td>
                              <td style='text-align:right'>";echo number_format(round($totalgrand,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($totalex,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Interest,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($totalnew,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle1,-2),0);echo "</td>
                              <td style='text-align:right'>";echo number_format(round($Interest1,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty1,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee1,-2),0);echo "</td>
                            </tr>";
                              
        
        
    }
    public function getrepayinmonthrm($start,$end)
    {
                            
             $brcode=$this->session->userdata('branch_code');
             $role=$this->session->userdata('role');   
             $sid=$this->session->userdata('system_id');       
             $startdate=date("Ymd",strtotime($start));
             $enddate=date("Ymd",strtotime($end));
             $result=$this->DailyCmr_model->getRepaymentInMonth($brcode,$role,$sid,$startdate,$enddate);

                                $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $AdminFee1=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $totalgrand=0;
                                $totalex=0;
                                $totalnew=0;
                                foreach($result as $row){
                                $totalgrand+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1);
                                $totalex+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee);
                                $totalnew+=$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;
                                
            echo              "<tr style='text-align:right'>
                              <td style='text-align:left;white-space: nowrap;overflow: hidden;'>";
            echo              $row->shortcode;
            echo              "</td><td style='text-align:right;'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle,0);$Principle+=$row->Principle;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest,0);$Interest+=$row->Interest;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Penalty,0);$Penalty+=$row->Penalty;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->AdminFee,0);$AdminFee+=$row->AdminFee;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1,0);$Principle1+=$row->Principle1;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest1,0);$Interest1+=$row->Interest1;
            echo              "</td><td style='text-align:right'>";
            echo             number_format($row->Penalty1,0);$Penalty1+=$row->Penalty1;
            echo             "</td><td style='text-align:right'>";
            echo             number_format($row->AdminFee1,0);$AdminFee1+=$row->AdminFee1;
            echo             "</td>
                            </tr>";
                                                      
                           
            }
            echo              "<tr style='text-align:right'>
                              <td style='text-align:center'>Total:</td>
                              <td style='text-align:right'>";echo number_format(round($totalgrand,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($totalex,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Interest,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($totalnew,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle1,-2),0);echo "</td>
                              <td style='text-align:right'>";echo number_format(round($Interest1,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty1,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee1,-2),0);echo "</td>
                            </tr>";
                              
        
        
    }
     public function getrepayDailyrm($start,$end)
    {
             $brcode=$this->session->userdata('branch_code');
             $role=$this->session->userdata('role');   
             $sid=$this->session->userdata('system_id');       
             $startdate=date("Ymd",strtotime($start));
             $enddate=date("Ymd",strtotime($end));
             $result=$this->DailyCmr_model->getDailyRepayment($brcode,$role,$sid,$startdate,$enddate);

                                $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $AdminFee1=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $totalgrand=0;
                                $totalex=0;
                                $totalnew=0;
                                foreach($result as $row){
                                $totalgrand+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1);
                                $totalex+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee);
                                $totalnew+=$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;                
            echo              "<tr style='text-align:right'>
                              <td style='text-align:left;white-space: nowrap;overflow: hidden;'>";
            echo              $row->shortcode;
            echo              "</td><td style='text-align:right;'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle,0);$Principle+=$row->Principle;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest,0);$Interest+=$row->Interest;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Penalty,0);$Penalty+=$row->Penalty;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->AdminFee,0);$AdminFee+=$row->AdminFee;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1,0);$Principle1+=$row->Principle1;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest1,0);$Interest1+=$row->Interest1;
            echo              "</td><td style='text-align:right'>";
            echo             number_format($row->Penalty1,0);$Penalty1+=$row->Penalty1;
            echo             "</td><td style='text-align:right'>";
            echo             number_format($row->AdminFee1,0);$AdminFee1+=$row->AdminFee1;
            echo             "</td>
                            </tr>";
                                                      
                           
            }
            echo              "<tr style='text-align:right'>
                              <td style='text-align:center'>Total:</td>
                              <td style='text-align:right'>";echo number_format(round($totalgrand,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($totalex,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Interest,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($totalnew,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle1,-2),0);echo "</td>
                              <td style='text-align:right'>";echo number_format(round($Interest1,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty1,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee1,-2),0);echo "</td>
                            </tr>";
        
    }
    public function getrepayDaily($start,$end)
    {
             $brcode=$this->session->userdata('branch_code');
             $role=$this->session->userdata('role');   
             $sid=$this->session->userdata('system_id');       
             $startdate=date("Ymd",strtotime($start));
             $enddate=date("Ymd",strtotime($end));
             $result=$this->DailyCmr_model->getDailyRepayment($brcode,$role,$sid,$startdate,$enddate);

                                $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $AdminFee1=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $totalgrand=0;
                                $totalex=0;
                                $totalnew=0;
                                foreach($result as $row){
                                $totalgrand+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1);
                                $totalex+=($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee);
                                $totalnew+=$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;                
            echo              "<tr style='text-align:right'>
                              <td style='text-align:left;white-space: nowrap;overflow: hidden;'>";
            echo              $row->CoName;
            echo              "</td><td style='text-align:right;'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle,0);$Principle+=$row->Principle;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest,0);$Interest+=$row->Interest;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Penalty,0);$Penalty+=$row->Penalty;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->AdminFee,0);$AdminFee+=$row->AdminFee;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Principle1,0);$Principle1+=$row->Principle1;
            echo              "</td><td style='text-align:right'>";
            echo              number_format($row->Interest1,0);$Interest1+=$row->Interest1;
            echo              "</td><td style='text-align:right'>";
            echo             number_format($row->Penalty1,0);$Penalty1+=$row->Penalty1;
            echo             "</td><td style='text-align:right'>";
            echo             number_format($row->AdminFee1,0);$AdminFee1+=$row->AdminFee1;
            echo             "</td>
                            </tr>";
                                                      
                           
            }
            echo              "<tr style='text-align:right'>
                              <td style='text-align:center'>Total:</td>
                              <td style='text-align:right'>";echo number_format(round($totalgrand,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($totalex,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Interest,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($totalnew,-2),0);echo"</td>
                              <td style='text-align:right'>";echo number_format(round($Principle1,-2),0);echo "</td>
                              <td style='text-align:right'>";echo number_format(round($Interest1,-2),0);echo "</td>    
                              <td style='text-align:right'>";echo number_format(round($Penalty1,-2),0);echo "</td> 
                              <td style='text-align:right'>";echo number_format(round($AdminFee1,-2),0);echo "</td>
                            </tr>";
        
    }
     public function getrationsDailyrm($start,$end)
    {
                                $startdate=date("Ymd",strtotime($start));
                                $enddate=date("Ymd",strtotime($end));
                                $brcode=$this->session->userdata('branch_code');
                                $role=$this->session->userdata('role');   
                                $sid=$this->session->userdata('system_id');
                                $Ratios=$this->DailyCmr_model->getPortfolioQualtiyRatiosDaily_model($brcode,$role,$sid,$startdate,$enddate);
                                $BalAmt=0;
                                $PAR1=0;
                                $PAR7=0;
                                $PAR30=0;
                                $PAR1_Amt=0;
                                $PAR7_Amt=0;
                                $PAR30_Amt=0;
                                $ParRatio1day=0;
                                $ParRatio7day=0;
                                $ParRatio30day=0;
                                $count=0;
                                foreach($Ratios as $rows){
                                $count++;
                echo          "<tr style='text-align:right'>
                              
                              <td style='text-align:left'>";
                              echo $rows->shortcode;
                              echo"</td><td>";
                              echo number_format($rows->BalAmt,0);$BalAmt+=$rows->BalAmt;
                              echo "</td><td>"; 
                              echo number_format($rows->PAR1,0);$PAR1+=$rows->PAR1;
                              echo "</td><td>";
                              echo number_format($rows->PAR1_Amt,0);$PAR1_Amt+=$rows->PAR1_Amt;
                              echo "<td>";
                              echo number_format($rows->ParRatio1day,2)*100;$ParRatio1day+=number_format($rows->ParRatio1day,2)*100;
                              echo "%</td><td>";
                              echo number_format($rows->PAR7,0);$PAR7+=$rows->PAR7;
                              echo "</td><td>";
                              echo number_format($rows->PAR7_Amt,0);$PAR7_Amt+=$rows->PAR7_Amt;
                              echo "</td><td>";
                              echo number_format($rows->ParRatio7day,2)*100;$ParRatio7day+=number_format($rows->ParRatio7day,2)*100;
                              echo "%</td><td>";
                              echo number_format($rows->PAR30,0);$PAR30+=$rows->PAR30;
                              echo "</td>";
                              echo "<td>".number_format($rows->PAR30_Amt,0);$PAR30_Amt+=$rows->PAR30_Amt;
                              echo "</td><td>";
                              echo number_format($rows->ParRatio30day,2)*100;$ParRatio30day+=number_format($rows->ParRatio30day,2)*100;
                              echo "%</td></tr>";
                              
                          
                            }
                              
                        echo  "<tr style='text-align:right'>                              
                              <td style='text-align:center'>Total:</td>
                              <td>";echo number_format(round($BalAmt,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR1,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR1_Amt,-2),0);echo "</td>
                              <td>";echo number_format($ParRatio1day/$count,2);echo "%</td>
                              <td>";echo number_format(round($PAR7,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR7_Amt,-2),0);echo "</td>
                              <td>";echo number_format($ParRatio7day/$count,2);echo "%</td>
                              <td>";echo number_format(round($PAR30,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR30_Amt,-2),0);echo "</td>
                              <td>";
                                 echo number_format($ParRatio30day/$count,2);echo "%
                              </td>
                            </tr>";
        
        
    }
    public function getrationsDaily($start,$end)
    {
                                $startdate=date("Ymd",strtotime($start));
                                $enddate=date("Ymd",strtotime($end));
                                $brcode=$this->session->userdata('branch_code');
                                $role=$this->session->userdata('role');   
                                $sid=$this->session->userdata('system_id');
                                $Ratios=$this->DailyCmr_model->getPortfolioQualtiyRatiosDaily_model($brcode,$role,$sid,$startdate,$enddate);
                                $BalAmt=0;
                                $PAR1=0;
                                $PAR7=0;
                                $PAR30=0;
                                $PAR1_Amt=0;
                                $PAR7_Amt=0;
                                $PAR30_Amt=0;
                                $ParRatio1day=0;
                                $ParRatio7day=0;
                                $ParRatio30day=0;
                                $count=0;
                                foreach($Ratios as $rows){
                                $count++;
                echo          "<tr style='text-align:right'>
                              
                              <td style='text-align:left'>";
                              echo $rows->CoName;
                              echo"</td><td>";
                              echo number_format($rows->BalAmt,0);$BalAmt+=$rows->BalAmt;
                              echo "</td><td>"; 
                              echo number_format($rows->PAR1,0);$PAR1+=$rows->PAR1;
                              echo "</td><td>";
                              echo number_format($rows->PAR1_Amt,0);$PAR1_Amt+=$rows->PAR1_Amt;
                              echo "<td>";
                              echo number_format($rows->ParRatio1day,2)*100;$ParRatio1day+=number_format($rows->ParRatio1day,2)*100;
                              echo "%</td><td>";
                              echo number_format($rows->PAR7,0);$PAR7+=$rows->PAR7;
                              echo "</td><td>";
                              echo number_format($rows->PAR7_Amt,0);$PAR7_Amt+=$rows->PAR7_Amt;
                              echo "</td><td>";
                              echo number_format($rows->ParRatio7day,2)*100;$ParRatio7day+=number_format($rows->ParRatio7day,2)*100;
                              echo "%</td><td>";
                              echo number_format($rows->PAR30,0);$PAR30+=$rows->PAR30;
                              echo "</td>";
                              echo "<td>".number_format($rows->PAR30_Amt,0);$PAR30_Amt+=$rows->PAR30_Amt;
                              echo "</td><td>";
                              echo number_format($rows->ParRatio30day,2)*100;$ParRatio30day+=number_format($rows->ParRatio30day,2)*100;
                              echo "%</td></tr>";
                              
                          
                            }
                              
                        echo  "<tr style='text-align:right'>                              
                              <td style='text-align:center'>Total:</td>
                              <td>";echo number_format(round($BalAmt,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR1,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR1_Amt,-2),0);echo "</td>
                              <td>";echo number_format($ParRatio1day/$count,2);echo "%</td>
                              <td>";echo number_format(round($PAR7,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR7_Amt,-2),0);echo "</td>
                              <td>";echo number_format($ParRatio7day/$count,2);echo "%</td>
                              <td>";echo number_format(round($PAR30,-2),0);echo "</td>
                              <td>";echo number_format(round($PAR30_Amt,-2),0);echo "</td>
                              <td>";
                                 echo number_format($ParRatio30day/$count,2);echo "%
                              </td>
                            </tr>";
        
        
    }
  public function getproductdaily($start,$end)
  {
                                $startdate=date("Ymd",strtotime($start));
                                $enddate=date("Ymd",strtotime($end));
                                $brcode=$this->session->userdata('branch_code');
                                $role=$this->session->userdata('role');   
                                $sid=$this->session->userdata('system_id');
                                $pro=$this->DailyCmr_model->getPortfolioQualitybyProductDaily($brcode,$role,$sid,$startdate,$enddate);
                                $PAR1EX=0;
                                $PAR7EX=0;
                                $PAR30EX=0;
                                $PAR1NE=0;
                                $PAR7NE=0;
                                $PAR30NE=0;$balance=0;
                                foreach($pro as $row){
                            
                        echo   "<tr style='text-align:right'>
                              <td style='text-align:left'>";echo $row->CoName;
                              echo "</td>
                              <td>";echo number_format($row->BalAmt,0);$balance+=$row->BalAmt;
                              echo "</td>
                              <td>";
                              echo number_format($row->PAR1EX,0);$PAR1EX+=$row->PAR1EX;echo "</td>
                              <td>";
                              echo number_format($row->PAR7EX,0);$PAR7EX+=$row->PAR7EX;echo "</td>
                              <td>";
                              echo number_format($row->PAR30EX,0);$PAR30EX+=$row->PAR30EX;echo "</td>
                              <td>";
                              echo number_format($row->PAR1NE,0);$PAR1NE+=$row->PAR1NE;echo "</td>                             
                              <td>";
                              echo number_format($row->PAR7NE,0);$PAR7NE+=$row->PAR7NE;echo "</td>                           
                             <td>";
                             echo number_format($row->PAR30NE,0);$PAR30NE+=$row->PAR30NE;echo "</td>
                            </tr>";
                            }
                        echo "<tr style='text-align:right'>
                              
                              <td style='text-align:center'>Total:</td>
                              <td>";echo number_format($balance,0);echo "</td>
                              <td>";echo number_format($PAR1EX,0);echo "</td>
                              <td>";echo number_format($PAR7EX,0);echo "</td>
                              <td>";echo number_format($PAR30EX,0);echo "</td>
                              <td>";echo number_format($PAR1NE,0);echo "</td>                             
                              <td>";echo number_format($PAR7NE,0);echo "</td>                           
                             <td>"; echo number_format($PAR30NE,0);echo "</td>
                            </tr>";
  }
  public function getproductdailyrm($start,$end)
  {
                                $startdate=date("Ymd",strtotime($start));
                                $enddate=date("Ymd",strtotime($end));
                                $brcode=$this->session->userdata('branch_code');
                                $role=$this->session->userdata('role');   
                                $sid=$this->session->userdata('system_id');
                                $pro=$this->DailyCmr_model->getPortfolioQualitybyProductDaily($brcode,$role,$sid,$startdate,$enddate);
                                $PAR1EX=0;
                                $PAR7EX=0;
                                $PAR30EX=0;
                                $PAR1NE=0;
                                $PAR7NE=0;
                                $PAR30NE=0;$balance=0;
                                foreach($pro as $row){
                            
                        echo   "<tr style='text-align:right'>
                              <td style='text-align:left'>";echo $row->shortcode;
                              echo "</td>
                              <td>";echo number_format($row->BalAmt,0);$balance+=$row->BalAmt;
                              echo "</td>
                              <td>";
                              echo number_format($row->PAR1EX,0);$PAR1EX+=$row->PAR1EX;echo "</td>
                              <td>";
                              echo number_format($row->PAR7EX,0);$PAR7EX+=$row->PAR7EX;echo "</td>
                              <td>";
                              echo number_format($row->PAR30EX,0);$PAR30EX+=$row->PAR30EX;echo "</td>
                              <td>";
                              echo number_format($row->PAR1NE,0);$PAR1NE+=$row->PAR1NE;echo "</td>                             
                              <td>";
                              echo number_format($row->PAR7NE,0);$PAR7NE+=$row->PAR7NE;echo "</td>                           
                             <td>";
                             echo number_format($row->PAR30NE,0);$PAR30NE+=$row->PAR30NE;echo "</td>
                            </tr>";
                            }
                        echo "<tr style='text-align:right'>
                              
                              <td style='text-align:center'>Total:</td>
                              <td>";echo number_format($balance,0);echo "</td>
                              <td>";echo number_format($PAR1EX,0);echo "</td>
                              <td>";echo number_format($PAR7EX,0);echo "</td>
                              <td>";echo number_format($PAR30EX,0);echo "</td>
                              <td>";echo number_format($PAR1NE,0);echo "</td>                             
                              <td>";echo number_format($PAR7NE,0);echo "</td>                           
                             <td>"; echo number_format($PAR30NE,0);echo "</td>
                            </tr>";
  }
}

?>
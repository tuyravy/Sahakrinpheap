 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id'); 
        if(isset($_GET['datestart']))
        {
            $reportdate=date("Y-m-d",strtotime($_GET['datestart']));
        }else
        {
            $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
        }
        
                
        $conspancolum=$this->DailyCmr_model->getConspanMonthlyrate($reportdate);
        $clientmonthlyrate=$this->DailyCmr_model->getClientMonthlyrate($reportdate);
        $monthly=$this->DailyCmr_model->getInteratMonthly($reportdate);
        $GrantedAmt=$this->DailyCmr_model->getGrantedAmt($reportdate);
        $ClientPer=$this->DailyCmr_model->getClientPer($reportdate);
        $disbPer=$this->DailyCmr_model->getdisbPer($reportdate);
        $disbPerPayment=$this->DailyCmr_model->getdisbPaymentfrequency($reportdate);
        
        
    
?><!-- page content -->
               
        
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
        
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>                        
                        <a href="<?= site_url('dcmrsahakrinpheaceo');?>" >Summary CMR-Daily</a>
                        <a href="<?= site_url('cmrSummRMCEO');?>">Summary CMR By RM-Daily</a>
                        <a href="<?= site_url('daillydisbursebyinterest');?>" class="active">Disbursement by Interest-Daily</a>
                        <!--<a href="<?= site_url('daily/daillyloan');?>">Written-Off and Loan > 90 Days</a>-->
            </div>
       

          <div class="">        
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-file" style="padding:10px;"></span>Disbursement by Interest-Daily<small></small></h3>
                    </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                       <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">
                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
                                           value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                                placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>" 
                                                value="<?php if(isset($_GET['dateend'])){echo $_GET['datestart'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
                                                readonly="true" style="background:white;">
                                      </div>
                                      <button type="submit" class="btn btn-primary" style="margin-top:5px;">Search</button>
                                    </fieldset>
                                
                                </form>
                            </div>
                            <div class="col-md-2 pull-right">
                                 
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                            <span style="margin-left:5px;">PRINT</span></button>  
                                        <p></p>
                                </div>    
                                 
                            </div>
                             
                             
                         
                       </div>
                       <br/>
                    
                      <div id="reports"> 
                    <div class="row">
                      <div class="col-md-12 nopadding">
                          
                          <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                          <h2 id="in" style="text-align:left;">CREDIT MONITORING REPORT_DAILY</h2>
                          <p id="in" style="text-align:left">Reports Date:
                          
                             <?php if(isset($_GET['datestart'])){echo date("d-M-Y",strtotime($_GET['datestart']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
                            <span style="margin-left:10px;">
                                To:<span style="margin-left:10px;"></span>
                            <?php if(isset($_GET['datestart'])){echo date("d-M-Y",strtotime($_GET['datestart']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
                            </span>
                              
                            
                          </p>
                          <p>1.Disbursement by Interest-Daily</p>
                      
                    </div>
                    <div class="col-md-12">
                    <div class="panel-body table-responsive">                        
                       <table class="table table-bordered table-condensed f11 col-md-12">
                          <thead class="active">
                          <tr class="active">
                            <th style="padding:10px 0px 5px 0px;text-align:center">Description</th> 
                            <th colspan="<?php echo $conspancolum;?>" style="padding:10px 0px 5px 0px;text-align:center">Interest by Type</th>
                            <th style="padding:10px 0px 5px 0px;text-align:center">Total</th>
                          </tr>
                            
                          </thead>
                           <tbody>
                                <tr style="text-align:right">
                                    <td style="text-align:left">Monthly Rate</td>
                                    <?php
                                        
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate/12,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                    <td></td>
                                </tr>
                                <tr style="text-align:right">
                                    <td style="text-align:left">Yearly Rate</td>
                                     <?php
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                     <td></td>
                                    
                                </tr>
                               <tr style="text-align:right">
                                    <td style="text-align:left">Number of Clients</td>
                                    <?php
                                       $totalClient=0;
                                        foreach($clientmonthlyrate as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalAcc,0);$totalClient+=$row->TotalAcc;?></td>
                                    <?php
                                     }
                                    ?>
                                     <td style="text-align:right"><?php echo number_format($totalClient,0);?></td>
                                    
                                </tr>
                                <tr style="text-align:right">
                                   <td style="text-align:left">Amt Dis</td>
                                    <?php
                                        $totalAmt=0;
                                        foreach($GrantedAmt as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalGrantedAmt,2);$totalAmt+=$row->TotalGrantedAmt;?></td>
                                    <?php
                                     }
                                    ?>
                                     <td style="text-align:right"><?php echo number_format($totalAmt,2);?></td>
                                    
                                </tr>
                                <tr style="text-align:right">
                                   <td style="text-align:left">% Cilent</td>
                                    <?php
                                        $perclient=0;
                                        foreach($ClientPer as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->client*100,2);$perclient+=$row->client;?>%</td>
                                    <?php
                                     }
                                    ?>
                                     <td style="text-align:right"><?php echo number_format($perclient*100);?>%</td>
                                    
                                </tr>
                                <tr style="text-align:right">
                                    <td style="text-align:left">%Disb</td>
                                    <?php
                                        $totaldisbper=0;
                                        foreach($disbPer as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->disbGrantedAmt*100,2);$totaldisbper+=$row->disbGrantedAmt;?>%</td>
                                    <?php
                                     }
                                    ?>
                                    <td style="text-align:right"><?php echo number_format($totaldisbper*100,0);?>%</td>
                                    
                                </tr>
                                 <tr style="text-align:right">
                                    <td colspan="<?php echo $conspancolum+1;?>" style="text-align:right">Convert To $</td>
                                    <td style="text-align:right"><?php echo number_format($totalAmt/4000,0);?></td>
                                    
                                    
                                </tr>
                           </tbody>
                      </table>
                    </div> 
                    <p>2.Disbursement by Interest ( Previous month and Actual )</p>                
                    <!---<div class="panel-body table-responsive">                        
                       <table class="table table-bordered table-condensed f11 col-md-12">
                          <thead class="active">
                          <tr class="active">
                            <th style="padding:10px 0px 5px 0px;text-align:center">Description</th> 
                            <th colspan="<?php echo $conspancolum;?>" style="padding:10px 0px 5px 0px;text-align:center">Previous month</th>
                            <th colspan="<?php echo $conspancolum;?>" style="padding:10px 0px 5px 0px;text-align:center">Actual</th>
                            <th colspan="<?php echo $conspancolum;?>" style="padding:10px 0px 5px 0px;text-align:center">Variance</th>
                            
                          </tr>
                            
                          </thead>
                           <tbody>
                                <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <td style="text-align:left">Monthly Rate</td>
                                    <?php
                                        
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate/12,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                    <?php
                                        
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate/12,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                    <?php
                                        
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate/12,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                    
                                </tr>
                                <tr style="text-align:right">
                                    <td style="text-align:left;white-space: nowrap;overflow: hidden;">Yearly Rate</td>
                                     <?php
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                    <?php
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                    <?php
                                        foreach($monthly as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->monthlyrate,2);?>%</td>
                                    <?php
                                     }
                                    ?>
                                    
                                    
                                </tr>
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <td style="text-align:left">Number of Clients</td>
                                    <?php
                                       $totalClient=0;
                                        foreach($clientmonthlyrate as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalAcc,0);$totalClient+=$row->TotalAcc;?></td>
                                    <?php
                                     }
                                    ?>
                                    <?php
                                       $totalClient=0;
                                        foreach($clientmonthlyrate as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalAcc,0);$totalClient+=$row->TotalAcc;?></td>
                                    <?php
                                     }
                                    ?>
                                    <?php
                                       $totalClient=0;
                                        foreach($clientmonthlyrate as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalAcc,0);$totalClient+=$row->TotalAcc;?></td>
                                    <?php
                                     }
                                    ?>
                                    
                                    
                                </tr>
                                <tr style="text-align:right">
                                   <td style="text-align:left">Amt Dis</td>
                                    <?php
                                        $totalAmt=0;
                                        foreach($GrantedAmt as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalGrantedAmt,2);$totalAmt+=$row->TotalGrantedAmt;?></td>
                                    <?php
                                     }
                                    ?>
                                     <?php
                                        $totalAmt=0;
                                        foreach($GrantedAmt as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalGrantedAmt,2);$totalAmt+=$row->TotalGrantedAmt;?></td>
                                    <?php
                                     }
                                    ?>
                                     <?php
                                        $totalAmt=0;
                                        foreach($GrantedAmt as $row){
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($row->TotalGrantedAmt,2);$totalAmt+=$row->TotalGrantedAmt;?></td>
                                    <?php
                                     }
                                    ?>
                                    
                                    
                                </tr>
                               
                                 <tr style="text-align:right">
                                    <td colspan="<?php echo $conspancolum+1;?>" style="text-align:right">Convert To $</td>
                                    <td style="text-align:right"><?php echo number_format($totalAmt/4000,0);?></td>
                                    <td style="text-align:right"><?php echo number_format($totalAmt/4000,0);?></td>
                                    <td style="text-align:right"><?php echo number_format($totalAmt/4000,0);?></td>
                                    
                                </tr>
                           </tbody>
                      </table>
                    </div> 


                        <p>3.Disbursement by Payment Frequency-Daily</p>
                        ---->
                        <br/>
                       <div class="panel-body table-responsive">                        
                        <table class="table table-bordered table-condensed f11">
                          <thead class="active">
                          <tr class="active">
                            <th style="padding:0px 0px 10px 0px;text-align:center" rowspan="2">Disbursement</th> 
                            <th colspan="3" style="padding:5px 0px 5px 0px;text-align:center">Payment Frequency</th> 
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">Total</th>                         
                          </tr>
                         <tr class="active">
                            <th  style="padding:0px 0px 3px 0px;text-align:center">Monthly</th> 
                            <th  style="padding:0px 0px 3px 0px;text-align:center">2 Week</th> 
                            <th  style="padding:0px 0px 3px 0px;text-align:center">Weekly</th> 
                                                   
                          </tr>
                          </thead>
                           <tbody>
                               <?php 
                                $i=1;
                                $a=0;
                                $b=0;
                                $c=0;
                                $total=0;
                                $totalpersion=0;
                                foreach($disbPerPayment as $row){
                                $a=$row->ClientMonthly;
                                $b=$row->Client2Week;
                                $c=$row->ClientWeekly;
                                
                               ?>
                            
                                <tr style="text-align:right">
                                    <td style="text-align:left"><?php echo $row->tital;?></td>
                                    <td style="text-align:right">
                                        <?php if($row->ClientMonthly==null){ echo 0;}else{echo $row->ClientMonthly;};?></td>
                                    <td style="text-align:right">
                                        <?php if($row->Client2Week==null){echo 0;}else{echo $row->Client2Week;};?></td>
                                    <td style="text-align:right"><?php if($row->ClientWeekly==null){echo 0;}else{ echo $row->ClientWeekly;};?></td>
                                    <td style="text-align:right">
                                        <?php  
                                                
                                                if($row->tital=='% Client'){
                                                    $row->ClientMonthly+$row->Client2Week+$row->ClientWeekly;
                                                    echo '100%';
                                                }else if($row->tital=='% Disb')
                                                {
                                                    $totalpersion=$row->ClientMonthly+$row->Client2Week+$row->ClientWeekly;
                                                    echo "100%";
                                                    
                                                }else if($row->tital=='Amt Disb')
                                                {
                                                    $total=($b+$a+$c)/4000;
                                                    echo number_format($totalAmt,0);
                                                }
                                                else if($row->tital=='Client')
                                                {
                                                      echo $b+$a+$c;
                                                }   
                                                else
                                                {
                                                    
                                                }
                                        ?>
                                    </td>                                  
                                </tr>
                               <?php }?>
                                <tr style="text-align:right">
                                    <td colspan="4" style="text-align:right">Convert To $</td>
                                    <td style="text-align:right"><?php  echo number_format($totalAmt/4000,0);?></td>                             
                                </tr>
                                
                               
                           </tbody>
                      </table>   
                     </div>
                    </div>  
                  </div>       
                 </div>
                         <div>
                         <p> FX= 	 4,000 </p>  
                        </div> 
                    </div>                      
                  </div>
                    
                </div>
                  
              </div>
            </div>
            
 <style>
   #in{text-align: left;}
   fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 0.5em 0.5em 0.5em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    }
    fieldset
    {
        width:64%;
        
    }
    .nopadding {
    padding: 0 !important;
    margin: 0 !important;
    }
</style>
   
    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML onl
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
            
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            
          
        }
    </script>
              
<!----------------JavaScript Get Datepicker--->
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>

              
<!-- page content -->        
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>                        
                        <a href="<?= site_url('dailydceo/dcmrsahakrinpheaceo');?>" >Summary CMR-Daily</a>
                        <a href="<?= site_url('dailydceo/cmrSummRMCEO');?>">Summary CMR By RM-Daily</a>
                        <?php if($type==3){}else{?>
                        <a href="<?= site_url('dailydceo/loandisbbyinterest');?>" class="active">Disbursement by Interest-Daily</a>
                        <?php }?>
                        <!--<a href="<?= site_url('daily/daillyloan');?>">Written-Off and Loan > 90 Days</a>-->
            </div>
       

          <div class="">        
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <span class="glyphicon glyphicon-file" style="padding:10px;"></span>Disbursement by Interest-Daily<small></small>
                    </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                       <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                               
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
                      <div class="col-md-12">
                          
                          <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                          <h2 id="in" style="text-align:left;">CREDIT MONITORING REPORT_DAILY</h2>
                          <p id="in" style="text-align:left;margin-left:15px;">Reports Date:
                             <?php  echo date("d-M-Y",strtotime($reportdate));?>  
                          </p>
                          <p style="font-weight:bold;">1.Disbursement by Interest-Daily</p>
                    </div>
                    <div class="col-md-12" style="margin-top:-12px;">
                    <div class="panel-body table-responsive">                        
                       <table class="table table-bordered table-condensed f11 col-md-12">
                          <thead class="active">
                          <tr class="active">
                            <th rowspan="3"><p style="margin-top:-60px;">Duration</p></th> 
                            <th style="text-align:left">Description</th> 
                            <th colspan="<?php echo $conspancolum;?>" style="padding:10px 0px 5px 0px;text-align:center">Interest by Type</th>
                            <th rowspan="3" style="padding:10px 0px 5px 0px;text-align:center"><p style="margin-top:-60px;">Total</p></th>
                          </tr>
                          <tr style="text-align:right" class="active">
                                    
                                    <th style="text-align:left">Monthly Rate</th>
                                    <?php
                                        
                                        foreach($monthly as $row){
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($row->monthlyrate/12,2);?>%</th>
                                    <?php
                                     }
                                    ?>
                                   
                                </tr>
                                <tr style="text-align:right" class="active">
                                    <th style="text-align:left">Yearly Rate</th>
                                     <?php
                                        foreach($monthly as $row){
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($row->monthlyrate,2);?>%</th>
                                    <?php
                                     }
                                    ?>
                                    
                                    
                                </tr>
                          </thead>
                           <tbody>
                                
                                
                               <tr style="text-align:right">
                                    <td rowspan="5"><p id="degre">Actual</p></td>
                                    <td style="text-align:left">Number of Clients</td>
                                    <?php
                                       $totalClient=0;
                                       $getInteratFull=$this->DailyCmr_model->getInteratFullMonth($reportdate,$reportdate);
                                        foreach($getInteratFull as $row){
                                       
                                        $clientmonthlyrate=$this->DailyCmr_model->getClientMonthlyrate($reportdate,$row->monthlyrate);   
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($clientmonthlyrate,0);$totalClient+=$clientmonthlyrate;?></td>
                                    <?php
                                     
                                    }
                                    ?>
                                     <td style="text-align:right"><?php echo number_format($totalClient,0);?></td>
                                    
                                </tr>
                                <tr style="text-align:right">
                                   <td style="text-align:left">Amt Disb</td>
                                    <?php
                                        $totalAmt=0;
                                        $totalAmtWeekly=0;
                                        foreach($getInteratFull as $row){
                                            $GrantedAmt=$this->DailyCmr_model->getGrantedAmt($reportdate,$row->monthlyrate);
                                    ?>
                                        <td style="text-align:right"><?php echo number_format($GrantedAmt,0);$totalAmt+=$GrantedAmt;$totalAmtWeekly+=$GrantedAmt;?></td>
                                    <?php
                                     }
                                    
                                    ?>
                                     <td style="text-align:right"><?php echo number_format($totalAmt,0);?></td>
                                    
                                </tr>
                                <tr style="text-align:right;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                   <td style="text-align:left">Amt Disb-USD</td>
                                    <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmt=$this->DailyCmr_model->getGrantedAmt($reportdate,$row->monthlyrate);
                                    ?>
                                        <td style="text-align:right">
                                        <small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($GrantedAmt/4000,2);$totalAmt+=$GrantedAmt;?></td>
                                    <?php
                                     }
                                    ?>
                                     <td style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($totalAmt/4000,2);?></td>
                                    
                                </tr>
                                <tr style="text-align:right">
                                   <td style="text-align:left">% Cilent</td>
                                   <?php
                                       
                                       $getInteratFull=$this->DailyCmr_model->getInteratFullMonth($reportdate,$reportdate);
                                        foreach($getInteratFull as $row){
                                       
                                        $clientmonthlyrate=$this->DailyCmr_model->getClientMonthlyrate($reportdate,$row->monthlyrate);   
                                    ?>
                                        <td style="text-align:right"><?php if($clientmonthlyrate==0){echo 0;}else{echo number_format(($clientmonthlyrate/$totalClient)*100,2);}?>%</td>
                                    <?php
                                     
                                    }
                                    ?>
                                     <td style="text-align:right"><?php if($totalClient==0){echo 0;}else{echo number_format(($totalClient/$totalClient)*100);}?>%</td>
                                    
                                </tr>
                                <tr style="text-align:right">
                                    <td style="text-align:left">%Disb</td>
                                    <?php
                                       
                                        foreach($getInteratFull as $row){
                                        $GrantedAmt=$this->DailyCmr_model->getGrantedAmt($reportdate,$row->monthlyrate);
                                    ?>
                                        <td style="text-align:right">
                                       <?php if($GrantedAmt==0){echo 0;}else{echo number_format(($GrantedAmt/$totalAmt)*100,2);}?>%</td>
                                    <?php
                                     }
                                    ?>
                                    <td style="text-align:right"><?php if($totalAmt==0){echo 0;}else{echo number_format(($totalAmt/$totalAmt)*100,0);}?>%</td>
                                    
                                </tr>
                                
                           </tbody>
                      </table>
                    </div> 
                                    
                    <p style="margin-top:-28px;font-weight:bold;">2.Disbursement by Payment Frequency-Daily</p>
                       <div class="panel-body table-responsive" style="margin-top:-10px;">                        
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
                                    <td style="text-align:right;">
                                        <?php if($row->Client2Week==null){echo 0;}else{echo $row->Client2Week;};?></td>
                                       
                                    <td style="text-align:right"><?php if($row->ClientWeekly==null){echo 0;}else{ echo $row->ClientWeekly;};?></td>
                                    <td style="text-align:right">
                                        <?php  
                                                
                                                if($row->tital=='% Client'){
                                                    //$row->ClientMonthly+$row->Client2Week+$row->ClientWeekly;
                                                    echo '100%';
                                                }else if($row->tital=='% Disb')
                                                {
                                                    //$totalpersion=$row->ClientMonthly+$row->Client2Week+$row->ClientWeekly;
                                                    echo "100%";
                                                    
                                                }else if($row->tital=='Amt Disb')
                                                {
                                                    
                                                    //$total=($b+$a+$c)/4000;
                                                    echo number_format($totalAmtWeekly,0);
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
                               
                                
                                
                               
                           </tbody>
                      </table>   
                     </div>
                                   
                    <p style="margin-top:-28px;font-weight:bold;">3.Disbursement by Interest (Previous and Actual Day)</p>   
                    <?php 

                    if(isset($_GET['datestart']))
                            {
                                $Prereportdate=date("Y-m-d",strtotime($_GET['datestart']));
                                $reportdate=date("Y-m-d",strtotime($_GET['dateend']));
                            }else
                            {
                                $reportdate=date("Y-m-d",strtotime($this->Function_model->GetCurrRunDate())); 
                                $Prereportdate=date("Y-m-d",strtotime($this->Function_model->GetPreReportDate($reportdate)));
                            }

                            $conspancolumfull=$this->DailyCmr_model->getConspanMonthlyrateFullMonth($Prereportdate,$reportdate);
                            $getInteratFull=$this->DailyCmr_model->getInteratFullMonth($Prereportdate,$reportdate);
                    ?>
                    <div class="col-md-12">
                                <fieldset class="scheduler-border">
                                  <legend class="scheduler-border">Specific Period:</legend>
                                <form class="form-inline">
                                  
                                      <div class="form-group">
                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
                                           value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date("Y-m-d",strtotime($Prereportdate));}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                                placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>" 
                                                value="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
                                                readonly="true" style="background:white;">
                                      </div>
                                      <button type="submit" class="btn btn-primary" style="margin-top:5px;">Search</button>
                                    
                                
                                </form>
                                
                            </fieldset>
                            </div>                          
                            <p id="in" style="text-align:left;margin-top:-10px;margin-left:15px;">Reports Date:
                                
                                    <?php if(isset($_GET['datestart'])){echo date("d-M-Y",strtotime($_GET['datestart']));}else{ echo date("d-M-Y",strtotime($Prereportdate));}?>
                                    <span style="margin-left:10px;">
                                        To:<span style="margin-left:10px;"></span>
                                    <?php if(isset($_GET['dateend'])){echo date("d-M-Y",strtotime($_GET['dateend']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
                                    </span>
                                    
                                    
                            </p>

                    <div class="panel-body table-responsive" style="margin-top:-10px;">                        
                       <table class="table table-bordered table-condensed f11 col-md-12">
                        <thead class="active">
                          <tr class="active">
                            <th rowspan="3"><p style="margin-top:-60px;">Duration</p></th> 
                            <th style="text-align:left">Description</th> 
                            <th colspan="<?php echo $conspancolumfull;?>" style="padding:10px 0px 5px 0px;text-align:center">Interest by Type</th>
                            <th rowspan="3"><p style="margin-top:-60px;">Total</p></th> 
                          </tr>
                          <tr class="active">
                                <th style="text-align:left">Monthly Rate</th>
                                <?php
                                    
                                    foreach($getInteratFull as $row){
                                ?>
                                    <th style="text-align:right"><?php echo number_format($row->monthlyrate/12,2);?>%</th>
                                <?php
                                }
                                ?>
                          </tr>
                          <tr class="active">
                                <th style="text-align:left;white-space: nowrap;overflow: hidden;">Yearly Rate</th>
                                <?php
                                    foreach($getInteratFull as $row){
                                ?>
                                    <th style="text-align:right"><?php echo number_format($row->monthlyrate,2);?>%</th>
                                <?php
                                }
                                ?>
                          </tr>

                          </thead>
                           <tbody>                               
                        
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <th rowspan="5"><p id="degre">Previous</p>

                                    <span style="margin-left:10px;color:rgba(105, 105, 105, 0.5);"><small>
                                        <?php if(isset($_GET['datestart'])){echo date("d-M-Y",strtotime($_GET['datestart']));}else{ echo date("d-M-Y",strtotime($Prereportdate));}?>
                                    </small></span>
                                    
                                    </th>
                                    <th style="text-align:left">Number of Clients</th>
                                    <?php
                                       $totalClientPre=0;
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($clientmonthlyrateFull,0);$totalClientPre+=$clientmonthlyrateFull;?></th>
                                        
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalClientPre,0);?></th>
                                </tr>
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left">Amt Dis</th>
                                    <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($GrantedAmtFull,0);$totalAmt+=$GrantedAmtFull;?></th>
                                    <?php
                                     }
                                    ?>
                                     <th style="text-align:right"><?php echo number_format($totalAmt,0);?></th>
                                </tr>
                               
                                <tr style="text-align:right;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">   
                                   
                                   <td style="text-align:left">Amt Dis-USD</td>
                                   <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($GrantedAmtFull/4000,2);$totalAmt+=$GrantedAmtFull/4000;?></th>
                                    <?php
                                     }
                                    ?>    
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($totalAmt,2);?></th>                            
                                </tr>   
                                <tr style="text-align:right;font-weight:bold;">   
                                   
                                   <td style="text-align:left">% Client</td>
                                   <?php                                       
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php if($clientmonthlyrateFull==0){echo 0;}else{echo number_format(($clientmonthlyrateFull/$totalClientPre)*100,2);}?>%</th>
                                        
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php if($totalClientPre==0){echo 0;}else{echo number_format(($totalClientPre/$totalClientPre)*100,2);}?>%</th>                            
                                </tr>  
                                <tr style="text-align:right;font-weight:bold;">   
                                   
                                   <td style="text-align:left">% Disb</td>
                                   <?php
                                        $dis=$totalAmt*4000;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php if($GrantedAmtFull==0){echo 0;}else{echo number_format(($GrantedAmtFull/$dis)*100,2);}?>%</th>
                                    <?php
                                     }
                                    ?>
                                     <th style="text-align:right"><?php if($totalAmt==0){echo 0;}else{ echo number_format(($totalAmt/$totalAmt)*100,2);}?>%</th>
                                </tr>                              
                                
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <td rowspan="5"><p id="degre">Actual</P>
                                    <span style="margin-left:10px;color:rgba(70, 70, 70, 0.5);"><small>
                                            <?php if(isset($_GET['dateend'])){echo date("d-M-Y",strtotime($_GET['dateend']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
                                    <small></span>
                                    </td>
                                    <th style="text-align:left">Number of Clients</th>
                                    <?php
                                       $totalClient=0;
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($reportdate,$row->monthlyrate);
                                        
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($clientmonthlyrateFull,0);$totalClient+=$clientmonthlyrateFull;?></th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalClient,0);?>
                                </tr>
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left;white-space: nowrap;overflow: hidden;">Amt Dis</th>
                                    <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($reportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($GrantedAmtFull,0);$totalAmt+=$GrantedAmtFull;?></th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalAmt,0);?></th> 
                                </tr>
                               
                                <tr style="text-align:right;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;white-space: nowrap;overflow: hidden;">   
                                   
                                   <td style="text-align:left">Amt Dis-USD</td>
                                   <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($reportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($GrantedAmtFull/4000,2);$totalAmt+=$GrantedAmtFull/4000;?></th>
                                    <?php
                                     }
                                    ?>    
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($totalAmt,2);?></th>                            
                                </tr>                  
                                <tr style="text-align:right;font-weight:bold;">   
                                   
                                   <td style="text-align:left">% Client</td>
                                   <?php                                       
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($reportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php if($clientmonthlyrateFull==0){echo 0;}else{echo number_format(($clientmonthlyrateFull/$totalClient)*100,2);}?>%</th>
                                        
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php if($totalClient==0){echo 0;}else{echo number_format(($totalClient/$totalClient)*100,2);}?>%</th>                            
                                </tr>  
                                <tr style="text-align:right;font-weight:bold;">   
                                   
                                   <td style="text-align:left">% Disb</td>
                                   <?php
                                        $dis=$totalAmt*4000;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($reportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php if($GrantedAmtFull==0){echo 0;}else{ echo number_format(($GrantedAmtFull/$dis)*100,2);}?>%</th>
                                    <?php
                                     }
                                    ?>
                                     <th style="text-align:right"><?php if($totalAmt==0){echo 0;}else{echo number_format(($totalAmt/$totalAmt)*100,2);}?>%</th>
                                </tr>                   
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <td rowspan="5"><p id="degre">Variance</p></td>
                                    <th style="text-align:left">Number of Clients</th>
                                    <?php
                                       $totalClient=0;
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($reportdate,$row->monthlyrate);
                                        $PreclientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($clientmonthlyrateFull-$PreclientmonthlyrateFull,0);$totalClient+=$clientmonthlyrateFull-$PreclientmonthlyrateFull;?></th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalClient,0);?></th>
                                </tr>
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left">Amt Dis</th>
                                    <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($reportdate,$row->monthlyrate);
                                        $PreGrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($GrantedAmtFull-$PreGrantedAmtFull,0);$totalAmt+=$GrantedAmtFull-$PreGrantedAmtFull;?></th>
                                    <?php
                                     }
                                    ?>
                                      <th style="text-align:right"><?php echo number_format($totalAmt,0);?></th>
                                </tr>
                               
                                <tr style="text-align:right;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;white-space: nowrap;overflow: hidden;">   
                                   
                                   <td style="text-align:left">Amt Dis-USD</td>
                                   <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($reportdate,$row->monthlyrate);
                                        $PreGrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format(($GrantedAmtFull-$PreGrantedAmtFull)/4000,2);$totalAmt+=($GrantedAmtFull-$PreGrantedAmtFull)/4000;?></th>
                                    <?php
                                     }
                                    ?>  
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($totalAmt,2);?></th>                              
                                </tr>                  
                                <tr style="text-align:right;font-weight:bold;white-space: nowrap;overflow: hidden;">   
                                   
                                   <td style="text-align:left">% Client</td>
                                   <?php
                                       
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($reportdate,$row->monthlyrate);
                                        $PreclientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right">
                                        <?php 
                                        if ($clientmonthlyrateFull==0){
                                            echo 0;
                                        }else{
                                            echo number_format((($clientmonthlyrateFull-$PreclientmonthlyrateFull)/$totalClient)*100,0);

                                        }
                                        ?>
                                        %</th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php if($totalClient==0){echo 0;}else{echo number_format(($totalClient/$totalClient)*100,2);}?>%</th>                              
                                </tr>      
                                <tr style="text-align:right;font-weight:bold;white-space: nowrap;overflow: hidden;">   
                                   
                                   <td style="text-align:left">% Disb</td>
                                   <?php
                                        $disb=$totalAmt*4000;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($reportdate,$row->monthlyrate);
                                        $PreGrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFull($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php if($GrantedAmtFull==0){echo 0;}else{ echo number_format((($GrantedAmtFull-$PreGrantedAmtFull)/$disb)*100,0);}?>%</th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php if($disb==0){echo 0;}else{echo number_format(($disb/$disb)*100,2);}?>%</th>                              
                                </tr> 
                           </tbody>
                      </table>
                    </div> 
                    <br/>
                    <p style="margin-top:-15px;font-weight:bold;">4.Disbursement by Interest (Previous and Actual Month)</p>   
                    
                    <div class="col-md-12">
                                 <?php 

                                    if(isset($_GET['datestart4']))
                                            {
                                                $Prereportdate=date("Y-m-d",strtotime($_GET['datestart4']));
                                                $reportdate=date("Y-m-d",strtotime($_GET['dateend4']));
                                            }else
                                            {
                                                $reportdate=date("Y-m-d",strtotime($this->Function_model->getCurrRundate()));
                                                $Prereportdate=date("Y-m-d",strtotime($this->Function_model->GetPreMonthCurrRundate()));
                                            }

                                            $conspancolumfull=$this->DailyCmr_model->getConspanMonthlyrateFull($Prereportdate,$reportdate);
                                            $getInteratFull=$this->DailyCmr_model->getInteratFull($Prereportdate,$reportdate);
                                    ?>   
                                <fieldset class="scheduler-border">
                                  <legend class="scheduler-border">Specific Period:</legend>
                                <form class="form-inline">
                                  
                                      <div class="form-group">
                                       
                                          <label for="exampleInputName2"> From:</label>
                                          <select class="form-control" name="datestart4">
                                          <?php $result=$this->db->query("select 
                                                                    distinct(LAST_DAY(reportdate)) as Reportdate
                                                                    from dis_values
                                                                    where reportdate>'2017-10-31'");
                                                 
                                                     if(isset($_GET["datestart4"]))
                                                     {
                                                    ?>
                                                        <option selected = 'selected'><?php echo date(" d - M - Y ",strtotime($_GET["datestart4"])); ?></option>
                                                <?php
                                                     }else
                                                     {
                                                ?>
                                                        <option selected = 'selected'><?php echo date(" d - M - Y ",strtotime($Prereportdate)); ?></option>
                                                <?php     }
                                                foreach($result->result() as $re){
                                                ?>
                                                            <option><?php echo date(" d - M - Y ",strtotime($re->Reportdate)); ?></option>                   
                                                 <?php 
                                                
                                                }   
                                             ?>                          
                                         </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                        <select class="form-control" name="dateend4">
                                        
                                           
                                           <?php $result=$this->db->query("select 
                                                                    distinct(LAST_DAY(reportdate)) as Reportdate
                                                                    from dis_values
                                                                    where reportdate>'2017-10-31'");
                                                 
                                                if(isset($_GET["datestart4"]))
                                                {
                                                ?>
                                                    <option selected = 'selected'><?php echo date(" d - M - Y ",strtotime($_GET["datestart4"])); ?></option>
                                                <?php
                                                     }else
                                                     {
                                                ?>
                                                        <option selected = 'selected'><?php echo date(" t - M - Y ",strtotime($reportdate)); ?></option>
                                                <?php     }
                                                foreach($result->result() as $re){
                                                ?>
                                                            <option><?php echo date(" d - M - Y ",strtotime($re->Reportdate)); ?></option>                   
                                                 <?php 
                                                }
                                              
                                             ?>    

                                         </select>
                                      </div>
                                      <button type="submit" class="btn btn-primary" style="margin-top:5px;">Search</button>
                                    
                                
                                </form>
                                
                            </fieldset>
                            </div>
                                                  
                            <p id="in" style="text-align:left;margin-left:15px;margin-top:-10px;">Reports Date:
                                
                                    <?php if(isset($_GET['datestart4'])){echo date("t-M-Y",strtotime($_GET['datestart4']));}else{ echo date("t-M-Y",strtotime($Prereportdate));}?>
                                    <span style="margin-left:10px;">
                                        To:<span style="margin-left:10px;"></span>
                                    <?php if(isset($_GET['dateend4'])){echo date("t-M-Y",strtotime($_GET['dateend4']));}else{ echo date("t-M-Y",strtotime($reportdate));}?>
                                    </span>
                                    
                                    
                            </p>

                    <div class="panel-body table-responsive" style="margin-top:-10px;">                        
                       <table class="table table-bordered table-condensed f11 col-md-12">
                        <thead class="active">
                          <tr class="active">
                            <th rowspan="3"><p style="margin-top:-60px;">Duration</p></th> 
                            <th style="text-align:left">Description</th> 
                            <th colspan="<?php echo $conspancolumfull;?>" style="padding:10px 0px 5px 0px;text-align:center">Interest by Type</th>
                            <th rowspan="3"><p style="margin-top:-60px;">Total</p></th> 
                          </tr>
                          <tr class="active">
                                <th style="text-align:left">Monthly Rate</th>
                                <?php
                                    
                                    foreach($getInteratFull as $row){
                                ?>
                                    <th style="text-align:right"><?php echo number_format($row->monthlyrate/12,2);?>%</th>
                                <?php
                                }
                                ?>
                          </tr>
                          <tr class="active">
                                <th style="text-align:left;white-space: nowrap;overflow: hidden;">Yearly Rate</th>
                                <?php
                                    foreach($getInteratFull as $row){
                                ?>
                                    <th style="text-align:right"><?php echo number_format($row->monthlyrate,2);?>%</th>
                                <?php
                                }
                                ?>
                          </tr>

                          </thead>
                           <tbody>                               
                        
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <th rowspan="5"><p id="degre">Previous</p>

                                    <span style="margin-left:10px;color:rgba(70, 70, 70, 0.5);"><small>
                                        <?php if(isset($_GET['datestart4'])){echo date("t-M-Y",strtotime($_GET['datestart4']));}else{ echo date("t-M-Y",strtotime($Prereportdate));}?>
                                    </small></span>
                                    
                                    </th>
                                    <th style="text-align:left">Number of Clients</th>
                                    <?php
                                       $totalClientPre=0;
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($clientmonthlyrateFull,0);$totalClientPre+=$clientmonthlyrateFull;?></th>
                                        
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalClientPre,0);?></th>
                                </tr>
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left">Amt Dis</th>
                                    <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($GrantedAmtFull,0);$totalAmt+=$GrantedAmtFull;?></th>
                                    <?php
                                     }
                                    ?>
                                     <th style="text-align:right"><?php echo number_format($totalAmt,0);?></th>
                                </tr>
                               
                                <tr style="text-align:right;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">   
                                   
                                   <td style="text-align:left">Amt Dis-USD</td>
                                   <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right;white-space: nowrap;overflow: hidden;"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($GrantedAmtFull/4000,2);$totalAmt+=$GrantedAmtFull/4000;?></th>
                                    <?php
                                     }
                                    ?>    
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($totalAmt,2);?></th>                            
                                </tr>                               
                                <tr style="text-align:right;font-weight:bold;">   
                                   
                                   <td style="text-align:left">% Client</td>
                                   <?php
                                       
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format(($clientmonthlyrateFull/$totalClientPre)*100,2);?>%</th>
                                        
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format(($totalClientPre/$totalClientPre)*100,2);?></th>                            
                                </tr>    
                                <tr style="text-align:right;font-weight:bold;">   
                                   
                                   <td style="text-align:left">% Disb</td>
                                  
                                    <?php
                                        $dissum=$totalAmt*4000;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format(($GrantedAmtFull/$dissum)*100,2);?>%</th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format(($dissum/$dissum)*100,2);?></th>                            
                                </tr>    
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <td rowspan="5"><p id="degre">Actual</P>
                                    <span style="margin-left:10px;color:rgba(70, 70, 70, 0.5);"><small>
                                            <?php if(isset($_GET['dateend4'])){echo date("t-M-Y",strtotime($_GET['dateend4']));}else{ echo date("t-M-Y",strtotime($reportdate));}?>
                                    <small></span>
                                    </td>
                                    <th style="text-align:left">Number of Clients</th>
                                    <?php
                                       $totalClient=0;
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($reportdate,$row->monthlyrate);
                                        
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($clientmonthlyrateFull,0);$totalClient+=$clientmonthlyrateFull;?></th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalClient,0);?>
                                </tr>
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left;white-space: nowrap;overflow: hidden;">Amt Dis</th>
                                    <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($reportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($GrantedAmtFull,0);$totalAmt+=$GrantedAmtFull;?></th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalAmt,0);?></th> 
                                </tr>
                               
                                <tr style="text-align:right;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;white-space: nowrap;overflow: hidden;">   
                                   
                                   <td style="text-align:left">Amt Dis-USD</td>
                                   <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($reportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($GrantedAmtFull/4000,2);$totalAmt+=$GrantedAmtFull/4000;?></th>
                                    <?php
                                     }
                                    ?>    
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($totalAmt,2);?></th>                            
                                </tr>                  
                                <tr style="text-align:right;font-weight:bold;">   
                                   
                                <td style="text-align:left">% Client</td>
                                <?php
                                    
                                     foreach($getInteratFull as $row){
                                     $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($reportdate,$row->monthlyrate);
                                 ?>
                                     <th style="text-align:right"><?php echo number_format(($clientmonthlyrateFull/$totalClient)*100,2);?>%</th>
                                     
                                 <?php
                                  }
                                 ?>
                                 <th style="text-align:right"><?php echo number_format(($totalClient/$totalClient)*100,2);?>%</th>                            
                             </tr>    
                             <tr style="text-align:right;font-weight:bold;">   
                                
                                <td style="text-align:left">% Disb</td>
                               
                                 <?php
                                     $dissum=$totalAmt*4000;
                                     foreach($getInteratFull as $row){
                                     $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($reportdate,$row->monthlyrate);
                                 ?>
                                     <th style="text-align:right"><?php echo number_format(($GrantedAmtFull/$dissum)*100,2);?>%</th>
                                 <?php
                                  }
                                 ?>
                                 <th style="text-align:right"><?php echo number_format(($dissum/$dissum)*100,2);?>%</th>                            
                             </tr>   
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                    <td rowspan="5"><p id="degre">Variance</p></td>
                                    <th style="text-align:left">Number of Clients</th>
                                    <?php
                                       $totalClient=0;
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($reportdate,$row->monthlyrate);
                                        $PreclientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($clientmonthlyrateFull-$PreclientmonthlyrateFull,0);$totalClient+=$clientmonthlyrateFull-$PreclientmonthlyrateFull;?></th>
                                    <?php
                                     }
                                    ?>
                                    <th style="text-align:right"><?php echo number_format($totalClient,0);?></th>
                                </tr>
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left">Amt Dis</th>
                                    <?php
                                        $totalAmt=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($reportdate,$row->monthlyrate);
                                        $PreGrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format($GrantedAmtFull-$PreGrantedAmtFull,0);$totalAmt+=$GrantedAmtFull-$PreGrantedAmtFull;?></th>
                                    <?php
                                     }
                                    ?>
                                      <th style="text-align:right"><?php echo number_format($totalAmt,0);?></th>
                                </tr>
                                <tr style="text-align:right;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;white-space: nowrap;overflow: hidden;">   
                                   
                                   <td style="text-align:left">Amt Dis-USD</td>
                                   <?php
                                        $totalAmts=0;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($reportdate,$row->monthlyrate);
                                        $PreGrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format(($GrantedAmtFull-$PreGrantedAmtFull)/4000,2);$totalAmts+=($GrantedAmtFull-$PreGrantedAmtFull)/4000;?></th>
                                    <?php
                                     }
                                    ?>  
                                    <th style="text-align:right"><small class="glyphicon glyphicon-usd" style="margin-right:10px;"></small><?php echo number_format($totalAmts,2);?></th>                              
                                </tr>        
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left">% Client</th>
                                   <?php
                                       
                                        foreach($getInteratFull as $row){
                                        $clientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($reportdate,$row->monthlyrate);
                                        $PreclientmonthlyrateFull=$this->DailyCmr_model->getClientMonthlyrateFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format((($clientmonthlyrateFull-$PreclientmonthlyrateFull)/$totalClient)*100,2);?>%</th>
                                    <?php
                                     }
                                    ?>
                                      <th style="text-align:right"><?php echo number_format(($totalClient/$totalClient)*100,2);?>%</th>
                                </tr>
                                <tr style="text-align:right">   
                                   
                                   <th style="text-align:left">% Disb</th>
                                   <?php
                                        $disbvi=$totalAmts*4000;
                                        foreach($getInteratFull as $row){
                                        $GrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($reportdate,$row->monthlyrate);
                                        $PreGrantedAmtFull=$this->DailyCmr_model->getGrantedAmtFullMonth($Prereportdate,$row->monthlyrate);
                                    ?>
                                        <th style="text-align:right"><?php echo number_format((($GrantedAmtFull-$PreGrantedAmtFull)/$disbvi)*100,2);?>%</th>
                                    <?php
                                     }
                                    ?>
                                      <th style="text-align:right"><?php echo number_format(($disbvi/$disbvi)*100,2);?>%</th>
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
    });
    jqOld(function() {
        jqOld("#dateend4" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#datestart4" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>

<style>
#degre
{
    margin-top:60px;
    font-size:12px;
    
}
</style>

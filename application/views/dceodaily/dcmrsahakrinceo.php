 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id'); 
        $type=$this->session->userdata('types'); 
        if(isset($_GET['datestart']) && isset($_GET['dateend']))
        {
            $reportdate=$_GET['datestart'];
            
        }else
        {
            $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
        }
        
        $res=$this->DailyCmr_model->getdcmrsahakrinpheaceo($reportdate,$type);
?><!-- page content -->
             
        
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
        
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dcmrsahakrinpheaceo');?>" class="active">Summary CMR-Daily</a>
                        <a href="<?= site_url('cmrSummRMCEO');?>">Summary CMR By RM-Daily</a>
                        <?php if($type==3){}else{?>
                            <a href="<?= site_url('daillydisbursebyinterest');?>">Disbursement by Interest-Daily</a>
                        <?php }?>
                        
                        <!--<a href="<?= site_url('dcmrPlanVsResult');?>">Plan Vs Result</a>
                        <a href="<?= site_url('dcmrResultAugVsSep');?>">Result Previous Vs Next</a>
                        <a href="<?= site_url('dcmrResultDailyDisburse');?>">Result-Daily Disburse</a>
                        -->
            </div>
          <div class="">        
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-file" style="padding:10px;"></span>Summary CMR-Daily<small></small></h3>
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
                                               placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo $reportdate;}?>"
                                           value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo $reportdate;}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                                placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo $reportdate;}?>" 
                                                value="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo $reportdate;}?>"
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
                      <div class="col-md-12 nopadding">
                          
                          <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                          <h2 id="in" style="text-align:left;">CREDIT MONITORING REPORT_DAILY</h2>
                          <p id="in" style="text-align:left">Reports Date:
                            <?php if(isset($_GET['datestart'])){echo date("d-M-Y",strtotime($_GET['datestart']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
                            <span style="margin-left:10px;">
                                To:<span style="margin-left:10px;"></span>
                            <?php if(isset($_GET['dateend'])){echo date("d-M-Y",strtotime($_GET['dateend']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
                            </span>
                              
                            
                          </p>
                      </div> 
                       <table class="table table-bordered">
                          <thead class="active">
                          <tr style="background-color:#5aadea;color:#ffffff;white-space: nowrap;overflow: hidden;">
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">No.</th> 
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">INDICATORS</th> 
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">Previous month</th> 
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">Actual</th> 
                            <th style="padding:0px 0px 0px 0px;text-align:center"> Variance</th> 
                          </tr>
                            <tr style="background-color:#5aadea;color:#ffffff;white-space: nowrap;overflow: hidden;"s>
                                
                                <th style="padding:0px 0px 0px 0px;text-align:center">Pre VS Next</th>
                            </tr>
                          </thead>
                           <tbody>
                            <tr style="text-align:center;"  class="active">
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">Currency</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">USD</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">USD</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">USD</td>
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">1.0</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight: bold;">SAHAKRINPHEAP Consolidate</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">2.0</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight: bold;">Total Active Borrower</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right;" style="margin-left:-10px;font-weight:bold;">
                                            <?= number_format($res->TotalActiveBorrowerPre,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right;" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalActiveBorrowerToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right;font-weight: bold;" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format(($res->TotalActiveBorrowerToday)-($res->TotalActiveBorrowerPre),0);?>
                                        </div>
                                     </div>
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">2.1</td>
                                 <td style="padding:3px 0px 0px 5px;">Number Of Active Borrower (New Prod.)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ActiveBorrowerNewPre,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ActiveBorrowerNewToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format(($res->ActiveBorrowerNewToday)-($res->ActiveBorrowerNewPre),0);?>
                                         </div>
                                     </div>
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">2.2</td>
                                 <td style="padding:3px 0px 0px 5px;">Number Of Active Borrower (Existing Prod.)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ActiveBorrowerExistingPre,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ActiveBorrowerExistingToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format(($res->ActiveBorrowerExistingToday-$res->ActiveBorrowerExistingPre),0);?>
                                         </div>
                                     </div>
                                     
                                 </td>   
                            </tr>
                            <tr style="background-color:rgba(255, 196, 0, 0.5);">
                                 <td style="padding:0px 0px 0px 0px;text-align:center">3.0</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">Total Loan Portfolio</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                       <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalLoanPortfolioPre,0)?>
                                                             
                                        </div>
                                      </div>            
                                     <div class="text-right">
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center;">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalLoanPortfolioToday,0);?>
                                         </div>
                                     </div>
                                    </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= (number_format($res->TotalLoanPortfolio,0));?>
                                         </div>
                                     </div>
                                
                                 </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">3.1</td>
                                 <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio - New Prod.</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->LoanPortfolioNewPre,0);?>
                                        </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->LoanPortfolioNewToday,0);?>
                                         </div>
                                     </div>
                                    </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->BalanceofLoanPortfolioNewProd,0));?>
                                         </div>
                                     </div>
                                
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">3.2</td>
                                 <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio -Existing Prod.</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->LoanPortfolioExistingPre,0);?>
                                         </div>
                                     </div>
                                 </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->LoanPortfolioExistingToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->BalanceofLoanPortfolioExsitProd,0));?>
                                         </div>
                                     </div>
                                
                                </td>   
                            </tr>   
                               
                             <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">4.0</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">Balance of Loan Disbursed-Daily </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalDailyDisbursedpreDay,0);?>
                                         </div>
                                     </div>
                                 </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalDailyDisbursedToday,0);?>
                                         </div>
                                     </div>
                                 </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalDailyDisbTotalSum,0);?>
                                         </div>
                                     </div>
                                 </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">4.1</td>
                                 <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - New Prod (Previous Day)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuedisbNewPreDay,0);?>
                                         </div>
                                     </div>
                                 </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuedisbNewToday,0);?>
                                         </div>
                                     </div>
                                 </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->TotalValuedis,0));?>
                                         </div>
                                     </div>
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">4.2</td>
                                 <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - Existing Prod (Previous Day)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuedisbExistingDay,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuedisbExistingToday,0);?>
                                        </div>
                                     </div>
                                 </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->ValuedisbExistingTodayTotal,0));?>
                                        </div>
                                     </div>                           
                                
                                 </td>   
                            </tr>      
                              
                               
                             <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">5.0</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">Balance of LoanRepayment-Daily</td>
                                 <td style="padding:0px 0px 0px 0px;">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalDailyRepayment,0);?>
                                         </div>
                                     </div>
                                 </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= number_format($res->TotalDailyRepaymentToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight: bold;">
                                            <?= (number_format($res->TotalDailyRepaymentTodaySUM,0));?>
                                         </div>
                                     </div>
                                 </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">5.1</td>
                                 <td style="padding:3px 0px 0px 5px;">Repayment-New Prod-Daily (Previous Day)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->DailyRepaymentNewPreDay,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->DailyRepaymentNewToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->DailyRepaymentNewTodayPrvi,0));?>
                                         </div>
                                     </div>
                                 </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">5.2</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">Repayment-Existing Prod-Daily (Previous Day)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->DailyRepaymentExistingPrDay,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->DailyRepaymentExistingToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->DailyRepaymentExistingPrDaySUM,0));?>
                                         </div>
                                     </div>
                                     
                                
                                 </td>   
                            </tr>     
                              
                               
                             <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">6.0</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">Portfolio Quality</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>   
                            </tr>
                            <tr style="background-color:rgba(255, 196, 0, 0.5);">
                                 <td style="padding:0px 0px 0px 0px;text-align:center">6.1</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">PAR Value (1 day)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight:bold;">
                                            <?= number_format($res->ValuePAR1day,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight:bold;">
                                            <?= number_format($res->ValuePAR1dayToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight:bold;">
                                            <?= (number_format($res->ValuePAR1dayTodaySUM,0));?>
                                         </div>
                                     </div>
                                
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">6.1.1</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Value (1 day)-New Prod</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR1dayNew,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR1dayNewToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->ValuePAR1dayNewTodaySUM,0));?>
                                         </div>
                                     </div>
                                
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">6.1.2</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Value (1 day)-Existing Prod</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR1dayExisting,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR1dayExistingToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->ValuePAR1dayExistingTodaySUM,0));?>
                                         </div>
                                     </div>
                                 </td>   
                            </tr>       
                             
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">6.2</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Value (7 days)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR7days,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR7daysToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->ValuePAR7daysTodaySUM,0));?>
                                         </div>
                                     </div>
                                
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">6.3</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Value (30 days)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR30days,0);?>
                                         </div>
                                     </div></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->ValuePAR30daysToday,0);?>
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2">$</div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= (number_format($res->ValuePAR30daysTodaySUM,0));?>
                                         </div>
                                     </div>
                                </td>   
                            </tr>        
                               
                               
                               <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">7.0</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">Portfolio Quality Ratio</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center"></td>   
                            </tr>
                            <tr  >
                                 <td style="padding:0px 0px 0px 0px;text-align:center">7.1</td>
                                 <td style="padding:3px 0px 0px 5px;font-weight:bold;">PAR Ratio (1 day)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight:bold;">
                                            <?= number_format($res->PARRatio1day*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight:bold;">
                                            <?= number_format($res->PARRatio1dayToday*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;font-weight:bold;">
                                            <?= number_format($res->PARRatio1dayTodaySUM*100,2);?>%
                                         </div>
                                     </div>
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">7.1.1</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Ratio (1 day)-New Prod</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                        <?= number_format($res->PARRatio1dayNew*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio1dayNewToday*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format(((number_format($res->PARRatio1dayNewToday,2))-(number_format($res->PARRatio1dayNew,2)))*100,2);?>%
                                         </div>
                                     </div>
                                </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">7.1.2</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Ratio (1 day)-Existing Prod</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio1dayExisting*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio1dayExistingToday*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio1dayExistingTodaySUM*100,2);?>%
                                         </div>
                                     </div>
                                
                                </td>   
                            </tr>       
                             
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">7.2</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Ratio (7 days)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio7days*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio7daysToday,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio7daysSUM,2);?>%
                                         </div>
                                     </div>
                                
                                 </td>   
                            </tr>
                            <tr>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">7.3</td>
                                 <td style="padding:3px 0px 0px 5px;">PAR Ratio (30 days)</td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            
                                            <?= number_format($res->PARRatio30days*100,2);?>%
                                         </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio30daysToday,2);?> %
                                        </div>
                                     </div>
                                </td>
                                 <td style="padding:0px 0px 0px 0px;text-align:center">

                                     <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10 text-right" style="margin-left:-10px;">
                                            <?= number_format($res->PARRatio30daysSUM,2);?>%
                                        </div>
                                     </div>
                                     
                                </td>   
                            </tr>     
                           </tbody>
                      </table>
                        
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
    padding: 0 1em 1em 1em !important;
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
        width:70%;
        
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
           window.location.href = '<?php echo site_url("dcmrsahakrinpheaceo");?>'; 
          
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
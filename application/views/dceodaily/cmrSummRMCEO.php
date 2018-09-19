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
        
?><!-- page content -->
               
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
          <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>  
         <!-- Include Required Prerequisites -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        
        
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dcmrsahakrinpheaceo');?>" >Summary CMR-Daily</a>
                        <a href="<?= site_url('cmrSummRMCEO');?>" class="active">Summary CMR By RM-Daily</a>
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
              <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="dashboard_graph x_panel">
                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-file" style="padding:10px;"></span>Summary CMR By RM-Daily <small></small></h3>
                    </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                     <div class="col-md-12">
                                         
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                                    <span style="margin-left:5px;">PRINT</span></button>  
                                                <p></p>
                                        </div>  
                        </div>
                       <div class="col-md-12 nopadding">
                            
                             <div class="col-md-12 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border" style="width:80%;">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">By RM:</label>
                                         <select class="form-control" data-show-subtext="true" data-live-search="true" name="rmvalues">
                                                
                                                <?= $bra=$this->DailyCmr_model->GetRMname();
                                                  foreach($bra as $row){?>
                                                  <option value="<?= $row->rid;?>"><?= $row->name;?></option>
                                                <?php }?>
                                                <option data-subtext="Select RM" value="0000">All RM</option>
                                               
                                              </select>
                                      </div> 
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
                                                placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['datestart'];}else{ echo $reportdate;}?>" 
                                                value="<?php if(isset($_GET['dateend'])){echo $_GET['datestart'];}else{ echo $reportdate;}?>"
                                                readonly="true" style="background:white;">
                                      </div> 
                                     
                                     <button type="submit" class="btn btn-primary" style="margin-top:5px;"><span style="margin-left:5px;">Search</span></button>
                                    </fieldset>
                                </form>
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
                            <?php if(isset($_GET['dateend'])){echo date("d-M-Y",strtotime($_GET['datestart']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
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
                            <tr style="background-color:#5aadea;color:#ffffff;white-space: nowrap;overflow: hidden;">                                
                                <th style="padding:0px 0px 0px 0px;text-align:center">Pre-Month VS Actual</th>
                            </tr>
                          </thead>
                           <tbody>
                            <?php 
                               $i=1;
                               $a=0;
                               if($type==3)
                               {
                                $rmvalues=2;
                               }else
                               {
                                $rmvalues=1;
                               }
                               
                                
                               if(isset($_GET['rmvalues']))
                                {
                                if($_GET['rmvalues']=="0000"){
                                      $bra=$this->DailyCmr_model->GetRMname();
                                      
                                       foreach($bra as $rm){                                           
                                        $res=$this->DailyCmr_model->getcmrsummRMCEO($rm->rid,$reportdate,$type);
                                       foreach($res as $row){  
                                
                                $i=$a++;
                             ?>
                                    <tr class="active">
                                         <td style="padding:3px 0px 0px 3px;text-align:center;font-weight:bold;font-size:16px;"><?= $a;?></td>
                                         <td style="padding:3px 0px 0px 3px;font-weight:bold;font-size:16px;"><?= $rm->name;?></td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                    </tr>

                                    <tr style="background-color:rgba(255, 196, 0, 0.5);">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.1</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower</td>
                                         <td style=s"padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalActiveBorrowerPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalActiveBorrowerToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                       <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalActiveBorrowerToday)-($row->TotalActiveBorrowerPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.2</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (New Prod.)</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                              <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerNewPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ActiveBorrowerNewToday)-($row->ActiveBorrowerNewPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.3</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (Existing Prod.)</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerExistingPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ActiveBorrowerExistingToday)-($row->ActiveBorrowerExistingPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.4</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalLoanPortfolioPre,0);?>
                                                 </div>
                                             </div>
                                             
                                         </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalLoanPortfolioToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalLoanPortfolioToday)-($row->TotalLoanPortfolioPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.5</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio - New Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioNewPre,0);?>
                                                 </div>
                                             </div>
                                         </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->LoanPortfolioNewToday)-($row->LoanPortfolioNewPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.6</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio -Existing Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioExistingPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->LoanPortfolioExistingToday)-($row->LoanPortfolioExistingPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>   

                               
                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.7</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of loan Disbursed in month</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalDailyDisbursedpreDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalDailyDisbursedToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalDailyDisbursedToday)-($row->TotalDailyDisbursedpreDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.8</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - New Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbNewPreDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuedisbNewToday)-($row->ValuedisbNewPreDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.9</td>
                                         <td style="padding:3px 0px 0px 5px;">Banace of Disbursed - Existing Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbExistingDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuedisbExistingToday)-($row->ValuedisbExistingDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>      




                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.10</td>
                                         <td style="padding:3px 0px 0px 5px;">Portfolio Quality</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                    </tr>
                                    <tr   class="warning">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.11</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR Ratio(1 day)%</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PARRatio1day*100,2);?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PARRatio1dayToday*100,2);?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->PARRatio1dayToday*100)-($row->PARRatio1day*100),2);?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.12</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR(1 day) $</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuePAR1day,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuePAR1dayToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuePAR1dayToday)-($row->ValuePAR1day),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                           <?php }}}else{
                                   
                                    
                                   
                                    if($_GET['rmvalues']>=0)
                                   {
                                       $rmvalues=$_GET['rmvalues'];
                                  
                                       $res=$this->DailyCmr_model->getcmrsummRMCEO($rmvalues,$reportdate,$type);
                                        
                                   }else
                                    {
                                    if($type==3)
                                    {
                                        $rmvalues=2;
                                    }
                                    else{
                                        $rmvalues=1;
                                    }
                                    $res=$this->DailyCmr_model->getcmrsummRMCEO($rmvalues,$reportdate,$type);
                                    }
                                    
                                    foreach($res as $row){  
                                
                                    $i=$a++;   
                               
                            ?>
                                     <tr class="info">
                                         <td style="padding:3px 0px 0px 3px;text-align:center;font-weight:bold;font-size:16px;"><?= $a;?></td>
                                         <td style="padding:3px 0px 0px 3px;font-weight:bold;font-size:16px;"><?= $row->name;?></td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                    </tr>

                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.1</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalActiveBorrowerPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalActiveBorrowerToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                       <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalActiveBorrowerToday)-($row->TotalActiveBorrowerPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.2</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (New Prod.)</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                              <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerNewPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ActiveBorrowerNewToday)-($row->ActiveBorrowerNewPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.3</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (Existing Prod.)</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerExistingPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ActiveBorrowerExistingToday)-($row->ActiveBorrowerExistingPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.4</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalLoanPortfolioPre,0);?>
                                                 </div>
                                             </div>
                                             
                                         </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalLoanPortfolioToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalLoanPortfolioToday)-($row->TotalLoanPortfolioPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.5</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio - New Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioNewPre,0);?>
                                                 </div>
                                             </div>
                                         </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->LoanPortfolioNewToday)-($row->LoanPortfolioNewPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.6</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio -Existing Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioExistingPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->LoanPortfolioExistingToday)-($row->LoanPortfolioExistingPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>   

                               
                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.7</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed in month</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalDailyDisbursedpreDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalDailyDisbursedToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalDailyDisbursedToday)-($row->TotalDailyDisbursedpreDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.8</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - New Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbNewPreDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuedisbNewToday)-($row->ValuedisbNewPreDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.9</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance disbursed - Existing Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbExistingDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuedisbExistingToday)-($row->ValuedisbExistingDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>      




                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.10</td>
                                         <td style="padding:3px 0px 0px 5px;">Portfolio Quality</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                    </tr>
                                    <tr   class="warning">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.11</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR Ratio(1 day)%</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PARRatio1day*100,2);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PARRatio1dayToday*100,2);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->PARRatio1dayToday*100)-($row->PARRatio1day*100),2);?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.12</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR(1 day) $</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuePAR1day,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuePAR1dayToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuePAR1dayToday)-($row->ValuePAR1day),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                               
                            <?php }}}else{
                              
                                    if($type==3)
                                    {
                                        $rmvalues=2;
                                    }else
                                    {
                                        $rmvalues=1;
                                    }
                                    
                                    $res=$this->DailyCmr_model->getcmrsummRMCEO($rmvalues,$reportdate,$type);
                                    
            
                                    foreach($res as $row){  
                                
                                    $i=$a++;   
                               
                            ?>
                                    <tr class="info">
                                         <td style="padding:3px 0px 0px 3px;text-align:center;font-weight:bold;font-size:16px;"><?= $a;?></td>
                                         <td style="padding:3px 0px 0px 3px;font-weight:bold;font-size:16px;"><?= $row->name;?></td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                    </tr>

                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.1</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalActiveBorrowerPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalActiveBorrowerToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                       <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalActiveBorrowerToday)-($row->TotalActiveBorrowerPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.2</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (New Prod.)</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                              <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerNewPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ActiveBorrowerNewToday)-($row->ActiveBorrowerNewPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.3</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (Existing Prod.)</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerExistingPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ActiveBorrowerExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ActiveBorrowerExistingToday)-($row->ActiveBorrowerExistingPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.4</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalLoanPortfolioPre,0);?>
                                                 </div>
                                             </div>
                                             
                                         </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalLoanPortfolioToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalLoanPortfolioToday)-($row->TotalLoanPortfolioPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.5</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio - New Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioNewPre,0);?>
                                                 </div>
                                             </div>
                                         </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->LoanPortfolioNewToday)-($row->LoanPortfolioNewPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.6</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio -Existing Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioExistingPre,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->LoanPortfolioExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->LoanPortfolioExistingToday)-($row->LoanPortfolioExistingPre),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>   

                               
                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.7</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed in month</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalDailyDisbursedpreDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->TotalDailyDisbursedToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->TotalDailyDisbursedToday)-($row->TotalDailyDisbursedpreDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.8</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - New Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbNewPreDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbNewToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuedisbNewToday)-($row->ValuedisbNewPreDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.9</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - Existing Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbExistingDay,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuedisbExistingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuedisbExistingToday)-($row->ValuedisbExistingDay),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>      




                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.10</td>
                                         <td style="padding:3px 0px 0px 5px;">Portfolio Quality</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                    </tr>
                                    <tr   class="warning">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.11</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR Ratio(1 day)%</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PARRatio1day*100,2);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PARRatio1dayToday*100,2);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->PARRatio1dayToday*100)-($row->PARRatio1day*100),2);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.12</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR(1 day) $</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuePAR1day,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->ValuePAR1dayToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->ValuePAR1dayToday)-($row->ValuePAR1day),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <?php }}?>
                               
                                <?php 
                                $summ=$this->DailyCmr_model->getsumary($reportdate,$type);
                                foreach($summ as $summary){
                               ?>
                            <tr class="success">
                                    
                                    <td style="padding:3px 0px 0px 5px;" colspan="5">I. SUMMARY</td>
                                         
                                </tr>
                                <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">Active Client</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->ActiveClientPrv,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->ActiveClientTODAY,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($summary->ActiveClientTODAY-$summary->ActiveClientPrv,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">Outstanding</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->OutstandingPrv,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->OutstandingToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($summary->OutstandingToday-$summary->OutstandingPrv,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">PAR 1day</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->PAR1dayPrv,0);?> 
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->PAR1dayActual,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($summary->PAR1dayActual-$summary->PAR1dayPrv,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">Monthly Disburse</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->MonthlyDisbursePrv,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->MonthlyDisburseToday,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                     <?= number_format($summary->MonthlyDisburseTotal,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">PAR 1day %</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->PAR1dayRatioPrv*100,2);?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($summary->PAR1dayRatioToday*100,2);?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($summary->PAR1dayRatioToday*100-$summary->PAR1dayRatioPrv*100,2);?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                              <?php }?>
                              
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
        width:75%;
        
    }
    .nopadding {
    padding: 0 !important;
    margin: 0 !important;
    }
 </style>
   <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <style>#in{text-align: left;}</style>
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
            window.location.href="<?= site_url("cmrSummRMCEO");?>";
          
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
    })
</script>
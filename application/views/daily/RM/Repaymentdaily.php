
        <script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css"> 
        <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailyrm/activeBorrower');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('dailyrm/loanPortfolio');?>">Loan Portfolio</a>
                        <a href="<?= site_url('dailyrm/loanDisbInMonth');?>" >Loan Disbursement</a>
                        <a href="<?= site_url('dailyrm/writtenoff');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('dailyrm/repaymentinmonth');?>" class="active">Loan Repayment</a>
         </div>
          <div class="">  
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="dashboard_graph x_panel">
                <div class="container">                  
                  <ul class="nav nav-tabs">
                    <li><a href="<?= site_url('dailyrm/repaymentinmonth');?>">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Repayment In Month</a></li>                 
                    
                    <li class="active"><a href="<?= site_url('dailyrm/repaymentdaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Repayment-Daily
                        </a></li>
                        <li><a href="<?= site_url('dailyrm/PortfolioQualitybyProductDaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Quality by Product-Daily
                        </a></li>
                        <li><a href="<?= site_url('dailyrm/PortfolioQualtiyRationsDaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Qualtiy Ratios-Daily
                        </a></li>
                      
                  </ul>

                      <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                           <br/>
                            <div class="row nopadding">
                             <div class="col-md-12 nopadding">
                                <form class="form-inline" action="<?php echo site_url('dailyrm/repaymentdaily');?>" method="POST">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific ReportDate:</legend>
                                     <div class="form-group"> 
                                       <!-- check user muilt branch -->
                                       
                                        <label for="exampleInputName2">Filter by Branch:</label>
                                          <select class="form-control" id="branchname" name="brname">
                                            <option value=''>Select Branch</option>
                                            <?php foreach($brlist as $row){
                                                  if(isset($brname)){?>
                                                  <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                                  <?php }else{?>
                                                  <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                                <?php }}?>
                                            <option value="All">All</option>
                                          </select>                                        
                                          
                                        </div>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                                      </div>  
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">To:</label>
                                          <input type="text" id="dateend" class="form-control" name="dateend" id="exampleInputName2"
                                               placeholder="<?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                                      </div>                                    
                                      <button type="submit" class="btn btn-primary" style="margin-top:5px;" id='search'>
                                      <span class="glyphicon glyphicon-refresh"></span> <span>Search</span></button>
                                      
                                      <button type="button" style="margin-top:5px;" class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                            <span>PRINT</span></button>
                                      <button type="button" class="btn btn-success" style="margin-top:5px;" id="DownloadExcel">
                                      <span class="glyphicon glyphicon-cloud-download"></span>
                                      <span>Download Excel</span></button>
                                    </fieldset>  
                                 
                                </form>
                              </div>                               
                             </div>
                            <br/>
                            <br/>
                       
                        <div id="reports" class="panel-body table-responsive">                     
                        <table class="table table-bordered table-condensed f11">
                          <thead>
                            <tr style="text-align:center;boder;">
                              <th style="boder;border-bottom:3pt solid #22d4ae;text-align:center;padding:10px 0px 25px 0px;white-space: nowrap;overflow: hidden;" rowspan="2">CO-Name</th>
                              <th style="boder;border-bottom:3pt solid #22d4ae;text-align:center;padding:10px 0px 25px 0px"  rowspan="2">Granted Total</th>
                              <th colspan="5" style="text-align:center;">Existing Product Repayment</th>
                              <th colspan="7" style="text-align:center;">New Product Repayment</th>                             
                            </tr>

                            <tr style="text-align:center;white-space: nowrap;overflow: hidden;boder;border-bottom:3pt solid #22d4ae;">
                              <th> Total Balance</th>
                              <th> Principle</th>
                              <th> Interest</th>    
                              <th> Penalty</th> 
                              <th> Admin Fee </th> 
                              <th> Total Balance</th>
                              <th> Principle</th>
                              <th> Interest</th>    
                              <th> Penalty</th> 
                              <th> Admin Fee </th>
                              <th style="text-align:center;">BrName</th>
                              <th style="text-align:center;">BrCode</th>
                            </tr>
                            <?php 
                                $TotalBalance=0;
                                $TotalBalanceNew=0;
                                $Total=0;
                                $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $AdminFee1=0;

                                foreach($Repayment as $re){?>
                            <tr>
                                <td style="text-align:left;white-space: nowrap;overflow: hidden;"><?= $re->CoName;?></td>
                                <td style="text-align:right"><?= number_format($re->Principle+$re->Interest+$re->Penalty+$re->AdminFee+$re->Principle1+$re->Interest1+$re->Penalty1+$re->AdminFee1,0);$Total+=$re->Principle+$re->Interest+$re->Penalty+$re->AdminFee+$re->Principle1+$re->Interest1+$re->Penalty1+$re->AdminFee1;?></td>
                                <td style="text-align:right"><?= number_format($re->Principle+$re->Interest+$re->Penalty+$re->AdminFee,0);$TotalBalance+=$re->Principle+$re->Interest+$re->Penalty+$re->AdminFee;?></td>
                                <td style="text-align:right"><?= number_format($re->Principle,0);$Principle+=$re->Principle;?></td>
                                <td style="text-align:right"><?= number_format($re->Interest,0);$Interest+=$re->Interest;?></td>
                                <td style="text-align:right"><?= number_format($re->Penalty,0);$Penalty+=$re->Penalty;?></td>
                                <td style="text-align:right"><?= number_format($re->AdminFee,0);$AdminFee+=$re->AdminFee;?></td>
                                <td style="text-align:right"><?= number_format($re->Principle1+$re->Interest1+$re->Penalty1+$re->AdminFee1,0);$TotalBalanceNew+=$re->Principle1+$re->Interest1+$re->Penalty1+$re->AdminFee1;?></td>
                                <td style="text-align:right"><?= number_format($re->Principle1,0);$Principle1+=$re->Principle1;?></td>
                                <td style="text-align:right"><?= number_format($re->Interest1,0);$Interest1+=$re->Interest1;?></td>
                                <td style="text-align:right"><?= number_format($re->Penalty1,0);$Penalty1=$re->Penalty1;?></td>
                                <td style="text-align:right"><?= number_format($re->AdminFee1,0);$AdminFee1+=$re->AdminFee1;?></td>                               
                                <td style="text-align:center;"><?= $re->shortcode;?></td>
                                <td style="text-align:center;"><?= $re->brcode;?></td>
                            </tr>
                            <?php }?>
                            <tr class="active"> 
                                <td style="text-align:right">Total:</td>
                                <td style="text-align:right"><?= $Total;?></td>
                                <td style="text-align:right"><?= number_format($TotalBalance,0);?></td>
                                <td style="text-align:right"><?= number_format($Principle,0);?></td>
                                <td style="text-align:right"><?= number_format($Interest,0);?></td>
                                <td style="text-align:right"><?= number_format($Penalty,0);?></td>
                                <td style="text-align:right"><?= number_format($AdminFee,0);?></td>
                                <td style="text-align:right"><?= number_format($TotalBalanceNew,0);?></td>
                                <td style="text-align:right"><?= number_format($Principle1,0);?></td>
                                <td style="text-align:right"><?= number_format($Interest1,0);?></td>
                                <td style="text-align:right"><?= number_format($Penalty1,0);?></td>
                                <td style="text-align:right"><?= number_format($AdminFee1,0);?></td>                               
                                <td style="text-align:center;" colspan="2"></td>
                                
                            </tr>
                            <tr class="info"> 
                                <td style="text-align:right">Total USD:</td>
                                <td style="text-align:right">$ <?=  number_format($Total/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($TotalBalance/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($Principle/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($Interest/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($Penalty/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($AdminFee/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($TotalBalanceNew/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($Principle1/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($Interest1/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($Penalty1/4000,0);?></td>
                                <td style="text-align:right">$ <?= number_format($AdminFee1/4000,0);?></td>                               
                                <td style="text-align:center;" colspan="2"></td>
                                
                            </tr>
                          </thead> 
                                                  
                        </table>
                        
                        </div>   
                        </div>                        
                      </div>
                  </div>
                </div>
                  
               </div>
                  
              </div>
        </div>
        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="<?php echo base_url();?>/public/RM/repaymentdaily.js"></script> 
        <script>
            var jqOld = jQuery.noConflict();
            jqOld(function() {
                jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
            });
            jqOld(function() {
                jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
            })
           
        </script>
        <!-- /page content -->  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
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
            window.location.href="<?= site_url("repaymentinmonth");?>";
          
        }
    </script>
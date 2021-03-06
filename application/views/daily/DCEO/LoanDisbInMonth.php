        <script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css">     
        <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailydceo/activeBorrower');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('dailydceo/loanPortfolio');?>">Loan Portfolio</a>
                        <a href="<?= site_url('dailydceo/loanDisbInMonth');?>" class="active">Loan Disbursement</a>
                        <a href="<?= site_url('dailydceo/writtenoff');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('dailydceo/repaymentinmonth');?>">Loan Repayment</a>
         </div>
          <div class="">  
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="dashboard_graph x_panel">
                <div class="container">                  
                  <ul class="nav nav-tabs">
                  <li class="active">
                        <a href="<?= site_url('dailydceo/loanDisbInMonth');?>">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Loans disbursement in Month</a></li>
                                    
                     <li><a href="<?= site_url('dailydceo/loanDisbDaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                         Loans Disbursement-Daily
                        </a></li>
                      
                  </ul>

                      <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                         <br/>
                         <div class="row nopadding">
                          <div class="col-md-12 nopadding">
                                  <form class="form-inline" action="<?php echo site_url('dailydceo/loanDisbInMonth');?>" method="POST">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific ReportDate:</legend>
                                     <div class="form-group"> 
                                       <!-- check user muilt branch -->
                                      
                                        <label for="exampleInputName2">Filter by:</label>
                                          <select class="form-control" id="systemid" name="systemid">
                                            <option value=''>Select RMName</option>
                                            <?php foreach($controlbyrm as $row){
                                                  if(isset($sid)){?>
                                                  <option value="<?php echo $row->sid;?>" <?php if($row->sid==$sid){ echo  'selected';}?>><?php echo $row->name;?></option>
                                                  <?php }else{?>
                                                  <option value="<?php echo $row->sid;?>"><?php echo $row->name;?></option>
                                                <?php }}?>
                                            <option value="All">All</option>
                                          </select>                                        
                                          <!-- <label for="exampleInputName2">Filter by Co:</label> -->
                                           <!-- Check User Single Branch -->
                                        </div>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">ReportDate:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
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
                         </div>
                        <br/>
                        <div id="reports">    
                        <table id="datatable-buttons2" class="table table-striped table-bordered">
                          <thead style="boder;border-bottom:3pt solid #22d4ae;">
                            <tr>
                              <th>ID</th>
                              <th style="text-align:center">BrName</th>   
                              <th style="text-align:center">BrCode</th>
                              <th style="text-align:center">Total Loan Disbursement</th>
                              <th>Balance of loan Disbursement</th>
                              <th>Product Name</th>   
                                                     
                            </tr>
                          </thead>    
                          <tbody>
                              <?php
                                $i=1;
                                $TotalAcc=0;
                                $TotalBalamt=0;  
                                foreach($loanDisbInMonth as $re){?>
                              <tr>
                                  <td><?= $i++;?></td>
                                  <td style="text-align:center"><?= $re->shortcode;?></td>
                                  <td style="text-align:center"><?= $re->brcode;?></td>
                                  <td style="text-align:center"><?= $re->DisbAccMonth;$TotalAcc+=$re->DisbAccMonth;?></td>       
                                  <td style="text-align:right"><?= number_format($re->DisbAmtMonth,0);$TotalBalamt+=$re->DisbAmtMonth;?></td>
                                  <td><?= $re->PrName;?></td>
                                 
                              </tr>
                              <?php }?>
                          </tbody>     
                                <tr>
                                  <td colspan="3" style="text-align:right">Total:</td>                                  
                                  <td style="text-align:center"><?= $TotalAcc;?></td>       
                                  <td style="text-align:right"><?= number_format($TotalBalamt,0);?></td> 
                                  <td colspan="2"></td>                                 
                                </tr>    
                                <tr>
                                  <td colspan="3" style="text-align:right">Total USD:</td>                                  
                                  <td style="text-align:center"><?= $TotalAcc;?></td>       
                                  <td style="text-align:right">$ <?= number_format($TotalBalamt/4000,0);?></td> 
                                  <td colspan="2"></td>                                 
                                </tr>              
                        </table>
                            <!-- <div class="pull-right">
                                <div style="margin-top: 25px;margin-bottom: -12px;">
                                    <label>Total <span class="label label-default"><?= $total_rows; ?></span>records</label>
                                </div>  
                                <br/>
                                <?php echo $this->pagination->create_links(); ?>
                            </div>   -->
                        </div>                         
                    </div>        
         <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="<?php echo base_url();?>/public/DCEO/loandisb.js"></script>  
        <script>
            var jqOld = jQuery.noConflict();
            jqOld(function() {
                jqOld("#dateend" ).datepicker(
                    { dateFormat: 'yy-mm-dd' }
                );
            });
            jqOld(function() {
                jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
            })          
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <!-- /page content -->

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
            window.location.href="<?= site_url("dailydceo/loanDisbInMonth");?>";
          
        }
    </script>
    

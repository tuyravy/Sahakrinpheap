          <script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
          <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css">
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailydceo/activeBorrower');?>" class="active">Loan Active Borrower</a>
                        <a href="<?= site_url('dailydceo/loanPortfolio');?>">Loan Portfolio</a>
                        <a href="<?= site_url('dailydceo/loanDisbInMonth');?>">Loan Disbursement</a>
                        <a href="<?= site_url('dailydceo/writtenoff');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('dailydceo/repaymentinmonth');?>">Loan Repayment</a>
            </div>
            <div class="">        
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">                
                  <div class="row x_title">
                    <div class="col-md-6">
                    <span class="glyphicon glyphicon-use"></span>Active Borrower by Product Type
                    </div>                    
                  </div>
                  <style>
                  fieldset
                  {
                      width:100% !important;                      
                  }
                  </style>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto">
                         <div class="row nopadding">
                             <div class="col-md-12 nopadding">
                                <form class="form-inline" action="<?php echo site_url('dailydceo/activeBorrower');?>" method="POST">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific ReportDate:</legend>
                                     <div class="form-group"> 
                                       <!-- check user muilt branch -->
                                      
                                        <label for="exampleInputName2">Filter by:</label>
                                          <select class="form-control" id="systemid" name="systemid">
                                            <option value=''><<  Select RMName  >></option>
                                            <?php foreach($controlbyrm as $row){
                                                  if(isset($systemid)){?>
                                                  <option value="<?php echo $row->sid;?>" <?php if($row->sid==$systemid){ echo  'selected';}?>><?php echo $row->name;?></option>
                                                  <?php }else{?>
                                                  <option value="<?php echo $row->sid;?>"><?php echo $row->name;?></option>
                                                <?php }}?>
                                            <option value="All">All</option>
                                          </select>                                       
                                         
                                      </div>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">ReportDate:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($datestart)){echo $datestart;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($datestart)){echo $datestart;}else{ echo date('Y-m-d');}?>"
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
                        <div id="reports">                      
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead style="boder;border-bottom:3pt solid #22d4ae;">
                            <tr>
                              <th style="text-align:center">ID</th>
                              <th style="text-align:center">BrCode</th>
                              <th style="text-align:center">BrName</th>
                              <th style="text-align:center">Total Acc</th>                              
                              <th>Product Name</th>                    
                            </tr>
                          </thead>
                          <tbody>
                           <?php 
                           $totalAcc=0;
                           $i=1;
                           foreach($LoanActivebyProduct as $re){?>
                            <tr>
                              <td style="text-align:center"><?php echo $i++;?></td>
                              <td style="text-align:center"><?php echo $re->brcode;?></td>
                              <td style="text-align:center"><?php echo $re->shortcode;?></td>
                              <td style="text-align:center"><?php echo $re->Acc;$totalAcc+=$re->Acc;?></td>                              
                              <td><?php echo $re->PrName;?></td>
                            </tr>
                           <?php }?>
                           <tr>
                              <td colspan='3' style="text-align:right">Total:</td>                              
                              <td style="text-align:center;"><?php echo $totalAcc;?></td>       
                              <td colspan='3'></td>                     
                            </tr>
                          </tbody>                          
                        </table>  
                       
                      </div>  
                    </div>                      
                  </div>                    
                </div>                  
              </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>  
            <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
            <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
            <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <script src="<?php echo base_url();?>/public/DCEO/app.js"></script>           
            <script language="javascript" type="text/javascript">
                        var jqOld = jQuery.noConflict();
                            jqOld(function() {
                                jqOld("#dateend" ).datepicker();
                            });
                            jqOld(function() {
                                jqOld("#datestart" ).datepicker();
                        })
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
                            window.location.href="<?= site_url("dailyrm/activeBorrower");?>";
                          
                        }
              </script>
              
   

              

  

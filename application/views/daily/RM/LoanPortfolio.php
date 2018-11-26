      <script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
      <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css">
      <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailyrm/activeBorrower');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('dailyrm/loanPortfolio');?>" class="active">Loan Portfolio</a>
                        <a href="<?= site_url('dailyrm/loanDisbInMonth');?>">Loan Disbursement</a>
                        <a href="<?= site_url('dailyrm/writtenoff');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('dailyrm/repaymentinmonth');?>">Loan Repayment</a>
        </div>
        <div class="">        
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                    <div class="col-md-6">
                      Loan Portfolio by Product Type<small></small>
                    </div>                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto">
                         <div class="row nopadding">
                          <div class="col-md-12 nopadding">
                                  <form class="form-inline" action="<?php echo site_url('dailyrm/loanPortfolio');?>" method="POST">
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
                        <table id="datatable-buttons" class="table table-bordered">
                          <thead style="boder;border-bottom:3pt solid #22d4ae;">
                          <tr>
                              <th style="text-align:center">IDCO</th>
                              <th style="text-align:left">CO-Name</th>
                              <th style="text-align:center">Total BalAmt</th>                              
                              <th>Product Name</th>   
                              <th style="text-align:center">BrName</th>
                              <th style="text-align:center">BrCode</th>                           
                            </tr>
                          </thead>  
                          <tbody>
                           <?php $toalbalamt=0;foreach($LoanActivebyProduct as $re){?>
                            <tr>
                              <td style="text-align:center"><?php echo $re->IdCo;?></td>
                              <td style="text-align:left"><?php echo $re->CoName;?></td>
                              <td style="text-align:right"><?php echo number_format($re->BalAmt,0);$toalbalamt+=$re->BalAmt;?></td>
                              <td style="text-align:left"><?php echo $re->PrName;?></td>
                              <td style="text-align:center"><?php echo $re->shortcode;?></td>
                              <td style="text-align:center"><?php echo $re->brcode;?></td>
                            </tr>
                           <?php }?>
                          </tbody>  
                          <tr>
                          <td style="text-align:right" colspan='2'>Total:</td>                           
                              <td style="text-align:right"><?php echo number_format($toalbalamt,0);?></td>
                              <td style="text-align:left" colspan='3'></td>
                          </tr>     
                          <td style="text-align:right" colspan='2'>Total USD:</td>                           
                              <td style="text-align:right">$ <?php echo number_format($toalbalamt/4000,0);?></td>
                              <td style="text-align:left" colspan='3'></td>
                          </tr>                       
                        </table>
                        <!-- <div class="pull-right">
                          <div style="margin-top: 25px;margin-bottom: -12px;">
                              <label>Total <span class="label label-default"><?= $total_rows; ?></span>records</label>
                          </div>  
                          <br/>
                          <?php echo $this->pagination->create_links(); ?>
                        </div>  -->
                     </div>   
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
<script src="<?php echo base_url();?>/public/RM/loanportfolio.js"></script>   
<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#dateend" ).datepicker();
    });
    jqOld(function() {
        jqOld("#datestart" ).datepicker();
    })
</script>
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
            window.location.href="<?= site_url("loanPortfolio");?>";
          
        }
    </script>

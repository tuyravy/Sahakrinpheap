        <script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css"> 
        <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('daily/activeBorrower');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('daily/loanPortfolio');?>">Loan Portfolio</a>
                        <a href="<?= site_url('daily/loanDisbInMonth');?>" >Loan Disbursement</a>
                        <a href="<?= site_url('daily/writtenoff');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('daily/repaymentinmonth');?>" class="active">Loan Repayment</a>
         </div>
          <div class="">  
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="dashboard_graph x_panel">
                <div class="container">                  
                  <ul class="nav nav-tabs">
                    <li><a href="<?= site_url('daily/repaymentinmonth');?>">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Repayment In Month</a></li>                 
                    
                    <li><a href="<?= site_url('daily/repaymentdaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Repayment-Daily
                        </a></li>
                    <li class="active"><a href="<?= site_url('daily/PortfolioQualitybyProductDaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Quality by Product-Daily
                        </a></li>
                        <li><a href="<?= site_url('daily/PortfolioQualtiyRationsDaily');?>">
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
                             <form class="form-inline" action="<?php echo site_url('daily/PortfolioQualitybyProductDaily');?>" method="POST">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific ReportDate:</legend>
                                     <div class="form-group"> 
                                       <!-- check user muilt branch -->
                                       <?php if($types==2){?>
                                        <label for="exampleInputName2">Filter by Branch:</label>
                                          <select class="form-control" id="branchname" name="brname">
                                            <option value=''><< Select Branch >></option>
                                            <?php foreach($brlist as $row){
                                                  if(isset($brname)){?>
                                                  <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                                  <?php }else{?>
                                                  <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                                <?php }}?>
                                            <option value="All">All</option>
                                          </select>                                        
                                          <!-- <label for="exampleInputName2">Filter by Co:</label> -->
                                          <select class="form-control" id="CoName" name="coname">
                                            <option value=''><< Select Co-Name >></option>    
                                            <?php foreach($CoName as $row){
                                                  if(isset($idCo)){?>                                                                              
                                                  <option value="<?php echo $row->IdCo;?>" <?php if($row->IdCo==$idCo){ echo  'selected';}?>><?php echo $row->CoName;?></option>
                                                  <?php }else{?>
                                                    <option value="<?php echo $row->IdCo;?>"><?php echo $row->CoName;?></option>
                                                <?php }}?>
                                                <option value="All">All</option>                                     
                                          </select>  
                                           <!-- Check User Single Branch -->
                                          <?php }else{?>
                                            <label for="exampleInputName2">Filter by Co:</label>
                                            <input type="hidden" value="<?php echo $this->session->userdata('branch_code');?>" id="brcode">                                              
                                              <select class="form-control CoNameSingle" name="coname">  
                                                
                                                <option value=''><< Select Co-Name >></option>                                               
                                                <?php foreach($CoName as $row){
                                                  if(isset($idCo)){?>                                                                              
                                                  <option value="<?php echo $row->IdCo;?>" <?php if($row->IdCo==$idCo){ echo  'selected';}?>><?php echo $row->CoName;?></option>
                                                  <?php }else{?>
                                                    <option value="<?php echo $row->IdCo;?>"><?php echo $row->CoName;?></option>
                                                <?php }}?>
                                                  <option value="All">All</option>                                                                                             
                                              </select>  
                                                  <?php };?>
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
                       
                        <div id="reports">
                        <table id="datatable-buttons8" class="table table-striped table-bordered">
                          <thead>                          
                              
                              <tr>
                              <th style="text-align:center;border-bottom:3pt solid #22d4ae;" rowspan="2">CO-Name</th>
                              <th rowspan="2" style="text-align:center;border-bottom:3pt solid #22d4ae;">Total Balance</th>
                              <th colspan="3" style="text-align:center;">Existing Product</th>
                              <th colspan="5" style="text-align:center;">New Product</th>                             
                             </tr>
                             <tr style="border-bottom:3pt solid #22d4ae;">
                              <th>PAR Values 1 Day</th>
                              <th>PAR Values 7 Day</th>
                              <th>PAR Values 30 Day</th>
                              <th>PAR Values 1 Day</th>                              
                              <th>PAR Values 7 Day</th>                            
                              <th>PAR Values 30 Day</th>
                              <th>BrName</th>
                              <th>BrCode</th>
                             </tr>                                                     
                          </thead>
                          <tbody id="showproductdaily">
                            <?php    
                                $BalAmt=0;
                                $PAR1EX=0;
                                $PAR7EX=0;
                                $PAR30EX=0;
                                $PAR1NE=0;
                                $PAR7NE=0;
                                $PAR30NE=0;                             
                                foreach($quality as $row){
                                    $BalAmt+=$row->BalAmt;
                                    $PAR1EX+=$row->PAR1EX;
                                    $PAR7EX+=$row->PAR7EX;
                                    $PAR30EX+=$row->PAR30EX;
                                    $PAR1NE+=$row->PAR1NE;
                                    $PAR7NE+=$row->PAR7NE;
                                    $PAR30NE+=$row->PAR30NE;  
                              ?>
                            <tr style="text-align:right">                              
                              <td style="text-align:left"><?php echo $row->CoName;?></td>
                              <td><?php echo number_format($row->BalAmt,0);?></td>
                              <td><?php echo number_format($row->PAR1EX,0);?></td>
                              <td><?php echo number_format($row->PAR7EX,0);?></td>
                              <td><?php echo number_format($row->PAR30EX,0);?></td>
                              <td><?php echo number_format($row->PAR1NE,0);?></td>                             
                              <td><?php echo number_format($row->PAR7NE,0);?></td>                           
                             <td><?php echo number_format($row->PAR30NE,0);?></td>
                             <td style="text-align:center;"><?= $row->shortcode;?></td>
                             <td style="text-align:center;"><?= $row->brcode;?></td>
                            </tr>
                            <?php }?>  
                            <tr style="text-align:right" class="active">                              
                              <td style="text-align:right">Total:</td>
                              <td><?php echo number_format($BalAmt,0);?></td>
                              <td><?php echo number_format($PAR1EX,0);?></td>
                              <td><?php echo number_format($PAR7EX,0);?></td>
                              <td><?php echo number_format($PAR30EX,0);?></td>
                              <td><?php echo number_format($PAR1NE,0);?></td>                             
                              <td><?php echo number_format($PAR7NE,0);?></td>                           
                             <td><?php echo number_format($PAR30NE,0);?></td>
                             <td style="text-align:center;" colspan='2'></td>
                            
                            </tr>                          
                          </tbody>      
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
        <script src="<?php echo base_url();?>/public/BM/portfolioqbyproduct.js"></script> 
        
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

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
                    
                    <li><a href="<?= site_url('dailyrm/repaymentdaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Repayment-Daily
                        </a></li>
                    <li><a href="<?= site_url('dailyrm/PortfolioQualitybyProductDaily');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Quality by Product-Daily
                        </a></li>
                        <li class="active"><a href="<?= site_url('dailyrm/PortfolioQualtiyRationsDaily');?>">
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
                             <form class="form-inline" action="<?php echo site_url('dailyrm/PortfolioQualtiyRationsDaily');?>" method="POST">
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
                       
                        <div id="reports">
                        <table  class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th rowspan="3" style="border-bottom:3pt solid #22d4ae;padding:0px 0px 30px 0px;text-align:center">CO-Name</th>
                              <th rowspan="3" style="border-bottom:3pt solid #22d4ae;padding:0px 0px 30px 0px;text-align:center">Total Balance</th>
                              <th colspan="11" style="padding:0px 0px 5px 0px;text-align:center">PAR Ratio</th>
                              
                              </tr>
                            <tr>
                                
                              <th colspan="3" style="padding:0px 0px 5px 0px;text-align:center">PAR 1 Day</th>
                              <th colspan="3" style="padding:5px 0px 5px 0px;text-align:center">PAR 7 Days</th>
                              <th colspan="5" style="padding:0px 0px 5px 0px;text-align:center">PAR 30 Days</th>
                            </tr>
                            <tr style="border-bottom:3pt solid #22d4ae;">
                              <th style="padding:0px 0px 5px 0px;text-align:center">#Acc</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">Balance</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">%</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">#Acc</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">Balance</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">%</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">#Acc</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">Balance</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">%</th>
                              <th style="text-align:center">BrName</th>
                              <th style="text-align:center">BrCode</th>                 
                            </tr>
                          </thead>
                          <tbody id="showrationsDaily">
                            <?php                               
                                 $Balamt=0;
                                 $PAR1=0;
                                 $PAR1AMT=0;
                                 $ParRatio1day=0;
                                 $PAR7=0;
                                 $PAR7AMT=0;
                                 $ParRation7day=0;
                                 $PAR30=0;
                                 $PAR30AMT=0;
                                 $ParRatio30day=0;        
                                 foreach($Ratios as $rows){ 
                                 $Balamt+=$rows->BalAmt;
                                 $PAR1+=$rows->PAR1;
                                 $PAR1AMT+=$rows->PAR1_Amt;
                                 $ParRatio1day+=$rows->ParRatio1day;
                                 $PAR7+=$rows->PAR7;
                                 $PAR7AMT+=$rows->PAR7_Amt;
                                 $ParRation7day+=$rows->ParRatio7day;
                                 $PAR30+=$rows->PAR30;
                                 $PAR30AMT+=$rows->PAR30_Amt;
                                 $ParRatio30day+=$rows->ParRatio30day;                        
                            ?>
                            <tr style="text-align:right">                              
                              <td style="text-align:left"><?php echo $rows->CoName;?></td>
                              <td><?php echo number_format($rows->BalAmt,0);?></td>
                              <td><?php echo number_format($rows->PAR1,0);?></td>
                              <td><?php echo number_format($rows->PAR1_Amt,0);?></td>
                              <td><?php echo number_format($rows->ParRatio1day,4)*100;?>%</td>
                              <td><?php echo number_format($rows->PAR7,0);?></td>
                              <td><?php echo number_format($rows->PAR7_Amt,0);?></td>
                              <td><?php echo number_format($rows->ParRatio7day,4)*100;?>%</td>
                              <td><?php echo number_format($rows->PAR30,0);?></td>
                              <td><?php echo number_format($rows->PAR30_Amt,0);?></td>                              
                              <td>
                                <?php echo number_format($rows->ParRatio30day,4)*100;?>%
                              </td>
                              <td style="text-align:center;"><?= $rows->shortcode;?></td>
                             <td style="text-align:center;"><?= $rows->brcode;?></td>
                            </tr>
                           <?php }?>                             
                           <tr style="text-align:right">                              
                              <td style="text-align:right">Total:</td>
                              <td><?php echo number_format($Balamt,0);?></td>
                              <td><?php echo number_format($PAR1,0);?></td>
                              <td><?php echo number_format($PAR1AMT,0);?></td>
                              <td><?php if($PAR1AMT==0){ echo number_format(0,2);}else{echo number_format($PAR1AMT/$Balamt,4)*100;}?>%</td>
                              <td><?php echo number_format($PAR7,0);?></td>
                              <td><?php echo number_format($PAR7AMT,0);?></td>
                              <td><?php if($PAR7AMT==0){echo number_format(0,2);}else{echo number_format($PAR7AMT/$Balamt,4)*100;}?>%</td>
                              <td><?php echo number_format($PAR30,0);?></td>
                              <td><?php echo number_format($PAR30AMT,0);?></td>                              
                              <td>
                                <?php if($PAR30AMT==0){echo number_format(0,2);}else{echo number_format($PAR30AMT/$Balamt,4)*100;}?>%
                              </td>
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
        <script src="<?php echo base_url();?>/public/RM/portfolioqRatiosDaily.js"></script> 
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
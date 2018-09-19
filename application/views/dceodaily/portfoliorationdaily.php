 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');  
        $sid=$this->session->userdata('system_id'); 
?><!-- page content -->
               

      
      
    
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
        <div class="breadcrumb flat row nopadding">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('daily/actived');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('daily/loanPortd');?>">Loan Portfolio</a>
                        <a href="<?= site_url('daily/loanDisbd');?>">Loan Disbursement</a>
                        <?php if($type==3){}else{?>
                          <a href="<?= site_url('writtenoffcollection');?>">Loan Written-Off Collection</a>
                        <?php }?>
                        
                        <a href="<?= site_url('daily/repaymentd');?>" class="active">Loan Repayment</a>
         </div>
          <div class="">  
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="dashboard_graph x_panel">
                <div class="container">
                  
                  <ul class="nav nav-tabs">
                    <li><a  href="<?php echo site_url("daily/repaymentd");?>">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Repayment In Month</a></li>                 
                    
                    <li><a href="<?php echo site_url("daily/repaymentdaily");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Repayment-Daily
                        </a></li>
                    <li class="active"><a href="<?php echo site_url("daily/portfoliorationdaily");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Qualtiy Ratios-Daily
                        </a></li>
                     <li><a href="<?php echo site_url("daily/portfoliobyproduct");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Quality by Product-Daily
                        </a></li>
                      
                  </ul>

                      <div class="tab-content">
                       <div id="menu3" class="tab-pane fade in active">                       
                          <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">
                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                                placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date('Y-m-d');}?>" 
                                                value="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date('Y-m-d');}?>"
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
                        <div class="panel-body table-responsive">
                          <table id="datatable-buttons7" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th rowspan="3" style="padding:0px 0px 30px 0px;text-align:center">Branch</th>
                              <th rowspan="3" style="padding:0px 0px 30px 0px;text-align:center">Total Balance</th>
                              <th colspan="9" style="padding:0px 0px 5px 0px;text-align:center">PAR Ratio</th>
                              
                              </tr>
                            <tr>
                                
                              <th colspan="3" style="padding:0px 0px 5px 0px;text-align:center">PAR 1 Day</th>
                              <th colspan="3" style="padding:5px 0px 5px 0px;text-align:center">PAR 7 Days</th>
                              <th colspan="3" style="padding:0px 0px 5px 0px;text-align:center">PAR 30 Days</th>
                            </tr>
                            <tr>
                              <th style="padding:0px 0px 5px 0px;text-align:center">#Acc</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">Balance</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">%</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">#Acc</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">Balance</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">%</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">#Acc</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">Balance</th>
                              <th style="padding:0px 0px 5px 0px;text-align:center">%</th>
                            </tr>
                          </thead>


                          <tbody id="showrationsDaily">
                            <?php
                                $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                $Ratios=$this->DailyCmr_model->getPortfolioQualtiyRatiosDailyDCEO($page,$datereports); 
                                $BalAmt=0;
                                $PAR1=0;
                                $PAR7=0;
                                $PAR30=0;
                                $PAR1_Amt=0;
                                $PAR7_Amt=0;
                                $PAR30_Amt=0;
                                $ParRatio1day=0;
                                $ParRatio7day=0;
                                $ParRatio30day=0;
                                foreach($Ratios as $rows){
                            ?>
                            <tr style="text-align:right">
                              
                              <td style="text-align:center"><?php echo $rows->shortcode;?></td>
                              <td style='text-align:right'><?php echo number_format($rows->BalAmt,0);$BalAmt+=$rows->BalAmt;?></td>
                              <td style='text-align:right'><?php echo number_format($rows->PAR1,0);$PAR1+=$rows->PAR1;?></td>
                              <td style='text-align:right'><?php echo number_format($rows->PAR1_Amt,0);$PAR1_Amt+=$rows->PAR1_Amt;?></td>
                              <td style='text-align:right'><?php echo number_format($rows->ParRatio1day*100,2);$ParRatio1day+=number_format($rows->ParRatio1day*100,2);?>%</td>
                              <td style='text-align:right'><?php echo number_format($rows->PAR7,0);$PAR7+=$rows->PAR7;?></td>
                              <td style='text-align:right'><?php echo number_format($rows->PAR7_Amt,0);$PAR7_Amt+=$rows->PAR7_Amt;?></td>
                              <td style='text-align:right'><?php echo number_format($rows->ParRatio7day*100,2);$ParRatio7day+=number_format($rows->ParRatio7day*100,2);?>%</td>
                              <td style='text-align:right'><?php echo number_format($rows->PAR30,0);$PAR30+=$rows->PAR30;?></td>
                              <td style='text-align:right'><?php echo number_format($rows->PAR30_Amt,0);$PAR30_Amt+=$rows->PAR30_Amt;?></td>
                              <td style='text-align:right'>
                                <?php echo number_format($rows->ParRatio30day*100,2);$ParRatio30day+=number_format($rows->ParRatio30day*100,2);?> %
                              </td>
                            </tr>
                           <?php }?>
                            
                          </tbody>
                           <tr style="text-align:right">                              
                              <td style="text-align:center">Total:</td>
                              <td style='text-align:right'><?php echo number_format(round($BalAmt,-2),0);?></td>
                              <td style='text-align:right'><?php echo number_format($PAR1,0);?></td>
                              <td style='text-align:right'><?php echo number_format(round($PAR1_Amt,-2),0);?></td>
                              <td style='text-align:right'><?php echo number_format($PAR1_Amt/$BalAmt*100,2);?>%</td>
                              <td style='text-align:right'><?php echo number_format($PAR7,0);?></td>
                              <td style='text-align:right'><?php echo number_format(round($PAR7_Amt,-2),0);?></td>
                              <td style='text-align:right'><?php echo number_format($PAR7_Amt/$BalAmt*100,2);?>%</td>
                              <td style='text-align:right'><?php echo number_format($PAR30,0);?></td>
                              <td style='text-align:right'><?php echo number_format(round($PAR30_Amt,-2),0);?></td>
                              <td style='text-align:right'>
                                <?php echo number_format($PAR30_Amt/$BalAmt*100,2);?> %
                              </td>
                            </tr>
                               <?php 
                                            $grandtoal=$this->DailyCmr_model->getGrandTotalAll(4,$datereports);
                                            foreach($grandtoal as $row){
                                ?>
                               <tr style="text-align:right" class="info">                              
                              <td style="text-align:center">Grand Total:</td>
                              <td style='text-align:right'><?php echo number_format(round($row->BalAmt,-2),0);?></td>
                              <td style='text-align:right'><?php echo number_format($row->PAR1,0);?></td>
                              <td style='text-align:right'><?php echo number_format(round($row->PAR1_Amt,-2),0);?></td>
                              <td style='text-align:right'><?php echo number_format($row->PAR1_Amt/$row->BalAmt*100,2);?>%</td>
                              <td style='text-align:right'><?php echo number_format($row->PAR7,0);?></td>
                              <td style='text-align:right'><?php echo number_format(round($row->PAR7_Amt,-2),0);?></td>
                              <td style='text-align:right'><?php echo number_format($row->PAR7_Amt/$row->BalAmt*100,2);?>%</td>
                              <td style='text-align:right'><?php echo number_format($row->PAR30,0);?></td>
                              <td style='text-align:right'><?php echo number_format(round($row->PAR30_Amt,-2),0);?></td>
                              <td style='text-align:right'>
                                <?php echo number_format($row->PAR30_Amt/$row->BalAmt*100,2);?> %
                              </td>
                            </tr>
                              <?php }?>
                        </table>
                        </div>
                            <div style="margin-top: 25px;margin-bottom: -12px;">
                                <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span>             records</label>
                              </div>  
                            <br/>
                            <?php echo $this->pagination->create_links(); ?>
                    
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

        <script>
            var jqOld = jQuery.noConflict();
            jqOld(function() {
                jqOld("#dateend" ).datepicker();
            });
            jqOld(function() {
                jqOld("#datestart" ).datepicker();
            })
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    

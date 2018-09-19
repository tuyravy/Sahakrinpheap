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
                    <li><a href="<?php echo site_url("daily/repaymentd");?>">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Repayment In Month</a></li>                 
                    
                    <li class="active"><a href="<?php echo site_url("daily/repaymentdaily");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Repayment-Daily
                        </a></li>
                    <li><a href="<?php echo site_url("daily/portfoliorationdaily");?>">
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
                        <div id="menu2" class="tab-pane fade in active">
                         <br/>
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
                            <table id="datatable-buttons" class="table table-striped table-bordered table-condensed f14">
                             <thead>
                                <tr>
                                  <th style="text-align:center;padding:10px 0px 25px 0px;" rowspan="2">Branch</th>
                                  <th style="text-align:center;padding:10px 0px 25px 0px;" rowspan="2">Granted Total</th>
                                  <th colspan="5" style="text-align:center;">Existing Product Repayment</th>
                                  <th colspan="5" style="text-align:center;">New Product Repayment</th>                             
                                </tr>
                                <tr style="text-align:center;white-space: nowrap;overflow: hidden;">
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
                                </tr>
                              </thead>


                          <tbody id="showdailyrepayment"> 

                           
                            <?php 
                                $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                $result=$this->DailyCmr_model->getDailyRepaymentDCEO($page,$datereports);
                                $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $AdminFee1=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $totalgranted=0;
                                $totalex=0;
                                $totalnew=0;
                                foreach($result as $row){
                              ?>
                              <tr style="text-align:right">
                              <td style="text-align:center"><?php echo $row->shortcode;?></td>
                              <td style="text-align:right">
                             <?php echo number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);$totalgranted+=$row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;?>
                              </td>
                              <td style="text-align:right"><?php echo number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,0);$totalex+=$row->Principle+$row->Interest+$row->Penalty+$row->AdminFee;?></td>
                              <td style="text-align:right"><?php echo number_format($row->Principle,0);$Principle+=$row->Principle;?></td>
                              <td style="text-align:right"><?php echo number_format($row->Interest,0);$Interest+=$row->Interest;?></td>    
                              <td style="text-align:right"><?php echo number_format($row->Penalty,0);$Penalty+=$row->Penalty;?></td> 
                              <td style="text-align:right"><?php echo number_format($row->AdminFee,0);$AdminFee+=$row->AdminFee;?></td> 
                              <td style="text-align:right"><?php echo number_format($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);$totalnew+=$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;?></td>
                              <td style="text-align:right"><?php echo number_format($row->Principle1,0);$Principle1+=$row->Principle1;?></td>
                              <td style="text-align:right"><?php echo number_format($row->Interest1,0);$Interest1+=$row->Interest1;?></td>    
                              <td style="text-align:right"><?php echo number_format($row->Penalty1,0);$Penalty1+=$row->Penalty1;?></td> 
                              <td style="text-align:right"><?php echo number_format($row->AdminFee1,0);$AdminFee1+=$row->AdminFee1;?></td>
                            </tr>
                                                      
                           
                          <?php }?>
                           <tr style="text-align:right">
                              <td style="text-align:center">Total:</td>
                              <td style="text-align:right"><?php echo number_format(round($totalgranted,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($totalex,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Principle,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Interest,-2),0);?></td>    
                              <td style="text-align:right"><?php echo number_format(round($Penalty,-2),0);?></td> 
                              <td style="text-align:right"><?php echo number_format(round($AdminFee,-2),0);?></td> 
                              <td style="text-align:right"><?php echo number_format(round($totalnew,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Principle1,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Interest1,-2),0);?></td>    
                              <td style="text-align:right"><?php echo number_format(round($Penalty1,-2),0);?></td> 
                              <td style="text-align:right"><?php echo number_format(round($AdminFee1,-2),0);?></td>
                            </tr>
                               <?php 
                                            $grandtoal=$this->DailyCmr_model->getGrandTotalAll(3,$datereports);
                                            foreach($grandtoal as $row){
                                ?>
                              
                               <tr style="text-align:right" class="info">
                              <td style="text-align:center">Grand Total:</td>
                              <td style="text-align:right"><?php echo number_format(round($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Principle,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Interest,-2),0);?></td>    
                              <td style="text-align:right"><?php echo number_format(round($Penalty,-2),0);?></td> 
                              <td style="text-align:right"><?php echo number_format(round($AdminFee,-2),0);?></td> 
                              <td style="text-align:right"><?php echo number_format(round($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Principle1,-2),0);?></td>
                              <td style="text-align:right"><?php echo number_format(round($Interest1,-2),0);?></td>    
                              <td style="text-align:right"><?php echo number_format(round($Penalty1,-2),0);?></td> 
                              <td style="text-align:right"><?php echo number_format(round($AdminFee1,-2),0);?></td>
                            </tr>
                              <?php }?>
                          </tbody>
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
    

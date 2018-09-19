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
                    <li><a href="<?php echo site_url("daily/portfoliorationdaily");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Qualtiy Ratios-Daily
                        </a></li>
                     <li class="active"><a data-toggle="tab" href="<?php echo site_url("daily/portfoliobyproduct");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Quality by Product-Daily
                        </a></li>
                      
                  </ul>

                      <div class="tab-content">
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
                          <table id="datatable-buttons5" class="table table-bordered  table-condensed f14">
                          <thead>
                           
                              
                              <tr>
                              <th style="text-align:center;" rowspan="2">Branch</th>
                              <th colspan="3" style="text-align:center;">Existing Product</th>
                              <th colspan="3" style="text-align:center;">New Product</th>                             
                             </tr>
                             <tr>
                              <th>PAR Values 1 Day</th>
                              <th>PAR Values 7 Day</th>
                              <th>PAR Values 30 Day</th>
                              <th>PAR Values 1 Day</th>                              
                              <th>PAR Values 7 Day</th>                            
                              <th>PAR Values 30 Day</th>
                             </tr>
                              

                            
                          </thead>


                          <tbody id="showproductdaily">
                            <?php 
                                $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                $datereports=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
                                $pro=$this->DailyCmr_model->getPortfolioQualitybyProductDailyDCEO($page,$datereports);
                                $PAR1EX=0;
                                $PAR7EX=0;
                                $PAR30EX=0;
                                $PAR1NE=0;
                                $PAR7NE=0;
                                $PAR30NE=0;
                                foreach($pro as $row){
                              ?>
                            <tr style="text-align:right">
                              
                              <td style="text-align:center"><?php echo $row->shortcode;?></td>
                              <td style="text-align:right"><?php echo number_format($row->PAR1EX,0);$PAR1EX+=$row->PAR1EX;?></td>
                              <td style="text-align:right"><?php echo number_format($row->PAR7EX,0);$PAR7EX+=$row->PAR7EX;?></td>
                              <td style="text-align:right"><?php echo number_format($row->PAR30EX,0);$PAR30EX+=$row->PAR30EX;?></td>
                              <td style="text-align:right"><?php echo number_format($row->PAR1NE,0);$PAR1NE+=$row->PAR1NE;?></td>                             
                              <td style="text-align:right"><?php echo number_format($row->PAR7NE,0);$PAR7NE+=$row->PAR7NE;?></td>                           
                             <td style="text-align:right"><?php echo number_format($row->PAR30NE,0);$PAR30NE+=$row->PAR30NE;?></td>
                            </tr>
                            <?php }?>
                            
                          </tbody>
                           <tr style="text-align:right">                              
                              <td style="text-align:center">Total:</td>
                              <td style="text-align:right"><?php echo number_format($PAR1EX,0);?></td>
                              <td style="text-align:right"><?php echo number_format($PAR7EX,0);?></td>
                              <td style="text-align:right"><?php echo number_format($PAR30EX,0);?></td>
                              <td style="text-align:right"><?php echo number_format($PAR1NE,0);?></td>                             
                              <td style="text-align:right"><?php echo number_format($PAR7NE,0);?></td>                           
                             <td style="text-align:right"><?php echo number_format($PAR30NE,0);?></td>
                            </tr>
                             <?php 
                                            $grandtoal=$this->DailyCmr_model->getGrandTotalAll(5,$datereports);
                                            foreach($grandtoal as $row){
                                ?>
                            <tr style="text-align:right" class="info">                              
                              <td style="text-align:center">Grand Total:</td>
                              <td style="text-align:right"><?php echo number_format($row->PAR1EX,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->PAR7EX,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->PAR30EX,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->PAR1NE,0);?></td>                             
                              <td style="text-align:right"><?php echo number_format($row->PAR7NE,0);?></td>                           
                             <td style="text-align:right"><?php echo number_format($row->PAR30NE,0);?></td>
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
    

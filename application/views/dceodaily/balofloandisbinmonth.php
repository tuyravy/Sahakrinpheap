 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');   
        $type=$this->session->userdata('types');
        $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));    
?><!-- page content -->
               

        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>

        <div class="breadcrumb flat row nopadding">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('daily/actived');?>" >Loan Active Borrower</a>
                        <a href="<?= site_url('daily/loanPortd');?>">Loan Portfolio</a>
                        <a href="<?= site_url('daily/loanDisbd');?>" class="active">Loan Disbursement</a>
                        <?php if($type==3){}else{?>
                          <a href="<?= site_url('writtenoffcollection');?>">Loan Written-Off Collection</a>
                        <?php }?>
                        
                        <a href="<?= site_url('daily/repaymentd');?>">Loan Repayment</a>
         </div>
          <div class="">  
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="dashboard_graph x_panel">
                <div class="container">
                  
                  <ul class="nav nav-tabs">
                    <li><a href="<?php echo site_url("daily/loanDisbd");?>">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Number of Loans Disbursement In Month</a></li>                 
                     <li class="active"><a href="<?php echo site_url('daily/loanDisbdbalamt');?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Balance of Loans disbursement in Month
                        </a></li>
                    <li><a href="<?php echo site_url("daily/numberofloandisbdaily");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Number of Loans disbursement-Daily
                        </a></li>
                   
                     <li><a  href="<?php echo site_url("daily/balamtofloandisbdaily");?>">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Balance of Loans Disbursement-Daily
                        </a></li>
                    
                      
                  </ul>

                      <div class="tab-content">
                        <div id="menu3" class="tab-pane fade in active">
                          <br/>
                              <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">
                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
                                           value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                                placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>" 
                                                value="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date("Y-m-d",strtotime($reportdate));}?>"
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
                        <div id="reports">
                         <div class="col-md-12">
                          
                              <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                              <h2 id="in" style="text-align:left;">Balance of Loan Disbursement In Month</h2>                              
                              <p id="in" style="text-align:left">Reports Date:
                                  <?php
                                    if(isset($_GET['datestart']))
                                    {
                                        echo date('d-M-Y',strtotime($_GET['datestart']));
                                    }else
                                    {
                                        echo date('d-M-Y',strtotime($reportdate));
                                    }
                                  ?>

                                <span style="margin-left:10px;">
                                    To:<span style="margin-left:10px;">
                                        <?php
                                        if(isset($_GET['enddate']))
                                        {
                                            echo date('d-M-Y',strtotime($_GET['enddate']));
                                        }else
                                        {
                                            echo date('d-M-Y',strtotime($reportdate));
                                        }
                                      ?>
                                       </span>
                                </span>


                              </p>
                          </div> 
                        <table id="datatable-buttons4" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>COName</th>
                              <th>Total Balance</th>
                              <th>ILD</th>
                              <th>ILF</th>
                              <th>GLD</th>
                              <th>GLF</th>
                              <th>ALI</th>
                              <th>ALG</th>
                              <th>MELI</th>
                              <th>MELG</th>
                              <th>SEL</th>
                              <th>PL</th>
                              <th>HRL</th>
                              <th>EL</th>
                            </tr>
                          </thead>


                          <tbody id="showvaluedis">
                             <?php 
                                    
                                    $active=$this->DailyCmr_model->getValueofLoansdisbursementinMonthDCEO(0,$reportdate,$type);
                                    $sumAcc=0;
                                    $ILD=0;
                                    $ILF=0;
                                    $GLD=0;
                                    $GLF=0;
                                    $ALI=0;
                                    $ALG=0;
                                    $MELI=0;
                                    $MELG=0;
                                    $SEL=0;
                                    $PL=0;
                                    $HRL=0;
                                    $EL=0;
                                    foreach($active as $row){
                              ?>
                            <tr style="text-align:right">
                              <td style="text-align:center"> <?php echo $row->shortcode;?>                              
                              </td>
                              
                                     <td><?php echo number_format($row->Balance,0);$sumAcc+=$row->Balance;?></td>
                                      <td><?php echo number_format($row->ILD,0);$ILD+=$row->ILD;?></td>
                                      <td><?php echo number_format($row->ILF,0);$ILF+=$row->ILF;?></td>
                                      <td><?php echo number_format($row->GLD,0);$GLD+=$row->GLD;?></td>
                                      <td><?php echo number_format($row->GLF,0);$GLF+=$row->GLF;?></td>
                                      <td><?php echo number_format($row->ALI,0);$ALI+=$row->ALI;?></td>
                                      <td><?php echo number_format($row->ALG,0);$ALG+=$row->ALG;?></td>
                                      <td><?php echo number_format($row->MELI,0);$MELI+=$row->MELI;?></td>
                                      <td><?php echo number_format($row->MELG,0);$MELG+=$row->MELG;?></td>
                                      <td><?php echo number_format($row->SEL,0);$SEL+=$row->SEL;?></td>
                                      <td><?php echo number_format($row->PL,0);$PL+=$row->PL;?></td>
                                      <td><?php echo number_format($row->HRL,0);$HRL+=$row->HRL;?></td>  
                                      <td><?php echo number_format($row->EL,0);$EL+=$row->EL;?></td>   
                              
                             
                            </tr>
                              <?php }?>
                            
                          </tbody>
                                <tr style="text-align:right">
                                 <td style="text-align:center">Total:</td>
                                  <td><?= number_format(round($sumAcc,-2),0);?></td>
                                  <td><?= number_format(round($ILD,-2),0);?></td>
                                  <td><?= number_format(round($ILF,-2),0);?></td>
                                  <td><?= number_format(round($GLD,-2),0);?></td>
                                  <td><?= number_format(round($GLF,-2),0);?></td>
                                  <td><?= number_format(round($ALI,-2),0);?></td>
                                  <td><?= number_format(round($ALG,-2),0);?></td>
                                  <td><?= number_format(round($MELI,-2),0);?></td>
                                  <td><?= number_format(round($MELG,-2),0);?></td>
                                  <td><?= number_format(round($SEL,-2),0);?></td>
                                  <td><?= number_format(round($PL,-2),0);?></td>                              
                                  <td><?= number_format(round($HRL,-2),0);?></td>
                                  <td><?= number_format(round($EL,-2),0);?></td>
                                </tr>
                                <?php $grandtotal=$this->DailyCmr_model->getGrandTotalLoanDisbursement(2,$reportdate);
                                  foreach($grandtotal as $row){
                                ?>
                                <tr style="text-align:right" class="info">
                                 <td style="text-align:center">Grand Total-KHR:</td>
                                  <td><?= number_format(round($row->Balance,-2),0);?></td>
                                  <td><?= number_format(round($row->ILD,-2),0);?></td>
                                  <td><?= number_format(round($row->ILF,-2),0);?></td>
                                  <td><?= number_format(round($row->GLD,-2),0);?></td>
                                  <td><?= number_format(round($row->GLF,-2),0);?></td>
                                  <td><?= number_format(round($row->ALI,-2),0);?></td>
                                  <td><?= number_format(round($row->ALG,-2),0);?></td>
                                  <td><?= number_format(round($row->MELI,-2),0);?></td>
                                  <td><?= number_format(round($row->MELG,-2),0);?></td>
                                  <td><?= number_format(round($row->SEL,-2),0);?></td>
                                  <td><?= number_format(round($row->PL,-2),0);?></td>                              
                                  <td><?= number_format(round($row->HRL,-2),0);?></td>
                                  <td><?= number_format(round($row->EL,-2),0);?></td>
                                </tr>
                                <tr style="text-align:right" class="warning">
                                 <td style="text-align:center">Grand Total-USD:</td>
                                  <td><?= number_format(round($row->Balance/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->ILD/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->ILF/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->GLD/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->GLF/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->ALI/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->ALG/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->MELI/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->MELG/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->SEL/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->PL/4000,-2),0);?></td>                              
                                  <td><?= number_format(round($row->HRL/4000,-2),0);?></td>
                                  <td><?= number_format(round($row->EL/4000,-2),0);?></td>
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
                    <div>
                       <p></p>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;"><span style="font-wegith">ILD</span> <span style="color:#1400ff;font-size:16px">:</span> Ind. Loan - Declining</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">ILF-PAR7 : Ind. Loan - Flat</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">GLD : Group Loan - Declining</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">GLF : Group Loan - Flat</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">ALI : Agriculture Loan - Ind.</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">ALG : Agriculture Loan - Group</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">MELI : Micro Enterpreneurs Loan - Ind.</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">MELG : Micro Enterpreneurs Loan - Group</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">SEL : Small Enterpreneurs Loan</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">PL : Personal Loan</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">HR : Home Renovation Loan</span></P>
                        <P><span class="glyphicon glyphicon-asterisk"></span><span style="margin-left:10px;">EL : Express Loan</span></P>
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
            
          
        }
        </script>
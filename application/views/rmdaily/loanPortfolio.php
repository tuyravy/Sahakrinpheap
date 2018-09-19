 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');  
        $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
?><!-- page content -->
    
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
        <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                       <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('daily/active');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('loanPort');?>" class="active">Loan Portfolio</a>
                        <a href="<?= site_url('loanDisb');?>">Loan Disbursement</a>
                        <a href="<?= site_url('writtenoffrm');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('repayment');?>">Loan Repayment</a>
        </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Loan Portfolio<small></small></h3>
                    </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto">
                        <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">                                       
                                        <label for="exampleInputName2">From:</label>
                                        <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                        placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{date('Y-m-d');}?>"
                                        value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{echo date('Y-m-d');}?>"
                                        readonly="true" style="background:white;">
                                     </div>
                                <div class="form-group">
                                <label for="exampleInputEmail2">To:</label>
                                 <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                        placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{date('Y-m-d');}?>" 
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
                    
                    <div class="panel-body table-responsive" id="reports" style="margin-left:-15px;">
                       <div class="col-md-12">
                          
                          <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                          <h2 id="in" style="text-align:left;">Loan Portfolio Report_Daily</h2>                         
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
                      
                        <table id="datatable-buttons" class="table table-bordered table-condensed f11">
                          <thead>
                            <tr>
                              <th>Branch</th>
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


                          <tbody>
                             <?php 
                                    $sumacc=0;
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
                                    if(isset($_GET['datestart']))
                                    {
                                        $start=date("Ymd",strtotime($_GET['datestart']));
                                        $end=date("Ymd",strtotime($_GET['dateend']));
                                        $active=$this->DailyCmr_model->getLoanPortfolio($brcode,$role,$sid,$start,$end); 
                                        
                                    }else{
                                        
                                    $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                    $active=$this->DailyCmr_model->getLoanPortfolio($brcode,$role,$sid,$reportdate,$reportdate);   
                                    }
                                    foreach($active as $row){
                                    $sumacc+=$row->BalAmt;
                                    $ILD+=$row->ILD;
                                    $ILF+=$row->ILF;
                                    $GLD+=$row->GLD;
                                    $GLF+=$row->GLF;
                                    $ALI+=$row->ALI;
                                    $ALG+=$row->ALG;
                                    $MELI+=$row->MELI;
                                    $MELG+=$row->MELG;
                                    $SEL+=$row->SEL;
                                    $PL+=$row->PL;
                                    $HRL+=$row->HRL;
                                    $EL+=$row->EL;
                              ?>
                            <tr style="text-align:right">
                              <td style="text-align:left"> <?php echo $row->shortcode;?>                              
                              </td>
                              <td style="text-align:right"><?php echo number_format($row->BalAmt,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->ILD,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->ILF,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->GLD,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->GLF,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->ALI,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->ALG,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->MELI,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->MELG,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->SEL,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->PL,0);?></td>
                              <td style="text-align:right"><?php echo number_format($row->HRL,0);?></td>  
                              <td style="text-align:right"><?php echo number_format($row->EL,0);?></td>   
                              
                             
                            </tr>
                              
                              <?php }?>
                            
                          </tbody>
                            <tr style="text-align:right">
                              <td style="text-align:center">Total:</td>
                              <td style="text-align:right"><?=  number_format($sumacc,0);?></td>
                              <td style="text-align:right"><?= number_format($ILD,0);?></td>
                              <td style="text-align:right"><?= number_format($ILF,0);?></td>
                              <td style="text-align:right"><?= number_format($GLD,0);?></td>
                              <td style="text-align:right"><?= number_format($GLF,0);?></td>
                              <td style="text-align:right"><?= number_format($ALI,0);?></td>
                              <td style="text-align:right"><?= number_format($ALG,0);?></td>
                              <td style="text-align:right"><?= number_format($MELI,0);?></td>
                              <td style="text-align:right"><?= number_format($MELG,0);?></td>
                              <td style="text-align:right"><?= number_format($SEL,0);?></td>
                              <td style="text-align:right"><?= number_format($PL,0);?></td>
                              <td style="text-align:right"><?= number_format($HRL,0);?></td>                              
                              <td style="text-align:right"><?= number_format($EL,0);?></td>
                            </tr>
                        </table>
                        
                       
                        <div class="col-md-10">
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
                        
                       <div class="col-md-2">
                            <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                            </div> 
                         <?php echo $this->pagination->create_links(); ?>  
                      </div> 
                    
                  </div>
                </div>
              </div>
            </div>  
              
        
<!----------------JavaScript Get Datepicker--->
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
            window.location.href="<?= site_url("loanPort");?>";
          
        }
    </script>
          
   

   
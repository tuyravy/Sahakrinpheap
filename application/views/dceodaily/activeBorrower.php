 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');
        $type=$this->session->userdata('types');
        $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
?><!-- page content -->
               
   
            
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('daily/actived');?>" class="active">Loan Active Borrower</a>
                        <a href="<?= site_url('daily/loanPortd');?>">Loan Portfolio</a>
                        <a href="<?= site_url('daily/loanDisbd');?>">Loans Disbursement</a>
                        <?php if($type==3){}else{?>
                          <a href="<?= site_url('writtenoffcollection');?>">Loan Written-Off Collection</a>
                        <?php }?>
                        
                        <a href="<?= site_url('daily/repaymentd');?>">Loan Repayment</a>
            </div>



          <div class="">        
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-user" style="padding:10px;"></span>Loan Active Borrower<small></small></h3>
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
                          <h2 id="in" style="text-align:left;">Loan Active Borrower Report_Daily</h2>                          
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
                        <table id="datatable-buttons" class="table table-bordered table-condensed f14">
                          <thead>
                            <tr class="active">
                              <th>Branch</th>
                              <th>Total Acc</th>
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
                                    $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                    
                                    $active= $this->DailyCmr_model->
                                    getActiveBorrowerDCEO(10,$page,$reportdate,$type);
                                    foreach($active as $row){
                                    $sumacc+=$row->Totalacc;
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
                              <td style="text-align:center"> <?php echo $row->shortcode;?>                              
                              </td>
                              <td><?php echo $row->Totalacc;?></td>
                              <td><?php if($row->ILD==''){ echo 0;}else{echo number_format($row->ILD,0);};?></td>
                              <td><?php if($row->ILF==''){ echo 0;}else{echo number_format($row->ILF,0);};?></td>
                              <td><?php if($row->GLD==''){ echo 0;}else{echo number_format($row->GLD,0);}?></td>
                              <td><?php if($row->GLF==''){ echo 0;}else{echo number_format($row->GLF,0);};?></td>
                              <td><?php if($row->ALI==''){ echo 0;}else{echo number_format($row->ALI,0);};?></td>
                              <td><?php if($row->ALG==''){ echo 0;}else{echo number_format($row->ALG,0);}?></td>
                              <td><?php if($row->MELI==''){echo 0;}else{echo number_format($row->MELI,0);}?></td>
                              <td><?php if($row->MELG==''){echo 0;}else{echo number_format($row->MELG,0);}?></td>
                              <td><?php if($row->SEL==''){echo 0;}else{echo number_format($row->SEL,0);};?></td>
                              <td><?php if($row->PL==''){echo 0;}else{echo number_format($row->PL,0);};?></td>
                              <td><?php if($row->HRL==''){echo 0;}else{echo number_format($row->HRL,0);};?></td>  
                              <td><?php if($row->EL==''){echo 0;}else{echo number_format($row->EL,0);};?></td>   
                              
                             
                            </tr>
                              <?php }?>
                            
                          </tbody>
                            <tr>
                              <td style="text-align:center">Total:</td>
                              <td style="text-align:center"><?= number_format($sumacc,0);?></td>
                              <td style="text-align:center"><?= number_format($ILD,0);?></td>
                              <td style="text-align:center"><?= number_format($ILF,0);?></td>
                              <td style="text-align:center"><?= number_format($GLD,0);?></td>
                              <td style="text-align:center"><?= number_format($GLF,0);?></td>
                              <td style="text-align:center"><?= number_format($ALI,0);?></td>
                              <td style="text-align:center"><?= number_format($ALG,0);?></td>
                              <td style="text-align:center"><?= number_format($MELI,0);?></td>
                              <td style="text-align:center"><?= number_format($MELG,0);?></td>
                              <td style="text-align:center"><?= number_format($SEL,0);?></td>
                              <td style="text-align:center"><?= number_format($PL,0);?></td>
                              <td style="text-align:center"><?= number_format($HRL,0);?></td>                              
                              <td style="text-align:center"><?= number_format($EL,0);?></td>
                            </tr>
                           <?php $grandtotal=$this->DailyCmr_model->getGrandTotalActiveBorrowver($reportdate);
                                foreach($grandtotal as $row){
                            ?>
                            <tr class="info">
                              <td style="text-align:center">Grand Total:</td>
                              <td style="text-align:center"><?= number_format($row->Totalacc,0);?></td>
                              <td style="text-align:center"><?= number_format($row->ILD,0);?></td>
                              <td style="text-align:center"><?= number_format($row->ILF,0);?></td>
                              <td style="text-align:center"><?= number_format($row->GLD,0);?></td>
                              <td style="text-align:center"><?= number_format($row->GLF,0);?></td>
                              <td style="text-align:center"><?= number_format($row->ALI,0);?></td>
                              <td style="text-align:center"><?= number_format($row->ALG,0);?></td>
                              <td style="text-align:center"><?= number_format($row->MELI,0);?></td>
                              <td style="text-align:center"><?= number_format($row->MELG,0);?></td>
                              <td style="text-align:center"><?= number_format($row->SEL,0);?></td>
                              <td style="text-align:center"><?= number_format($row->PL,0);?></td>
                              <td style="text-align:center"><?= number_format($row->HRL,0);?></td>                              
                              <td style="text-align:center"><?= number_format($row->EL,0);?></td>
                            </tr>
                          <?php }?>
                        </table>
                    </div>  
                    </div>                      
                             
                    <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                    </div>  
                    <br/>
                    <?php echo $this->pagination->create_links(); ?>
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
            
 <style>
   #in{text-align: left;}
   fieldset.scheduler-border {
    border: 1px groove #e0d5d5 !important;
    padding: 0 0.5em 0.5em 0.5em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    }
    fieldset
    {
        width:64%;
        
    }
    .nopadding {
    padding: 0 !important;
    margin: 0 !important;
    }
    
</style>

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


       


            
           
              
 
  

     
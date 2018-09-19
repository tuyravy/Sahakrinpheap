 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');     
        $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate())); 
?><!-- page content -->
               

      
      
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
        <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('daily/active');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('loanPort');?>">Loan Portfolio</a>
                        <a href="<?= site_url('loanDisb');?>" class="active">Loan Disbursement</a>
                        <a href="<?= site_url('writtenoffrm');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('repayment');?>">Loan Repayment</a>
         </div>
          <div class="">  
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="dashboard_graph x_panel">
                <div class="container">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Number of Loans Disbursement In Month</a></li>                 
                    <li><a data-toggle="tab" href="#menu3">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Balance of Loans disbursement in Month
                        </a></li>
                    <li><a data-toggle="tab" href="#menu2">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Number of Loans Disbursement-Daily
                        </a></li>
                    
                     <li><a data-toggle="tab" href="#menu4">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Balance of Loans Disbursement-Daily
                        </a></li>
                      
                  </ul>

                      <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                         <br/>
                        <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" id="exampleInputName2" value="<?= date('Y-m-d');?>" 
                                          
                                          readonly="true" style="background:white;" required="required">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" value="<?= date('Y-m-d');?>" readonly="true" style="background:white;" required="required">
                                      </div> 
                                      <button type="button" id="loandisbinmonthbtn" class="btn btn-primary" style="margin-top:5px;">Search</button>
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
                          <h2 id="in" style="text-align:left;">Loan Disbursement In Month</h2>                         
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
                        <table id="datatable-buttons2" class="table table-striped table-bordered">
                          <thead>
                            <tr>
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


                          <tbody id="loandisbinmonth">
                             <?php 
                                    if(isset($_GET['datestart']))
                                    {
                                        $start=date("Ymd",strtotime($_GET['datestart']));
                                        $end=date("Ymd",strtotime($_GET['dateend']));
                                        $active=$this->DailyCmr_model->getLoansdisbursementInMonth($brcode,$role,$sid,$start,$end);
                                    }else{
                                        
                                    $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                    $active=$this->DailyCmr_model->getLoansdisbursementInMonth($brcode,$role,$sid,$reportdate,$reportdate);
                                    }
                                   
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
                              <td style="text-align:left"> <?php echo $row->shortcode;?>                              
                              </td>
                              <td><?php echo $row->Totalacc;$sumAcc+=$row->Totalacc;?></td>
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
                            <tr style="text-align:right">
                              <td style="text-align:center">Total:</td>
                              <td><?= number_format($sumAcc,0);?></td>
                              <td><?= number_format($ILD,0);?></td>
                              <td><?= number_format($ILF,0);?></td>
                              <td><?= number_format($GLD,0);?></td>
                              <td><?= number_format($GLF,0);?></td>
                              <td><?= number_format($ALI,0);?></td>
                              <td><?= number_format($ALG,0);?></td>
                              <td><?= number_format($MELI,0);?></td>
                              <td><?= number_format($MELG,0);?></td>
                              <td><?= number_format($SEL,0);?></td>
                              <td><?= number_format($PL,0);?></td>                              
                              <td><?= number_format($HRL,0);?></td>
                              <td><?= number_format($EL,0);?></td>
                            </tr>
                          </tbody>
                            
                        </table>
                        </div>
                        <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                        </div>  
                      </div>   
                       
                      
                       
                       
                        <div id="menu2" class="tab-pane fade">
                           <br/>
                          <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">From:</label>
                                      <input type="text" id="datestart1" class="form-control" id="exampleInputName2" value="<?= date('Y-m-d');?>"
                                      readonly="true" style="background:white;">
                                    </div>
                                <div class="form-group">
                                <label for="exampleInputEmail2">To:</label>
                                 <input type="text" class="form-control" id="dateend1" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" value="<?= date('Y-m-d');?>" readonly="true" style="background:white;">
                              </div> 
                              <button type="button" class="btn btn-primary" id="dailyloandisb" style="margin-top:5px;">Search</button>
                             </fieldset>
                            </form>
                          </div>
                            <div class="col-md-2 pull-right">                                 
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" onclick="javascript:printDiv('reports1')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                            <span style="margin-left:5px;">PRINT</span></button>  
                                        <p></p>
                                </div>
                                 
                            </div>
                         </div>
                        <br/>
                            <div id="reports1">
                            <div class="col-md-12">
                          
                              <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                              <h2 id="in" style="text-align:left;">Loan Disbursement Report-Daily</h2>
                             
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
                            <table id="datatable-buttons3" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>CoName</th>
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


                              <tbody id="dailyloandisbtr">
                                 <?php 
                                         $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                        $active=$this->DailyCmr_model->getDailyLoansdisbursement($brcode,$role,$sid,$reportdate,$reportdate);
                                      
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
                                      <td style="text-align:left"> <?php echo $row->shortcode;?>                              
                                      </td>
                                      <td><?php echo $row->Totalacc;$sumAcc+=$row->Totalacc;?></td>
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
                              <?php } ?>
                                <tr style="text-align:right">
                                 <td style="text-align:center">Total:</td>
                                  <td><?= number_format($sumAcc,0);?></td>
                                  <td><?= number_format($ILD,0);?></td>
                                  <td><?= number_format($ILF,0);?></td>
                                  <td><?= number_format($GLD,0);?></td>
                                  <td><?= number_format($GLF,0);?></td>
                                  <td><?= number_format($ALI,0);?></td>
                                  <td><?= number_format($ALG,0);?></td>
                                  <td><?= number_format($MELI,0);?></td>
                                  <td><?= number_format($MELG,0);?></td>
                                  <td><?= number_format($SEL,0);?></td>
                                  <td><?= number_format($PL,0);?></td>                              
                                  <td><?= number_format($HRL,0);?></td>
                                  <td><?= number_format($EL,0);?></td>
                                </tr>
                                  
                              </tbody>
                                
                            </table>
                          </div>
                            <div style="margin-top: 25px;margin-bottom: -12px;">
                                <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                            </div>  
                           </div>   
                        <div id="menu3" class="tab-pane fade">
                         <br/>
                          <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart2" class="form-control" id="exampleInputName2" value="<?= date('Y-m-d');?>"
                                          readonly="true" style="background:white;">
                                     </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend2" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" value="<?= date('Y-m-d');?>" readonly="true" style="background:white;">
                                      </div> 
                                      <button type="button" class="btn btn-primary" style="margin-top:5px;" id="valuesloandisb">Search</button>
                                 </fieldset>
                                </form>
                          </div>
                            <div class="col-md-2 pull-right">                                 
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" onclick="javascript:printDiv('reports2')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                            <span style="margin-left:5px;">PRINT</span></button>  
                                        <p></p>
                                </div>
                                 
                            </div>
                         </div>
                        <br/>
                            <div id="reports2">
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
                                  <th>CoName</th>
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


                          <tbody id="valuedisbinmonth">
                             <?php 
                                    $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                    $active=$this->DailyCmr_model->getValueofLoansdisbursementinMonth($brcode,$role,$sid,$reportdate,$reportdate);
                        
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
                              <td style="text-align:left"> <?php echo $row->shortcode;?>                              
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
                        </table>
                        </div>
                           <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                        </div>  
                        </div>    
                        <div id="menu4" class="tab-pane fade">
                          <br/>
                         <div class="col-md-12 nopadding">
                             <div class="col-md-10 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">From:</label>
                                        <input type="text" id="datestart3" class="form-control" id="exampleInputName2" value="<?= date('Y-m-d');?>"
                                        readonly="true" style="background:white;">
                                    </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail2">To:</label>
                                     <input type="text" class="form-control" id="dateend3" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" value="<?= date('Y-m-d');?>" readonly="true" style="background:white;">
                                  </div> 
                              <button type="button" class="btn btn-primary" id="valuesdailydisb" style="margin-top:5px;">Search</button>
                            </fieldset>
                            </form>
                          </div>
                             <div class="col-md-2 pull-right">                                 
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" onclick="javascript:printDiv('reports3')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                            <span style="margin-left:5px;">PRINT</span></button>  
                                        <p></p>
                                </div>
                                 
                            </div>
                         </div>
                        <br/>
                        <br/>
                          <div id="reports3">  
                          <div class="col-md-12">
                          
                              <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                              <h2 id="in" style="text-align:left;">Balance of Loan Disbursement Report-Daily</h2>                              
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
                          <table id="datatable-buttons5" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>CoName</th>
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


                          <tbody id="dailydisbvalues">
                             <?php 
                                    $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                    $active=$this->DailyCmr_model->getValueofDailyLoansdisbursementinMonth($brcode,$role,$sid,$reportdate,$reportdate);
                                   
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
                              <td style="text-align:left"> <?php echo $row->shortcode;?>                              
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
                         
                             
                            
                          </tbody>
                               
                        </table>
                        </div>
                                <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                        </div>  
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
                        
<!----------------JavaScript Get Datepicker--->
         <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <script>
            var jqOld = jQuery.noConflict();
            jqOld(function() {
                jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
            });
            jqOld(function() {
                jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
            })
            jqOld(function() {
                jqOld("#dateend1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            });
            jqOld(function() {
                jqOld("#datestart1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            })
            jqOld(function() {
                jqOld("#dateend2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            });
            jqOld(function() {
                jqOld("#datestart2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            })
            jqOld(function() {
                jqOld("#dateend3" ).datepicker({ dateFormat: 'yy-mm-dd' });
            });
            jqOld(function() {
                jqOld("#datestart3" ).datepicker({ dateFormat: 'yy-mm-dd' });
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
            window.location.href="<?= site_url("loanDisb");?>";
          
        }
    </script>
    
    
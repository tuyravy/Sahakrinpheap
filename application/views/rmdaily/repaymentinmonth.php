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
                        <a href="<?= site_url('active');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('loanPort');?>">Loan Portfolio</a>
                        <a href="<?= site_url('loanDisb');?>">Loan Disbursement</a>
                        <a href="<?= site_url('writtenoffrm');?>">Loan Written-Off Collection</a>
                        <a href="<?= site_url('repayment');?>" class="active">Loan Repayment</a>
         </div>
           <div class="">  
              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="dashboard_graph x_panel">
                <div class="container">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">
                        <span class="glyphicon glyphicon-home"></span>
                       <span style="margin-left:5px;"></span>Repayment In Month</a></li>                 
                    
                    <li><a data-toggle="tab" href="#menu2">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Repayment-Daily
                        </a></li>
                    <li><a data-toggle="tab" href="#menu3">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Qualtiy Ratios-Daily
                        </a></li>
                     <li><a data-toggle="tab" href="#menu4">
                        <span class="glyphicon glyphicon-th-list"></span>
                        <span style="margin-left:5px;"></span>
                        Portfolio Quality by Product-Daily
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
                                      readonly="true" style="background:white;">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail2">To:</label>
                                     <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" value="<?= date('Y-m-d');?>" readonly="true" style="background:white;">
                                  </div> 
                                  <button type="button" class="btn btn-primary" id="repayinmonth" style="margin-top:5px;">Search</button>
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
                            <br/>
                       
                        <div id="reports">
                        <div class="col-md-12">                          
                          <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                          <h2 id="in" style="text-align:left;">Balance of Loan Repayment In Month</h2>                         
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
                              <th style="text-align:center;padding:10px 0px 25px 0px" rowspan="2">Branch</th>
                              <th style="text-align:center;padding:10px 0px 25px 0px"  rowspan="2">Granted Total</th>
                              <th colspan="5" style="text-align:center;">Existing Product Repayment</th>
                              <th colspan="5" style="text-align:center;">New Product Repayment</th>                             
                            </tr>
                            <tr style="text-align:center;">
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
                            

                          <tbody id="showrapayinmonth"> 
                               <?php 
                                
                                $result=$this->DailyCmr_model->getRepaymentInMonth($brcode,$role,$sid,$reportdate,$reportdate);
                                $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $AdminFee1=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $totalbalance=0;
                                $totalOs=0;
                                $totalex=0;
                                $totalnew=0;
                                foreach($result as $row){
                              ?>
                              <tr style="text-align:right">
                              <td style="text-align:left"><?php echo $row->shortcode;?></td>
                              <td><?php 
                                        echo number_format(
                                        $row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1
                                            ,0);
                                        
                                        $totalOs+=$row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;
                                    ?>
                               </td>
                              <td><?php echo number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,0);$totalex+=$row->Principle+$row->Interest+$row->Penalty+$row->AdminFee;?></td>
                              <td><?php echo number_format($row->Principle,0);$Principle+=$row->Principle;?></td>
                              <td><?php echo number_format($row->Interest,0);$Interest+=$row->Interest;?></td>    
                              <td><?php echo number_format($row->Penalty,0);$Penalty+=$row->Penalty;?></td> 
                              <td><?php echo number_format($row->AdminFee,0);$AdminFee+=$row->AdminFee;?></td> 
                              <td><?php echo number_format($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);$totalnew+=$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;?></td>
                              <td><?php echo number_format($row->Principle1,0);$Principle1+=$row->Principle1;?></td>
                              <td><?php echo number_format($row->Interest1,0);$Interest1+=$row->Interest1;?></td>    
                              <td><?php echo number_format($row->Penalty1,0);$Penalty1+=$row->Penalty1;?></td> 
                              <td><?php echo number_format($row->AdminFee1,0);$AdminFee1+=$row->AdminFee1;?></td>
                            </tr>
                                                      
                           
                          <?php }?>
                            <tr style="text-align:right">
                              <td style="text-align:center">Total:</td>
                             <td><?php echo number_format(round($totalOs,-2),0);?></td>
                              <td><?php echo number_format(round($totalex,-2),0);?></td>
                              <td><?php echo number_format(round($Principle,-2),0);?></td>
                              <td><?php echo number_format(round($Interest,-2),0);?></td>    
                              <td><?php echo number_format(round($Penalty,-2),0);?></td> 
                              <td><?php echo number_format(round($AdminFee,-2),0);?></td>
                              <td><?php echo number_format(round($totalnew,-2),0);?></td> 
                              <td><?php echo number_format(round($Principle1,-2),0);?></td>
                              <td><?php echo number_format(round($Interest1,-2),0);?></td>    
                              <td><?php echo number_format(round($Penalty1,-2),0);?></td> 
                              <td><?php echo number_format(round($AdminFee1,-2),0);?></td>
                            </tr>
                           
                          </tbody>
                        </table>
                       </div>
                         <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                        </div>  
                           
                        <br/>
                            
                            
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
                                  <button type="button" class="btn btn-primary" id="repaydaily" style="margin-top:5px;">Search</button>
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
                        <br/>
                            <div id="reports1">
                             <div class="col-md-12">                          
                              <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                              <h2 id="in" style="text-align:left;">Balance of Loan Repayment-Daily</h2>                         
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
                            
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th style="text-align:center;padding:10px 0px 25px 0px" rowspan="2">Branch</th>
                              <th style="text-align:center;padding:10px 0px 25px 0px"  rowspan="2">Granted Total</th>
                              <th colspan="5" style="text-align:center;">Existing Product Repayment</th>
                              <th colspan="5" style="text-align:center;">New Product Repayment</th>                             
                            </tr>
                            <tr style="text-align:center;">
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
                                $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                $result=$this->DailyCmr_model->getDailyRepayment($brcode,$role,$sid,$reportdate,$reportdate);
                                 $Principle=0;
                                $Interest=0;
                                $Penalty=0;
                                $AdminFee=0;
                                $AdminFee1=0;
                                $Principle1=0;
                                $Interest1=0;
                                $Penalty1=0;
                                $totalbalance=0;
                                 $totalOs=0;
                                $totalex=0;
                                $totalnew=0;
                                foreach($result as $row){
                              ?>
                          <tr style="text-align:right">
                              <td style="text-align:left"><?php echo $row->shortcode;?></td>
                              <td><?php 
                                        echo number_format(
                                        $row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1
                                            ,0);
                                        
                                        $totalOs+=$row->Principle+$row->Interest+$row->Penalty+$row->AdminFee+$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;
                                    ?>
                               </td>
                              <td><?php echo number_format($row->Principle+$row->Interest+$row->Penalty+$row->AdminFee,0);$totalex+=$row->Principle+$row->Interest+$row->Penalty+$row->AdminFee;?></td>
                              <td><?php echo number_format($row->Principle,0);$Principle+=$row->Principle;?></td>
                              <td><?php echo number_format($row->Interest,0);$Interest+=$row->Interest;?></td>    
                              <td><?php echo number_format($row->Penalty,0);$Penalty+=$row->Penalty;?></td> 
                              <td><?php echo number_format($row->AdminFee,0);$AdminFee+=$row->AdminFee;?></td> 
                              <td><?php echo number_format($row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1,0);$totalnew+=$row->Principle1+$row->Interest1+$row->Penalty1+$row->AdminFee1;?></td>
                              <td><?php echo number_format($row->Principle1,0);$Principle1+=$row->Principle1;?></td>
                              <td><?php echo number_format($row->Interest1,0);$Interest1+=$row->Interest1;?></td>    
                              <td><?php echo number_format($row->Penalty1,0);$Penalty1+=$row->Penalty1;?></td> 
                              <td><?php echo number_format($row->AdminFee1,0);$AdminFee1+=$row->AdminFee1;?></td>
                            </tr>
                                                      
                           
                          <?php }?>
                            <tr style="text-align:right">
                              <td style="text-align:center">Total:</td>
                              <td><?php echo number_format(round($totalOs,-2),0);?></td>
                              <td><?php echo number_format(round($totalex,-2),0);?></td>
                              
                              <td><?php echo number_format(round($Principle,-2),0);?></td>
                              <td><?php echo number_format(round($Interest,-2),0);?></td>    
                              <td><?php echo number_format(round($Penalty,-2),0);?></td> 
                              <td><?php echo number_format(round($AdminFee,-2),0);?></td>
                              <td><?php echo number_format(round($totalnew,-2),0);?></td> 
                              <td><?php echo number_format(round($Principle1,-2),0);?></td>
                              <td><?php echo number_format(round($Interest1,-2),0);?></td>    
                              <td><?php echo number_format(round($Penalty1,-2),0);?></td> 
                              <td><?php echo number_format(round($AdminFee1,-2),0);?></td>
                            </tr>
                              
                          </tbody>
                        </table>
                        </div>
                        <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                        </div>  
                           
                        <br/>
                            
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
                                      <button type="button" class="btn btn-primary" id="rationsDaily" style="margin-top:5px;">Search</button>
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
                              <h2 id="in" style="text-align:left;">Portfolio Qualtiy Ratios-Daily</h2>                         
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
                                 
                                $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                $Ratios=$this->DailyCmr_model->getPortfolioQualtiyRatiosDaily_model($brcode,$role,$sid,$reportdate,$reportdate);
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
                              
                              <td style="text-align:left"><?php echo $rows->shortcode;?></td>
                              <td><?php echo number_format($rows->BalAmt,0);$BalAmt+=$rows->BalAmt;?></td>
                              <td><?php echo number_format($rows->PAR1,0);$PAR1+=$rows->PAR1;?></td>
                              <td><?php echo number_format($rows->PAR1_Amt,0);$PAR1_Amt+=$rows->PAR1_Amt;?></td>
                              <td><?php echo number_format($rows->ParRatio1day,4)*100;$ParRatio1day+=number_format($rows->ParRatio1day,4)*100;?>%</td>
                              <td><?php echo number_format($rows->PAR7,0);$PAR7+=$rows->PAR7;?></td>
                              <td><?php echo number_format($rows->PAR7_Amt,0);$PAR7_Amt+=$rows->PAR7_Amt;?></td>
                              <td><?php echo number_format($rows->ParRatio7day,4)*100;$ParRatio7day+=number_format($rows->ParRatio7day,4)*100;?>%</td>
                              <td><?php echo number_format($rows->PAR30,0);$PAR30+=$rows->PAR30;?></td>
                              <td><?php echo number_format($rows->PAR30_Amt,0);$PAR30_Amt+=$rows->PAR30_Amt;?></td>                              <td>
                                <?php echo number_format($rows->ParRatio30day,4)*100;$ParRatio30day+=number_format($rows->ParRatio30day,4)*100;?> %
                              </td>
                            </tr>
                           <?php }?>
                            <tr style="text-align:right">
                              
                              <td style="text-align:center">Total:</td>
                              <td><?php echo number_format(round($BalAmt,-2),0);?></td>
                              <td><?php echo number_format($PAR1,0);?></td>
                              <td><?php echo number_format(round($PAR1_Amt,-2),0);?></td>
                              <td><?php echo number_format($PAR1_Amt/$BalAmt,4)*100;?>%</td>
                              <td><?php echo number_format($PAR7,0);?></td>
                              <td><?php echo number_format(round($PAR7_Amt,-2),0);?></td>
                              <td><?php echo number_format($PAR7_Amt/$BalAmt,4)*100;?>%</td>
                              <td><?php echo number_format($PAR30,0);?></td>
                              <td><?php echo number_format(round($PAR30_Amt,-2),0);?></td>
                              <td>
                                <?php  echo number_format($PAR30_Amt/$BalAmt,4)*100;?> %
                              </td>
                            </tr>
                          </tbody>
                           
                        </table>
                       </div>
                        <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                        </div>  
                           
                        <br/>
                            
                            
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
                                <button type="button" class="btn btn-primary" id="productdaily" style="margin-top:5px;">Search</button>
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
                              <h2 id="in" style="text-align:left;">Portfolio Quality by Product-Daily</h2>                         
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
                          <table id="datatable-buttons8" class="table table-striped table-bordered">
                          <thead>
                           
                              
                              <tr>
                              <th style="text-align:center;padding:10px 0px 25px 0px" rowspan="2">Branch</th>
                              <th style="text-align:center;padding:10px 0px 25px 0px" rowspan="2">Total Balance</th>
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
                                $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                $pro=$this->DailyCmr_model->getPortfolioQualitybyProductDaily($brcode,$role,$sid,$reportdate,$reportdate);
                                $PAR1EX=0;
                                $PAR7EX=0;
                                $PAR30EX=0;
                                $PAR1NE=0;
                                $PAR7NE=0;
                                $PAR30NE=0;
                                $totalBalance=0;
                                foreach($pro as $row){
                              ?>
                            <tr style="text-align:right">
                              
                              <td style="text-align:left"><?php echo $row->shortcode;?></td>
                              <td>
                                    <?php echo number_format($row->PAR1EX+$row->PAR7EX+$row->PAR30EX+$row->PAR1NE+$row->PAR7NE+$row->PAR30NE,0);
                                    $totalBalance+=$row->PAR1EX+$row->PAR7EX+$row->PAR30EX+$row->PAR1NE+$row->PAR7NE+$row->PAR30NE;
                                    ?>
                                </td>
                              <td><?php echo number_format($row->PAR1EX,0);$PAR1EX+=$row->PAR1EX;?></td>
                              <td><?php echo number_format($row->PAR7EX,0);$PAR7EX+=$row->PAR7EX;?></td>
                              <td><?php echo number_format($row->PAR30EX,0);$PAR30EX+=$row->PAR30EX;?></td>
                              <td><?php echo number_format($row->PAR1NE,0);$PAR1NE+=$row->PAR1NE;?></td>                             
                              <td><?php echo number_format($row->PAR7NE,0);$PAR7NE+=$row->PAR7NE;?></td>                           
                             <td><?php echo number_format($row->PAR30NE,0);$PAR30NE+=$row->PAR30NE;?></td>
                            </tr>
                            <?php }?>
                            <tr style="text-align:right">
                              
                              <td style="text-align:center">Total:</td>
                              <td><?php echo number_format($totalBalance,0);?></td>
                              <td><?php echo number_format($PAR1EX,0);?></td>
                              <td><?php echo number_format($PAR7EX,0);?></td>
                              <td><?php echo number_format($PAR30EX,0);?></td>
                              <td><?php echo number_format($PAR1NE,0);?></td>                             
                              <td><?php echo number_format($PAR7NE,0);?></td>                           
                             <td><?php echo number_format($PAR30NE,0);?></td>
                            </tr>
                          </tbody>
                           
                        </table>
                        </div>
                            <div style="margin-top: 25px;margin-bottom: -12px;">
                            <label>Total <span class="label label-default"><?= $total_rows=$this->DailyCmr_model->record_count(); ?></span> records</label>
                        </div>  
                          
                        <br/>
                        
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

        
        <!-- /page content -->
  
       
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
            window.location.href="<?= site_url("repayment");?>";
          
        }
    </script>

    
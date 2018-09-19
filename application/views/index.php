<div class="">
          <?php
          foreach($history as $row){
           ?>
            <div class="row top_tiles">
                   
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                      <div class="icon"></div>
                      <div class="count" style="font-size:25px;"><?php echo number_format($row->Active,0);?></div>
                      <p>Number of Loan Active</p>
                  </div>
                </div>

                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"></div>
                      <div class="count" style="font-size:25px;">
                        <?php echo  number_format($row->Disbursement,0);?>
                      </div>
                      <p>Number of Loan Disbursement In Month</p>
                    </div>
                </div>

                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                    <div class="icon"></div>
                    <div class="count" style="font-size:25px;">
                    <span style="padding:5px;">
                      <?php echo number_format($row->PARRaito1DAY*100,2);?>
                    </span>%</div>
                    <p>PAR Raito 1Days-Daily</p>
                  </div>
                </div>
            
             
          </div>
              
              
        <div class="row top_tiles">
                   
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                    <div class="tile-stats">

                      <div class="icon"></div>

                      <div class="count" style="font-size:25px;">
                      <?php echo  number_format($row->OS,0);?>
                      </div>
                      <p>Balance of Loan Outstanding-KHR</p>
                    </div>

                </div>

              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="tile-stats">

                    <div class="icon"></div>

                    <div class="count" style="font-size:25px;">                    
                      <?php echo number_format($row->BalanceDisbursement,0);?>                      
                    </div>                  

                    <p>Balance of Loan Disbursement in Month-KHR</p>

                  </div>

              </div>

              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="tile-stats">

                  <div class="icon"></div>

                  <div class="count" style="font-size:25px;">
                  <span style="padding:5px;">
                    <?php echo number_format($row->PARRaito7DAY*100,2);?>
                  </span>%</div>

                  <p>PAR Raito 7Days-Daily</p>
                </div>
              </div>
              
        </div>

        <div class="row top_tiles">
                   
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                    <div class="tile-stats">

                      <div class="icon"></div>

                      <div class="count" style="font-size:25px;">
                      <i class="icon-usd" style="margin-left:2px;"></i>
                      <span style="padding:2px;"><?php echo  number_format($row->OS/4000,0);?></span>
                      </div>
                      <p>Balance of Loan Outstanding-USD</p>
                    </div>

                </div>

              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="tile-stats">

                    <div class="icon"></div>

                    <div class="count" style="font-size:25px;">
                    <i class="icon-usd" style="margin-left:2px;"></i>
                      <span style="padding:2px;">
                      <?php echo number_format($row->BalanceDisbursement/4000,0);?>
                      </span>
                    </div>                  

                    <p>Balance of Loan Disbursement in Month-USD</p>

                  </div>

              </div>

              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="tile-stats">

                  <div class="icon"></div>

                  <div class="count" style="font-size:25px;">
                    <span style="padding:5px;"><?php echo number_format($row->PARRaito30DAY*100,2);?></span>%</div>

                  <p>PAR Raito 30Days-Daily</p>
                </div>
              </div>
              
        </div>

        <?php }?>

      
      <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
                <h2><span class="glyphicon glyphicon-tasks"></span><span style="margin-left:10px;">Previous month and Actual</span><small></small></h2>
                <div class="clearfix"></div>
          </div>
                  <div class="x_content">
                      <!-----------------Talble Not Yet Upload------------>
                      <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                  <table class="table table-bordered table-striped">
                                    <thead>
                                      <tr style="background-color:#5aadea;color:#ffffff;white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">No.</th>
                                        <th style="text-align:center;white-space: nowrap;overflow: hidden;">Indicators</th>
                                        <th style="text-align:center">Previous month</th>
                                        <th style="text-align:center">Actual</th>
                                        <th style="text-align:center">Variance</th>
                                      </tr>
                                    </thead>
                                    <?php                                
                                        foreach($history as $row){
                                    ?>
                                    <tbody>                                        
                                    <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">1</th>
                                        <th>Number of Loan Active</th>
                                        <td style="text-align:right"><?php echo  number_format($row->Active_pre,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Active,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Active-$row->Active_pre,0);?></td>
                                      </tr>                                       
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">2</th>
                                        <th>Balance of Loan Outstanding-KHR</th>
                                        <td style="text-align:right"><?php echo  number_format($row->OS_pre,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->OS,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->OS-$row->OS_pre,0);?></td>
                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">3</th>
                                        <th>Balance of Loan Outstanding-USD</th>
                                        <td style="text-align:right;font-weight:bold;">
                                          <i class="icon-usd" style="margin-left:2px;"></i>
                                          <?php echo  number_format($row->OS_pre/4000,0);?>
                                        </td>
                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo  number_format($row->OS/4000,0);?></td>
                                        <td style="text-align:right;font-weight:bold;">
                                         <i class="icon-usd" style="margin-left:2px;"></i>
                                          <?php echo  number_format(($row->OS-$row->OS_pre)/4000,0);?>
                                        </td>
                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">4</th>
                                        <th>Number of Loan Disbursement In Month</th>
                                        <td style="text-align:right"><?php echo  number_format($row->Disbursement_pre,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Disbursement,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Disbursement-$row->Disbursement_pre,0);?></td>
                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">5</th>
                                        <th>Balance of Loan Disbursement in Month-KHR</th>

                                        <td style="text-align:right"><?php echo number_format($row->BalanceDisbursement_pre,0);?></td>

                                        <td style="text-align:right"> <?php echo number_format($row->BalanceDisbursement,0);?></td>

                                        <td style="text-align:right"><?php echo number_format($row->BalanceDisbursement-$row->BalanceDisbursement_pre,0);?></td>

                                      </tr>
                                       <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">6</th>
                                        <th>Balance of Loan Disbursement in Month-USD</th>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format($row->BalanceDisbursement_pre/4000,0);?></td>

                                        <td style="text-align:right"> 
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format($row->BalanceDisbursement/4000,0);?>
                                        </td>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format(($row->BalanceDisbursement-$row->BalanceDisbursement_pre)/4000,0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                       <th style="text-align:center">7</th>
                                        <th>Balance of Loan Written-off Collection in Month-KHR</th>

                                        <td style="text-align:right"><?php echo  number_format($row->BalanceWrittenoff_pre,0);?></td>

                                        <td style="text-align:right"><?php echo  number_format($row->BalanceWrittenoff,0);?></td>

                                        <td style="text-align:right"><?php echo  number_format($row->BalanceWrittenoff-$row->BalanceWrittenoff_pre,0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">8</th>
                                        <th>Balance of Loan Written-off Collection in Month-USD</th>

                                        <td style="text-align:right"><i class="icon-usd" style="margin-left:2px;"></i> <?php echo  number_format($row->BalanceWrittenoff_pre/4000,0);?></td>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo  number_format($row->BalanceWrittenoff/4000,0);?>
                                        </td>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo  number_format(($row->BalanceWrittenoff-$row->BalanceWrittenoff_pre)/4000,0);?></td>

                                      </tr>
                                      
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">9</th>
                                        <th>Values PAR 1Days-Daily KHR</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format($row->VALUESPAR1DAY_pre,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->VALUESPAR1DAY,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->VALUESPAR1DAY-$row->VALUESPAR1DAY_pre),0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">10</th>
                                        <th>Values PAR 1Days-Daily USD</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format($row->VALUESPAR1DAY_pre/4000,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                            <?php echo number_format($row->VALUESPAR1DAY/4000,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format(($row->VALUESPAR1DAY-$row->VALUESPAR1DAY_pre)/4000,0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">11</th>
                                        <th>Values PAR 7Days-Daily</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format($row->VALUESPAR7DAY_pre,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->VALUESPAR7DAY,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->VALUESPAR7DAY-$row->VALUESPAR7DAY_pre),0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">12</th>
                                        <th>Values PAR 30Days-Daily</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format($row->VALUESPAR30DAY_pre,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->VALUESPAR30DAY,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->VALUESPAR30DAY-$row->VALUESPAR30DAY_pre),0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">13</th>
                                        <th>PAR Raito 1Days-Daily</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format($row->PARRaito1DAY_pre*100,2);?>%</td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->PARRaito1DAY*100,2);?>
                                            %</td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->PARRaito1DAY-$row->PARRaito1DAY_pre)*100,2);?>%</td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">14</th>
                                        <th>PAR Raito 7Days-Daily</th>

                                        <td style="text-align:right">
                                        <?php echo number_format($row->PARRaito7DAY_pre*100,2);?>%
                                        </td>

                                        <td style="text-align:right">
                                         <?php echo number_format($row->PARRaito7DAY*100,2);?>%</td>

                                        <td style="text-align:right"><?php echo number_format(($row->PARRaito7DAY-$row->PARRaito7DAY_pre)*100,2);?>%</td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                       <th style="text-align:center">15</th>
                                        <th>PAR Raito 30Days-Daily</th>

                                        <td style="text-align:right"><?php echo number_format($row->PARRaito30DAY_pre*100,2);?>%</td>

                                        <td style="text-align:right">
                                        <?php echo number_format($row->PARRaito30DAY*100,2);?>%</td>

                                        <td style="text-align:right">
                                          <?php echo number_format(($row->PARRaito30DAY-$row->PARRaito30DAY_pre)*100,2);?>%
                                        </td>

                                      </tr>                                     
                                      
                                      <tr class="active">
                                       <th colspan="5"></th>
                                        

                                      </tr>
                                    </tbody>
                                        <?php }?>
                                  </table>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                </div>
              </div>   
          </div 
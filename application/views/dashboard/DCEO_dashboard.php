<div class="">
           
            
            
            <div class="row top_tiles">                   
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                      <div class="icon"></div>
                      <div class="count" style="font-size:25px;"><?php echo number_format($row->NumOfActive,0);?></div>
                      <p>Number of Loan Active</p>
                  </div>
                </div>

                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"></div>
                      <div class="count" style="font-size:25px;">
                        <?php echo  number_format($row->NumberofLoanDisbursement,0);?>
                      </div>
                      <p>Number of Loan Disbursement In Month</p>
                    </div>
                </div>

                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                    <div class="icon"></div>
                    <div class="count" style="font-size:25px;">
                    <span style="padding:5px;">
<<<<<<< .merge_file_a16956
                      <?php if($row->PAR1DAY==0){ echo 0;}else{ echo number_format($row->PAR1DAY/$row->Balance*100,2);}?>
=======
                      <?php echo number_format($row->PAR1DAY/$row->Balance*100,2);?>
>>>>>>> .merge_file_a16164
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
                      <?php echo  number_format($row->Balance,0);?>
                      </div>
                      <p>Balance of Loan Outstanding-KHR</p>
                    </div>

                </div>

              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                  <div class="tile-stats">

                    <div class="icon"></div>

                    <div class="count" style="font-size:25px;">                    
                      <?php echo number_format($row->Balance_Disbursed,0);?>                      
                    </div>                  

                    <p>Balance of Loan Disbursement in Month-KHR</p>

                  </div>

              </div>

              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="tile-stats">

                  <div class="icon"></div>

                  <div class="count" style="font-size:25px;">
                  <span style="padding:5px;">
<<<<<<< .merge_file_a16956
                    <?php if($row->PAR7DAY==0){echo 0;}else{echo number_format($row->PAR7DAY/$row->Balance*100,2);}?>
=======
                    <?php echo number_format($row->PAR7DAY/$row->Balance*100,2);?>
>>>>>>> .merge_file_a16164
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
                      <span style="padding:2px;"><?php echo  number_format($row->Balance/4000,0);?></span>
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
                      <?php echo number_format($row->Balance_Disbursed/4000,0);?>
                      </span>
                    </div>                  

                    <p>Balance of Loan Disbursement in Month-USD</p>

                  </div>

              </div>

              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="tile-stats">

                  <div class="icon"></div>

                  <div class="count" style="font-size:25px;">
<<<<<<< .merge_file_a16956
                    <span style="padding:5px;"><?php if($row->PAR30DAY==0){echo 0;}else{echo number_format($row->PAR30DAY/$row->Balance*100,2);}?></span>%</div>
=======
                    <span style="padding:5px;"><?php echo number_format($row->PAR30DAY/$row->Balance*100,2);?></span>%</div>
>>>>>>> .merge_file_a16164

                  <p>PAR Raito 30Days-Daily</p>
                </div>
              </div>
              
        </div>

     

      
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
                                   
                                    <tbody>                                        
                                    <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">1</th>
                                        <th>Number of Loan Active</th>
                                        <td style="text-align:right"><?php echo  number_format($pre->NumOfActive,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->NumOfActive,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->NumOfActive-$pre->NumOfActive,0);?></td>
                                      </tr>                                       
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">2</th>
                                        <th>Balance of Loan Outstanding-KHR</th>
                                        <td style="text-align:right"><?php echo  number_format($pre->Balance,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Balance,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Balance-$pre->Balance,0);?></td>
                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">3</th>
                                        <th>Balance of Loan Outstanding-USD</th>
                                        <td style="text-align:right;font-weight:bold;">
                                          <i class="icon-usd" style="margin-left:2px;"></i>
                                          <?php echo  number_format($pre->Balance/4000,0);?>
                                        </td>
                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo  number_format($row->Balance/4000,0);?></td>
                                        <td style="text-align:right;font-weight:bold;">
                                         <i class="icon-usd" style="margin-left:2px;"></i>
                                          <?php echo  number_format(($row->Balance-$pre->Balance)/4000,0);?>
                                        </td>
                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">4</th>
                                        <th>Number of Loan Disbursement In Month</th>
                                        <td style="text-align:right"><?php echo  number_format($pre->Balance_Disbursed,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Balance_Disbursed,0);?></td>
                                        <td style="text-align:right"><?php echo  number_format($row->Balance_Disbursed-$pre->Balance_Disbursed,0);?></td>
                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">5</th>
                                        <th>Balance of Loan Disbursement in Month-KHR</th>

                                        <td style="text-align:right"><?php echo number_format($pre->Balance_Disbursed,0);?></td>

                                        <td style="text-align:right"> <?php echo number_format($row->Balance_Disbursed,0);?></td>

                                        <td style="text-align:right"><?php echo number_format($row->Balance_Disbursed-$pre->Balance_Disbursed,0);?></td>

                                      </tr>
                                       <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">6</th>
                                        <th>Balance of Loan Disbursement in Month-USD</th>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format($pre->Balance_Disbursed/4000,0);?></td>

                                        <td style="text-align:right"> 
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format($row->Balance_Disbursed/4000,0);?>
                                        </td>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format(($row->Balance_Disbursed-$pre->Balance_Disbursed)/4000,0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                       <th style="text-align:center">7</th>
                                        <th>Balance of Loan Written-off Collection in Month-KHR</th>

                                        <td style="text-align:right"><?php echo  number_format($pre->wirttenoff_pre,0);?></td>

                                        <td style="text-align:right"><?php echo  number_format($row->wirttenoff,0);?></td>

                                        <td style="text-align:right"><?php echo  number_format($row->wirttenoff-$pre->wirttenoff_pre,0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">8</th>
                                        <th>Balance of Loan Written-off Collection in Month-USD</th>

                                        <td style="text-align:right"><i class="icon-usd" style="margin-left:2px;"></i> <?php echo  number_format($pre->wirttenoff_pre/4000,0);?></td>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo  number_format($row->wirttenoff/4000,0);?>
                                        </td>

                                        <td style="text-align:right">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo  number_format(($row->wirttenoff-$pre->wirttenoff_pre)/4000,0);?></td>

                                      </tr>
                                      
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">9</th>
                                        <th>Values PAR 1Days-Daily KHR</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format($pre->PAR1DAY,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->PAR1DAY,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->PAR1DAY-$pre->PAR1DAY),0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">10</th>
                                        <th>Values PAR 1Days-Daily USD</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format($pre->PAR1DAY/4000,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                            <?php echo number_format($row->PAR1DAY/4000,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <i class="icon-usd" style="margin-left:2px;"></i>
                                        <?php echo number_format(($row->PAR1DAY-$pre->PAR1DAY)/4000,0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">11</th>
                                        <th>Values PAR 7Days-Daily</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format($pre->PAR7DAY,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->PAR7DAY,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->PAR7DAY-$pre->PAR7DAY),0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">12</th>
                                        <th>Values PAR 30Days-Daily</th>

                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format($pre->PAR30DAY,0);?></td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->PAR30DAY,0);?>
                                            </td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->PAR30DAY-$pre->PAR30DAY),0);?></td>

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;background-color:rgba(255, 196, 0, 0.5);font-weight:bold;">
                                        <th style="text-align:center">13</th>
                                        <th>PAR Raito 1Days-Daily</th>

                                        <td style="text-align:right;font-weight:bold;">
<<<<<<< .merge_file_a16956
                                        <?php if($pre->PAR1DAY==0){echo 0;}else{echo number_format($pre->PAR1DAY/$pre->Balance*100,2);}?>%</td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php if($row->PAR1DAY==0){echo 0;}else{echo number_format($row->PAR1DAY/$row->Balance*100,2);}?>
                                            %</td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php if($row->PAR1DAY==0){echo 0;}else{ echo number_format(($row->PAR1DAY/$row->Balance-$pre->PAR1DAY/$pre->Balance)*100,2);}?>%</td>
=======
                                        <?php echo number_format($pre->PAR1DAY/$pre->Balance*100,2);?>%</td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->PAR1DAY/$row->Balance*100,2);?>
                                            %</td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->PAR1DAY/$row->Balance-$pre->PAR1DAY/$pre->Balance)*100,2);?>%</td>
>>>>>>> .merge_file_a16164

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                        <th style="text-align:center">14</th>
                                        <th>PAR Raito 7Days-Daily</th>

                                       <td style="text-align:right;font-weight:bold;">
<<<<<<< .merge_file_a16956
                                        <?php if($pre->PAR7DAY==0){echo 0;}else{echo number_format($pre->PAR7DAY/$pre->Balance*100,2);}?>%</td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php if($row->PAR7DAY==0){echo 0;}else{echo number_format($row->PAR7DAY/$row->Balance*100,2);}?>
                                            %</td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php if($row->PAR7DAY==0){echo 0;}else{echo number_format(($row->PAR7DAY/$row->Balance-$pre->PAR7DAY/$pre->Balance)*100,2);}?>%</td>
=======
                                        <?php echo number_format($pre->PAR7DAY/$pre->Balance*100,2);?>%</td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->PAR7DAY/$row->Balance*100,2);?>
                                            %</td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->PAR7DAY/$row->Balance-$pre->PAR7DAY/$pre->Balance)*100,2);?>%</td>
>>>>>>> .merge_file_a16164

                                      </tr>
                                      <tr style="white-space: nowrap;overflow: hidden;">
                                       <th style="text-align:center">15</th>
                                        <th>PAR Raito 30Days-Daily</th>

                                         <td style="text-align:right;font-weight:bold;">
<<<<<<< .merge_file_a16956
                                        <?php if($pre->PAR30DAY==0){echo 0;}else{echo number_format($pre->PAR30DAY/$pre->Balance*100,2);}?>%</td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php if($row->PAR30DAY==0){echo 0;}else{echo number_format($row->PAR30DAY/$row->Balance*100,2);}?>
                                            %</td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php if($row->PAR30DAY==0){echo 0;}else{echo number_format(($row->PAR30DAY/$row->Balance-$pre->PAR30DAY/$pre->Balance)*100,2);}?>%</td>
=======
                                        <?php echo number_format($pre->PAR30DAY/$pre->Balance*100,2);?>%</td>

                                        <td style="text-align:right;font-weight:bold;">
                                       
                                            <?php echo number_format($row->PAR30DAY/$row->Balance*100,2);?>
                                            %</td>                                           
                                        <td style="text-align:right;font-weight:bold;">
                                        <?php echo number_format(($row->PAR30DAY/$row->Balance-$pre->PAR30DAY/$pre->Balance)*100,2);?>%</td>
>>>>>>> .merge_file_a16164

                                      </tr>                                     
                                      
                                      <tr class="active">
                                       <th colspan="5"></th>
                                        

                                      </tr>
                                    </tbody>
                                       
                                  </table>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                </div>
              </div>   
          </div 
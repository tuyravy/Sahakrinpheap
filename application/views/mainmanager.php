
<style>
    .font13{
        font-size: 14px;
    }
</style>
<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>



<script>
        $(window).load(function(){
                $('#onload').modal('show');
            });
</script>

 <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                
                <div class="row" role="main" style="background-color: white;padding:10px;">
                    <div class="clearfix"></div>
                    <?php
                                $reportdate=date('Ymd',strtotime($this->Menu_model->getCurrRundate()));
                                 $systemid=$this->session->userdata('system_id');
                                 $history=$this->DailyCmr_model->gethistorydetailbyDECO($reportdate);
                                 foreach($history as $row){
                    ?>
                    <div class="row">
                        <!--current balance SKP-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">Number of Loan Active In Month</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo number_format($row->Active,0);?></span></h1>
                            </div>
                        </div>
                        <!--current balance MMI-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">Number of Loan Disbursement In Month</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo number_format($row->Disbursement,0);?></span></h1>
                            </div>
                        </div>
                        <!--current balance FSS-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-users"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">Number of Loan Close in Month</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo number_format($row->Closes,0);?></span></h1>
                            </div>
                        </div>
                        <!--pending cash request-->
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">Balance of loan Outstanding-KHR</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo  number_format($row->OS,0);?></span><span>៛</span></h1>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon" style="margin-top:5px;"></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">Balance of Loan Disbursement in Month-KHR</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo number_format($row->BalanceDisbursement,0);?></span><span>៛</span></h1>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon" style='margin-top:5px;'></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">Balance of Loan Written-off Collection in Month-KHR</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo  number_format($row->BalanceWrittenoff,0);?></span><span>៛</span></h1>
                            </div>
                        </div>
                         
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3  class="font13" style="margin-top: 10px;">Balance of Loan Outstanding-USD</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1>
                                    <i class="icon-usd" style="margin-left:10px;"></i>
                                    <span style="padding:10px;"><?php echo  number_format($row->OS/4000,0);?></span>
                                </h1>
                            </div>
                        </div>
                         <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"  style="margin-top:5px;"></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">Balance of Loan Disbursement in Month-USD</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1>
                                    <i class="icon-usd" style="margin-left:10px;"></i>
                                    <span style="padding:10px;"><?php echo number_format($row->BalanceDisbursement/4000,0);?></span>
                                </h1>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon" style='margin-top:5px;'></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">Balance of Loan Written-off Collection in Month-USD</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1>
                                    <i class="icon-usd" style="margin-left:10px;"></i>
                                    <span style="padding:10px;"><?php echo  number_format($row->BalanceWrittenoff/4000,0);?></span></h1>
                            </div>
                        </div>
                         
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-pie-chart"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">PAR Raito 1Days-Daily</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo number_format($row->PARRaito1DAY*100,2);?></span>%</h1>
                            </div>
                        </div>
                         
                         <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-pie-chart"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">PAR Raito 7Days-Daily</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo number_format($row->PARRaito7DAY*100,2);?></span>%</h1>
                            </div>
                        </div>
                         <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-pie-chart"></i></div>
                                <div class="count" style="font-size: 20px"></div>
                                <h3 class="font13" style="margin-top: 10px;">PAR Raito 30Days-Daily</h3>
                                <p><a href="javascript:void(0)">&nbsp;</a></p>
                                <h1><span style="padding:10px;"><?php echo number_format($row->PARRaito30DAY*100,2);?></span>%</h1>
                            </div>
                        </div>
                    </div>
                    <?php }?>  
            </div>
            </div>
           
            <?php $count=$this->Menu_model->getNotyatupload();
                if($count==0){
            ?>
                    
            <?php 
            if($profile=$this->session->userdata('profile')==1){
            ?>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">

                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i><span style="margin-left:10px;"></span>System Request Change Profile</h4>
                    </div>
                    <div class="modal-body" style="text-align:center">
                     <h2>Do you want to change your profile ?</h2>
                     <p><span class="glyphicon glyphicon-hand-right"></span><a href="http://app.sahakrinpheap.com/skp_reports/home/changeprofile" style="margin-left:10px;color:#001dff">Please Click Here</a></p>
                    </div>

                  </div>

                </div>
            </div>
            <?php }?>


            <?php
                }else{
            ?>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Branch Not Yet Upload</h4>
                  </div>
                  <div class="modal-body">
                   
                         <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                     
                    <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                           
                            <th class="column-title">Branch Khmer </th>
                            <th class="column-title">Branch Eng </th>
                           
                            
                          </tr>
                        </thead>

                        <tbody>
                        <?php 
                            $res=$this->Menu_model->getNotyetuploadbranch();
                            foreach($res as $row){?>
                          <tr class="even pointer">
                           
                            <td class=" "><?php echo $row->brNamekh;?></td>
                            <td class=" "><?php echo $row->brName;?></td>
                                                       
                           
                          </tr>
                         <?php }?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                   </div>
                  </div>
                    
                   
                  
                  </div>
                  <div class="modal-footer">
                   
                  </div>
                </div><!-- /.modal-content -->
              </div>
            </div>
    <?php }?>
            

<script>
    function load()
    {
       
        $(".bs-example-modal-lg").modal("show");
    }
    window.onload = load;

</script>
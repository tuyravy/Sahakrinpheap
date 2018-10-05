
<style>
    .font13{
        font-size: 14px;
    }
</style>

<div class="row" role="main">
    <div class="clearfix"></div>
    <?php
                
                 foreach($history as $row){
    ?>
    <div class="row">
        <!--current balance SKP-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3  class="font13" style="margin-top: 10px;">Number of loans active in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php echo number_format($row->activeloan,0);?></span></h1>
            </div>
        </div>
        <!--current balance MMI-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon" style="margin-top:5px;"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3  class="font13" style="margin-top: 10px;">Number of loans disbursement in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php echo number_format($row->disbloan,0);?></span></h1>
            </div>
        </div>
        <!--current balance FSS-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3  class="font13" style="margin-top: 10px;">Number of loan written-off in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php echo number_format($row->woloan,0);?></span></h1>
            </div>
        </div>
        <!--pending cash request-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-pie-chart"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3 class="font13" style="margin-top: 10px;">Number of loan PAR>90days</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php echo number_format($row->pastloan,0);?></span></h1>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon" style="margin-top:10px;"></div>
                <div class="count" style="font-size: 20px"></div>
                <h3 class="font13" style="margin-top: 10px;">Balance of loan written-off collection in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php echo number_format($row->WoAmt,0);?> /
                     <?php echo number_format($row->AccCollectWOInmonth,0);?></span></h1>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3 class="font13" style="margin-top: 10px;">Total number of loan closed in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php echo number_format($row->closeloan,0);?></span></h1>
            </div>
        </div>
    </div>
    <?php }?>  
</div>



<!-- page content -->
          <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
          
           
              
              
            
            <?php $count=$this->Menu_model->getNotyatupload();
                if($count==0){
            
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
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Branch Khmer </th>
                            <th class="column-title">Branch Eng </th>
                            <th class="column-title">Branch Short </th>
                            <th class="column-title">BranchCode </th>                                                       
                            <th class="column-title no-link last"><span class="nobr">Status</span></th>
                            
                          </tr>
                        </thead>

                        <tbody>
                        <?php 
                            $res=$this->Menu_model->getNotyetuploadbranch();
                            foreach($res as $row){?>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" "><?php echo $row->brNamekh;?></td>
                            <td class=" "><?php echo $row->brName;?></td>
                            <td class=" "><?php echo $row->shortcode;?> </td>
                            <td class=" "><?php echo $row->brCode;?></td>                                        
                            <td class="a-right a-right "><a href="">Not Yet Upload</a></td>                           
                           
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                  </div>
                </div><!-- /.modal-content -->
              </div>
            </div>
<?php 
        }
    ?>

                
                
        
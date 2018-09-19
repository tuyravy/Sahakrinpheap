
<style>
    .font13{
        font-size: 14px;
    }
</style>

<div class="row" role="main">
    <div class="clearfix"></div>
    <?php
                 $reportdate=date('Ymd',strtotime($this->Menu_model->getCurrRundate()));
                 $systemid=$this->session->userdata('system_id');
                 $history=$this->DailyCmr_model->gethistorydetailbyRm($systemid,$reportdate);
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
          
            <div class="row">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Total Employee <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <?php 
                      $summary=$this->DailyCmr_model->GetEmployee($systemid);
                      
                      ?>

                    <div class="widget_summary">
                      <div class="w_left w_55">
                       <span class="glyphicon glyphicon-play"></span> <span>Branch Manager</span>
                      </div>
                      
                      <div class="w_right w_20">
                        
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->BranchManager;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                       <span class="glyphicon glyphicon-play"></span> <span>Chief Credit Officer</span>
                      </div>
                      
                      <div class="w_right w_20">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->BranchCreditManager;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                       <span class="glyphicon glyphicon-play"></span> <span>Branch Teller</span>
                      </div>
                      
                      <div class="w_right w_20">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->BranchTeller;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                       <span class="glyphicon glyphicon-play"></span> <span>Branch Cashier</span>
                      </div>
                      
                      <div class="w_right w_20">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->BranchCashier;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                      <span class="glyphicon glyphicon-play"></span>  <span>Branch Accountant</span>
                      </div>
                      
                      <div class="w_right w_20">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->BranchAccountant;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                       <span class="glyphicon glyphicon-play"></span> <span>Loan Recovery Officer</span>
                      </div>
                      
                      <div class="w_right w_20">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->LoanRecoveryOfficer;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                       <span class="glyphicon glyphicon-play"></span> <span>Specialist Credit Officer</span>
                      </div>
                      
                      <div class="w_right w_20">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->SpecialistCreditOfficer;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                       <span class="glyphicon glyphicon-play"></span> <span>General Credit Officer</span>
                      </div>
                      
                      <div class="w_right w_25">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->GeneralCreditOfficer;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                      <div class="w_left w_55">
                      <span class="glyphicon glyphicon-play"></span>  <span>Cleaner|Guard</span>
                      </div>
                      
                      <div class="w_right w_25">
                        <span style="font-size:16px;"><?php $sum=0;foreach($summary as $row){$sum+=$row->GuardCleaner;};echo $sum;?> នាក់</span>
                      </div>
                      <div class="clearfix"></div>
                     
                    </div>
                  </div>
                    
                </div>
              </div>

              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Employee Leaves <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:20%;">
                        <p>BrName</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-7">
                          <p class="" style="margin-left:5px;">Request</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-5">
                          
                        </div>
                      </th>
                    </tr>
                      <?php 
                       
                       $leaves=$this->DailyCmr_model->getEleaves($systemid,$reportdate);
                        foreach($leaves as $row)
                        {
                      ?>
                    <tr>
                      <td>
                         <i class="fa fa-check-circle" aria-hidden="true"></i>
                          <span style="margin-left:5px"><?= $row->shortcode;?></span>
                      </td>
                      <td >
                         <span style="margin-left:15px;"><?= $row->numberrequest;?></span>
                         <span style="color:red;margin-left:10px;">(Pendding)</span>
                      </td>
                      <td>
                         <a href="http://www.app.sahakrinpheap.com/eleaves/login">Click here</a>
                      </td>
                    </tr>
                    <?php }?>
                  </table>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Employee Login <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">
                     
                    <table class="" style="width:100%">
                        <tr>
                          <th style="width:70%;">
                            <p>BrName</p>
                          </th>
                          <th>

                              <p class="">Status</p>


                          </th>
                        </tr>
                     <?php 
                                $loginhis=$this->DailyCmr_model->getactionlogin($systemid);
                                
                                foreach($loginhis as $row){
                                
                    ?>
                    <tr>
                      <td>
                       <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <span style="margin-left:5px;"><?= $row->brName;?></span>
                      </td>
                      <td>
                            <a href="">Active</a>
                      </td>
                    </tr>
                            
                    <?php }?>
                  </table>
                     
                    </div>
                  </div>
                </div>
              </div>
            
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
<script>
        $(window).load(function(){
                $('#onload').modal('show');
            });
</script>
<script>
    function load()
    {
       
        $(".bs-example-modal-lg").modal("show");
    }
    window.onload = load;

</script>
                
                
              
        <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    </script>
  <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons1").length) {
            $("#datatable-buttons1").DataTable({
              dom: "Bfrtip",
              buttons: [
                
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    </script>
    
    <!-- /Datatables -->
        <!-- /page content -->
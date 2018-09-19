<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>

          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reports Leaves</h2>
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
                    <div align="center">
                      <form class="form-inline">
                          
                          <div class="form-group">
                            <label for="exampleInputName2">Department:</label>
                            <select name="dpt" class="form-control">
                                <option value="0">Select Department</option>
                                <?php foreach($department as $row){?>
                                <option value="<?php echo $row->dpt_id;?>"><?php echo $row->dpt_name;?></option>
                                <?php }?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName2">Report Date:</label>
                            <input type="text" class="form-control" id="datestart" name="datestart" placeholder="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail2">To:</label>
                            <input type="text" class="form-control" id="dateend" name="dateend" placeholder="">
                          </div>
                          <button type="submit" class="btn btn-primary" style="margin-top:5px;">Submit</button>
                     </form>
                        
                        
                    </div>
                      
                      
                      
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>StaffName</th>
                          <th>Position</th>
                          <th>Department</th>
                          <th>TimesWorkingday</th>
                          <th>Overtime</th>
                          <th>Leaves</th>
                          <th>Late</th>
                          <th>BonusOT</th>
                          <th>BonusOther</th>
                          <th>BasicSalary</th>
                          <th>More</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                            
                            
                            
                            $this->load->model('reports_model');
                            $startdate=0;
                            if(isset($_GET['dpt'])){$dpt=$_GET['dpt'];};
                            if(isset($_GET['datestart'])){$startdate=date("Y-m-d",strtotime($_GET['datestart']));};
                            if(isset($_GET['dateend'])){$enddate=date('Y-m-d',strtotime($_GET['dateend']));};
                            if($startdate==0)
                            {
                                $month=date('m')-2;
                                $startdate=date('Y-0'.$month.'-01');
                                $enddate=date('Y-m-d');
                                $dpt=0;
                                $detail=$this->reports_model->getreportdetail($startdate,$enddate,$dpt);
                            }
                            else
                            {
                                
                                
                                $detail=$this->reports_model->getreportdetail($startdate,$enddate,$dpt);
                            }
                            
                            foreach($detail as $row){
                        ?>
                        <tr>
                          <td><?php echo $row->en_name;?></td>
                          <td><?php echo $row->description;?></td>
                          <td><?php echo $row->dpt_name;?></td>
                          <td><?php echo round($row->Workingday,2);?></td>
                          <td><?php echo round($row->overtime,2);?></td>
                          <td><?php echo round($row->leaves,2);?></td>
                          <td><?php echo round($row->late,2);?></td>
                          <td><?php echo $row->bonus_ot;?></td>
                          <td><?php echo $row->bonus_other;?></td>
                          <td><?php echo $row->basic_salary;?></td>
                          <td><a href="<?php echo site_url('report_Controller/reportsviews');?>/<?php echo $row->system_ID;?>/<?php echo $startdate;?>/<?php echo $enddate;?>">
                              <span class="glyphicon glyphicon-file"></span></a></td>
                        </tr>
                            <?php } ?>
                      </tbody>
                    </table>
                      
                  </div>
                </div>
              </div>

              

              
        <!-- /page content -->

     
   <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
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
   
    <script type="text/javascript">
$(function() {
    $('input[name="datestart"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    },
    
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        
    });
});
$(function() {

    $('input[name="dateend"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    },
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        
    });
});
</script>

   
    
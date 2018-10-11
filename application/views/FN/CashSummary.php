        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>  
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
         <!-- page content -->
         <div role="main">
            <div class="">
              <div class="clearfix"></div>  
              <div class="row">
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_title">
                    <span class="glyphicon glyphicon-align-justify"></span><span style="margin-left:10px;">Daily Cash Movement Summary</span>
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
                      <div class="row">
                          <div class="col-md-12">
                              <form class="form-inline" action="<?php echo site_url('DailyCash/CashSummary');?>" method="post">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group" style="margin-top:-10px;">                                       
                                          <label for="exampleInputName2">FITTER BRACH</label>
                                          <div class="row-fluid">
                                          <select class="selectpicker" id="brname" data-show-subtext="true" data-live-search="true" name="brname" required>
                                            <option data-subtext="Select by RM" value="">Select</option>
                                            <?php 
                                              if(isset($role)==2){
                                           
                                              foreach($brlist as $row){
                                                if(isset($brname)){?>
                                                <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                                <?php }else{?>
                                                <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                              <?php }}?>
                                            <?php
                                              }else{
                                              foreach($BRANCH as $row){
                                              if(isset($brname)){?>
                                              <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                              <?php }else{?>
                                              <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                            <?php }}}?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="form-group" style="margin-top:10px;">                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                          placeholder="<?php if(isset($datestart)){echo $datestart;}else{date('Y-m-d');}?>"
                                          value="<?php if(isset($datestart)){echo $datestart;}else{echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                <div class="form-group" style="margin-top:10px;">
                                    <label for="exampleInputEmail2">To:</label>
                                        <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                        placeholder="<?php if(isset($dateend)){echo $dateend;}else{date('Y-m-d');}?>" 
                                        value="<?php if(isset($dateend)){echo $dateend;}else{ echo date('Y-m-d');}?>"
                                        readonly="true" style="background:white;">
                                </div> 
                               <button type="submit" class="btn btn-primary" id="dailyloandisb" style="margin-top:15px;"><span class="
                               glyphicon glyphicon-search"></span><span style="margin-left:5px;">Search</span></button>
                               <button type="button" class="btn btn-success" id="downloadinterbranch" style="margin-top:15px;"><span class="
                                glyphicon glyphicon-download-alt"></span><span style="margin-left:5px;">Download Excel Files</span></button>
                               <button type="button" class="btn btn-default" onclick="javascript:printDiv('reports')" id="btnPrint" style="margin-top:15px;">
                               <span class="
                               glyphicon glyphicon-print"></span><span style="margin-left:5px;">PRINT</span></button>
                              </fieldset>
                            </form>
                          </div>
                      </div>
                      <!-- start project list -->
                    <div class="row">
                        <div class="panel-body table-responsive">
                          <div id="reports">
                            <div class="row" id="logoreports" style="display:none">
                                    <div class="col-md-6">
                                          <img src="<?php echo base_url();?>public/img/logo_simple.png" class="img-responsive" alt="Cinque Terre">
                                    </div>
                                    <div class="col-md-6" id="textcenter">
                                        <h2 id="in" style="font-size:25px;text-align:center">សហគ្រិនភាព ម៉ាយក្រួហ្វាយនែន ភិអិលស៊ី</h2>
                                        <h2 id="in1" style="text-align:center;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                                        <h2 id="in2" style="text-align:center;">Cash Inter-Branch Reports</h2>
                                        <p id="in3" style="text-align:center">Reports Date:
                                        <?php if(isset($datestart)){echo $datestart;}else{echo date("Y-m-d");}?>
                                          <span style="margin-left:10px;">
                                              To:<span style="margin-left:10px;">
                                                <?php if(isset($dateend)){echo $dateend;}else{echo date("Y-m-d");}?>
                                                </span>
                                          </span>
                                        </p>
                                    </div>   
                            </div> 
                            <table class="table table-bordered projects" id="datatable-buttons">
                                <thead>
                                <tr>
                                  <th rowspan='2' valign="middle" style="vertical-align: middle;text-align:center;border-bottom:3pt solid #22d4ae;">Date</th>
                                  <th colspan='2' style="text-align:center;white-space: nowrap;overflow: hidden;">Repay over Branch</th>
                                  <th colspan='13' style="text-align:center;white-space: nowrap;overflow: hidden;">Cash In</th>                                  
                                  <th colspan='5' style="text-align:center;white-space: nowrap;overflow: hidden;">Cash Out</th>
                                  
                                </tr>
                                <tr style="border-bottom:3pt solid #22d4ae;">
                                    
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Cash In</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Cash Out</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Withdrawal from bank</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Loan collection</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Loan Prepayment(Defferred)</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Write Back</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">CBC Fee</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Admin Fee</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Stamp Fee</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Loan penalty</th>
                                    <th style="width: 20%;white-space: nowrap;overflow: hidden;">Staff Penalty</th>
                                    <th>Surplus</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Forex Gain</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Others</th>
                                    <th style="text-align:center">Total</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Deposit with bank</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Loan Disbursement</th>
                                    <th style="text-align:center">Payments</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">Cash shortage</th>
                                    <th style="text-align:center">Others</th>
                                   
                                    
                                </tr>
                                </thead>
                                <tbody id="reportsinterbranch">
                                <?php
                                
                                foreach($summarydatail as $row){?>
                                <tr  style="text-align:right;">
                                  <td style="white-space: nowrap;overflow: hidden;"><?php echo date("Y-m-d",strtotime($row->PostDate));?></td>
                                  <td><?php echo number_format($row->Cash_In,0);?></td>
                                  <td><?php echo number_format($row->Cash_Out,0);?></td>
                                  <td><?php echo number_format($row->Withdrawal,0);?></td>
                                  <td><?php echo number_format($row->Loancollection,0);?></td>
                                  <td><?php echo number_format($row->LoanPrepayment,0);?></td>
                                  <td><?php echo number_format($row->WriteBack,0);?></td>
                                  <td><?php echo number_format($row->CBC_Fee,0);?></td>
                                  <td><?php echo number_format($row->Admin_Fee,0);?></td>
                                  <td><?php echo number_format($row->Stamp_Fee,0);?></td>
                                  <td><?php echo number_format($row->Loan_penalty,0);?></td>
                                  <td><?php echo number_format($row->Staff_Penalty,0);?></td>
                                  <td><?php echo number_format($row->Surplus,0);?></td>
                                  <td><?php echo number_format($row->Forex_Gain,0);?></td>
                                  <td><?php echo number_format($row->Otherss,0);?></td>
                                  <td><?php echo number_format($row->TOTAL,0);?></td>
                                  <td><?php echo number_format($row->Deposit_with_bank,0);?></td>
                                  <td><?php echo number_format($row->LoanDisbursement,0);?></td>
                                  <td><?php echo number_format($row->Payments,0);?></td>
                                  <td><?php echo number_format($row->Cashshortage,0);?></td>
                                  <td><?php echo number_format($row->Otherscashout,0);?></td>
                                  
                                </tr>                              
                                <?php }?>
                                </tbody>
                            </table>
                            <div class="col-sm-12" id="foldershow" style="display:none;">
                                    <p>ថ្ងៃទី.......ខែ.....ឆ្នាំ..<?php echo date('Y');?></p>
                                    <p style="margin-left:40px;">ហត្ថលេខា</p>
                                    <p>................................</p>
                                    <p><span style="margin-left:30px;"><?php echo $this->session->userdata('fullname');?></span></p>
                                  <br/>
                            </div>
                          </div>
                        </div>
                    </div>
                      <div class="title_right">
                         <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <div style="margin-top: 25px;margin-bottom: -12px;">
                                  <label>Total <span class="label label-default"><?= $total_rows; ?></span>records</label>
                                  </div>  
                                  <br/>
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
                          </div>
                        </div>                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- /page content -->
          <script>
            $(document).ready(function()
               {
               $("#datatable-buttons #looptr").on("click","#edit",function()
               {
                  $("#exampleModalCenter").modal('show');
               });
               $("#datatable-buttons #looptr").on("click","#view",function(){
                  $("#exampleModalCenterviewtable").modal('show');
               });
               $("#datatable-buttons #looptr").on("click",".sweet-4",function()
                   {
                    
                      
                       swal({
                       title: "Are you sure?",
                       text: "",
                       type: "warning",
                       showCancelButton: true,
                       confirmButtonClass: 'btn-danger ok',
                       confirmButtonText: 'Yes, delete it!',
                       closeOnConfirm: false,
                       closeOnCancel: false
                       },  
                       function(isConfirm) {
                           if (isConfirm) {
                               swal("Deleted!", "Your imaginary file has been deleted.", "success");
                               onclick=function(){
                                 
                               }
                           } else {
                               swal("Cancelled", "Your imaginary file is safe :)", "error");
                           }
                       }         
                       /*function(){
                       swal("", "Your record has been deleted!", "success");
                       }*/,
                       
                       );
                   })
               });
            </script>
  <style>
  fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1em 1em 1em !important;
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
        width:100%;
        
    }
    @media print and (width: 21cm) and (height: 29.7cm) {
      @page {
          margin: 3cm;
          
      }
      
  }

  /* style sheet for "letter" printing */
  @media print and (width: 8.5in) and (height: 11in) {
      @page {
          margin: 1in;
      }
     
  }
  
  /* A4 Landscape*/
  @page {
      size: A4 landscape;
      margin: 10%;
  }
  </style>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
   
</script>
<script>
  $(document).ready(function()
  {
    $("#downloadinterbranch").on("click",function()
    {
      var brname=$("#brname").val();
      var datestart=$("#datestart").val();
      var dateend=$("#dateend").val();
      
      if(brname==''){
        alert("Please Choose Branch Name");
      }else
      {
        window.location.href="<?php echo site_url('DailyCash/DOWNLOADCASHSUMMARY');?>/"+datestart+"/"+dateend+"/"+brname;   
      }
     
    });
  });
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
              document.getElementById("foldershow").style.display= "inline-block";   
              document.getElementById("logoreports").style.display= "inline-block";  
              document.getElementById("textcenter").style.margin = "0px 100px 10px 210px";
              var table=document.getElementById("reportsinterbranch");
              var r=0;
              while(row=table.rows[r++])
              {
                var c=9;
                while(cell=row.cells[c++])
                {
                  //cell.innerHTML='[Row='+r+',Col='+c+']'; // do sth with cell
                  cell.innerHTML=""; // do sth with cell

                }
              }
              
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            window.location.href="<?= site_url("DailyCash/CashSummary");?>";
          
        }
    </script>
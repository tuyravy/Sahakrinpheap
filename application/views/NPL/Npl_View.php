        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> 
        <link href="https://fonts.googleapis.com/css?family=Khmer" rel="stylesheet">  
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
     
        
         <!-- page content -->
         <div role="main">
            <div class="">
              <div class="clearfix"></div>  
              <div class="row">
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_title">
                    <span class="glyphicon glyphicon-align-justify"></span><span style="margin-left:10px;">របាយការណ៍ប្រមូលទឹកប្រាក់កម្ចីធំជាង ៩០ ថ្ងៃ និងអិតិថិជនកាត់ចេញពីបញ្ជីរប្រចាំថ្ងៃ</span>
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
                              <form class="form-inline" action="<?php echo site_url('npl/nplcollection');?>" method="post">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group" style="margin-top:-10px;">                                       
                                          <label for="exampleInputName2">FITTER BRACH</label>
                                          <div class="row-fluid">
                                          <select class="selectpicker" id="brname" data-show-subtext="true" data-live-search="true" name="brname" required>
                                           
                                           <option data-subtext="Select Branch" value="All">All</option>
                                               <?php foreach($brlist as $row){
                                                   if(isset($brname)){?>
                                                   <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                                   <?php }else{?>
                                                   <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                               <?php }}?>
                                           </select>
                                        </div>
                                      </div>
                                      <div class="form-group" style="margin-top:10px;">                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                          placeholder="<?php echo date('Y-m-d');?>" 
                                          value="<?php if(isset($datestart)){echo $datestart;}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                      <div class="form-group" style="margin-top:10px;">
                                    <label for="exampleInputEmail2">To:</label>
                                        <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                        placeholder="<?php echo date('Y-m-d');?>" 
                                        value="<?php if(isset($dateend)){echo $dateend;}else{ echo date('Y-m-d');}?>"
                                        readonly="true" style="background:white;">
                                </div> 
                                <button type="submit" class="btn btn-primary" id="dailyloandisb" style="margin-top:15px;" name="submit"><span class="
                               glyphicon glyphicon-search"></span><span style="margin-left:5px;">Search</span></button>
                               <button type="button" class="btn btn-success" id="downloadnplcollectiontoloan" style="margin-top:15px;"><span class="
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
                            <table class="table table-bordered projects" id="datatable-buttons">
                                <thead>
                                <tr>
                                
                                  <th rowspan='2' valign="middle" style="vertical-align: middle;text-align:center;border-bottom:3pt solid #22d4ae;">លេខរៀង</th>
                                    <th rowspan='2' valign="middle" style="vertical-align: middle;text-align:center;border-bottom:3pt solid #22d4ae;">លេខកូដសាខា</th>
                                      <th rowspan='2' valign="middle" style="vertical-align: middle;text-align:center;border-bottom:3pt solid #22d4ae;">ឈ្មោះសាខា</th>
                                  <th colspan='3' style="text-align:center;white-space: nowrap;overflow: hidden;"> កម្ចីធំជាង ៩០ ថ្ងៃ(NPL) របស់អនុប្រធានសាខា</th>
                                  <th colspan='4' style="text-align:center;white-space: nowrap;overflow: hidden;">កម្ចីលុបចេញពីបញ្ជី(WO)</th>                                  
                                  <th colspan='2' style="text-align:center;white-space: nowrap;overflow: hidden;">លទ្ធផលសរុប</th>
                                  
                                </tr>
                                
                                <tr style="border-bottom:3pt solid #22d4ae;">                                    
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនអតិថិជន</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនទឹកប្រាក់បានបញ្ចូល MB</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនទឹកប្រាក់ខ្ចប់ទុកបញ្ចូល MB</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនអតិថិជន  </th>                                   
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនទឹកប្រាក់បានបញ្ចូល MB</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនទឹកប្រាក់បានបញ្ចូល SKP TOOLS</th> 
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">លំអៀង</th>                                   
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនអតិថិជន</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនទឹកប្រាក់</th>
                                </tr>
                                </thead>
                                <tbody> 
                                <?php
                                $Total=0;
                                $Total1=0;
                                $Total2=0;
                                $Total3=0;
                                $Total4=0;
                                $Total5=0;
                                $Total6=0;
                                $Total7=0;
                                $Total8=0;
                                $i=1;
                                  if(isset($viewnplwo)){
                                  foreach($viewnplwo as $row):?>
                                  <tr>
                                    <td><?= $i++;?></td>
                                    <td><?= $row->BrCode;?></td>
                                    <td><?= $row->BrName;?></td>
                                    <td style="text-align:right;"><?= number_format($row->NumClient,0);$Total+=$row->NumClient;?></td>
                                    <td style="text-align:right;"><?= number_format($row->TrnAmt,0);$Total1+=$row->TrnAmt;?></td>
                                    <td style="text-align:right;"><?= number_format($row->AmtMB,0);$Total2+=$row->AmtMB ;?></td>
                                    <td style="text-align:right;"><?= number_format($row->TotalClient,0);$Total3+=$row->TotalClient ;?></td>
                                    <td style="text-align:right;"><?= number_format($row->AmtWOMB,0);$Total4+=$row->AmtWOMB;?></td>
                                    <td style="text-align:right;"><?= number_format($row->TotalBalWOTools,0);$Total5+=$row->TotalBalWOTools;?></td>
                                    <td style="text-align:right;"><?php echo number_format($row->AmtWOMB-$row->TotalBalWOTools,0);$Total6+=$row->AmtWOMB-$row->TotalBalWOTools;?></td>
                                    <td style="text-align:right;"><?php echo number_format($row->NumClient+$row->TotalClient,0);$Total7+=$row->NumClient+$row->TotalClient;?></td> 
                                    <td style="text-align:right;"><?php echo number_format($row->TrnAmt+$row->AmtWOMB,0);$Total8+= $row->TrnAmt+$row->AmtWOMB;?></td> 
                                  </tr>
                                  <?php endforeach;}?>
                                  <tr>
                                    <td colspan="3" style="text-align:right">សរុប</td>                                   
                                    <td style="text-align:right;"> <?= number_format($Total,0);?> </td>
                                    <td style="text-align:right;"> <?= number_format($Total1,0);?></td>
                                    <td style="text-align:right;"> <?= number_format($Total2,0);?></td>
                                    <td style="text-align:right;"> <?= number_format($Total3,0);?></td>
                                    <td style="text-align:right;"><?= number_format($Total4,0);?></td>
                                    <td style="text-align:right;"> <?= number_format($Total5,0);?></td>
                                    <td style="text-align:right;"> <?= number_format($Total6,0);?> </td>
                                    <td style="text-align:right;"> <?= number_format($Total7,0);?> </td>
                                    <td style="text-align:right;"> <?= number_format($Total8,0);?></td>    
                                  </tr>
                                </tbody>
                            </table>                            
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
    $("#downloadnplcollectiontoloan").on("click",function()
    {
    
      var brname=$("#brname").val();
      var datestart=$("#datestart").val();
      var dateend=$("#dateend").val();
      
      if(brname==''){
        alert("Please Choose Branch Name");
      }else
      {
        window.location.href="<?php echo site_url('npl/downloadnplwo');?>/"+brname+"/"+datestart+"/"+dateend
      }
     
    });
  });
</script>        
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


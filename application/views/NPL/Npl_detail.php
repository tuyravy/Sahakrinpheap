<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> 
        <link href="https://fonts.googleapis.com/css?family=Khmer" rel="stylesheet">  
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
     
         <!-- page content -->
         <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">ទំព័រដើម</a>
                        <a href="<?= site_url('npl/npldetail');?>" class="active">ប្រាក់ប្រមូលបានបង់ចូលគណនីអតិថិជន​ធំជាង ៩០​ថ្ងៃ</a>
                        <a href="<?= site_url('npl/npldeferpaymant');?>">ប្រាក់ប្រមូលបានបង់ខ្ចប់ទុកសម្រាប់អតិថិជន​ធំជាង ៩០​ថ្ងៃ</a>
                        <a href="<?= site_url('npl/writtenoffdetail');?>">ប្រាក់ប្រមូលបានពីអតិថិជនកាត់ចេញពីបញ្ជីរបង់ចូល SKP_Tools</a>
                        <a href="<?= site_url('npl/writtenoffwithgl');?>">ប្រាក់ប្រមូលបានកាត់ចេញពីបញ្ជីរបង់ចូលបង់ចូលគណនី Written Off</a>      
         </div>
      
         <div role="main">
            <div class="">
              <div class="clearfix"></div>  
              <div class="row">
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_title">
                    <span class="glyphicon glyphicon-align-justify"></span><span style="margin-left:10px;">របាយការណ៍ប្រមូលទឹកប្រាក់អតិថិជនធំជាង ៩០ ថ្ងៃ</span>
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
                              <form class="form-inline" action="<?php echo site_url('npl/npldetail');?>" method="post">
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
                                
                                <tr style="border-bottom:3pt solid #22d4ae;">                                    
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ល.រ</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">លេខកូដសាខា</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ឈ្មោះសាខា</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ឈ្មោះមន្ត្រីឥណទាន</th>                                   
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">តួនាទី</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">លេខគណនីអតិថិជន</th>                                    
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">ចំនួនទឹកប្រាក់បានបង់</th>
                                    <th style="text-align:center;white-space: nowrap;overflow: hidden;">កាលបរិច្ឆេកប្រមូល</th>
                                </tr>
                                </thead>
                                <tbody> 
                                  <?php 
                                  $Total=0;
                                  $i=1;
                                  if(isset($viewnpl_toloan)){
                                  foreach($viewnpl_toloan as $row):?>
                                  <tr style="text-align:center;">
                                    <td><?= $i++;?></td>
                                    <td><?= $row->BrCode;?></td>
                                    <td><?= $row->BrName;?></td>
                                    <td><?= $row->CoName;?></td>
                                    <td><?= $row->Position;?></td>
                                    <td><?= $row->Acc;?></td>
                                    <td style="text-align:right;"><?= number_format($row->TrnAmt,0); $Total+=$row->TrnAmt;?></td>
                                    <td><?= $row->TrnDate;?></td>  
                                  </tr>
                                  <?php endforeach;}?>
                                  <tr>
                                    <td colspan="6" style="text-align:right">សរុប</td>                                   
                                    <td style="text-align:right;"> <?= number_format($Total,0);?></td>
                                    <td></td>
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
        window.location.href="<?php echo site_url('npl/downloadnpldetail');?>/"+brname+"/"+datestart+"/"+dateend
      }
     
    });
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


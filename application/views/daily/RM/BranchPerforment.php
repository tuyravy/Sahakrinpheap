       ​​<script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css">  
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
            <a href="<?= base_url();?>">Home</a>
            <a href="<?= site_url('dailyrm/performentbyco');?>">Co-Performant-Daily</a>
            <a href="<?= site_url('dailyrm/brancPer');?>" class="active">Branch-Performant-Daily</a>
        </div>     
        <div class=""> 
            <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <span class="glyphicon glyphicon-file" style="padding:10px;"></span>Branch-Performant-Daily<small></small>
                    </div>                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                    <form class="form-inline" action="<?php echo site_url('dailyrm/brancPer');?>" method="POST">
                       <fieldset class="scheduler-border" style="width:80%;">
                         <legend class="scheduler-border">Specific Period:</legend>
                            <div class="form-group">
                              <label class="sr-only" for="exampleInputEmail3"></label>
                              <div class="row-fluid">
                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="branchname" name="brname">
                                    <option value=''>Select Branch</option>
                                            <?php foreach($brlist as $row){
                                                  if(isset($brname)){?>
                                                  <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                                  <?php }else{?>
                                                  <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                                <?php }}?>
                                            <option value="All">All</option>
                                    </select>                                    
                                  </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword3">From:</label>
                              <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                           placeholder="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                            </div>
                            <div class="form-group">
                              <label  for="exampleInputPassword3">To:</label>
                              <input type="text" id="dateend" class="form-control" name="dateend" 
                              placeholder="<?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top:5px;" id='search'>
                            <span class="glyphicon glyphicon-search"></span><span style="margin-left:5px;">Search</span></button>                         
                            <button type="button" class="btn btn-success" id="DownloadExcel" style="margin-top:5px;">
                            <span class="glyphicon glyphicon-download-alt"></span>
                                <span style="margin-left:5px;">Download Excel Files</span>
                            </button> 
                          </fieldset>
                        </form>                     
                       <div class="panel-body table-responsive">
                        <table id="datatable-buttons" class="table table-bordered table-condensed f11">
                          <thead>
                            <tr style="white-space: nowrap;overflow: hidden;">
                              <th rowspan="3"  style="vertical-align: middle;text-align:center;white-space: nowrap;overflow: hidden;border-bottom:3pt solid #22d4ae;" class="active">No</th>
                              <th rowspan="3"  style="vertical-align: middle;text-align:center;white-space: nowrap;overflow: hidden;border-bottom:3pt solid #22d4ae;" class="active">Branch</th>
                              <th colspan="8"  style="text-align:center;" class="active">Result Current</th>
                              <th colspan="8"  style="text-align:center;" class="danger">Result Previous</th>
                              <th colspan="8"  style="text-align:center;" class="warning">Varaince</th>
                            </tr>
                            <tr>
                              <th colspan="8"  style="text-align:center;"  class="active">
                              <?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>
                              </th>

                              <th colspan="8"  style="text-align:center;" class="danger">
                              <?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>  
                              </th>
                              <th colspan="8"  style="text-align:center;" class="warning">
                   
                                      <span style="padding:10px;">
                                      <?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?> /
                                      <?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>
                                      </span>
                                
                              </th>
                            </tr>
                            <tr style="white-space: nowrap;overflow: hidden;border-bottom:3pt solid #22d4ae;">
                              <th  style="text-align:center;" class="active">Total Balance</th>
                              <th  style="text-align:center;" class="active">Clients</th>
                              <th  style="text-align:center;" class="active">PAR Value 1-Days</th>
                              <th  style="text-align:center;" class="active">PAR Value 7-Days</th>
                              <th  style="text-align:center;" class="active">PAR Value 30-Days</th>
                              <th  style="text-align:center;" class="active">PAR Ratio 1Days(%)</th>
                              <th  style="text-align:center;" class="active">Disbursement</th>
                              <th  style="text-align:center;" class="active">Client_Dis</th>

                              <th  style="text-align:center;" class="danger">Total Balance</th>
                              <th  style="text-align:center;" class="danger">Clients</th>
                              <th  style="text-align:center;" class="danger">PAR Value 1-Days</th>
                              <th  style="text-align:center;" class="danger">PAR Value 7-Days</th>
                              <th  style="text-align:center;" class="danger">PAR Value 30-Days</th>
                               <th  style="text-align:center;" class="danger">PAR Ratio 1Days(%)</th>
                              <th  style="text-align:center;" class="danger">Disbursement</th>
                              <th  style="text-align:center;" class="danger">Client_Dis</th>

                              <th  style="text-align:center;" class="warning">Total Balance</th>
                              <th  style="text-align:center;" class="warning">Clients</th>
                              <th  style="text-align:center;" class="warning">PAR Value 1-Days</th>
                              <th  style="text-align:center;" class="warning">PAR Value 7-Days</th>
                              <th  style="text-align:center;" class="warning">PAR Value 30-Days</th>
                               <th  style="text-align:center;" class="warning">PAR Ratio 1Days(%)</th>
                              <th  style="text-align:center;" class="warning">Disbursement</th>
                              <th  style="text-align:center;" class="warning">Client_Dis</th>
                            </tr>
                           </thead>  
                           <?php $i=1;foreach($brperforment as $row):?>
                                    <tr>
                                    <td><?= $i++;?></td>
                                    <td><?= $row->shortcode;?></td>
                                    <td style="text-align:right;"><?= number_format($row->Balance,0);?></td>
                                    <td style="text-align:right;"><?= $row->Clients;?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR1Days,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR7Days,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR30Days,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format($row->PAR1Days/$row->Balance*100,2);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($row->DisbAmt,0),0);?></td>
                                    <td style="text-align:right;"><?= $row->ClientDisb;?></td>
                                    
                                    <td style="text-align:right;"><?= number_format($row->Balance_pre,0);?></td>
                                    <td style="text-align:right;"><?= $row->Clients_pre;?></td>
                                    <td style="text-align:right;"><?=  number_format($row->PAR1Days_pre,0);?></td>
                                    <td style="text-align:right;"><?=  number_format($row->PAR7Days_pre,0);?></td>
                                    <td style="text-align:right;"><?=  number_format($row->PAR30Days_pre,0);?></td>
                                    <td style="text-align:right;"><?=  number_format($row->PAR1Days_pre/$row->Balance_pre*100,2);?>%</td>
                                    <td style="text-align:right;"><?=  number_format($row->DisbAmt_pre,0);?></td>
                                    <td style="text-align:right;"><?=  $row->ClientDisb_pre;?></td>

                                    <td style="text-align:right;"><?= number_format($row->Balance-$row->Balance_pre,0);?></td>
                                    <td style="text-align:right;"><?= $row->Clients-$row->Clients_pre;?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR1Days-$row->PAR1Days_pre,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR7Days-$row->PAR7Days_pre,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR30Days-$row->PAR30Days_pre,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(($row->PAR1Days/$row->Balance-$row->PAR1Days_pre/$row->Balance_pre)*100,0);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($row->DisbAmt-$row->DisbAmt_pre,0),0);?></td>
                                    <td style="text-align:right;"><?= $row->ClientDisb-$row->Clients_pre;?></td>

                                </tr>
                               <?php endforeach;?> 
                           <body>
                           
                           </body>                 
                        </table>
                      </div>
                    </div>  
                    </div>                      
                  </div>                    
                </div>                  
              </div>
            </div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="<?php echo base_url();?>/public/RM/branchperforments.js"></script> 

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
   
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  
        <script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css"> 
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailydceo/performentbyco');?>" class="active">Co-Performant-Daily</a>
                        <a href="<?= site_url('dailydceo/brancPer');?>">Branch-Performant-Daily</a>
                       
            </div>
          <div class="">    
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">                  
                <div class="dashboard_graph x_panel">                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <span class="glyphicon glyphicon-file" style="padding:10px;"></span>Co-Performant-Daily<small></small>
                    </div>                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container col-md-12" style="height:auto;">
                    <form class="form-inline" action="<?php echo site_url('dailydceo/performentbyco');?>" method="POST">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific ReportDate:</legend>
                                     <div class="form-group"> 
                                       <!-- check user muilt branch -->
                                      
                                        <label for="exampleInputName2">Filter by:</label>
                                          <select class="form-control" id="systemid" name="systemid">
                                            <option value=''>Select RMName</option>
                                            <?php foreach($controlbyrm as $row){
                                                  if(isset($sid)){?>
                                                  <option value="<?php echo $row->sid;?>" <?php if($row->sid==$sid){ echo  'selected';}?>><?php echo $row->name  ;?></option>
                                                  <?php }else{?>
                                                  <option value="<?php echo $row->sid;?>"><?php echo $row->name;?></option>
                                                <?php }}?>
                                            <option value="All">All</option>
                                          </select>    
                                          <select class="form-control" id="branchname" name="branchname">
                                            <option value=''>Select Branch</option> 
                                            <?php foreach($brlist as $row){
                                                  if(isset($brcode)){?>
                                                  <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brcode){ echo  'selected';}?>><?php echo $row->shortcode;?></option>
                                                <?php }}?>                                           
                                            <option value="All">All</option>
                                          </select>   
                                                                            
                                          <!-- <label for="exampleInputName2">Filter by Co:</label> -->
                                          
                                        </div>
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($reportdate)){echo $reportdate;}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                                      </div>  
                                      <div class="form-group">                                       
                                          <label for="exampleInputName2">To:</label>
                                          <input type="text" id="dateend" class="form-control" name="dateend" id="exampleInputName2"
                                               placeholder="<?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>"
                                           value="<?php if(isset($reportend)){echo $reportend;}else{ echo date('Y-m-d');}?>"
                                          readonly="true" style="background:white;">
                                      </div>                                    
                                      <button type="submit" class="btn btn-primary" style="margin-top:5px;" id='search'>
                                      <span class="glyphicon glyphicon-refresh"></span> <span>Search</span></button>
                                      
                                      <button type="button" style="margin-top:5px;" class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                            <span>PRINT</span></button>
                                      <button type="button" class="btn btn-success" style="margin-top:5px;" id="DownloadExcel">
                                      <span class="glyphicon glyphicon-cloud-download"></span>
                                      <span>Download Excel</span></button>
                                    </fieldset>
                                </form>                     
                        </div>                       
                        <div class="panel-body table-responsive">
                        <table class="table table-bordered table-condensed f11">
                            <thead>
                                <tr>
                                    <th rowspan="3"  style="vertical-align: middle;text-align:center;white-space: nowrap;overflow: hidden;border-bottom:3pt solid #22d4ae;" class="active">No</th>
                                    <th rowspan="3"  style="vertical-align: middle;text-align:center;white-space: nowrap;overflow: hidden;border-bottom:3pt solid #22d4ae;" class="active">CO-Name</th>
                                    <th colspan="8"  style="text-align:center;" class="active">Result Current</th>
                                    <th colspan="8"  style="text-align:center;" class="danger">Result Previous</th>
                                    <th colspan="10"  style="text-align:center;" class="warning">Varaince</th>
                                </tr>
                                <tr>
                                
                                <th colspan="8"  style="text-align:center;" class="active"><?php if(isset($reportdate)){echo date('d-M-Y',strtotime($reportdate));}else{echo date("d-M-Y");};?></th>
                                <th colspan="8"  style="text-align:center;" class="danger"><?php if(isset($prereportdate)){echo date('d-M-Y',strtotime($prereportdate));}else{echo date("d-M-Y");};?></th>
                                <th colspan="10"  style="text-align:center;" class="warning"><?php if(isset($prereportdate)){echo date('d-M-Y',strtotime($prereportdate));}else{echo date("d-M-Y");};?><span style="padding:10px;">/</span><?php if(isset($reportdate)){echo date('d-M-Y',strtotime($reportdate));}else{echo date("d-M-Y");};?></th>
                                </tr>
                                <tr style="white-space: nowrap;overflow: hidden;border-bottom:3pt solid #22d4ae;">
                                <th  style="text-align:center;" class="active">Total Balance</th>
                                <th  style="text-align:center;" class="active">Clients</th>
                                <th  style="text-align:center;" class="active">PAR 1Days</th>
                                <th  style="text-align:center;" class="active">PAR 7Days</th>
                                <th  style="text-align:center;" class="active">PAR 30Days</th>
                                <th  style="text-align:center;" class="active">PAR Ratio 1Day(%)</th>
                                <th  style="text-align:center;" class="active">Disb</th>
                                <th  style="text-align:center;" class="active">Client_Dis</th>
                                    
                                <th  style="text-align:center;" class="danger">Total Balance</th>
                                <th  style="text-align:center;" class="danger">Clients</th>
                                <th  style="text-align:center;" class="danger">PAR 1Days</th>
                                <th  style="text-align:center;" class="danger">PAR 7Days</th>
                                <th  style="text-align:center;" class="danger">PAR 30Days</th>
                                <th  style="text-align:center;" class="danger">PAR Ratio 1Day(%)</th>
                                <th  style="text-align:center;" class="danger">Disb</th>
                                <th  style="text-align:center;" class="danger">Client_Dis</th>

                                <th  style="text-align:center;" class="warning">Total Balance</th>
                                <th  style="text-align:center;" class="warning">Clients</th>
                                <th  style="text-align:center;" class="warning">PAR 1Days</th>
                                <th  style="text-align:center;" class="warning">PAR 7Days</th>
                                <th  style="text-align:center;" class="warning">PAR 30Days</th>
                                <th  style="text-align:center;" class="warning">PAR Ratio 1Day(%)</th>
                                <th  style="text-align:center;" class="warning">Disb</th>
                                <th  style="text-align:center;" class="warning">Client_Dis</th>
                                <th  style="text-align:center;" class="warning">BrName</th>
                                <th  style="text-align:center;" class="warning">BrCode</th>
                                </tr>                               
                            </thead>
                            <body>
                            <?php $i=1;foreach($coperforment as $row):?>
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                        <td><?= $i++;?></td>
                                        <td style="text-align:left;"><?= $row->CoName;?></td>
                                        <td><?= number_format($row->OS,0);?></td>
                                        <td><?= $row->Cilent;?></td>
                                        <td><?=  number_format($row->PAR1_Amt,0);?></td>
                                        <td><?=  number_format($row->PAR7_Amt,0);?></td>
                                        <td><?=  number_format($row->PAR30_Amt,0);?></td>
                                        <td><?=  number_format($row->Ratio1day*100,2);?>%</td>
                                        <td><?=  number_format($row->DisbAmtDaily,0);?></td>
                                        <td><?=  $row->DisbAccDaily;?></td>

                                        <td><?= number_format($row->OSPre,0);?></td>
                                        <td><?= $row->CilentPre;?></td>
                                        <td><?=  number_format($row->PAR1_AmtPre,0);?></td>
                                        <td><?=  number_format($row->PAR7_AmtPre,0);?></td>
                                        <td><?=  number_format($row->PAR30_AmtPre,0);?></td>
                                        <td><?=  number_format($row->Ratio1dayPre*100,2);?>%</td>
                                        <td><?=  number_format($row->DisbAmtDailyPre,0);?></td>
                                        <td><?=  $row->DisbAccDailyPre;?></td>

                                        <td><?= number_format(($row->OS)-($row->OSPre),0);?></td>
                                        <td><?= ($row->Cilent)-($row->CilentPre);?></td>
                                        <td><?=  number_format(($row->PAR1_Amt)-($row->PAR1_AmtPre),0);?></td>
                                        <td><?=  number_format(($row->PAR7_Amt)-($row->PAR7_AmtPre),0);?></td>
                                        <td><?=  number_format(($row->PAR30_Amt)-($row->PAR30_AmtPre),0);?></td>
                                        <td><?=  number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?>%</td>
                                        <td><?=  number_format(($row->DisbAmtDaily)-($row->DisbAmtDailyPre),0);?></td>
                                        <td><?=  ($row->DisbAccDaily)-($row->DisbAccDailyPre);?></td>
                                        <td><?=  $row->shortcode;?></td>
                                        <td><?= $row->brcode;?></td>
                                    </tr>
                                <?php endforeach;?>
                            </body>
                            </table>
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
<script src="<?php echo base_url();?>/public/DCEO/performentbyco.js"></script> 

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

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
                                <th colspan="8"  style="text-align:center;" class="danger"><?php if(isset($reportend)){echo date('d-M-Y',strtotime($reportend));}else{echo date("d-M-Y");};?></th>
                                <th colspan="10"  style="text-align:center;" class="warning"><?php if(isset($reportdate)){echo date('d-M-Y',strtotime($reportdate));}else{echo date("d-M-Y");};?><span style="padding:10px;">/</span><?php if(isset($reportend)){echo date('d-M-Y',strtotime($reportend));}else{echo date("d-M-Y");};?></th>
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
                            <?php $i=1;
                                $TotalBalance=0;
                                $TotalClients=0;
                                $TotalPar1Days=0;
                                $TotalPar7Days=0;
                                $TotalPar30Days=0;
                               
                                $TotalDisbAmt=0;
                                $TotalClientDisb=0;

                                $TotalBalance_Pre=0;
                                $TotalClients_Pre=0;
                                $TotalPar1Days_Pre=0;
                                $TotalPar7Days_Pre=0;
                                $TotalPar30Days_Pre=0;
                                $TotalRaito1Day_Pre=0;
                                $TotalDisbAmt_Pre=0;
                                $TotalClientDisb_Pre=0;



                                foreach($coperforment as $row):?>
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                        <td><?= $i++;?></td>
                                        <td style="text-align:left;"><?= $row->COName;?></td>
                                        <td><?= number_format($row->Balance,0);$TotalBalance+=$row->Balance;?></td>
                                        <td><?= $row->Clients;$TotalClients+=$row->Clients;?></td>
                                        <td><?=  number_format($row->PAR1Days,0);$TotalPar1Days+=$row->PAR1Days;?></td>
                                        <td><?=  number_format($row->PAR7Days,0);$TotalPar7Days+=$row->PAR7Days;?></td>
                                        <td><?=  number_format($row->PAR30Days,0);$TotalPar30Days+=$row->PAR30Days;?></td>
                                        <td><?php if($row->PAR1Days==0){ echo number_format(1/$row->Balance*100,2);}else{ echo number_format($row->PAR1Days/$row->Balance*100,2);}?>%</td>
                                        <td><?=  number_format($row->DisbAmt,0);$TotalDisbAmt+=$row->DisbAmt;?></td>
                                        <td><?=  $row->ClientDisb;$TotalClientDisb+= $row->ClientDisb;?></td>

                                        <td><?= number_format($row->Balance_pre,0); $TotalBalance_Pre+=$row->Balance_pre;?></td>
                                        <td><?= $row->Clients_pre;$TotalClients_Pre+=$row->Clients_pre;?></td>
                                        <td><?=  number_format($row->PAR1Days_pre,0);$TotalPar1Days_Pre+=$row->PAR1Days_pre;?></td>
                                        <td><?=  number_format($row->PAR7Days_pre,0);$TotalPar7Days_Pre+=$row->PAR7Days_pre;?></td>
                                        <td><?=  number_format($row->PAR30Days_pre,0);$TotalPar30Days_Pre+=$row->PAR30Days_pre;?></td>
                                        <td><?php if($row->PAR1Days_pre==0){$PAR1Days_pres=1;echo number_format($PAR1Days_pres/$row->Balance_pre*100,2);}else{ echo number_format($row->PAR1Days_pre/$row->Balance_pre*100,2);}?>%</td>
                                        <td><?=  number_format($row->DisbAmt_pre,0);$TotalDisbAmt_Pre+=$row->DisbAmt_pre;?></td>
                                        <td><?=  $row->ClientDisb_pre;$TotalClientDisb_Pre+=$row->ClientDisb_pre;?></td>

                                        <td><?= number_format(($row->Balance)-($row->Balance_pre),0);?></td>
                                        <td><?= ($row->Clients)-($row->Clients);?></td>
                                        <td><?=  number_format(($row->PAR1Days)-($row->PAR1Days_pre),0);?></td>
                                        <td><?=  number_format(($row->PAR7Days)-($row->PAR7Days_pre),0);?></td>
                                        <td><?=  number_format(($row->PAR30Days)-($row->PAR30Days_pre),0);?></td>
                                        <td><?php if($row->PAR1Days==0 || $row->PAR1Days_pre==0){ $PAR1Days=1;$PAR1Days_pre=1;echo number_format(($PAR1Days/$row->Balance-$PAR1Days_pre/$row->Balance_pre)*100,2);}else{echo number_format(($row->PAR1Days/$row->Balance-$row->PAR1Days_pre/$row->Balance_pre)*100,2);}?>%</td>
                                        <td><?=  number_format(($row->DisbAmt)-($row->DisbAmt_pre),0);?></td>
                                        <td><?=  ($row->ClientDisb)-($row->ClientDisb_pre);?></td>
                                        <td style="text-align:left;"><?=  $row->shortcode;?></td>
                                        <td><?=  $row->BrCode;?></td>
                                    </tr>
                                <?php endforeach;?>
                                <tr style="text-align:right;white-space: nowrap;overflow: hidden;" class="active">
                                        <td colspan="2">Total:</td>
                                        
                                        <td><?= number_format($TotalBalance,0)?></td>
                                        <td><?= $TotalClients;?></td>
                                        <td><?=  number_format($TotalPar1Days);?></td>
                                        <td><?=  number_format($TotalPar7Days);?></td>
                                        <td><?=  number_format($TotalPar30Days);?></td>
                                        <td><?=  number_format(($TotalPar1Days/$TotalBalance)*100,2);?>%</td>
                                        <td><?=  number_format($TotalDisbAmt,0);?></td>
                                        <td><?=  $TotalClientDisb?></td>

                                        <td><?= number_format($TotalBalance_Pre,0);?></td>
                                        <td><?= $TotalClients_Pre;?></td>
                                        <td><?=  number_format($TotalPar1Days_Pre,0);?></td>
                                        <td><?=  number_format($TotalPar7Days_Pre,0);?></td>
                                        <td><?=  number_format($TotalPar30Days_Pre,0);?></td>
                                        <td><?=  number_format($TotalPar1Days_Pre/$TotalBalance_Pre*100,2);?>%</td>
                                        <td><?=  number_format($TotalDisbAmt_Pre,0);?></td>
                                        <td><?=  $TotalClientDisb_Pre;?></td>

                                        <td><?= number_format(($TotalBalance)-($TotalBalance_Pre),0);?></td>
                                        <td><?= $TotalClients-$TotalClients_Pre;?></td>
                                        <td><?=  number_format($TotalPar1Days-$TotalPar1Days_Pre,0);?></td>
                                        <td><?=  number_format($TotalPar7Days-$TotalPar7Days_Pre,0);?></td>
                                        <td><?=  number_format($TotalPar30Days-$TotalPar30Days_Pre,0);?></td>
                                        <td><?=  number_format((($TotalPar1Days/$TotalBalance)-($TotalPar1Days_Pre/$TotalBalance_Pre))*100,2);?>%</td>
                                        <td><?=  number_format(($TotalDisbAmt)-($TotalDisbAmt_Pre),0);?></td>
                                        <td><?=  ($TotalClientDisb)-($TotalClientDisb_Pre);?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="text-align:right;white-space: nowrap;overflow: hidden;" class="info">
                                        <td colspan="2">Total USD:</td>
                                        
                                        <td>$ <?= number_format($TotalBalance/4000,0)?></td>
                                        <td><?= $TotalClients;?></td>
                                        <td>$ <?=  number_format($TotalPar1Days/4000);?></td>
                                        <td>$ <?=  number_format($TotalPar7Days/4000);?></td>
                                        <td>$ <?=  number_format($TotalPar30Days/4000);?></td>
                                        <td><?=  number_format(($TotalPar1Days/$TotalBalance)*100,2);?>%</td>
                                        <td>$ <?=  number_format($TotalDisbAmt/4000,0);?></td>
                                        <td><?=  $TotalClientDisb?></td>

                                        <td>$ <?= number_format($TotalBalance_Pre/4000,0);?></td>
                                        <td><?= $TotalClients_Pre;?></td>
                                        <td>$ <?=  number_format($TotalPar1Days_Pre/4000,0);?></td>
                                        <td>$ <?=  number_format($TotalPar7Days_Pre/4000,0);?></td>
                                        <td>$ <?=  number_format($TotalPar30Days_Pre/4000,0);?></td>
                                        <td><?=  number_format($TotalPar1Days_Pre/$TotalBalance_Pre*100,2);?>%</td>
                                        <td>$ <?=  number_format($TotalDisbAmt_Pre,0);?></td>
                                        <td><?=  $TotalClientDisb_Pre;?></td>

                                        <td>$ <?= number_format((($TotalBalance)-($TotalBalance_Pre))/4000,0);?></td>
                                        <td><?= $TotalClients-$TotalClients_Pre;?></td>
                                        <td>$ <?=  number_format(($TotalPar1Days-$TotalPar1Days_Pre)/4000,0);?></td>
                                        <td>$ <?=  number_format(($TotalPar7Days-$TotalPar7Days_Pre)/4000,0);?></td>
                                        <td>$ <?=  number_format(($TotalPar30Days-$TotalPar30Days_Pre)/4000,0);?></td>
                                        <td><?=  number_format((($TotalPar1Days/$TotalBalance)-($TotalPar1Days_Pre/$TotalBalance_Pre))*100,2);?>%</td>
                                        <td>$ <?=  number_format((($TotalDisbAmt)-($TotalDisbAmt_Pre))/4000,0);?></td>
                                        <td><?=  ($TotalClientDisb)-($TotalClientDisb_Pre);?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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

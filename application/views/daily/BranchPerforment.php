       ​​<script src="<?php echo base_url();?>public/dist/sweetalert.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/sweetalert.css">  
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
            <a href="<?= base_url();?>">Home</a>
            <a href="<?= site_url('daily/performentbyco');?>">Co-Performant-Daily</a>
            <a href="<?= site_url('daily/brancPer');?>" class="active">Branch-Performant-Daily</a>
        </div>     
        <div class=""> 
            <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">                
                  <div class="row x_title">
                    <div class="col-md-6">
                    <span class="glyphicon glyphicon-th-list"></span><span style="margin-left:5px;">Branch-Performant-Daily</span>
                    </div>                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                    <form class="form-inline" action="<?php echo site_url('daily/brancPer');?>" method="POST">
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
                           <?php $i=1;
                                    $OS=0;$Cilent=0;$PAR1_Amt=0;$PAR7_Amt=0;$PAR30_Amt=0;$Ratio1day=0;$DisbAmtDaily=0;$DisbAccDaily=0;
                                    $OS_P=0;$Cilent_P=0;$PAR1_Amt_P=0;$PAR7_Amt_P=0;$PAR30_Amt_P=0;$Ratio1day_P=0;$DisbAmtDaily_P=0;$DisbAccDaily_P=0;
                                    $OS_T=0;$Cilent_T=0;$PAR1_Amt_T=0;$PAR7_Amt_T=0;$PAR30_Amt_T=0;$Ratio1day_T=0;$DisbAmtDaily_T=0;$DisbAccDaily_T=0;
                                    foreach($brperforment as $row):
                                    $OS+=$row->OS;$Cilent+=$row->Cilent;$PAR1_Amt+=$row->PAR1_Amt;$PAR7_Amt+=$row->PAR7_Amt;$PAR30_Amt+=$row->PAR30_Amt;$Ratio1day+=$row->PAR1_Amt/$row->OS;$DisbAmtDaily+=$row->DisbAmtDaily;$DisbAccDaily+=$row->DisbAccDaily;
                                    $OS_P+=$row->OSPre;$Cilent_P+=$row->CilentPre;$PAR1_Amt_P+=$row->PAR1_AmtPre;$PAR7_Amt_P+=$row->PAR7_AmtPre;$PAR30_Amt_P+=$row->PAR30_AmtPre;if($row->PAR1_AmtPre==0 ||$row->OSPre==0){ $PAR1_AmtPre=1;$OSPre=1;$Ratio1day_P+=$PAR1_AmtPre/$OSPre;}else{$Ratio1day_P+=$row->PAR1_AmtPre/$row->OSPre;};$DisbAmtDaily_P+=$row->DisbAmtDailyPre;$DisbAccDaily_P+=$row->DisbAccDailyPre;
                                    $OS_T+=$row->OS-$row->OSPre;$Cilent_T+=$row->Cilent-$row->CilentPre;$PAR1_Amt_T+=$row->PAR1_Amt-$row->PAR1_AmtPre;$PAR7_Amt_T+=$row->PAR7_Amt-$row->PAR7_AmtPre;$PAR30_Amt_T+=$row->PAR30_Amt-$row->PAR30_AmtPre;$DisbAmtDaily_T+=$row->DisbAmtDaily-$row->DisbAmtDailyPre;$DisbAccDaily_T+=$row->DisbAccDaily-$row->DisbAccDailyPre;
                                    ?>
                                    <tr>
                                    <td><?= $i++;?></td>
                                    <td><?= $row->shortcode;?></td>
                                    <td style="text-align:right;"><?= number_format($row->OS,0);?></td>
                                    <td style="text-align:right;"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR1_Amt,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR7_Amt,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR30_Amt,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($row->DisbAmtDaily,0),0);?></td>
                                    <td style="text-align:right;"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;"><?= number_format($row->OSPre,0);?></td>
                                    <td style="text-align:right;"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;"><?=  number_format($row->PAR1_AmtPre,0);?></td>
                                    <td style="text-align:right;"><?=  number_format($row->PAR7_AmtPre,0);?></td>
                                    <td style="text-align:right;"><?=  number_format($row->PAR30_AmtPre,0);?></td>
                                    <td style="text-align:right;"><?=  number_format($row->Ratio1dayPre*100,2);?>%</td>
                                    <td style="text-align:right;"><?=  number_format($row->DisbAmtDailyPre,0);?></td>
                                    <td style="text-align:right;"><?=  $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;"><?= number_format($row->OS-$row->OSPre,0);?></td>
                                    <td style="text-align:right;"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR1_Amt-$row->PAR1_AmtPre,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR7_Amt-$row->PAR7_AmtPre,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR30_Amt-$row->PAR30_AmtPre,0),0);?></td>
                                    <td style="text-align:right;"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,0);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($row->DisbAmtDaily-$row->DisbAmtDailyPre,0),0);?></td>
                                    <td style="text-align:right;"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>

                                </tr>
                               <?php endforeach;?>
                               <tr style="text-align:right;white-space: nowrap;overflow: hidden;" class="active">
                                        <td colspan='2' style="text-align:right">Total:</td>                                        
                                        <td style="text-align:right"><?= number_format($OS,0);?></td>
                                        <td style="text-align:right"><?= $Cilent;?></td>
                                        <td style="text-align:right"><?=  number_format($PAR1_Amt,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR7_Amt,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR30_Amt,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR1_Amt/$OS*100,2);?>%</td>
                                        <td style="text-align:right"><?=  number_format($DisbAmtDaily,0);?></td>
                                        <td style="text-align:right"><?=  $DisbAccDaily;?></td>

                                        <td style="text-align:right"><?= number_format($OS_P,0);?></td>
                                        <td style="text-align:right"><?= $Cilent_P;?></td>
                                        <td style="text-align:right"><?=  number_format($PAR1_Amt_P,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR7_Amt_P,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR30_Amt_P,0);?></td>
                                        <td style="text-align:right"><?php if($PAR1_Amt_P==0 ||$OS_P==0){$PAR1_Amt_P=1;$OS_P=1;echo number_format($PAR1_Amt_P/$OS_P*100,2);}else{echo number_format($PAR1_Amt_P/$OS_P*100,2);}?>%</td>
                                        <td style="text-align:right"><?=  number_format($DisbAmtDaily_P,0);?></td>
                                        <td style="text-align:right"><?=  $DisbAccDaily_P;?></td>

                                        <td style="text-align:right"><?= number_format($OS_T,0);?></td>
                                        <td style="text-align:right"><?= $Cilent_T;?></td>
                                        <td style="text-align:right"><?=  number_format($PAR1_Amt_T,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR7_Amt_T,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR30_Amt_T,0);?></td>
                                        <td style="text-align:right"><?php if($PAR1_Amt==0 ||$PAR1_Amt_P==0 || $OS==0 ||$OS_P==0){$PAR1_Amt=1;$PAR1_Amt_P=1;$OS=1;$OS_P=1; echo number_format(($PAR1_Amt/$OS-$PAR1_Amt_P/$OS_P)*100,2);}else{echo number_format(($PAR1_Amt/$OS-$PAR1_Amt_P/$OS_P)*100,2);}?>%</td>
                                        <td style="text-align:right"><?=  number_format($DisbAmtDaily_T,0);?></td>
                                        <td style="text-align:right"><?=  $DisbAccDaily_T;?></td>
                                       
                                       
                                    </tr> 
                                    <tr style="text-align:right;white-space: nowrap;overflow: hidden;" class="info">
                                        <td colspan='2' style="text-align:right">Total USD:</td>                                        
                                        <td style="text-align:right">$ <?= number_format($OS/4000,0);?></td>
                                        <td style="text-align:right"><?= $Cilent;?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR1_Amt/4000,0);?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR7_Amt/4000,0);?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR30_Amt/4000,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR1_Amt/$OS*100,2);?>%</td>
                                        <td style="text-align:right">$ <?=  number_format($DisbAmtDaily/4000,0);?></td>
                                        <td style="text-align:right"><?=  $DisbAccDaily;?></td>

                                        <td style="text-align:right">$ <?= number_format($OS_P/4000,0);?></td>
                                        <td style="text-align:right"><?= $Cilent_P;?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR1_Amt_P/4000,0);?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR7_Amt_P/4000,0);?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR30_Amt_P/4000,0);?></td>
                                        <td style="text-align:right"><?=  number_format($PAR1_Amt_P/$OS_P*100,2);?>%</td>
                                        <td style="text-align:right">$ <?=  number_format($DisbAmtDaily_P/4000,0);?></td>
                                        <td style="text-align:right"><?=  $DisbAccDaily_P;?></td>

                                        <td style="text-align:right">$ <?= number_format($OS_T/4000,0);?></td>
                                        <td style="text-align:right"><?= $Cilent_T;?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR1_Amt_T/4000,0);?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR7_Amt_T/4000,0);?></td>
                                        <td style="text-align:right">$ <?=  number_format($PAR30_Amt_T/4000,0);?></td>
                                        <td style="text-align:right"><?php if($PAR1_Amt==0 ||$PAR1_Amt_P==0){ $PAR1_Amt=1;$PAR1_Amt_P=1;$OS=1;$OS_P=1;echo number_format(($PAR1_Amt/$OS-$PAR1_Amt_P/$OS_P)*100,2);}else{echo number_format(($PAR1_Amt/$OS-$PAR1_Amt_P/$OS_P)*100,2);}?>%</td>
                                        <td style="text-align:right">$ <?=  number_format($DisbAmtDaily_T/4000,0);?></td>
                                        <td style="text-align:right"><?=  $DisbAccDaily_T;?></td>
                                       
                                       
                                    </tr> 
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
<script src="<?php echo base_url();?>/public/BM/branchperforments.js"></script> 

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

  
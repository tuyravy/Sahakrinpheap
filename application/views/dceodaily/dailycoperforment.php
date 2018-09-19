 <?php 
        
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');   
        $type=$this->session->userdata('types'); 
        
?><!-- page content -->
            
          <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
          <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>  
         <!-- Include Required Prerequisites -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailycoperforment');?>" class="active">Co-Performant-Daily</a>
                        <a href="<?= site_url('brancPerforment');?>">Branch-Performant-Daily</a>
                       
            </div>
          <div class="">    
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">                  
                <div class="dashboard_graph x_panel">
                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-file" style="padding:10px;"></span>Co-Performant-Daily<small></small></h3>
                    </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container row" style="height:auto;">
                     <form class="form-inline">
                        <fieldset class="scheduler-border" style="width:80%;">
                         <legend class="scheduler-border">Specific Period:</legend>
                          <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3"></label>
                            <div class="row-fluid">
                                  <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="brCode" name="brcode">
                                    <option data-subtext="Select by Branch" value="0"></option>
                                    <?= $bra=$this->DailyCmr_model->getBrcode($sid,$role,$type);
                                      foreach($bra as $row){
                                       if(isset($_GET['brcode'])){?>
                                              <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$_GET['brcode']){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                        <?php }else{?>
                                              <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                        <?php }}?>                                                                        
                                  </select>                                  
                                </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleInputPassword3">From:</label>
                            <input type="text" id="datestartpre" class="form-control" name="reportdatepre" id="exampleInputName2"
                                       placeholder="<?php if(isset($_GET['reportdatepre'])){echo $_GET['reportdatepre'];}else{ echo date('Y-m-d');}?>"
                                value="<?php if(isset($_GET['reportdatepre'])){echo $_GET['reportdatepre'];}else{ echo date("Y-m-d",strtotime($this->Menu_model->getPreCurrRundate()));}?>"
                                readonly="true" style="background:white;">
                           
                          </div>

                          <div class="form-group">
                            <label  for="exampleInputPassword3">To:</label>
                            <input type="text" id="datestart" class="form-control" name="reportdate" id="exampleInputName2"
                                       placeholder="<?php if(isset($_GET['reportdate'])){echo $_GET['reportdate'];}else{ echo date('Y-m-d');}?>"
                                value="<?php if(isset($_GET['reportdate'])){echo $_GET['reportdate'];}else{ echo date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));}?>"
                                readonly="true" style="background:white;">
                          </div>
                          <button type="submit" class="btn btn-primary" style="margin-top:5px;">
                          <span class="glyphicon glyphicon-search"></span><span style="margin-left:5px;">Search</span></button>
                          </fieldset>
                        </form>
                        <div class="pull-right">       
                            <button type="button" class="btn btn-success" id="dailycoperforment">
                            <span class="glyphicon glyphicon-download-alt"></span>
                                <span style="margin-left:5px;">Download Excel Files</span>
                            </button>       
                        </div>
                        
                        <br/>
                        <p style="font-weight:bold;">Branch:
                            <?php 
                                if(isset($_GET['brcode']))
                                    {
                                       echo $brcode=substr($brcode=$_GET['brcode'],3);
                                    }
                                else
                                {
                                    $a=0;
                                         $brcode=0;
                                         foreach($bra as $row){
                                            $a=$row->brCode;
                                         }
                                    echo $brcode=$a;
                                };                                
                            ?>
                        </p>
                                    
                        <p style="font-weight:bold;">ReportDate:
                            <?php 
                               
                                    if(isset($_GET['reportdate']))
                                    {
                                       
                                        
                                        $reportdate=$_GET['reportdate'];  
                                        $prereportdate=$_GET['reportdatepre'];  
                                        echo $finaldate=date('d-M-Y',strtotime($reportdate));
                                        
                                        
                                    }else
                                    {   
                                         echo $reportdate=date("d-M-Y",strtotime($this->Menu_model->getCurrRundate()));
                                              $prereportdate=date("d-M-Y",strtotime($this->Menu_model->getPreCurrRundate()));
                                        
                                    }
                            ?>
                        
                        </p>
                        
                        <div class="panel-body table-responsive">
                        <table class="table table-bordered table-condensed f11">
                            <thead>
                                <tr>
                                    <th rowspan="3"  style="text-align:center;padding:0px 0px 30px 0px;" class="active">No</th>
                                    <th rowspan="3"  style="text-align:center;padding:0px 0px 30px 0px;" class="active">CO-Name</th>
                                    <th colspan="8"  style="text-align:center;" class="active">Result Current</th>
                                    <th colspan="8"  style="text-align:center;" class="danger">Result Previous</th>
                                    <th colspan="8"  style="text-align:center;" class="warning">Varaince</th>
                                </tr>
                                <tr>
                                
                                <th colspan="8"  style="text-align:center;" class="active"><?php if(isset($reportdate)){echo date('d-M-Y',strtotime($reportdate));}else{echo date("d-M-Y");};?></th>
                                <th colspan="8"  style="text-align:center;" class="danger"><?php if(isset($prereportdate)){echo date('d-M-Y',strtotime($prereportdate));}else{echo date("d-M-Y");};?></th>
                                <th colspan="8"  style="text-align:center;" class="warning"><?php if(isset($prereportdate)){echo date('d-M-Y',strtotime($prereportdate));}else{echo date("d-M-Y");};?><span style="padding:10px;">/</span><?php if(isset($reportdate)){echo date('d-M-Y',strtotime($reportdate));}else{echo date("d-M-Y");};?></th>
                                </tr>
                                <tr style="white-space: nowrap;overflow: hidden;">
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
                                </tr>
                               
                            </thead>
                            <tbody>  
                                <?php  
                                        
                                    if(isset($_GET['brcode']))
                                            {
                                        
                                                $brcode=substr($brcode=$_GET['brcode'],0,3);
                                                if($brcode==0)
                                                {
                                                    
                                                    $finaldate=date('Ymd',strtotime($reportdate));
                                                    $prereportsdate=date('Ymd',strtotime($prereportdate));
                                                    $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                                    $result=$this->DailyCmr_model->getDailyCoPerforment($brcode,$role,1,$page,$finaldate,$prereportsdate);
                                                }else{
                                                    
                                                $reportdate=$_GET['reportdate'];  
                                                $prereportdate=$_GET['reportdatepre'];
                                                $finaldate=date('Ymd',strtotime($reportdate));
                                                $prereportsdate=date('Ymd',strtotime($prereportdate));
                                                $result=$this->DailyCmr_model->getDailyCoPerforment($brcode,$role,0,0,$finaldate,$prereportsdate);
                                                }
                                            }
                                        else
                                        {
                                            $bra=$this->DailyCmr_model->getBrcode($sid,$role,$type);
                                            $a=0;
                                            $brcode=0;
                                            foreach($bra as $row){
                                                $a=$row->brCode;
                                            }
                                            $brcode=$a;
                                            $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                            $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                            $prereportsdate=date('Ymd',strtotime($this->Menu_model->getPreCurrRundate()));
                                            $result=$this->DailyCmr_model->getDailyCoPerforment($brcode,$role,1,$page,$reportdate,$prereportsdate);
                                        };    
                                        
                                        $i=1;
                                        $os=0;
                                        $par1=0;
                                        $par7=0;
                                        $par30=0;
                                        $rat1=0;
                                        $Disbdailysum=0;
                                        $DisbAccDaily=0;
                                        $Cilent=0;
                                        $totalCo=0;
                                        $ospre=0;
                                        $par1pre=0;
                                        $par7pre=0;
                                        $par30pre=0;
                                        $rat1pre=0;
                                        $Disbdailypre=0;
                                        $DisbAccDailypre=0;
                                        $Cilentpre=0;
                                        $totalCopre=0;
                                        $temp=array();
                                        foreach($result as $row):
                                        $totalCo++;
                                        array_push($temp,$row->DisbAmtDaily);
                                       
                                ?>

                                    <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                        <td><?= $i++;?></td>
                                        <td style="text-align:left;"><?= $row->CoName;?></td>

                                        <td><?= number_format($row->OS,0);$os+=$row->OS;?></td>
                                        <td><?= $row->Cilent;$Cilent+=$row->Cilent;?></td>
                                        <td><?=  number_format($row->PAR1_Amt,0);$par1+=$row->PAR1_Amt;?></td>
                                        <td><?=  number_format($row->PAR7_Amt,0);$par7+=$row->PAR7_Amt;?></td>
                                        <td><?=  number_format($row->PAR30_Amt,0);$par30+=$row->PAR30_Amt;?></td>
                                        <td><?=  number_format($row->Ratio1day*100,2);$rat1+=$row->Ratio1day*100;?>%</td>
                                        <td><?=  number_format($row->DisbAmtDaily,0);?></td>
                                        <td><?=  $row->DisbAccDaily;$DisbAccDaily+=$row->DisbAccDaily;?></td>

                                        <td><?= number_format($row->OSPre,0);$ospre+=$row->OSPre;?></td>
                                        <td><?= $row->CilentPre;$Cilentpre+=$row->CilentPre;?></td>
                                        <td><?=  number_format($row->PAR1_AmtPre,0);$par1pre+=$row->PAR1_AmtPre;?></td>
                                        <td><?=  number_format($row->PAR7_AmtPre,0);$par7pre+=$row->PAR7_AmtPre;?></td>
                                        <td><?=  number_format($row->PAR30_AmtPre,0);$par30pre+=$row->PAR30_AmtPre;?></td>
                                        <td><?=  number_format($row->Ratio1dayPre*100,2);$rat1pre+=$row->Ratio1dayPre*100;?>%</td>
                                        <td><?=  number_format($row->DisbAmtDailyPre,0);$Disbdailypre+=$row->DisbAmtDailyPre;?></td>
                                        <td><?=  $row->DisbAccDailyPre;$DisbAccDailypre+=$row->DisbAccDailyPre;?></td>

                                        <td><?= number_format(($row->OS)-($row->OSPre),0);$os+=($row->OS)-($row->OSPre);?></td>
                                        <td><?= ($row->Cilent)-($row->CilentPre);$Cilent+=($row->Cilent)-($row->CilentPre);?></td>
                                        <td><?=  number_format(($row->PAR1_Amt)-($row->PAR1_AmtPre),0);$par1+=($row->PAR1_Amt)-($row->PAR1_AmtPre);?></td>
                                        <td><?=  number_format(($row->PAR7_Amt)-($row->PAR7_AmtPre),0);$par7+=($row->PAR7_Amt)-($row->PAR7_AmtPre);?></td>
                                        <td><?=  number_format(($row->PAR30_Amt)-($row->PAR30_AmtPre),0);$par30+=($row->PAR30_Amt)-($row->PAR30_AmtPre);?></td>
                                        <td><?=  number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);$rat1+=($row->Ratio1day-$row->Ratio1dayPre)*100;?>%</td>
                                        <td><?=  number_format(($row->DisbAmtDaily)-($row->DisbAmtDailyPre),0);$Disbdailysum+=($row->DisbAmtDaily)-($row->DisbAmtDailyPre);?></td>
                                        <td><?=  ($row->DisbAccDaily)-($row->DisbAccDailyPre);$DisbAccDaily+=($row->DisbAccDaily)-($row->DisbAccDailyPre);?></td>

                                    </tr>
                                <?php endforeach;?>
                                <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                        <td colspan="2">Total:</td>                                    
                                        <td><?= number_format($os,0);?></td>
                                        <td><?= number_format($Cilent,0);?></td>
                                        <td><?=  number_format($par1,0);?></td>
                                        <td><?=  number_format($par7,0);?></td>
                                        <td><?=  number_format($par30,0);?></td>
                                        <td><?php if($par1==0){echo 0;}else{ echo number_format($par1/$os*100,2);}?>%</td>
                                        <td><?=  number_format(array_sum($temp),0);?></td>
                                        <td><?=  $DisbAccDaily;?></td>

                                        <td><?= number_format($ospre,0);?></td>
                                        <td><?= number_format($Cilentpre,0);?></td>
                                        <td><?=  number_format($par1pre,0);?></td>
                                        <td><?=  number_format($par7pre,0);?></td>
                                        <td><?=  number_format($par30pre,0);?></td>
                                        <td><?php  if($par1pre==0){ echo 0;}else{echo number_format($par1pre/$ospre*100,2);};?>%</td>
                                        <td><?=  number_format($Disbdailypre,0);?></td>
                                        <td><?=  $DisbAccDailypre;?></td>

                                        <td><?= number_format($os-$ospre,0);?></td>
                                        <td><?= number_format($Cilent-$Cilentpre,0);?></td>
                                        <td><?=  number_format($par1-$par1pre,0);?></td>
                                        <td><?=  number_format($par7-$par7pre,0);?></td>
                                        <td><?=  number_format($par30-$par30pre,0);?></td>
                                        <td><?php if($par1==0){echo 0;}else{ echo number_format(number_format(($par1/$os*100),2)-number_format(($par1pre/$ospre*100),2),2);}?>%</td>
                                        <td><?=  number_format($Disbdailypre,0);?></td>
                                        <td><?=  $DisbAccDaily-$DisbAccDailypre;?></td>

                                    </tr>
                                <?php 
                                                $grandtoal=$this->DailyCmr_model->getGrandTotalAll(6,$reportdate,$role,$sid,$prereportsdate);
                                                foreach($grandtoal as $row){
                                    ?>
                                <tr style="text-align:right;white-space: nowrap;overflow: hidden;">
                                        <td class="active" colspan="2">Grand Total-KHR:</td>                                    
                                        <td class="active"><?= number_format($row->OS,0);?></td>
                                        <td class="active"><?= number_format($row->Cilent,0);?></td>
                                        <td class="active"><?=  number_format($row->PAR1_Amt,0);?></td>
                                        <td class="active"><?=  number_format($row->PAR7_Amt,0);?></td>
                                        <td class="active"><?=  number_format($row->PAR30_Amt,0);?></td>
                                        <td class="active"><?=  number_format($row->Ratio1day*100,2);?>%</td>
                                        <td class="active"><?=  number_format($row->DisbAmtDaily,0);?></td>
                                        <td class="active"><?=  $row->DisbAccDaily;?></td>

                                        <td class="danger"><?= number_format($row->OSPre,0);?></td>
                                        <td class="danger"><?= number_format($row->CilentPre,0);?></td>
                                        <td class="danger"><?=  number_format($row->PAR1_AmtPre,0);?></td>
                                        <td class="danger"><?=  number_format($row->PAR7_AmtPre,0);?></td>
                                        <td class="danger"><?=  number_format($row->PAR30_AmtPre,0);?></td>
                                        <td class="danger"><?=  number_format($row->Ratio1dayPre*100,2);?>%</td>
                                        <td class="danger"><?=  number_format($row->DisbAmtDailyPre,0);?></td>
                                        <td class="danger"><?=  $row->DisbAccDailyPre;?></td>

                                        <td class="warning"><?= number_format($row->OS-$row->OSPre,0);?></td>
                                        <td class="warning"><?= number_format($row->Cilent-$row->CilentPre,0);?></td>
                                        <td class="warning"><?=  number_format($row->PAR1_Amt-$row->PAR1_AmtPre,0);?></td>
                                        <td class="warning"><?=  number_format($row->PAR7_Amt-$row->PAR7_AmtPre,0);?></td>
                                        <td class="warning"><?=  number_format($row->PAR30_Amt-$row->PAR30_AmtPre,0);?></td>
                                        <td class="warning"><?=  number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?>%</td>
                                        <td class="warning"><?=  number_format($row->DisbAmtDaily-$row->DisbAmtDailyPre,0);?></td>
                                        <td class="warning"><?=  $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>

                                    </tr>
                                <tr style="text-align:right;background-color:rgba(255, 219, 99, 0.92);white-space: nowrap;overflow: hidden;">
                                        <td class="active" colspan="2">Grand Total-USD:</td>                                    
                                        <td class="active"><?= number_format($row->OS/4000,0);?></td>
                                        <td class="active"><?= number_format($row->Cilent,0);?></td>
                                        <td class="active"><?=  number_format($row->PAR1_Amt/4000,0);?></td>
                                        <td class="active"><?=  number_format($row->PAR7_Amt/4000,0);?></td>
                                        <td class="active"><?=  number_format($row->PAR30_Amt/4000,0);?></td>
                                        <td class="active"><?=  number_format($row->Ratio1day*100,2);?>%</td>
                                        <td class="active"><?=  number_format($row->DisbAmtDaily/4000,0);?></td>
                                        <td class="active"><?=  $row->DisbAccDaily;?></td>

                                        <td class="danger"><?= number_format($row->OSPre/4000,0);?></td>
                                        <td class="danger"><?= number_format($row->CilentPre,0);?></td>
                                        <td class="danger"><?=  number_format($row->PAR1_AmtPre/4000,0);?></td>
                                        <td class="danger"><?=  number_format($row->PAR7_AmtPre/4000,0);?></td>
                                        <td class="danger"><?=  number_format($row->PAR30_AmtPre/4000,0);?></td>
                                        <td class="danger"><?=  number_format($row->Ratio1dayPre*100,2);?>%</td>
                                        <td class="danger"><?=  number_format($row->DisbAmtDailyPre/4000,0);?></td>
                                        <td class="danger"><?=  $row->DisbAccDailyPre;?></td>

                                        <td class="warning"><?= number_format(($row->OS-$row->OSPre)/4000,0);?></td>
                                        <td class="warning"><?= number_format(($row->Cilent-$row->CilentPre),0);?></td>
                                        <td class="warning"><?=  number_format(($row->PAR1_Amt-$row->PAR1_AmtPre)/4000,0);?></td>
                                        <td class="warning"><?=  number_format(($row->PAR7_Amt-$row->PAR7_AmtPre)/4000,0);?></td>
                                        <td class="warning"><?=  number_format(($row->PAR30_Amt-$row->PAR30_AmtPre)/4000,0);?></td>
                                        <td class="warning"><?=  number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?>%</td>
                                        <td class="warning"><?=  number_format(($row->DisbAmtDaily-$row->DisbAmtDailyPre)/4000,0);?></td>
                                        <td class="warning"><?=  $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>

                                    </tr>
                                <?php }?>
                            </tbody>
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

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#datestartpre" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
  $(document).ready(function()
  {
    $("#dailycoperforment").on("click",function()
    {
      var datestartpre=$("#datestartpre").val();
      var datestart=$("#datestart").val();
      var brCode=$("#brCode").val();
      if(brCode=='0'){
        alert("Please Choose Branch Name");
      }else
      {
        window.location.href="<?php echo site_url('Daily/DONWLOADCOPERFORMENT');?>/"+datestartpre+"/"+datestart+"/"+brCode;   
      }
     
    });
  });
</script>
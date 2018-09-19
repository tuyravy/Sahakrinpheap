 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $type=$this->session->userdata('types');
       
?><!-- page content -->
            
         
        <!-- Include Date Range Picker -->
           
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
                        <a href="<?= site_url('dailycoperforment');?>" >Co-Performant-Daily</a>
                        <a href="<?= site_url('brancPerforment');?>" class="active">Branch-Performant-Daily</a>
                       
            </div>
       

          <div class="">    
              
              
              
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-file" style="padding:10px;"></span>Branch-Performant-Daily<small></small></h3>
                    </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                    <form class="form-inline">
                       <fieldset class="scheduler-border" style="width:80%;">
                         <legend class="scheduler-border">Specific Period:</legend>
                            <div class="form-group">
                              <label class="sr-only" for="exampleInputEmail3"></label>
                              <div class="row-fluid">
                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="rmsid" id="rmsid" required>
                                    
                                    <?php
                                    if($role==3){
                                    ?>
                                      <option value="<?php echo $sid=$this->session->userdata('system_id');?>" selected = 'selected'><?php echo $this->session->userdata('full_name');?></option>
                                    <?php
                                    
                                    }else{
                                    $bra=$this->DailyCmr_model->GetRMname();?>                                   
                                          <option data-subtext="Select by RM" value=""></option>
                                       <?php   
                                           if(isset($_GET['rmsid']))
                                           {
                                             $rmsid=$_GET['rmsid'];
                                           }
                                           foreach($bra as $row){
                                                if($row->sid==$rmsid){        
                                       ?>
                                                        <option value="<?php echo $row->sid;?>" selected = 'selected'><?php echo $row->name;?></option>
                                       <?Php 
                                                }else{
                                       ?>
                                                        <option value="<?= $row->sid;?>"><?= $row->name;?></option>
                                            <?php }
                                            }?>
                                          <option  value="0000">All RM</option>
                                       <?php 
                                          
                                        }
                                       ?>
                                    </select>
                                    
                                  </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword3">From:</label>
                              <input type="text" id="reportdatepre" class="form-control" name="reportdatepre" 
                                        placeholder="<?php if(isset($_GET['reportdatepre'])){echo $_GET['reportdatepre'];}else{ echo date('Y-m-d');}?>"
                                  value="<?php if(isset($_GET['reportdatepre'])){echo $_GET['reportdatepre'];}else{ echo date("Y-m-d",strtotime($this->Menu_model->getPreCurrRundate()));}?>"
                                  readonly="true" style="background:white;">
                            </div>
                            <div class="form-group">
                              <label  for="exampleInputPassword3">To:</label>
                              <input type="text" id="reportdate" class="form-control" name="reportdate" 
                                        placeholder="<?php if(isset($_GET['reportdate'])){echo $_GET['reportdate'];}else{ echo date('Y-m-d');}?>"
                                  value="<?php if(isset($_GET['reportdate'])){echo $_GET['reportdate'];}else{ echo date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));}?>"
                                  readonly="true" style="background:white;">
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top:5px;">
                            <span class="glyphicon glyphicon-search"></span><span style="margin-left:5px;">Search</span></button>                         
                          </fieldset>
                        </form>
                      <div class="row">
                        <div class="pull-right">       
                            <button type="button" class="btn btn-success" id="dailybranchperforment">
                            <span class="glyphicon glyphicon-download-alt"></span>
                                <span style="margin-left:5px;">Download Excel Files</span>
                            </button>       
                        </div>
                      </div>
                        <br/>
                       <div class="panel-body table-responsive">
                        <table id="datatable-buttons" class="table table-bordered table-condensed f11">
                          <thead>
                            <tr style="white-space: nowrap;overflow: hidden;">
                              <th rowspan="3"  style="text-align:center;padding:0px 0px 35px 0px;" class="active">No</th>
                              <th rowspan="3"  style="text-align:center;padding:0px 0px 35px 0px;" class="active">Branch</th>
                              <th colspan="8"  style="text-align:center;" class="active">Result Current</th>
                              <th colspan="8"  style="text-align:center;" class="danger">Result Previous</th>
                              <th colspan="8"  style="text-align:center;" class="warning">Varaince</th>
                            </tr>
                            <tr>
                              <th colspan="8"  style="text-align:center;"  class="active">
                                  <?php
                                    if(isset($_GET['reportdate']))
                                    {
                                        
                                       echo  $reportdate=date("d-M-Y",strtotime($_GET['reportdate']));
                                    }else
                                    {
                                       echo $reportdate=date("d-M-Y",strtotime($this->Menu_model->getCurrRundate()));
                                       
                                    };?></th>

                              <th colspan="8"  style="text-align:center;" class="danger">
                                    <?php
                                      if(isset($_GET['reportdatepre']))
                                      {
                                          
                                        echo  $reportdatepre=date("d-M-Y",strtotime($_GET['reportdatepre']));
                                      }else
                                      {
                                        echo $reportdatepre=date("d-M-Y",strtotime($this->Menu_model->getPreCurrRundate()));
                                        
                                      };?>
                              </th>
                              <th colspan="8"  style="text-align:center;" class="warning">
                              <?php
                                      if(isset($_GET['reportdatepre']))
                                      {
                                          
                                        echo  $reportdatepre=date("d-M-Y",strtotime($_GET['reportdatepre']));
                                      }else
                                      {
                                        echo $reportdatepre=date("d-M-Y",strtotime($this->Menu_model->getPreCurrRundate()));
                                        
                                      };?>
                                      <span style="padding:10px;">
                                      /
                                      </span>
                                    <?php
                                      if(isset($_GET['reportdate']))
                                      {
                                          
                                        echo  $reportdate=date("d-M-Y",strtotime($_GET['reportdate']));
                                      }else
                                      {
                                        echo $reportdate=date("d-M-Y",strtotime($this->Menu_model->getCurrRundate()));
                                        
                                      };?>
                              </th>
                            </tr>
                            <tr style="white-space: nowrap;overflow: hidden;">
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
                           <tbody id="showvalues">
                               <?php
                                    if(isset($_GET['rmsid'])){
                                      $sid=$_GET['rmsid'];
                                      if($sid=="0000"){
                                          foreach($bra as $rmrow){
                                            
                                                  $reportdate=date("Ymd",strtotime($_GET['reportdate'])); 
                                                  $reportdatepre=date("Ymd",strtotime($_GET['reportdatepre']));                                             
                                                  $result=$this->DailyCmr_model->DailyBranchPerforment($rmrow->sid,3,$reportdate,100,0,$reportdatepre,$type);
                                                      
                                          
                                      $i=1;
                                    foreach($result as $row):
                                
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
                               
                               <?php        $grandtoal=$this->DailyCmr_model->getGrandTotalAll(7,$reportdate,3,$rmrow->sid,$reportdatepre);
                                            foreach($grandtoal as $row){
                                ?>
                               <tr>
                                    <td class="active" style="white-space: nowrap;overflow: hidden;"><?php echo $rmrow->name; ?></td>         
                                    <td class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-KHR:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR1_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR7_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR30_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->DisbAmtDaily,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format($row->OS-$row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR1_Amt-$row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR7_Amt-$row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR30_Amt-$row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->DisbAmtDaily-$row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>
                               <tr>
                                    <td class="active" style="white-space: nowrap;overflow: hidden;"><?php echo $rmrow->name; ?></td>
                                    <td class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-USD:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS/4000,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR1_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR7_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR30_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->DisbAmtDaily/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre/4000,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR1_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR7_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR30_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->DisbAmtDailyPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format(($row->OS-$row->OSPre)/4000,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR1_Amt-$row->PAR1_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR7_Amt-$row->PAR7_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR30_Amt-$row->PAR30_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->DisbAmtDaily-$row->DisbAmtDailyPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>
                              
                               <?php    
                                            
                                        }
                                      }
                                ?>
                                 <?php        $grandtoal=$this->DailyCmr_model->getGrandTotalAll(7,$reportdate,$role,$sid,$reportdatepre);
                                            foreach($grandtoal as $row){
                                ?>
                               <tr>
                                    <td colspan="2" class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-KHR:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR1_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR7_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR30_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->DisbAmtDaily,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format($row->OS-$row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR1_Amt-$row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR7_Amt-$row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR30_Amt-$row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->DisbAmtDaily-$row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>
                               <tr>
                                    <td colspan="2" class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-USD:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS/4000,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR1_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR7_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR30_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->DisbAmtDaily/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre/4000,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR1_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR7_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR30_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->DisbAmtDailyPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format(($row->OS-$row->OSPre)/4000,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR1_Amt-$row->PAR1_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR7_Amt-$row->PAR7_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR30_Amt-$row->PAR30_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->DisbAmtDaily-$row->DisbAmtDailyPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>

                                <?php
                                            }
                                    }else{
                                  
                                      $reportdate=date("Ymd",strtotime($_GET['reportdate'])); 
                                      $reportdatepre=date("Ymd",strtotime($_GET['reportdatepre'])); 
                                        //$sid=$this->session->userdata('system_id'); 
                                        //$reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                        //$reportdatepre=date("Ymd",strtotime($this->Menu_model->getPreCurrRundate())); 
                                        $result=$this->DailyCmr_model->DailyBranchPerforment($sid,3,$reportdate,100,0,$reportdatepre,$type);
                                  $i=1;
                                 
                                 foreach($result as $row):
                                  
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
                                    <td style="text-align:right;"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($row->DisbAmtDaily-$row->DisbAmtDailyPre,0),0);?></td>
                                    <td style="text-align:right;"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>

                                </tr>
                               <?php endforeach;?>
                               
                               <?php        
                                            $reportdate=date("Ymd",strtotime($_GET['reportdate'])); 
                                            $reportdatepre=date("Ymd",strtotime($_GET['reportdatepre'])); 
                                            $grandtoal=$this->DailyCmr_model->getGrandTotalAll(7,$reportdate,3,$sid,$reportdatepre);
                                            foreach($grandtoal as $row){
                                ?>
                               <tr>
                                    <td colspan="2" class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-KHR:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR1_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR7_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR30_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->DisbAmtDaily,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format($row->OS-$row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR1_Amt-$row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR7_Amt-$row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR30_Amt-$row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->DisbAmtDaily-$row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>
                               <tr>
                                    <td colspan="2" class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-USD:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS/4000,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR1_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR7_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR30_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->DisbAmtDaily/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre/4000,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR1_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR7_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR30_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->DisbAmtDailyPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format(($row->OS-$row->OSPre)/4000,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR1_Amt-$row->PAR1_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR7_Amt-$row->PAR7_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR30_Amt-$row->PAR30_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->DisbAmtDaily-$row->DisbAmtDailyPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>
                                            <?php
                                           }
                                          }
                                        }else{                         
                                        $sid=$this->session->userdata('system_id'); 
                                        $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                        $reportdatepre=date("Ymd",strtotime($this->Menu_model->getPreCurrRundate())); 
                                        $result=$this->DailyCmr_model->DailyBranchPerforment($sid,$role,$reportdate,100,0,$reportdatepre,$type);
                                  $i=1;
                                 
                                 foreach($result as $row):
                                  
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
                                    <td style="text-align:right;"><?= number_format(round($row->PAR1_Amt-$row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR7_Amt-$row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR30_Amt-$row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($row->DisbAmtDaily-$row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>

                                </tr>
                               <?php endforeach;?>
                               
                               <?php        $grandtoal=$this->DailyCmr_model->getGrandTotalAll(7,$reportdate,$role,$sid,$reportdatepre);
                                            foreach($grandtoal as $row){
                                ?>
                               <tr>
                                    <td colspan="2" class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-KHR:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR1_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR7_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->PAR30_Amt,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round($row->DisbAmtDaily,0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round($row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format($row->OS-$row->OSPre,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR1_Amt-$row->PAR1_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR7_Amt-$row->PAR7_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->PAR30_Amt-$row->PAR30_AmtPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round($row->DisbAmtDaily-$row->DisbAmtDailyPre,0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>
                               <tr>
                                    <td colspan="2" class="active" style="white-space: nowrap;overflow: hidden;">Grand Total-USD:</td>                                   
                                    <td style="text-align:right;" class="active"><?= number_format($row->OS/4000,0);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->Cilent;?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR1_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR7_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->PAR30_Amt/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;" class="active"><?= number_format(round(($row->DisbAmtDaily/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="active"><?= $row->DisbAccDaily;?></td>

                                    <td style="text-align:right;" class="danger"><?= number_format($row->OSPre/4000,0);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->CilentPre;?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR1_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR7_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->PAR30_AmtPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= number_format($row->Ratio1dayPre*100,2);?> % </td>
                                    <td style="text-align:right;" class="danger"><?= number_format(round(($row->DisbAmtDailyPre/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="danger"><?= $row->DisbAccDailyPre;?></td>

                                    <td style="text-align:right;" class="warning"><?= number_format(($row->OS-$row->OSPre)/4000,0);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->Cilent-$row->CilentPre;?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR1_Amt-$row->PAR1_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR7_Amt-$row->PAR7_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->PAR30_Amt-$row->PAR30_AmtPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= number_format(($row->Ratio1day-$row->Ratio1dayPre)*100,2);?> % </td>
                                    <td style="text-align:right;" class="warning"><?= number_format(round((($row->DisbAmtDaily-$row->DisbAmtDailyPre)/4000),0),-2);?></td>
                                    <td style="text-align:right;" class="warning"><?= $row->DisbAccDaily-$row->DisbAccDailyPre;?></td>
                               </tr>
                              <?php
                                            }
                                          
                                        }
                                ?>
                           </tbody>
                           
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

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#reportdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#reportdatepre" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
   
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
  $(document).ready(function()
  {
    $("#dailybranchperforment").on("click",function()
    {
      var reportdatepre=$("#reportdatepre").val();
      var reportdate=$("#reportdate").val();
      var rmsid=$("#rmsid").val();
      if(rmsid==''){
        alert("Please Choose Branch Name");
      }else
      {
        window.location.href="<?php echo site_url('Daily/DONWLOADBRANCHPERFORMENT');?>/"+reportdatepre+"/"+reportdate+"/"+rmsid;   
      }
     
    });
  });
</script>



  
        <?php
        if(isset($_GET['datestart']))
        {
            $reportdate=$_GET['datestart'];
            $reportdateend=$_GET['dateend'];
        }
        ?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailydceo/dcmrsahakrinpheaceo');?>" >Summary CMR-Daily</a>
                        <a href="<?= site_url('dailydceo/cmrSummRMCEO');?>" class="active">Summary CMR By RM-Daily</a>
                        <?php if($type==3){}else{?>
                            <a href="<?= site_url('dailydceo/loandisbbyinterest');?>">Disbursement by Interest-Daily</a>
                        <?php }?>
            </div>
          <div class="">        
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="dashboard_graph x_panel">                
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-file" style="padding:10px;"></span>Summary CMR By RM-Daily <small></small></h3>
                    </div>                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                     <div class="col-md-12">                                         
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                    <span style="margin-left:5px;">PRINT</span></button>  
                                    <p></p>
                        </div>  
                    </div>
                    <div class="col-md-12 nopadding">                            
                             <div class="col-md-12 nopadding">
                                <form class="form-inline">
                                  <fieldset class="scheduler-border" style="width:80%;">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">By RM:</label>
                                         <select class="form-control" data-show-subtext="true" data-live-search="true" name="rmvalues">                                                
                                         <option data-subtext="Select RM" value="0000"><< Select RM >></option>  
                                            <?php
                                                foreach($bra as $row){?>                                               
                                                <?php  
                                                if(isset($_GET['rmvalues'])){?>                                               
                                                  <option value="<?php echo $row->sid;?>" <?php if($row->sid==$_GET['rmvalues']){ echo  'selected';}?>><?php echo $row->name;?></option>
                                                  <?php }else{?>
                                                  <option value="<?php echo $row->sid;?>"><?php echo $row->name;?></option>
                                                <?php }}?>
                                            <option data-subtext="Select RM" value="0000">All RM</option>
                                        </select>
                                      </div> 
                                      <div class="form-group">
                                        <label for="exampleInputName2">From:</label>
                                        <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                               placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo $reportdateend;}?>"
                                        value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo $reportdateend;}?>"
                                        readonly="true" style="background:white;">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail2">To:</label>
                                         <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                                placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo $reportdate;}?>" 
                                                value="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo $reportdate;}?>"
                                                readonly="true" style="background:white;">
                                      </div> 
                                     
                                     <button type="submit" class="btn btn-primary" style="margin-top:5px;"><span style="margin-left:5px;">Search</span></button>
                                    </fieldset>
                                </form>
                             </div>
                        </div>  
                        
                        
                        <br/>
                      <div id="reports"> 
                      <div class="col-md-12 nopadding">
                         
                          <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                          <h2 id="in" style="text-align:left;">CREDIT MONITORING REPORT_DAILY</h2>
                          <p id="in" style="text-align:left">Reports Date:
                          
                             <?php if(isset($_GET['datestart'])){echo date("d-M-Y",strtotime($_GET['datestart']));}else{ echo date("d-M-Y",strtotime($reportdateend));}?>
                            <span style="margin-left:10px;">
                                To:<span style="margin-left:10px;"></span>
                            <?php if(isset($_GET['dateend'])){echo date("d-M-Y",strtotime($_GET['dateend']));}else{ echo date("d-M-Y",strtotime($reportdate));}?>
                            </span>
                              
                            
                          </p>
                      </div> 
                       <table class="table table-bordered">
                          <thead class="active">
                          <tr style="background-color:#5aadea;color:#ffffff;white-space: nowrap;overflow: hidden;">
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">No.</th> 
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">INDICATORS</th> 
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">Previous month</th> 
                            <th rowspan="2" style="padding:0px 0px 10px 0px;text-align:center">Actual</th> 
                            <th style="padding:0px 0px 0px 0px;text-align:center"> Variance</th> 
                          </tr>
                            <tr style="background-color:#5aadea;color:#ffffff;white-space: nowrap;overflow: hidden;">                                
                                <th style="padding:0px 0px 0px 0px;text-align:center">Pre-Month VS Actual</th>
                            </tr>
                          </thead>
                           <tbody>
                            <?php
                               if(isset($_GET['rmvalues']))
                                {
                                    if($_GET['rmvalues']=="0000"){  
                                        $a=1;                       
                                       foreach($bra as $rm){                                           
                                        $row=$this->DCEO_model->getcmrsummRMCEO($rm->sid,$reportdateend,$type);
                                        $pre=$this->DCEO_model->getcmrsummRMCEO($rm->sid,$reportdate,$type);
                                ?>
                                    <tr class="info">
                                         <td style="padding:3px 0px 0px 3px;text-align:center;font-weight:bold;font-size:16px;"><?= $a++;?></td>
                                         <td style="padding:3px 0px 0px 3px;font-weight:bold;font-size:16px;"><?= $rm->name;?></td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                    </tr>

                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a-1;?>.1</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->NumOfActive,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->NumOfActive,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                       <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->NumOfActive)-($pre->NumOfActive),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.2</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (New Prod.)</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                              <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->NumOfActive_New,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->NumOfActive_New,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->NumOfActive_New)-($pre->NumOfActive_New),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.3</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (Existing Prod.)</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->NumOfActive_Existing,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->NumOfActive_Existing,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->NumOfActive_Existing)-($pre->NumOfActive_Existing),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.4</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                         </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance)-($pre->Balance))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.5</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio - New Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_New/4000,0);?>
                                                 </div>
                                             </div>
                                         </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_New/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_New)-($pre->Balance_New))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.6</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio -Existing Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Existing)-($pre->Balance_Existing))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>   

                               
                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.7</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed in month</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Disbursed/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Disbursed/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Disbursed)-($pre->Balance_Disbursed))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.8</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - New Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Disburesd_New/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Disburesd_New/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Disburesd_New)-($pre->Balance_Disburesd_New))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.9</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - Existing Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Disburesd_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Disburesd_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Disburesd_Existing)-($pre->Balance_Disburesd_Existing))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>      




                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.10</td>
                                         <td style="padding:3px 0px 0px 5px;">Portfolio Quality</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                    </tr>
                                    <tr   class="warning">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.11</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR Ratio(1 day)%</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?php if($pre->PAR1DAY==0){ echo 0;}else{ echo number_format($pre->PAR1DAY/$pre->Balance*100,2);}?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?php if($pre->PAR1DAY==0){ echo 0;}else{echo number_format($row->PAR1DAY/$row->Balance*100,2);}?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?php if($row->PAR1DAY==0 || $pre->PAR1DAY==0){echo 0;}else{ echo number_format(($row->PAR1DAY/$row->Balance*100)-($pre->PAR1DAY/$pre->Balance*100),2);}?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.12</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR(1 day) $</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->PAR1DAY/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PAR1DAY/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->PAR1DAY)-($pre->PAR1DAY))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                           <?php }}else{    
                                        $a=1;
                                        $row=$this->DCEO_model->getcmrsummRMCEO($_GET['rmvalues'],$reportdateend,$type);
                                        $pre=$this->DCEO_model->getcmrsummRMCEO($_GET['rmvalues'],$reportdate,$type);
                                ?>
                                        <tr class="info">
                                             <td style="padding:3px 0px 0px 3px;text-align:center;font-weight:bold;font-size:16px;"><?= 1;?></td>
                                             <td style="padding:3px 0px 0px 3px;font-weight:bold;font-size:16px;"><?= $this->DCEO_model->getRmNamebySID($_GET['rmvalues']);?></td>
                                             <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                             <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                             <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                        </tr>
    
                                        <tr class="danger">
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.1</td>
                                             <td style="padding:3px 0px 0px 5px;">Number of Active Borrower</td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->NumOfActive,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->NumOfActive,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                           <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format(($row->NumOfActive)-($pre->NumOfActive),0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                        <tr>
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.2</td>
                                             <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (New Prod.)</td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                  <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->NumOfActive_New,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->NumOfActive_New,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format(($row->NumOfActive_New)-($pre->NumOfActive_New),0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                        <tr>
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.3</td>
                                             <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (Existing Prod.)</td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->NumOfActive_Existing,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->NumOfActive_Existing,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2"></div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format(($row->NumOfActive_Existing)-($pre->NumOfActive_Existing),0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                        <tr class="danger">
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.4</td>
                                             <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio</td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->Balance/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                             </td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->Balance/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format((($row->Balance)-($pre->Balance))/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                   
                                        <tr>
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.5</td>
                                             <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio - New Prod.</td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->Balance_New/4000,0);?>
                                                     </div>
                                                 </div>
                                             </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->Balance_New/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format((($row->Balance_New)-($pre->Balance_New))/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                   
                                        <tr>
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.6</td>
                                             <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio -Existing Prod.</td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->Balance_Existing/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->Balance_Existing/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format((($row->Balance_Existing)-($pre->Balance_Existing))/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>   
    
                                   
                                         <tr class="danger">
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.7</td>
                                             <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed in month</td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->Balance_Disbursed/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->Balance_Disbursed/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format((($row->Balance_Disbursed)-($pre->Balance_Disbursed))/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                        <tr>
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.8</td>
                                             <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - New Prod</td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->Balance_Disburesd_New/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->Balance_Disburesd_New/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format((($row->Balance_Disburesd_New)-($pre->Balance_Disburesd_New))/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                        <tr>
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.9</td>
                                             <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - Existing Prod</td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->Balance_Disburesd_Existing/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->Balance_Disburesd_Existing/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format((($row->Balance_Disburesd_Existing)-($pre->Balance_Disburesd_Existing))/4000,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>      
    
    
    
    
                                         <tr class="danger">
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.10</td>
                                             <td style="padding:3px 0px 0px 5px;">Portfolio Quality</td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                
                                                 
                                            </td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                
                                                 
                                            </td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                
                                                 
                                            </td>
                                        </tr>
                                        <tr   class="warning">
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.11</td>
                                             <td style="padding:3px 0px 0px 5px;">PAR Ratio(1 day)%</td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">%</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?php if($pre->PAR1DAY==0){echo 0;}else{echo number_format($pre->PAR1DAY/$pre->Balance*100,2);}?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">%</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?php if($row->PAR1DAY==0){echo 0;}else{echo number_format($row->PAR1DAY/$row->Balance*100,2);}?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">%</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?php if($row->PAR1DAY==0){echo 0;}else{echo number_format(($row->PAR1DAY/$row->Balance*100)-($pre->PAR1DAY/$pre->Balance*100),2);}?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                        <tr>
                                             <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.12</td>
                                             <td style="padding:3px 0px 0px 5px;">PAR(1 day) $</td>
                                             <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($pre->PAR1DAY,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format($row->PAR1DAY,0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                            <td style="padding:0px 0px 0px 0px;text-align:center">
                                                 <div class="row">
                                                  <div class="col-md-2">$</div>
                                                    <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                        <?= number_format(($row->PAR1DAY)-($pre->PAR1DAY),0);?>
                                                     </div>
                                                 </div>
                                                 
                                            </td>
                                        </tr>
                                 
                            <?php }}else{                              
                                    $a=1;
                                    $row=$this->DCEO_model->getcmrsummRMCEO('344',$reportdate,$type);
                                    $pre=$this->DCEO_model->getcmrsummRMCEO('344',$reportdateend,$type);
                                    if(isset($sid)){
                                        if($sid==""){
                                            $sid='344';
                                        }
                                    }
                                  
                               
                            ?>
                                    <tr class="info">
                                         <td style="padding:3px 0px 0px 3px;text-align:center;font-weight:bold;font-size:16px;"><?= 1;?></td>
                                         <td style="padding:3px 0px 0px 3px;font-weight:bold;font-size:16px;"><?= $this->DCEO_model->getRmNamebySID('344');?></td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                         <td style="padding:3px 0px 0px 3px;text-align:center">USD</td>
                                    </tr>

                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.1</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->NumOfActive,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->NumOfActive,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                       <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->NumOfActive)-($pre->NumOfActive),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.2</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (New Prod.)</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                              <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->NumOfActive_New,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->NumOfActive_New,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->NumOfActive_New)-($pre->NumOfActive_New),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.3</td>
                                         <td style="padding:3px 0px 0px 5px;">Number of Active Borrower (Existing Prod.)</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->NumOfActive_Existing,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->NumOfActive_Existing,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->NumOfActive_Existing)-($pre->NumOfActive_Existing),0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.4</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                         </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance)-($pre->Balance))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.5</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio - New Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_New/4000,0);?>
                                                 </div>
                                             </div>
                                         </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_New/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_New)-($pre->Balance_New))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.6</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Portfolio -Existing Prod.</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Existing)-($pre->Balance_Existing))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>   

                               
                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.7</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed in month</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Disbursed/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Disbursed/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Disbursed)-($pre->Balance_Disbursed))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.8</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - New Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Disburesd_New/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Disburesd_New/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Disburesd_New)-($pre->Balance_Disburesd_New))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.9</td>
                                         <td style="padding:3px 0px 0px 5px;">Balance of Loan Disbursed - Existing Prod</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->Balance_Disburesd_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->Balance_Disburesd_Existing/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->Balance_Disburesd_Existing)-($pre->Balance_Disburesd_Existing))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>      




                                     <tr class="danger">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.10</td>
                                         <td style="padding:3px 0px 0px 5px;">Portfolio Quality</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                            
                                             
                                        </td>
                                    </tr>
                                    <tr   class="warning">
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.11</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR Ratio(1 day)%</td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?php if($pre->PAR1DAY==0){echo 0;}else{echo number_format($pre->PAR1DAY/$pre->Balance*100,2);}?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                <?php if($row->PAR1DAY==0){echo 0;}else{echo number_format($row->PAR1DAY/$row->Balance*100,2);}?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">%</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?php if($row->PAR1DAY==0 || $pre->PAR1DAY==0){echo 0;}else{ echo number_format(($row->PAR1DAY/$row->Balance*100)-($pre->PAR1DAY/$pre->Balance*100),2);}?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                         <td style="padding:0px 0px 0px 0px;text-align:center"><?= $a;?>.12</td>
                                         <td style="padding:3px 0px 0px 5px;">PAR(1 day) $</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($pre->PAR1DAY/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->PAR1DAY/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format((($row->PAR1DAY)-($pre->PAR1DAY))/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <?php }?>
                               
                                <?php 
                                $pre=$this->DCEO_model->getsumary($reportdate);
                                $row=$this->DCEO_model->getsumary($reportdateend);
                               
                               ?>
                            <tr class="success">
                                    
                                    <td style="padding:3px 0px 0px 5px;" colspan="5">I. SUMMARY</td>
                                         
                                </tr>
                                <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">Active Client</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($pre->NumOfActive,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($row->NumOfActive,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format($row->NumOfActive-$pre->NumOfActive,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                                <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">Outstanding</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($pre->Balance/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($row->Balance/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->Balance-$pre->Balance)/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">PAR 1day</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($pre->PAR1DAY/4000,0);?> 
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($row->PAR1DAY/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?= number_format(($row->PAR1DAY-$pre->PAR1DAY)/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">Monthly Disburse</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($pre->Balance_Disbursed/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?= number_format($row->Balance_Disbursed/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2">$</div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                     <?= number_format(($row->Balance_Disbursed-$pre->Balance_Disbursed)/4000,0);?>
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                               <tr>
                                    
                                         <td style="padding:3px 0px 0px 5px;" colspan="2">PAR 1day %</td>
                                         <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?php if($pre->PAR1DAY==0){echo 0;}else{echo number_format($pre->PAR1DAY/$pre->Balance*100,2);}?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                   <?php if($row->PAR1DAY==0){echo 0;}else{echo number_format($row->PAR1DAY/$row->Balance*100,2);}?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                        <td style="padding:0px 0px 0px 0px;text-align:center">
                                             <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-10 text-right" style="margin-left:-10px;">
                                                    <?php if($row->PAR1DAY==0){echo 0;}else{echo number_format(($row->PAR1DAY/$row->Balance-$pre->PAR1DAY/$pre->Balance)*100,2);}?>%
                                                 </div>
                                             </div>
                                             
                                        </td>
                                    </tr>
                             
                              
                           </tbody>
                           
                      </table>
                              
                        </div> 
                        
                       <div>
                        <p> FX= 	 4,000 </p>  
                      </div>                         
                    </div>                      
                  </div>
                    
                </div>
                  
              </div>
            </div>
<style>
   #in{text-align: left;}
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
        width:75%;
        
    }
    .nopadding {
    padding: 0 !important;
    margin: 0 !important;
    }
 </style>
   <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <style>#in{text-align: left;}</style>
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
            
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            window.location.href="<?= site_url("cmrSummRMCEO");?>";
          
        }
    </script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>
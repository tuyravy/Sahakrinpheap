 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');    
?><!-- page content -->
            
         
        <!-- Include Date Range Picker -->
       
        
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
                          
                          <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword3"></label>
                            <input type="text" name="reportdate" id="reportdate" class="form-control"
                            placeholder="<?php if(isset($_GET['reportdate'])){echo $_GET['reportdate'];}else{ echo $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));}?>"
                            value="<?php if(isset($_GET['reportdate'])){echo $_GET['reportdate'];}else{ echo $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));}?>">
                          </div>
                         
                          <button type="submit" class="btn btn-primary" style="margin-top:5px;">
                          <span class="glyphicon glyphicon-search"></span><span style="margin-left:5px;">Search</span></button>
                           <a href="<?= site_url('AllbranchPerforment');?>"  class="btn btn-primary" style="margin-top:5px;" ><i class="fa fa-eye" aria-hidden="true"></i>
                          <span style="margin-left:5px;">View All Branch</span></a>
                        </form>
                        
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div style="margin-left:180px;">
                                <form class="form-inline" style="margin-right:-50px;">                          
                                  <div class="form-group">
                                    <label for="inputPassword3" class="control-label">Option Compare</label>                                  
                                  </div>
                                  <div class="form-group">
                                     
                                        <select class="form-control">
                                          <option>Daily</option>
                                          <option>Monthly</option>                                          
                                        </select>
                                    
                                  </div>
                                </form>
                             </div>
                            <div class="col-md-2 pull-right">
                                 
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" onclick="javascript:printDiv('reports')" id="btnPrint"><span class="glyphicon glyphicon-print"></span>
                                            <span style="margin-left:5px;">PRINT</span></button>  
                                        <p></p>
                                </div>
                            </div>
                        </div>
                            
                        </div>                        
                        <br/>
                       <div class="panel-body table-responsive">   
                        <div id="reports">
                        <table id="datatable-buttons" class="table table-bordered table-condensed f11">
                          <thead>
                            <tr style="white-space: nowrap;overflow: hidden;">
                              <th rowspan="2"  style="text-align:center;padding:0px 0px 25px 0px;">No</th>
                              <th rowspan="2"  style="text-align:center;padding:0px 0px 25px 0px;">Branch</th>
                              <th colspan="14"  style="text-align:center;">
                                  <?php
                                    if(isset($_GET['reportdate']))
                                    {
                                        
                                       echo  $reportdate=date("d-M-Y",strtotime($_GET['reportdate']));
                                    }else
                                    {
                                       echo $reportdate=date("d-M-Y",strtotime($this->Menu_model->getCurrRundate()));
                                       
                                    };?></th>
                            
                            </tr>
                            <tr style="white-space: nowrap;overflow: hidden;">
                              <th  style="text-align:center;">Total Pre-Balance</th> 
                              <th  style="text-align:center;">Total Balance</th>   
                              <th  style="text-align:center;">Clients-Pre</th>
                              <th  style="text-align:center;">Clients</th>
                              <th  style="text-align:center;">Pre-PAR Value 1-Days</th>
                              <th  style="text-align:center;">PAR Value 1-Days</th>
                              <th  style="text-align:center;">Pre-PAR Value 7-Days</th>
                              <th  style="text-align:center;">PAR Value 7-Days</th>
                              <th  style="text-align:center;">Pre-PAR Value 30-Days</th>
                              <th  style="text-align:center;">PAR Value 30-Days</th>
                              <th  style="text-align:center;">Pre-PAR Ratio 1Days(%)</th>
                              <th  style="text-align:center;">PAR Ratio 1Days(%)</th>
                              <th  style="text-align:center;">Balance of loan Disbursement</th>
                              <th  style="text-align:center;">Client_Dis</th>
                            </tr>
                           </thead>
                           <tbody id="showvalues">
                               <?php
                                    
                                    if(isset($_GET['reportdate']))
                                    {                                    
                                        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                         if($page==null)
                                        {
                                            $page=0;
                                        }
                                        $reportdate=date("Ymd",strtotime($_GET['reportdate'])); 
                                        $result=$this->DailyCmr_model->DailyBranchPerforment($sid,$role,$reportdate,$page,1);
                                       
                                        
                                    }else
                                    {
                                        
                                        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                        if($page==null)
                                        {
                                            $page=0;
                                        }
                                        $reportdate=date("Ymd",strtotime($this->Menu_model->getCurrRundate()));
                                        $result=$this->DailyCmr_model->DailyBranchPerforment($sid,$role,$reportdate,$page,1);
                                       
                                    }
                                    $i=1;
                                    $TotalOS=0;
                                    $TotalCilent=0;
                                    $TotalPAR1_Amt=0;
                                    $TotalPAR7_Amt=0;
                                    $TotalPAR30_Amt=0;
                                    $TotalRatio1day=0;
                                    $TotalDisbAmtDaily=0;
                                    $TotalDisbAccDaily=0;
                                    foreach($result as $row):
                                    $TotalOS+=$row->OS;
                                    $TotalCilent+=$row->Cilent;
                                    $TotalPAR1_Amt+=$row->PAR1_Amt;
                                    $TotalPAR7_Amt+=$row->PAR7_Amt;
                                    $TotalPAR30_Amt+=$row->PAR30_Amt;
                                    $TotalRatio1day+=$row->Ratio1day;
                                    $TotalDisbAmtDaily+=$row->DisbAmtDaily;
                                    $TotalDisbAccDaily+=$row->DisbAccDaily;
                               ?>
                                <tr>
                                    <td><?= $i++;?></td>
                                    <td><?= $row->shortcode;?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format($row->OS,0);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= $row->Cilent;?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR1_Amt,0),2);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR7_Amt,0),2);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format(round($row->PAR30_Amt,0),2);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format($row->Ratio1day*100,2);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($row->DisbAmtDaily,0),2);?></td>
                                    <td style="text-align:right;"><?= $row->DisbAccDaily;?></td>
                                </tr>
                               <?php endforeach;?>
                               <tr>
                                    <td colspan="2">Total:</td>                                   
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format($TotalOS,0);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= $TotalCilent;?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format(round($TotalPAR1_Amt,0),2);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format(round($TotalPAR7_Amt,0),2);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format(round($TotalPAR30_Amt,0),2);?></td>
                                    <td></td>
                                    <td style="text-align:right;"><?= number_format(round($TotalRatio1day,2),2);?> % </td>
                                    <td style="text-align:right;"><?= number_format(round($TotalDisbAmtDaily,0),2);?></td>
                                    <td style="text-align:right;"><?= $TotalDisbAccDaily;?></td>
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

                               

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
 <!----------------JavaScript Get Datepicker--->
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#reportdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
   
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
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
            window.location.href="<?= site_url("AllbranchPerforment");?>";
          
        }
    </script>



  
 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id'); 
        $reportdate=date("Y-m-d",strtotime($this->Menu_model->getCurrRundate()));
       
?><!-- page content -->
               
        
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
        
            <div class="breadcrumb flat row nopadding" style="margin-top:-10px;">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('dailyrm/activeBorrower');?>">Loan Active Borrower</a>
                        <a href="<?= site_url('dailyrm/loanPortfolio');?>">Loan Portfolio</a>
                        <a href="<?= site_url('dailyrm/loanDisbInMonth');?>" >Loan Disbursement</a>
                        <a href="<?= site_url('dailyrm/writtenoff');?>" class="active">Loan Written-Off Collection</a>
                        <a href="<?= site_url('dailyrm/repaymentinmonth');?>">Loan Repayment</a>
            </div>
       

          <div class="">        
              <div class="row">                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3><span class="glyphicon glyphicon-file" style="padding:10px;"></span>Written-Off and Loan > 90 Days<small></small></h3>
                    </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:auto;">
                     
                       <div class="col-md-12">
                          <div class="col-md-10">
                              <form class="form-inline">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                               <div class="form-group">
                                    <label for="exampleInputName2">From:</label>
                                    <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                       placeholder="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date('Y-m-d');}?>"
                                    value="<?php if(isset($_GET['datestart'])){echo $_GET['datestart'];}else{ echo date('Y-m-d');}?>"
                                    readonly="true" style="background:white;">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail2">To:</label>
                                 <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                        placeholder="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date('Y-m-d');}?>" 
                                        value="<?php if(isset($_GET['dateend'])){echo $_GET['dateend'];}else{ echo date('Y-m-d');}?>"
                                        readonly="true" style="background:white;">
                              </div> 
                              <div class="form-group">
                                  <label>
                                      <input type="checkbox" value="0" name="keydetail"> Detail Reports
                                 </label>
                              </div>
                              <button type="submit" class="btn btn-primary" style="margin-top:5px;">Search</button>
                               </fieldset>
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
                         <br/>
                      <div id="reports"> 
                      <div class="col-md-12">
                          
                          <h2 id="in" style="text-align:left;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                          <h2 id="in" style="text-align:left;">CREDIT MONITORING REPORT_DAILY</h2>
                          <p id="in" style="text-align:left">Reports Date:
                              <?php
                                if(isset($_GET['datestart']))
                                {
                                    echo date('d-M-Y',strtotime($_GET['datestart']));
                                }else
                                {
                                    echo date('d-M-Y',strtotime($reportdate));
                                }
                              ?>
                          
                            <span style="margin-left:10px;">
                                To:<span style="margin-left:10px;">
                                    <?php
                                    if(isset($_GET['enddate']))
                                    {
                                        echo date('d-M-Y',strtotime($_GET['enddate']));
                                    }else
                                    {
                                        echo date('d-M-Y',strtotime($reportdate));
                                    }
                                  ?>
                                   </span>
                            </span>
                              
                            
                          </p>
                      </div> 
                       <table class="table table-bordered">
                          <thead class="active">
                          <tr class="active">
                            <th rowspan="3" style="padding:0px 0px 10px 0px;text-align:center">N<sup>0</sup></th> 
                            <th colspan="9" style="padding:0px 0px 3px 0px;text-align:center">Balance and Achievement</th> 
                            <th rowspan="3" style="padding:0px 0px 10px 0px;text-align:center">Achievement</th> 
                            <th rowspan="3" style="padding:0px 0px 10px 0px;text-align:center">Amt-Defer</th> 
                            <th rowspan="3" style="padding:0px 0px 10px 0px;text-align:center">Reportdate</th>
                          </tr>
                            <tr class="active">
                                
                                <th colspan="3" style="padding:0px 0px 0px 0px;text-align:center">Loan late >90 Days</th>
                                <th colspan="3" style="padding:0px 0px 0px 0px;text-align:center">Written-Off</th>
                                <th colspan="3" style="padding:0px 0px 0px 0px;text-align:center">Total</th>
                                
                                
                            </tr>
                             <tr class="active">
                                
                                <th style="padding:0px 0px 0px 0px;text-align:center">Balance</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">Collection</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">%</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">Balance</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">Collection</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">%</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">Balance</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">Collection</th>
                                <th style="padding:0px 0px 0px 0px;text-align:center">%</th>
                                
                            </tr>
                          </thead>
                           <tbody>
                                <?php 
                                    if(isset($_GET['datestart']))
                                    {
                                        if(isset($_GET['keydetail']))
                                        {
                                            $key=$_GET['keydetail'];
                                            $datestart=date('Ymd',strtotime($_GET['datestart']));
                                            $dateend=date('Ymd',strtotime($_GET['dateend']));
                                            $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                            $WO=$this->DailyCmr_model->getWO($datestart,$dateend,$role,$brcode,$key,$sid,0);
                                        }else
                                        {
                                            $datestart=date('Ymd',strtotime($_GET['datestart']));
                                            $dateend=date('Ymd',strtotime($_GET['dateend']));
                                            $key=1;
                                            $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                            if($page==null)
                                            {
                                                $page=0;
                                            }
                                            
                                            $WO=$this->DailyCmr_model->getWO($datestart,$dateend,$role,$brcode,$key,$sid,0);
                                        }
                                    }else
                                    {
                                        $key=1;
                                        $page = $this->uri->segment(2) ? $this->uri->segment(3):1;
                                            if($page==null)
                                            {
                                                $page=0;
                                            }
                                        $WO=$this->DailyCmr_model->getWO($reportdate,$reportdate,$role,$brcode,$key,$sid,0);
                                    }
                                    $i=1;
                                    $totalLoan90Collect=0;
                                    $totalper90collect=0;
                                    $totalWOCollect=0;
                                    $totalperWo=0;
                                    $totalCollection=0;
                                    $totalperCollect=0;
                                    $totalAchievement=0;
                                    $totalAmtDefer=0;
                                    foreach($WO as $row){
                                ?>
                                
                                <tr style="text-align:right">
                                    <td style="text-align:center"><?= $i++;?></td>
                                    
                                    <td><?= number_format($row->Loan90Balance,0);?></td>
                                    <td><?= number_format($row->Loan90Collect,0);$totalLoan90Collect+=$row->Loan90Collect;?></td>
                                    <td><?php
                                        
                                        if($row->Loan90Collect==0 || $row->Loan90Balance==0)
                                        {
                                            echo 0;
                                            
                                        }
                                        else
                                        {
                                            echo number_format($row->Loan90Collect/$row->Loan90Balance,2);
                                            $totalper90collect+=$row->Loan90Collect/$row->Loan90Balance;
                                        }
                                        
                                        
                                    ?></td>
                                    
                                    <td><?= number_format($row->LoanWOBalance,0);?></td>
                                    <td><?= number_format($row->ValueWOWithGLDaily,0);$totalWOCollect+=$row->ValueWOWithGLDaily;?></td>
                                    <td><?php 
                                            
                                            if($row->ValueWOWithGLDaily==0)
                                            {
                                                echo number_format(0,2);    
                                            }else
                                            {
                                               echo number_format($row->ValueWOWithGLDaily/$row->LoanWOBalance*100,2);
                                                $totalperWo+=$row->ValueWOWithGLDaily/$row->LoanWOBalance;
                                            } 
                                        
                                     ?></td>
                                    <td><?= number_format($row->Balance,0);?></td>
                                    <td><?= number_format($row->ValueWOWithGLDaily+$row->Loan90Collect,0);$totalCollection+=$row->ValueWOWithGLDaily+$row->Loan90Collect;?></td>
                                    <td><?php
                                            if($row->Collection==0)
                                            {
                                                echo number_format(0,2);
                                            }else
                                            {
                                                echo number_format($row->Collection/$row->Balance,2);
                                                $totalperCollect+=$row->Collection/$row->Balance; 
                                            }
                                           
                                        ?>
                                    </td>
                                    <td><?= number_format($row->Achievement,0);$totalAchievement+=$row->Achievement;?></td>
                                    <td><?= number_format($row->AmtDefer,0);$totalAmtDefer+=$row->AmtDefer;?></td>
                                    <td><?php if(isset($_GET['keydetail']))
                                        {
                                            echo date('Y-M-d',strtotime($row->Reportdate));
                                        }else{if(isset($_GET['dateend'])){echo date('Y-M-d',strtotime($_GET['dateend']));}else{
                                        echo date('Y-M-d',strtotime($reportdate));}}?></td>
                                </tr>
                               <?php }?>
                                <tr style="text-align:right" class="active">
                                    <td style="text-align:right" colspan="2">Total:</td>
                                    
                                    <td><?= number_format($totalLoan90Collect,0);?></td>
                                    <td><?= number_format($totalper90collect,2);?></td>
                                    <td style="text-align:center">Total:</td>
                                    <td><?= number_format($totalWOCollect,0);?></td>
                                    <td><?= number_format($totalperWo*100,2);?></td>
                                    <td style="text-align:center">Total:</td>
                                    <td><?= number_format($totalCollection,0);?></td>
                                    <td><?= number_format($totalperCollect,2);?></td>
                                    <td style="text-align:center">Total:</td>
                                    <td><?= number_format($totalAchievement,0);?></td>
                                    <td></td>
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
            
          
        }
    </script>
     <style>
   #in{text-align: left;}
   fieldset.scheduler-border {
    border: 1px groove #e0d5d5 !important;
    padding: 0 0.5em 0.5em 0.5em !important;
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
        width:80%;
        
    }
    .nopadding {
    padding: 0 !important;
    margin: 0 !important;
    }
    
</style>          
              
<!----------------JavaScript Get Datepicker--->
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#dateend" ).datepicker();
    });
    jqOld(function() {
        jqOld("#datestart" ).datepicker();
    })
</script>


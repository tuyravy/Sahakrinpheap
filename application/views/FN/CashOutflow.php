        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />  
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        
         <!-- page content -->
         <div role="main">
            <div class="">
              <div class="clearfix"></div>  
              <div class="row">
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_title">
                    <span class="glyphicon glyphicon-align-justify"></span><span style="margin-left:10px;">CASH OUTFLOW</span>
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
                              <form class="form-inline" action="<?php echo site_url('DailyCash/Cashoutflow');?>" method="post">
                                  <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Specific Period:</legend>
                                      <div class="form-group" style="margin-top:-10px;">                                       
                                          <label for="exampleInputName2">FITTER BRACH</label>
                                          <div class="row-fluid">
                                          <select class="selectpicker" id="brname" data-show-subtext="true" data-live-search="true" name="brname" required>
                                            
                                            <option data-subtext="Select Branch" value="All">All</option>
                                            <?php 
                                              if(isset($role)==2){
                                           
                                              foreach($brlist as $row){
                                                if(isset($brname)){?>
                                                <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                                <?php }else{?>
                                                <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                              <?php }}?>
                                            <?php
                                              }else{
                                              foreach($BRANCH as $row){
                                              if(isset($brname)){?>
                                              <option value="<?php echo $row->brCode;?>" <?php if($row->brCode==$brname){ echo  'selected';}?>><?php echo $row->shortcode  ;?></option>
                                              <?php }else{?>
                                              <option value="<?php echo $row->brCode;?>"><?php echo $row->shortcode;?></option>
                                            <?php }}}?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="form-group" style="margin-top:10px;">                                       
                                          <label for="exampleInputName2">From:</label>
                                          <input type="text" id="datestart" class="form-control" name="datestart" id="exampleInputName2"
                                          placeholder="<?php if(isset($datestart)){echo $datestart;}else{echo $reportdate;}?>"
                                          value="<?php if(isset($datestart)){echo $datestart;}else{echo $reportdate;}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                <div class="form-group" style="margin-top:10px;">
                                    <label for="exampleInputEmail2">To:</label>
                                        <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                        placeholder="<?php if(isset($dateend)){echo $dateend;}else{echo $reportdate;}?>" 
                                        value="<?php if(isset($dateend)){echo $dateend;}else{ echo $reportdate;}?>"
                                        readonly="true" style="background:white;">
                                </div> 
                               <button type="submit" class="btn btn-primary" id="dailyloandisb" style="margin-top:15px;"><span class="
                               glyphicon glyphicon-search"></span><span style="margin-left:5px;">Search</span></button>
                               <button type="button" class="btn btn-success" id="downloadinterbranch" style="margin-top:15px;"><span class="
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
                          <div class="row" id="logoreports" style="display:none">
                                  <div class="col-md-6">
                                        <img src="<?php echo base_url();?>public/images/logo_simple.png" class="img-responsive" alt="Cinque Terre">
                                  </div>
                                  <div class="col-md-6" id="textcenter">
                                      <h2 id="in" style="font-size:25px;text-align:center">សហគ្រិនភាព ម៉ាយក្រួហ្វាយនែន ភិអិលស៊ី</h2>
                                      <h2 id="in1" style="text-align:center;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                                      <h2 id="in2" style="text-align:center;">Cash Out Flow Reports</h2>
                                      <p id="in3" style="text-align:center">Reports Date:
                                      <?php if(isset($datestart)){echo $datestart;}else{echo date("Y-m-d");}?>
                                        <span style="margin-left:10px;">
                                            To:<span style="margin-left:10px;">
                                              <?php if(isset($dateend)){echo $dateend;}else{echo date("Y-m-d");}?>
                                              </span>
                                        </span>
                                      </p>
                                  </div>   
                          </div> 
                      <table class="table table-bordered projects" id="datatable-buttons">
                        <thead>
                          <tr style="border-bottom:3pt solid #22d4ae;">
                            <th style="width: 1%;text-align:center" colspan="2">AccNo</th>   
                            <th style="text-align:right;white-space: nowrap;overflow: hidden;r">BANK W/D</th>
                            <th style="text-align:right;white-space: nowrap;overflow: hidden;">Loan Disbursement</th>
                            <th style="text-align:right">Payments</th>
                            <th style="text-align:right;white-space: nowrap;overflow: hidden;">Cash Shortage</th>
                            <th style="text-align:right">Others</th>
                            <th style="text-align:right">TOTAL</th>
                            <!-- <th style="white-space: nowrap;overflow: hidden;">Ending Balance</th> -->
                            <!-- <th style="text-align:center;white-space: nowrap;overflow: hidden;">ENDING BALANCE</th>
                            <th style="text-align:center;white-space: nowrap;overflow: hidden;">MAXIMUM BALANCE</th>
                            <th style="text-align:center;white-space: nowrap;overflow: hidden;">SURPLUS BALANCE</th>
                            <th style="text-align:center">REMARK</th> -->
                            
                          </tr>
                        </thead>
                        <tbody id="reportsinterbranch">
                        <?php 
                          $BANKWD=0;
                          $LOANDISBURSEMENT=0;
                          $PAYMENTS=0;
                          $CASHSHORTAGE=0;
                          $OTHERS=0;
                          $TOTAL=0;
                          foreach($CASHOUTFLOW as $row){?>
                          <tr style="text-align:right">
                          <td><?php echo $row->ACC;?></td>
                            <td style="white-space: nowrap;overflow: hidden;text-align:left"><?php echo $row->TITLE_ACC;?></td>
                            
                            <td><?php echo number_format($row->BANKWD,0);$BANKWD+=$row->BANKWD;?></td>
                            <td><?php echo number_format($row->LOANDISBURSEMENT,0);$LOANDISBURSEMENT+=$row->LOANDISBURSEMENT;?></td>
                            <td><?php echo number_format($row->PAYMENTS,0);$PAYMENTS+=$row->PAYMENTS;?></td>
                            <td><?php echo number_format($row->CASHSHORTAGE,0);$CASHSHORTAGE+=$row->CASHSHORTAGE;?></td>
                            <td><?php echo number_format($row->OTHERS,0);$OTHERS+=$row->OTHERS;?></td>
                            <td><?php echo number_format($row->OTHERS+$row->BANKWD+$row->LOANDISBURSEMENT+$row->PAYMENTS+
                            $row->CASHSHORTAGE+$row->OTHERS,0);
                            $TOTAL+=($row->OTHERS+$row->BANKWD+$row->LOANDISBURSEMENT+$row->PAYMENTS+
                            $row->CASHSHORTAGE+$row->OTHERS);?></td>
                            <!-- <td></td> -->
                            <!-- <td></td>
                            <td></td>
                            <td></td>
                            <td></td> -->
                          </tr>
                        <?php }?>
                           <tr>
                            <td style="text-align:center" colspan='2'>Total</td>
                            <td style="text-align:right"><?php echo number_format($BANKWD,0);?></td>
                            <td style="text-align:right"><?php echo number_format($LOANDISBURSEMENT,0);?></td>
                            <td style="text-align:right"><?php echo number_format($PAYMENTS,0);?></td>
                            <td style="text-align:right"><?php echo number_format($CASHSHORTAGE,0);?></td>
                            <td style="text-align:right"><?php echo number_format($OTHERS,0);?></td>
                            <td style="text-align:right"><?PHP echo number_format($TOTAL,0);?></td>
                            <!-- <td></td> -->
                            <!-- <td></td>
                            <td></td>
                            <td></td>
                            <td></td> -->
                           </tr>
                        </tbody>
                      </table>
                      <div class="col-sm-12" id="foldershow" style="display:none;">
                                    <p>ថ្ងៃទី.......ខែ.....ឆ្នាំ..<?php echo date('Y');?></p>
                                    <p style="margin-left:40px;">ហត្ថលេខា</p>
                                    <p>................................</p>
                                    <p><span style="margin-left:30px;"><?php echo $this->session->userdata('fullname');?></span></p>
                                  <br/>

                      </div>
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
       /* style sheet for "A4" printing */
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
<script>
  $(document).ready(function()
  {
    $("#downloadinterbranch").on("click",function()
    {
      var brname=$("#brname").val();
      var datestart=$("#datestart").val();
      var dateend=$("#dateend").val();
      
      if(brname==''){
        alert("Please Choose Branch Name");
      }else
      {
        window.location.href="<?php echo site_url('DailyCash/DONLOADCASHOUTFLOW');?>/"+datestart+"/"+dateend+"/"+brname;   
      }
     
    });
  });
</script>
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
              document.getElementById("foldershow").style.display= "inline-block";   
              document.getElementById("logoreports").style.display= "inline-block";  
              document.getElementById("textcenter").style.margin = "0px 100px 10px 210px";
              var table=document.getElementById("reportsinterbranch");
              var r=0;
              while(row=table.rows[r++])
              {
                var c=9;
                while(cell=row.cells[c++])
                {
                  //cell.innerHTML='[Row='+r+',Col='+c+']'; // do sth with cell
                  cell.innerHTML=""; // do sth with cell

                }
              }
              
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            window.location.href="<?= site_url("DailyCash/Cashoutflow");?>";
          
        }
    </script>
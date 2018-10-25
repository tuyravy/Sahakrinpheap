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
                      <span class="glyphicon glyphicon-align-justify"></span><span style="margin-left:10px;">CASH INTER-BRANCH</span>
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
                              <form class="form-inline" action="<?php echo site_url('DailyCash/Cashinterbranch');?>" method="post">
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
                                          placeholder="<?php if(isset($datestart)){echo $datestart;}else{ echo $reportdate;}?>"
                                          value="<?php if(isset($datestart)){echo $datestart;}else{ echo $reportdate;}?>"
                                          readonly="true" style="background:white;">
                                      </div>
                                <div class="form-group" style="margin-top:10px;">
                                    <label for="exampleInputEmail2">To:</label>
                                        <input type="text" class="form-control" id="dateend" name="dateend" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="+2d" 
                                        placeholder="<?php if(isset($dateend)){echo $dateend;}else{ echo $reportdate;}?>" 
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
                     
                      <div id="reports">
                        <div class="row" id="logoreports" style="display:none">
                                <div class="col-md-6">
                                      <img src="<?php echo base_url();?>public/images/logo_simple.png" class="img-responsive" alt="Cinque Terre">
                                </div>
                                <div class="col-md-6" id="textcenter">
                                    <h2 id="in" style="font-size:25px;text-align:center">សហគ្រិនភាព ម៉ាយក្រួហ្វាយនែន ភិអិលស៊ី</h2>
                                    <h2 id="in1" style="text-align:center;">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                                    <h2 id="in2" style="text-align:center;">Cash Inter-Branch Reports</h2>
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
                      <!-- start project list -->
                      <table class="table table-bordered projects" id="datatable-buttons">
                        <thead>
                          <tr style="border-bottom:3pt solid #22d4ae;">
                            <th style="width: 1%;text-align:center" colspan="2">AccNo</th>                           
                            <th style="text-align:center">BALANCE IN</th>
                            <th style="text-align:center">BALANCE OUT</th>
                            <!-- <th style="text-align:center">Ending Balance</th> -->
                           
                          </tr>
                        </thead>
                        <tbody id="reportsinterbranch">
                          <?php 
                           $Total_CashIn=0;
                           $Total_CashOut=0;
                          foreach($cashonhand as $row){?>
                          <tr style="text-align:right">
                            <td><?php echo $row->Acc;?></td>
                            <td style="white-space: nowrap;overflow: hidden;text-align:left"><?php echo $row->titel;?></td>
                            <td><?php  echo number_format($row->CASH_IN,0);$Total_CashIn+=$row->CASH_IN;?></td>
                            <td><?php  echo number_format($row->CASH_OUT,0);$Total_CashOut+=$row->CASH_OUT;?></td>                           
                            <!-- <td></td> -->
                          </tr>
                          <?php }?>
                          
                          <tr style="text-align:right"  >
                            <td colspan='2' style="text-align:center">Total</td>                            
                            <td><?php  echo number_format($Total_CashIn,0);?></td>
                            <td><?php  echo number_format($Total_CashOut,0);?></td>
                            <!-- <td></td> -->
                          
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
        window.location.href="<?php echo site_url('DailyCash/DONLOADCASHINTERBRANCH');?>/"+datestart+"/"+dateend+"/"+brname;   
      }
     
    });
  });
</script>
<script>
    var jqOld = jQuery.noConflict();
    jqOld(function() {
        jqOld("#datestart" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
    jqOld(function() {
        jqOld("#dateend" ).datepicker({ dateFormat: 'yy-mm-dd' });
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
            window.location.href="<?= site_url("DailyCash/Cashinterbranch");?>";
        }
    </script>
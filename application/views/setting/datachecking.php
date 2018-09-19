<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<div class="container">
    <div class="row">
    
        <div class="col-md-12">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Data Checking</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create">Create New</button>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        
                        <th class="hidden-xs">ID</th>                        
                        <th style="text-align:center">Table Daily_loanhistory</th>
                        <th style="text-align:center">Table Loandetail</th>
                        <th style="text-align:center">Table Dis_Values</th>
                        <th style="text-align:center">Status</th>
                    </tr> 
                    <?php 
                            $i=0;
                            foreach($preparedata as $row):
                            $i++;
                        ?>
                    <tr>
                        <td align="center"><?php echo $i;?></td>
                        <td align="center"><?php echo $row->TableDaily_loanhistory;?></td>
                        <td align="center"><?php echo $row->TotalLoandetail;?></td>
                        <td align="center"><?php echo $row->TatableDis_Values;?></td>
                        <td align="center"><?php if($row->TatableDis_Values-$row->TotalLoandetail==0 && $row->TatableDis_Values-$row->TableDaily_loanhistory==0 && $row->TotalLoandetail-$row->TableDaily_loanhistory==0)
                        {
                            echo "OK";
                        }else
                        {
                            echo "Errors";
                        };?></td>
                    </tr>
                    <?php endforeach;?>
                  </thead>
                  <tbody>
                    
                 </tbody>
                </table>
              </div>
              <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Data Duplicates</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create">Create New</button>
                  </div>
                </div>
              </div>
              <div class="panel-body">
              <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        
                        <th class="hidden-xs">ID</th>
                        <th style="text-align:center">Branch Name</th>
                        <th style="text-align:center">BrCode</th>
                        <th style="text-align:center">Account Number</th>
                        <th style="text-align:center">Number Duplicates</th>
                        <th style="text-align:center">Other</th>
                    </tr> 
                  </thead>
                  <tbody>
                   <?php 
                        $i=0;
                        foreach($duplicate as $row):
                        $i++;
                    ?>
                    <tr>
                        <td align="center"><?php echo $i;?></td>
                        <td align="center"><?php echo $row->brname;?></td>
                        <td align="center"><?php echo $row->brcode;?></td>
                        <td align="center"><?php echo $row->Acc;?></td>
                        <td align="center"><?php echo $row->total;?></td>
                        <td align="center"></td>
                    </tr>
                    <?php endforeach;?>
                 </tbody>
                </table>
            </div>
            </div>

</div></div></div>
<style>
.panel-table .panel-body{
  padding:0;
}

.panel-table .panel-body .table-bordered{
  border-style: none;
  margin:0;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
    text-align:center;
    width: 100px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
  border-right: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
  border-left: 0px;
}

.panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
  border-bottom: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
  border-top: 0px;
}

.panel-table .panel-footer .pagination{
  margin:0; 
}

/*
used to vertically center elements, may need modification if you're not using default sizes.
*/
.panel-table .panel-footer .col{
 line-height: 34px;
 height: 15px;
}

.panel-table .panel-heading .col h3{
 line-height: 30px;
 height: 15px;
}

.panel-table .panel-body .table-bordered > tbody > tr > td{
  line-height: 15px;
}


</style>
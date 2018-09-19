<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<div class="container">
    <div class="row">
    
   
    
        <div class="col-md-12">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Daily Checking</h3>
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
                        <th>Branch Name</th>
                        <th>BrCode</th>
                        <th>Daily_loanhistory</th>
                        <th>Loandetail</th>
                    </tr> 
                  </thead>
                  <tbody>
                    <?php $x=0; foreach($check as $rows){ ?>
                          <tr>
                           
                            <td class="hidden-xs" align="center"><?php echo $x++;?></td>
                            <td><?php echo $rows->brNameKh;?></td>
                            <td align="center"><?php echo $rows->brCode;?></td>
                            <td align="center"><?php echo $rows->Checking;?></td>
                            <td></td>
                          </tr>
                    <?php }?>
                        
                    <?php 
                        foreach($loandetail as $row){
                    ?>
                        <tr>
                           
                            <td align="center"><?php echo $x++;?></td>
                            <td><?php echo $row->brNamekh;?></td>
                            <td align="center"><?php echo $row->brcode;?></td>
                            <td></td>                           
                            <td align="center"><?php echo $row->Number;?></td>
                        </tr>
                    <?php }?>
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
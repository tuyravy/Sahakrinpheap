 <?php 
        $brcode=$this->session->userdata('branch_code');
        $role=$this->session->userdata('role');   
        $sid=$this->session->userdata('system_id');    
?><!-- page content -->
               
        
        <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
        
            <div class="breadcrumb flat row nopadding">
                        <a href="<?= base_url();?>">Home</a>
                        <a href="<?= site_url('actived');?>" class="active">Active Borrower</a>
                        <a href="<?= site_url('loanPortd');?>">Loan Portfolio</a>
                        <a href="<?= site_url('loanDisb');?>">Loans Disb In Month</a>
                        <a href="#">Written-Off Collection Daily</a>
                        <a href="<?= site_url('repaymentd');?>">Repayment In Month</a>
            </div>
       

          <div class="">        
              <div class="row">                
               <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="container">
                          <div class="row">
                              <div class="panel panel-default">
                                 
                                    <div class="col-md-6">
                                      <h3>Active Borrower<small></small></h3>
                                    </div>

                                  
                                <table class="table table-fixed table-bordered">
                                  <thead>
                                    <tr>
                                      <th class="col-xs-1">#</th>
                                      <th class="col-xs-1">Name</th>
                                      <th class="col-xs-1">Points</th>
                                      <th class="col-xs-1">#</th>
                                      <th class="col-xs-1">Name</th>
                                      <th class="col-xs-1">Points</th>
                                      <th class="col-xs-1">Points</th>
                                      <th class="col-xs-1">Points</th>
                                      <th class="col-xs-1">Points</th>
                                      <th class="col-xs-1">Points</th>
                                      <th class="col-xs-1">Points</th>
                                      <th class="col-xs-1">Points</th>
                                      
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $s=$this->DailyCmr_model->getBrcode();
                                        foreach($s as $row){?>
                                    <tr>
                                      <td class="col-xs-1"><?php echo $row->shortcode;?></td>
                                      <td class="col-xs-1">Mike Adams</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
                                      <td class="col-xs-1">23</td>
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
                  
            
            
        <!-- /page content -->
<style>
    .table-fixed thead {
      width: 97%;
    }
    .table-fixed tbody {
      height: 400px;
      overflow-y: auto;
      width: 100%;
    }
    .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
      display: block;
    }
    .table-fixed tbody td, .table-fixed thead > tr> th {
      float: left;
      border-bottom-width: 0;
    }              
</style>
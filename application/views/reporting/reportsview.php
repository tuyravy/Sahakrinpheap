<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>

          <div class="">
            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reports Detail</h2>
                    <span style="margin-left:20px;"><a href="<?php echo base_url();?>reports_detail" class="btn btn-success">Back</a></span>
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
                 <div class="col-md-3">
                      <img src="<?php echo base_url();?>assets/img/logo/Company-Logo.png" class="img-responsive" alt="Cinque Terre">
                 </div>
                  
                  <div class="col-md-6">
                      <h2 id="in" style="font-size:25px;">សហគ្រិនភាព ម៉ាយក្រួហ្វាយនែន ភិអិលស៊ី</h2>
                      <h2 id="in">SAHAKRINPHEAP S.T MICROFINANCE PLC</h2>
                      <h2 id="in">របាយការណ៍រំអិតអំពីម៉ោងធ្វើការរបស់បុគ្លលិក</h2>
                      <p id="in">Report Date:<span style="margin-left:10px;"><?php echo $startdate;?></span><span style="margin-left:10px;">To:</span><span style="margin-left:10px;"><?php echo $enddate;?></span></p>
                  </div>   
                  <div class="col-md-3" id="in">
                     <img src="<?php echo base_url();?>assets/img/logo/user.png" >
                      <h3 id="in"><?php echo $staffname->en_name;?></h3>
                  </div>
                  <div class="row">
                      <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Date Working</th>
                          <th colspan="2" id="in">Check In (AM)</th>
                          <th colspan="2" id="in">Check Out (PM)</th>
                          <th colspan="2" id="in">Overtime Check In (AM)</th>
                          <th colspan="2" id="in">Overtime Check Out (PM)</th>
                            <style>#in{text-align: center;}</style>
                          <th>Late</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                            $this->load->model('reports_model');
                            $detail=$this->reports_model->getreportdetailbystaff($startdate,$enddate,$id);
                            foreach($detail as $row){
                        ?>
                        <tr>
                          <td><?php echo $row->Date;?></td>
                          <td><?php echo $row->check_in_am;?></td>
                          <td><?php echo $row->check_out_am;?></td>
                          <td><?php echo $row->check_in_pm;?></td>
                          <td><?php echo $row->check_out_pm;?></td>
                          <td><?php echo $row->check_in_ot;?></td>
                          <td><?php echo $row->check_out_ot;?></td>
                          <td><?php echo $row->check_in_ot;?></td>
                          <td><?php echo $row->check_out_ot;?></td>
                          <td><?php echo $row->Late;?></td>
                          
                          
                        </tr>
                            <?php } ?>
                         
                      </tbody>
                    </table>
                      <div id="roler">
                           <div class="x_title"></div>
                      </div>
                   <div>
                    <div class="col-md-6">
                    </div>  
                    <div class="col-md-6">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                        <?php foreach($eom as $row){?>
                            <tr>
                                <td>Times Workingday:</td>  
                                <td><?php echo round(($row->number_check_am)+($row->number_check_pm),2);?></td>
                                <td>Hours</td>
                            </tr>
                            <tr>
                                <td>Overtime:</td>
                                <td><?php echo round($row->number_ot,2);?></td>
                                 <td>Hours</td>
                            </tr>
                            <tr>
                                <td>Leaves:</td>
                                <td></td>
                                <td>Day</td>
                            </tr>
                            <tr>
                                <td>Late:</td>
                                <td></td>
                                <td>Hours</td>
                            </tr>
                            <tr>  
                                <td>Bonus OT:</td>
                                <td><?php echo $row->bonus_ot;?></td>
                                <td>លុយខ្មែរ</td>
                            </tr>
                            <tr>
                                <td>Bonus Other:</td>
                                <td><?php echo $row->bonus_other;?></td>
                                <td>លុយខ្មែរ</td>
                            </tr>
                            <tr>
                                <td>Basic Salary:</td>
                                <td><?php echo $row->bast_salary;?></td>
                                <td>លុយខ្មែរ</td>
                            </tr>
                          <?php }?>
                        </table>
                        <div class="row">
                        <div class="x_title"></div>
                    </div>
                    </div>
                       
                  </div>
                    
                    <div>
                        <div class="col-md-4">
                         <div id="in">
                             <h4>Prepar By</h4> 
                             <p>................</p>
                             <br/>
                         </div>
                        </div>

                        <div class="col-md-4">
                            <div id="in">
                              <h4>Verifiy By</h4> 
                             <p>................</p>
                             <br/>
                            </div>
                        </div>

                        <div class="col-md-4">
                           <div id="in">
                              <h4>Accep By</h4> 
                             <p>................</p>
                             <br/>
                             <br/>
                             <h4 id="in"><?php echo $staffname->en_name;?></h4>
                           </div>
                        </div>  
                   </div>      
                  </div>   
                    
                  </div>
                </div>
              </div>

              

              
        <!-- /page content -->

     
   
<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
<div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change User Profile<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <!--<ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>-->
                          
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <?php if(isset($error)){?>
                       <div class="alert alert-danger" style="text-align:left;"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                          <p>១-សូមដាក់លេខកូដរបស់លោក អ្នកអោយបានត្រឹមត្រូវ !</p>
                           <p>២-លេខកូដសម្គាល់ខ្លួនរបស់លោក អ្នកមិនមានក្នុងបញ្ជីបុគ្គលិកទេ</p>
                           <p>៣-សូមទាក់ទងទៅកាន់អ្នកជំនាញ</p>
                          
                      </div>
                      <?php }?>
                     <?php foreach($users as $row){?> 
                    
                   <form method="post" action="<?php echo site_url('home/setprofilesuser');?>" enctype="multipart/form-data" class="form-horizontal"  id="contact-form">
                    <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Staff ID</label>
                      <div class="col-sm-6">
                        <input type="text" value="<?php echo $row->system_id;?>" class="form-control" name="sid" id="sid"  data-toggle="tooltip" data-placement="left" title="SID Required" placeholder="លេខកាតសម្គាល់ខ្លួន" required> 
                      </div>
                      
                    </div>
                     
                    
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Staff Name(Eng)</label>
                        
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value='<?php echo $row->full_name;?>' id="fname" name="fname" data-toggle="tooltip" data-placement="left" title="First name Required"  placeholder="ឈ្មោះពេញជាអក្សរឡាតាំង" required>
                      </div>
                      
                    </div>
                      
                     <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Staff Name(KH)</label>
                      <div class="col-sm-6">
                        <input type="text" value='<?php echo $row->full_name_kh;?>' class="form-control" id="fname" name="fnamekhr" data-toggle="tooltip" data-placement="left" title="First name Required"  placeholder="ឈ្មោះពេញជាអក្សរខ្មែរ" required>
                      </div>
                       
                     
                      
                      
                    </div>
                      
                     <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Email Address</label>
                      <div class="col-sm-6">
                        <input type="email" value='<?php echo $row->email;?>' class="form-control" id="email" name="email" data-toggle="tooltip" data-placement="left" title="Email Required" placeholder="អាសយដ្ឋានអ៊ីមេល" required>
                      </div>
                    
                        
                         
                    </div>
                     <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Phone Number</label>
                     
                       <div class="col-sm-6">
                        <input type="text" value='<?php echo $row->phone;?>' class="form-control" id="pnumber" name="pnumber" data-toggle="tooltip" data-placement="left" title="Phone number Required" placeholder="លេខទូរស័ព្ទ" required>
                      </div>    
                         
                    </div>
                      
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                     
                       <div class="col-sm-6">
                        <input type="password" value='<?php echo $row->password;?>' class="form-control" id="pnumber" name="password" data-toggle="tooltip" data-placement="left" title="Phone number Required" placeholder="លេខសម្ងាត់" required>
                      </div>    
                         
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Confirm Password</label>
                     
                       <div class="col-sm-6">
                        <input type="password" class="form-control" id="pnumber" name="Confirm" data-toggle="tooltip" data-placement="left" title="Confirm Password Required" placeholder="បញ្ជាក់លេខសម្ងាត់" required>
                      </div>    
                         
                    </div>
                     
                   
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <div align='right' style="margin-right:180px;">
                        
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span><span style="margin-left:10px;"></span>Change Now</button>
                        <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span><span style="margin-left:10px;"></span>Cancel   </button>
                    </div> 
                   
                  </div><!-- /.box-footer -->
                </form>
                  
                <?php }?>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        
            



              <style>
                  .table-hover tr td:hover
                  {
                      
                      cursor: pointer;
                  }
              </style>
              <script>
                  $(document).ready(function()
                    {
                      
                     $('#sid').focusout(function()
                     {
                         var sid=$(this).val();
                         if(sid=="")
                         {
                           $("#style").html("<style>#sid{border:1px solid red;}</style>");
                           $("#style").show();  
                           $("#submit").hide();
                         }
                         else
                         {
                             $("#style").hide();
                             
                         }
                     })  
                     $("#postion").focus(function()
                        {
                            $("#postionmodal").modal();
                        })
                    })
                    $("#selected #hover").on("click","td",function()
                     {
                        var id=$(this).data('id');
                        var name=$(this).data('name');
                        var description=$(this).data('description');
                        document.getElementById("postion").value=name;
                        document.getElementById("idpostion").value=id;
                        
                        $("#postionmodal").modal("hide");
                     })
                    $("#manager").focus(function()
                    {
                        $("#managementmodel").modal();
                        
                    })
                    $("#selected #hovermana").on("click","td",function()
                    {
                        var id=$(this).data('id');
                        var name=$(this).data('name');
                        var brcode=$(this).data('code');
                        document.getElementById("manager").value=name;
                        document.getElementById("idmanager").value=id;
                        document.getElementById("brcode").value=brcode;
                        $("#managementmodel").modal("hide");
                    })
              </script>
                <script type="text/javascript">
                $(function() {
                    $('input[name="empdate"]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true
                    },

                    function(start, end, label) {
                        var years = moment().diff(start, 'years');

                    });
                });
                $(function() {

                    $('input[name="dateend"]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true
                    },
                    function(start, end, label) {
                        var years = moment().diff(start, 'years');

                    });
                });
                </script>
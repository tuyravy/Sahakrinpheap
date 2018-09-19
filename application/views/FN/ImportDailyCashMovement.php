<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>dist/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>dist/sweetalert.css">
<div class="">            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-upload" aria-hidden="true"></i><span style="margin-left:10px;">Import Daily Cash Movement</span> <small></small></h2>
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
                    <p>Drag  files to the box below for  upload or click to select files.</p>
                    <?php if($this->session->flashdata('success')){?>
                    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?>
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    <?php }?>
                    <?php if($this->session->flashdata('error')){?>
                    <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error'); ?>
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    <?php }?>
                    <div align="center" id="showimports">
                        <form action="<?php echo site_url('DailyCash/IMPORTEXCEL');?>" class="dropzone" method="post" enctype="multipart/form-data">
                          <div>
                              <img src="<?php echo base_url();?>public/img/imports.png" id="showimage" width="15%">
                              <input type="file" name="file" id="images" style="display:none;" required accept=".xls,.xlsx">
                          </div>
                            <lable>Please Select Filse</lable>
                          
                          <P><button type="submit" class="btn btn-primary submit">Imports Excel</button></P>
                        </form>
                        <p class="danger"><?php if(isset($error)){echo $error;}?></p>
                    </div>
                    <br />
                    <div>
                      <p>សូមធ្វើការទាញយកទិន្ននៅក្នុង Daily Cash Movement នេះនៅក្នុងទីតាំងដែលបានបង្ហាញដូចខាងក្រោម៖</p>
                      <p>D:\MBWin_Backup\EXPORT_PATH\ បន្ទប់មកជ្រើសរើសយកប្រភេទ File ទៅតាមថ្ងៃខែរបស់របាយការណ៏នីមួយៗ</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <script>
            $('.submit').click(function () {                
                    // Get the Login Name value and trim it
                    var name = $.trim($('#images').val());                    
                    // Check if empty of not
                        if (name  === '') {                        
                            swal({
                            title: "Please Select Files to upload?",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: 'btn-info',                      
                            closeOnCancel: false
                            });                            
                            return false;
                        }
                    
                  });
        </script>

    <script>           
        $(document).ready(function()
        {
            
            $("#showimage").click(function()
            {
                $("#images").click();
                
            });
        
        })
       
        </script>
          <style>
              #showimports
              {
                  
                  cursor: pointer;
              }
              
          </style>
<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
<div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Staff Information Imports <small></small></h2>
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
                    <div align="center" id="showimports">
                        <form action="<?php echo site_url('importsfiles');?>" class="dropzone" method="post" enctype="multipart/form-data">
                          <div>
                              <img src="<?php echo base_url();?>public/img/imports.png" id="showimage" width="15%">
                              <input type="file" name="userfile" id="images" style="display:none;">
                          </div>
                            <lable>Please Select Filse</lable>
                          
                          <P><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#processing-modal">Imports CSV</button></P>
                        </form>
                        <p class="danger"><?php if(isset($error)){echo $error;}?></p>
                    </div>
                    <br />
                    <p>List  files upload daily.</p>
                    <div class="show"></div>
                    <table class="table table-bordered" id="showimportfile">
                      <tr class="success">
                        <td>#</td> 
                        <td>PC Upload</td>
                        <td>User Upload</td>
                        <td>File Name</td> 
                        <td>Report Date</td>
                        <td>Date Imports</td>
                        <td>Other</td> 
                      </tr>
                    <?php $i=1;foreach($historyimport as $row){?>
                      <tr>
                        <td><?php echo $i++;?></td> 
                        <td><?php echo $row->pc_name;?></td>
                        <td><?php echo $row->full_name;?></td>
                        <td><?php echo $row->file_name;?></td> 
                        <td><?php echo $row->report_date;?></td>
                        <td><?php echo $row->created_date;?></td>
                        <td>
                            <a href=""><span class="glyphicon glyphicon-trash"></span></a>
                        </td> 
                      </tr>
                    <?php }?>
                    </table>
                    <br />
                    <br />
                    <br />
                    <br />
                  </div>
                </div>
              </div>
            </div>
          </div>
    
        


        <!-- Static Modal -->
        <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="http://www.travislayne.com/images/loading.gif" class="icon" />
                            <h4>Processing... <button type="button" class="close" style="float: none;" data-dismiss="modal" aria-hidden="true">×</button></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <script>
        $(document).ready(function()
        {
            $("#showimage").click(function()
            {
                $("#images").click();
                
            })
           /* $("#images").change(function()
            {
                var sourcefile=$(this).val();
                $(".show").load("<?php echo site_url('imports/importstofolder')?>/" + sourcefile);
                alert(sourcefile);
                
            })
            */
        })
       
        </script>
          <style>
              #showimports
              {
                  
                  cursor: pointer;
              }
              .modal-static { 
                position: fixed;
                top: 50% !important; 
                left: 50% !important; 
                margin-top: -100px;  
                margin-left: -100px; 
                overflow: visible !important;
            }
            .modal-static,
            .modal-static .modal-dialog,
            .modal-static .modal-content {
                width: 200px; 
                height: 200px; 
            }
            .modal-static .modal-dialog,
            .modal-static .modal-content {
                padding: 0 !important; 
                margin: 0 !important;
            }
            .modal-static .modal-content .icon {
            }
          </style>
        
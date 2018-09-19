<script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Form Imports Files</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>CSV Files <small></small></h2>
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
                        <form action="<?php echo site_url('imports/importscsv');?>" class="dropzone" method="post" enctype="multipart/form-data">
                          <div>
                              <img src="<?php echo base_url();?>public/img/imports.png" id="showimage" width="15%">
                              <input type="file" name="userfile" id="images" style="display:none;">
                          </div>
                            <lable>Please Select Filse</lable>
                          
                          <P><button type="submit" class="btn btn-primary">Imports CSV</button></P>
                        </form>
                        <p class="danger"><?php if(isset($error)){echo $error;}?></p>
                    </div>
                    <br />
                    <p>List  files upload daily.</p>
                    <div class="show"></div>
                    <table class="table table-bordered" id="showimportfile">
                      <tr class="success">
                        <td>#</td> 
                        <td>File Name</td> 
                        <td>Report Date</td>
                        <td>Date Imports</td>
                        <td>Other</td> 
                      </tr>
                    
                      <tr>
                        <td>#</td> 
                        <td>File Name</td> 
                        <td>Report Date</td>
                        <td>Date Imports</td>
                        <td>Other</td> 
                      </tr>
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
              
          </style>
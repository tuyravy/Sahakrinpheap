  <head>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>
   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/custom.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
   
     
   
    <link href="<?php echo base_url();?>public/build/css/custom.min.css" rel="stylesheet">
  </head>
        
      
       <div class="modal fade bs-example-modal-sm changepassword" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
              </div>
              <div class="modal-body">
                 <?php if(isset($succ)){
                    ?>
                        <p class="bg-success">Password changed successfully</p>
                        <br/>
                   <?php }else{?>
                        <h5>The password must be change !</h5>
                  
                <form action="<?php echo site_url("Home/changepassword")?>" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Old Passwrod</label>
                    <input type="password" class="form-control" name="oldpassword" id="exampleInputEmail1" placeholder="Old Password" value="<?php echo $this->session->userdata('password');?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" name="newpassword" id="exampleInputPassword1" placeholder="Password" required="required">
                  </div>
                 <div class="form-group">
                    <label for="exampleInputPassword1">Confrm Password</label>
                    <input type="password" class="form-control" name="repassword" id="exampleInputPassword1" placeholder="Confrm Password" required="required">
                    <p style="color:red"><?php if(isset($msg)){echo $msg;}?></p>
                  </div>
                    
                  <div class="pull-right">
                     
                      
                       <?php if(!isset($succ)){?>
                            <button type="submit" class="btn btn-primary">Change Now</button>
                       <?php }?>
                  </div>
                    
                </form>  
                 <?php }?> 
               </div>                        
              
            </div>
          </div>
      </div>
      
    <!-- jQuery -->
    <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>public/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>public/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
   
    <!-- gauge.js -->
    
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url();?>public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
 
    <script src="<?php echo base_url();?>public/build/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>public/vendors/validator/validator.min.js"></script>
      
<script>
    function load()
    {
        
        $(".changepassword").modal("show"); 
    }
    window.onload = load;
   
    $(".close").click(function()
    {
        window.location.href="<?php echo base_url();?>/Login/logout";
    });
</script>
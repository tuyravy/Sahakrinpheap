<!DOCTYPE html>
<html lang="en">
  <head>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="This Web App build for Support Sahakrinpheap MIF PLC.">
    <meta name="theme-color" content="#317EFB"/>
    <title>Sahakrinpheap Reports</title>
    <link href="<?php echo base_url(); ?>public/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Khmer" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url().'assets/img/favicon.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= base_url().'assets/img/favicon57x57.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url().'assets/img/favicon72x72.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url().'assets/img/favicon114x114.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url().'assets/img/favicon144x144.png';?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/custom_page.css">
    <link href="<?php echo base_url();?>public/bootstrap.min.css" rel="stylesheet">   
    <link href="<?php echo base_url();?>public/custom.min.css" rel="stylesheet">
  </head>
  <style>
  body{
  font-family:Khmer OS Content !important;
  font-size:12px;
  }
  .badge-light {
    display: inline-block;
    min-width: 5px;
    padding: 1px 2px;
    font-size:12px;
    font-weight:100;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius:5px;
    margin-left:-5px;
}
  </style>
  <?php 
   $types=$this->session->userdata('types');
   $checking=$this->Menu_model->CheckUpload(); 
  ?>
  <body class="nav-md" onload="setTimeout(myFunction,900000);">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border:0;">
              <a href="<?php echo base_url();?>">
            <img src="<?= base_url() . 'public/images/logo.png' ?>"  class="img-circle" style="width:80px;height:auto;padding:10px;"> 
            <span style="font-size: 15px;color:#fff">SKP_REPORT</span></a>
            </div>
            <div class="clearfix"></div>            
            <div class="profile">
            </div>        
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">                
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">                      
                      <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                    </ul>
                  </li>
                  <?php foreach ($mlist[0] as $key=>$val): ?>
                    <li><a><i class="<?php echo $val->icon_name;?>"></i>                    
                    <?php echo $val->function_name; ?>
                    <span class="fa fa-chevron-down"></span></a>  
                      <?php foreach($mlist[1] as $key=>$valsub):?>   
                          <?php foreach ($valsub as $key=>$vl):
                            if($key==$val->mid):?>
                            <ul class="nav child_menu">
                              <?php foreach ($vl as $v):?>                     
                                <li><a href="<?php echo site_url($v->controller);?>">    
                                  <?php echo $v->function_name;?>                 
                                </a>
                                </li>                  
                              <?php endforeach;?>
                            </ul>     
                          <?php endif;?>                 
                        <?php endforeach;?>
                      <?php endforeach;?>
                    </li>     
                  <?php endforeach;?>           
                </ul>                  
              </div>
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>                
              </div>            
           
              <ul class="nav navbar-nav navbar-right">  
                             
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url();?>public/images/user.png" alt="user"><?php echo $this->session->userdata('full_name'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>                    
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo site_url("home/changeprofile");?>"> Profile</a></li>
                    
                    <li>                    
                    <li><a href="<?php echo site_url('logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
               
                <li role="presentation" class="dropdown">
                  <a href="javascript:onmouseover;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>   
                    <?php if($this->Menu_model->getNotyatupload()==0){ echo "";}else{?>                                       
                      <span class="badge bg-green">                                             
                        <?php echo $this->Menu_model->getNotyatupload();?>
                      </span>
                    <?php }?>
                  </a>                  
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <?php                         
                        $res=$this->Menu_model->getNotyetuploadbranch();
                        foreach($res as $row){
                      ?>
                    <li>
                      <a href="<?= site_url("detail/detail_notyetupload");?>">
                        <span class="image"><img src="<?= base_url() . 'public/images/logo.png' ?>" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo $row->shortcode;?></span>
                          <span class="time"></span>
                        </span>
                        
                        <span class="message">
                          Today Branch <?php echo $row->shortcode;?> Not Yet Upload Data...
                        </span>
                      </a>
                    </li>
                   <?php }?>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>         
                <li>
                       <a href="javascript:onmouseover;" class="nohover">
                       <span class="fa fa-bell">
                          <small>
                              <?php if($checking>=1){?>
                              <sup class="badge badge-light" style="background-color:rgba(231,76,60,0.88);">
                                <?php if($checking){echo $checking;}?>
                              </sup>  
                              <?php }?>
                          </small>     
                        </span>                 
                       </a>
                </li>        
                <li class="nohover">
                    <a class="nohover">Report Date:<span style="margin-left:10px;" class="badge badge-secondary"><?php echo date("d-M-Y",strtotime($this->Function_model->GetCurrRunDate()));?></span></a>   
                </li>

               
                <li class="nohover" style="hover:none;">
                    <a class="nohover">Branch:<span style="margin-left:10px;" class="badge badge-secondary">
                        <?php echo $this->Menu_model->getbranchname($this->session->userdata('branch_code'));?></span></a>   
                </li>
                           
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->       
        <!-- page content -->
        <div class="right_col" role="main">  
            <?php  
           
            if($checking>=1){?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><span class="fa fa-exclamation-triangle"></span><span style="margin-left:10px;">សូមត្រួតពិនិត្យទិន្នន័យរបស់លោកអ្នក! ទិន្នន័យរបស់លោកអ្នកមិនទាន់បានជោតជ័យទេ<span></strong> <a href="<?= site_url("detail/detail_notyetupload");?>">ចុចត្រង់នេះ</a>
                <?php if($types==4){?>
                <strong><p style="margin-left:25px;">ប្រព័ន្ធកំពុងធ្វើប្រតិបត្តិការត្រួតពិនិត្យទិន្នន័យ</p> </strong>
                <?php }?>        
            </div>    
            <?php }?>   
            <?php 
                
                if(isset($viewpage)){
                $this->load->view($viewpage);
                }
            ?>          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        
        <!-- /footer content -->
      </div>
    </div>
    
    
    <script src="<?php echo base_url();?>public/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url();?>public/nprogress.js"></script>
    <script src="<?php echo base_url();?>public/bootstrap-progressbar.min.js"></script> -->
    <script src="<?php echo base_url();?>public/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/app.js"></script>
   <script>
        function myFunction() {
            window.location.href="<?php echo base_url();?>index.php/Login/logout";
        }
  </script>
  </body>
</html>
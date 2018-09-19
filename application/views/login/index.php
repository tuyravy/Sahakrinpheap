<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title; ?></title>
        <link rel="shortcut icon" href="<?= base_url().'assets/img/favicon.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= base_url().'assets/img/favicon57x57.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url().'assets/img/favicon72x72.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url().'assets/img/favicon114x114.png';?>" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url().'assets/img/favicon144x144.png';?>" />
        <link href="<?php echo base_url();?>public/bootstrap.min.css" rel="stylesheet">       
        <link href="<?php echo base_url();?>public/custom.min.css" rel="stylesheet">
    </head>
    <body class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form" style="box-shadow: 0px 0px 10px #ccc;">
                    <section class="login_content">
                        <div>
                            <img src="<?= base_url() . 'public/images/logo.png'; ?>" class="img-circle" style="width: 100px;height:auto;margin: -15px;">
                        </div>
                        <form method="post" action="<?= site_url('login/checksession') ?>" role="form" class="form-horizontal">
                            <h2>Sahakrinpheap Report</h2>
                            <hr>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input value="" type="text" class="form-control" name="username" placeholder="Username"  autocomplete="off" required="true" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input type="password" class="form-control" name="password" placeholder="Password" data-error="Password required" autocomplete="off" required="true" />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div>
                                <button type="submit" name="submit" class="btn btn-primary submit" style="margin-top: 8px;"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Sign In</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                
                                <p style="color:red;"><?php if(isset($errornotAcc)){echo $errornotAcc;}?></p>
                                <p style="color:red;"><?php if(isset($errordevice)){echo $errordevice;}?></p>
                                <p style="color:red;"><?php if(isset($errorlogin)){echo $errorlogin;}?></p>
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <p>©<?= date('Y') ?> All Rights Reserved.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Stexo - Responsive Admin & Dashboard Template | Themesdesign</title>
        <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
        <meta content="Themesdesign" name="author" />
        <link rel="shortcut icon" href="<?= base_url()?>assets/template/images/favicon.ico">

        <link href="<?= base_url()?>assets/template/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url()?>assets/template/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url()?>assets/template/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url()?>assets/template/css/style.css" rel="stylesheet" type="text/css">

    </head>

    <body>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="home-btn d-none d-sm-block">
                <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a>
            </div>
        <div class="wrapper-page">
                <div class="card card-pages shadow-none">
    
                    <div class="card-body">
                        <div class="text-center m-t-0 m-b-15">
                                <a href="index.html" class="logo logo-admin"><img src="<?= base_url()?>assets/template/images/logo-dark.png" alt="" height="24"></a>
                        </div>
                        <h5 class="font-18 text-center"><?php echo $this->session->flashdata('pesan') ?></h5>
    
                        <form class="form-horizontal m-t-30" method="post" action="<?= base_url('welcome/login')?>">
    
                            <div class="form-group">
                                <div class="col-12">
                                        <label>Email</label>
                                    <input class="form-control" name="email" type="email" required="" placeholder="Email">
                                    <?php echo form_error('email', '<div class="text-danger small">', '</div>') ?>

                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-12">
                                        <label>Password</label>
                                    <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                    <?php echo form_error('password', '<div class="text-danger small">', '</div>') ?>

                                </div>
                            </div>
    
                            <!-- <div class="form-group">
                                <div class="col-12">
                                    <div class="checkbox checkbox-primary">
                                            <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1"> Remember me</label>
                                                  </div>
                                    </div>
                                </div>
                            </div> -->
    
                            <div class="form-group text-center m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
    
                            <div class="form-group row m-t-30 m-b-0">
                                <div class="col-sm-7">
                                    <!-- <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a> -->
                                </div>
                                <div class="col-sm-5 text-right">
                                    <a href="<?= base_url('welcome/register')?>" class="text-muted">Create an account</a>
                                </div>
                            </div>
                        </form>
                    </div>
    
                </div>
            </div>
        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="<?= base_url()?>assets/template/js/jquery.min.js"></script>
        <script src="<?= base_url()?>assets/template/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url()?>assets/template/js/metismenu.min.js"></script>
        <script src="<?= base_url()?>assets/template/js/jquery.slimscroll.js"></script>
        <script src="<?= base_url()?>assets/template/js/waves.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url()?>assets/template/js/app.js"></script>
        
    </body>

</html>
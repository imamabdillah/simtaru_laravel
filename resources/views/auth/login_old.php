<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>Sistem Informasi PU Terpadu</title>

        <meta name="description" content="INTIP Surakarta">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="INTIP Surakarta - Login">
        <meta property="og:site_name" content="INTIP">
        <meta property="og:description" content="INTIP Surakarta">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/img/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Codebase framework -->
        <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">
        <style>
        div.captcha img{
            width:100% !important;
        }
        </style>
        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>

        <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <!-- <div class="bg-body-dark bg-pattern" style="background-image: url('<?= base_url(); ?>assets/img/various/bg-pattern-inverse.png');"> -->
                <div class="bg-body-dark bg-pattern">
                    <div class="row mx-0 justify-content-center">
                        <div class="hero-static col-lg-6 col-xl-4">
                            <div class="content content-full overflow-hidden">
                                <!-- Header -->
                                <div class="py-30 text-center">
                                    <a class="link-effect font-w700" href="index.html">
                                        <i class="si si-fire"></i>
                                        <span class="font-size-xl text-primary-dark">INTIP</span><span class="font-size-xl"> Surakarta</span>
                                    </a>
                                    <!-- <h1 class="h4 font-w700 mt-30 mb-10">&nbsp;</h1> -->
                                    <!-- <h2 class="h5 font-w400 text-muted mb-0">Silahkan login untuk melanjutkan</h2> -->
                                </div>
                                <!-- END Header -->
                                
                                <!-- Sign In Form -->
                                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signin" id="myForm" action="<?= base_url(); ?>login/auth" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                    <div class="block block-themed block-rounded block-shadow">
                                        <div class="block-header bg-gd-dusk">
                                            <h3 class="block-title">Silahkan login</h3>                                            
                                        </div>
                                        <div class="block-content">
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group captcha row">
                                                <div class="col-12">
                                                    <p id="captcha_img"><?=$image;?></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="captcha">Kode Captcha</label> <a href="#" onclick="ref();" class="float-right ref"><i class="fa fa-refresh"></i> Refresh</a>
                                                <input type="text" class="form-control" id="captcha" placeholder="Masukkan Kode Captcha" name="captcha" autocomplete="off" required>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-sm-12 text-sm-right push">
                                                    <button type="button" class="btn btn-alt-default btn-depan">
                                                        <i class="si si-home mr-10"></i> Halaman Depan
                                                    </button>
                                                    <button type="submit" class="btn btn-alt-primary">
                                                        <i class="si si-login mr-10"></i> Masuk
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/codebase.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?= base_url(); ?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?= base_url(); ?>assets/js/pages/op_auth_signin.js"></script>
        <script type="text/javascript">
            
        $('.btn-depan').on('click',function(){
            window.location.replace('<?= base_url(); ?>');
        });
        function ref(){
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('auth/login/change_captcha')?>",
            dataType : "JSON",
                success: function(response){
                    $("#captcha_img").html(response);
                }
            });
            return false;
        }
 
        </script>
    </body>
</html>
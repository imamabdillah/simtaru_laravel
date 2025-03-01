<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>INTIP KOTA SURAKARTA</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/depan/img/favicon.png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url() ?>assets/depan/fonts/iconfont/material-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/depan/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/depan/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/depan/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/depan/css/shortcodes/shortcodes.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/depan/css/shortcodes/login.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/depan/css/style.css" rel="stylesheet">
</head>
<style>
.box {
    max-width: 350px;
    padding: 32px 35px 0px 35px;
    border: 1px solid #EEE;
}
</style>

<body>
    <main>
        <center style="margin-top: 60px;">
            <img class="responsive-img" style="max-width: 250px; padding-top: 10px; padding-bottom: 10px;" src="<?php echo base_url() ?>assets/depan/img/logo-intip2.png" />
            <h5 class="indigo-text">Silakan masuk menggunakan akun anda</h5>
            <div class="container">
                <div class="z-depth-1 grey lighten-4 row box">
                    <form class="col s12" action="<?php echo base_url('login') ?>" method="POST">
                        <?php echo ($this->session->flashdata('msg') == '' ? '' : $this->session->flashdata('msg')); ?>
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='username' id='username' />
                                <label for='username'>Username</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='password' id='password' />
                                <label for='password'>Password</label>
                            </div>
                        </div>
                        <!-- <div class='row'>
                            <div class='input-field col s12'>
                                <center><?php echo $captcha['image']; ?></center>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' id="captcha" type="text" name="captcha" />
                                <label for='password'>Captcha</label>
                            </div>
                        </div> -->
                        <br />
                        <center>
                            <div class='row' style="padding: 20px;">
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect  red accent-4'>Login</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </center>
    </main>
    <!-- <div id="preloader">
        <div class="preloader-position">
            <img src="<?php echo base_url() ?>assets/depan/img/logo-bappeda-dark.png" alt="logo">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div> -->
    <script src="<?php echo base_url() ?>assets/depan/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/materialize/js/materialize.min.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/menuzord.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/jquery.sticky.min.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/smoothscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/jquery.stellar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/imagesloaded.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/animated-headline.js"></script>
    <script src="<?php echo base_url() ?>assets/depan/js/scriptsae52.js?v=5"></script>
</body>

</html>
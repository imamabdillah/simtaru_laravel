<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>SIMPUTER | Kota Tegal</title>
    <link rel="shortcut icon" href="{{ asset('assets/front_20232/images/favicon-tegal.ico') }}">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/front/fonts/iconfont/material-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/materialize/css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/shortcodes/shortcodes.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/shortcodes/login.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/style.css') }}" rel="stylesheet">
</head>
<style>
    .box {
        max-width: 350px;
        padding: 32px 35px 0px 35px;
        border: 1px solid #EEE;
    }

    #captcha_img img {
        max-width: 264px !important;
    }

    .bg-overlay {
        background: rgba(225, 183, 38, .1);
        backdrop-filter: blur(2px);
        border-radius: 16px;
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        z-index: 5;
    }

    .parent {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: 1fr;
        grid-column-gap: 0px;
        grid-row-gap: 0px;
        height: 100vh;
        overflow: hidden;
    }

    .input-field {
        margin-bottom: 16px;
        margin-top: 0;
    }
</style>

<body>
    <main class="parent">
        <div class="" style="padding: 48px; display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <div style="width: 100%;">
                <h5>Sistem Informasi PU Terpadu Kota Tegal</h5>
                <h2 style="font-weight: 600; font-size: 24px; margin-bottom: 32px;">Silakan masuk menggunakan akun anda</h2>

                <form class="" action="{{ url('login/auth') }}" method="POST">
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <div class='input-field'>
                        <input class='validate' type='text' name='username' id='username' />
                        <label for='username'>Username</label>
                    </div>

                    <div class='input-field'>
                        <input class='validate' type='password' name='password' id='password' />
                        <label for='password'>Password</label>
                    </div>

                    <div class="form-group captcha">
                        <p id="captcha_img"><?= $image; ?></p>
                    </div>

                    <div class="form-group">
                        <label for="captcha">Kode Captcha</label> <a href="#" onclick="ref();" class="float-right ref"><i class="fa fa-refresh"></i> Refresh</a>
                        <input type="text" class="form-control" id="captcha" placeholder="Masukkan Kode Captcha" name="captcha" autocomplete="off" required>
                    </div>

                    <div style="margin-top: 32px;">
                        <button type='submit' name='btn_login' class='btn' style="font-weight: 600; color: white; padding: 6px 32px; background-color: #E1B726; margin-right: 24px;">Login</button>
                        <a href="{{ url('/') }}" style="color: #888888"><i class="fa fa-home" style="font-size:larger;"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="position-relative d-hidden d-md-block" style="overflow: hidden; padding: 16px;">
            <div style="width: 100%; height: 100%; object-fit: cover; border-radius: 16px; position: relative; z-index: 1;">
                <div class="bg-overlay"></div>
                <img src="{{ asset('assets_front/images/dpupr.jpeg') }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 16px;">
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/front/js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/front/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/materialize/js/materialize.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/menuzord.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.sticky.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/smoothscroll.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/front/js/animated-headline.js') }}"></script>
    <script src="{{ asset('assets/front/js/scriptsae52.js?v=5') }}"></script>
    <script>
        function ref() {
            $.ajax({
                type: "POST",
                url: "{{ url('auth/login/change_captcha') }}",
                dataType: "JSON",
                success: function(response) {
                    $("#captcha_img").html(response);
                }
            });
            return false;
        }
    </script>
</body>

</html>
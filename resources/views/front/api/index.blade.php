<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu</title>

    <meta name="description" content="Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu">
    <meta name="author" content="Phicosdev">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu">
    <meta property="og:site_name" content="INTIP">
    <meta property="og:description" content="Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | Sistem Informasi PU Terpadu">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon-180x180.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/codebase.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
</head>
<body>
<main id="main-container">
    <div class="content">
        <div class="block block-themed">
            <div class="block-header bg-danger">
                <h3 class="block-title">API SIMTARU Sukoharjo</h3>
            </div>

            <div class="block-content" style="padding: 50px">
                @foreach($akses_layer as $v)
                    <h6>{{ $v->nama_layer }}</h6>
                    <div class="form-group row" style="background: #eeeeee; padding: 5px;">
                        <div class="col-lg-12" style="word-wrap: break-word;">
                            <i class="fa fa-link"></i> 
                            <a href="{{ url('api/geojson/'.$token.'/'.$v->id_layer.'/d/'.strtolower(str_replace(' ', '_', $v->nama_layer))) }}" target="_blank">
                                {{ url('api/geojson/'.$token.'/'.$v->id_layer.'/d/'.strtolower(str_replace(' ', '_', $v->nama_layer))) }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
<footer id="page-footer" class="opacity-0">
    <div class="content py-20 font-size-xs clearfix">
        <div class="float-left">
            <a class="font-w600" href="#"></a> &copy; Sistem Informasi PU Terpadu
        </div>
    </div>
</footer>

<script src="{{ asset('assets/js/core/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.scrollLock.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.appear.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.countTo.min.js') }}"></script>
<script src="{{ asset('assets/js/core/js.cookie.min.js') }}"></script>
<script src="{{ asset('assets/js/codebase.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2/new.js') }}"></script>

@if(isset($extra_js))
    {!! $extra_js !!}
@endif
</body>
</html>

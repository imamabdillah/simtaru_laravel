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
    <link rel="shortcut icon" href="<?= base_url() ?>assets/front_20232/images/favicon-tegal.ico">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .head{
        background-color: #0205c6;
        color: white;
    }
    .head .container{
        position: relative;
    }
    .float-title{
        position: absolute;
        top: 10%;
        right: 10%;
    }
    .float-img{
        position: absolute;
        bottom: 10%;
        right: 10%;
    }
    .float-img img{
        filter: drop-shadow(-1px 2px 1px black);
        width: 100px;
    }
    .bold{
        font-weight: 800;
    }
    .font-h1{
        font-size: 50px;
    }
    .font-h2{
        font-size: 45px;
    }
    .font-h3{
        font-size: 18px;
        text-align: justify;
    }
    .font-h4{
        font-size: 75px;
    }
    .title{
        width: 70%;
    }
    .btn-rounded{
        padding: 10px 60px;
    }
    .text-primary{
        color: #0205c6 !important;
    }
    @font-face {
        font-family: 'FontAwesome';
        src: url("<?= base_url('assets/') ?>fonts/fontawesome-webfont.eot?v=4.7.0");
        src: url("<?= base_url('assets/') ?>fonts/fontawesome-webfont.eot?#iefix&v=4.7.0") format("embedded-opentype"), url("<?= base_url('assets/') ?>fonts/fontawesome-webfont.woff2?v=4.7.0") format("woff2"), url("<?= base_url('assets/') ?>fonts/fontawesome-webfont.woff?v=4.7.0") format("woff"), url("<?= base_url('assets/') ?>fonts/fontawesome-webfont.ttf?v=4.7.0") format("truetype"), url("<?= base_url('assets/') ?>fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular") format("svg");
        font-weight: normal;
        font-style: normal;
    }

    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .fa-arrow-left:before {
        content: "\f060";
    }
    .mr-1{
        margin-right: 5px;
    }
    .back{
        cursor: pointer;
    }
    .back:hover{
        text-decoration: underline;
    }
    #hasil{
        margin-left: -17px;
    }
</style>
<body>
    <div class="head py-5">
        <div class="container">
            <div class="float-title bold">
                SI-TIMBUL
                <span class="ml-3 font-h2">2024</span>
            </div>
            <div class="float-img"><img src="<?= base_url() ?>assets/tegal.png"></div>
            <div class="title">
                <div class="font-h3 mb-3">Welcome to</div>
                <div class="font-h1 bold">Simulasi</div>
                <div class="font-h2 bold">Perizinan Pemanfaatan Ruang</div>
                <div class="font-h3 mt-2">
                    Layanan ini bagian dari Pra-Izin Pemerintah Kota Tegal.<br>
                    Dengan melakukan simulasi ini Saudara dapat mengetahui perizinan yang harus diajukan, persyaratan, alur dan tutorial untuk mengaksesnya.
                </div>
                <div class="font-h3 mt-3">Say No to Calo! Perizinan Mudah di Kota Tegal</div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="soal soal_1 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">01</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Saudara sudah memiliki bukti penguasaan lahan?</div>
                <button class="btn btn-rounded btn-primary" data-id="1" data-val="1">Sudah</button>
                <button class="btn btn-rounded btn-danger" data-id="1" data-val="2">Belum</button>
            </div>
        </div>
        <div class="soal soal_2 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">02</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Kegiatan Saudara sudah ada bangunan?</div>
                <button class="btn btn-rounded btn-primary" data-id="2" data-val="1">Sudah</button>
                <button class="btn btn-rounded btn-danger" data-id="2" data-val="2">Belum</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_21 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">02.1</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Bangunan tersebut sudah memiliki IMB/PBG semua?</div>
                <button class="btn btn-rounded btn-primary" data-id="21" data-val="1">Sudah</button>
                <button class="btn btn-rounded btn-danger" data-id="21" data-val="2">Belum</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_22 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">02.2</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Bangunan tersebut sudah memiliki SLF?</div>
                <button class="btn btn-rounded btn-primary" data-id="22" data-val="1">Sudah</button>
                <button class="btn btn-rounded btn-danger" data-id="22" data-val="2">Belum</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_3 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">03</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Kegiatan Saudara kegiatan berusaha?</div>
                <button class="btn btn-rounded btn-primary" data-id="3" data-val="1">Ya</button>
                <button class="btn btn-rounded btn-danger" data-id="3" data-val="2">Tidak</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_4 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">04</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Saudara sudah memiliki Nomor Induk Berusaha?</div>
                <button class="btn btn-rounded btn-primary" data-id="4" data-val="1">Sudah</button>
                <button class="btn btn-rounded btn-danger" data-id="4" data-val="2">Belum</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_5 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">05</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Modal Saudara lebih dari 5 Miliyar (tidak termasuk tanah dan bangunan)?</div>
                <button class="btn btn-rounded btn-primary" data-id="5" data-val="1">Ya</button>
                <button class="btn btn-rounded btn-danger" data-id="5" data-val="2">Tidak</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_6 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">06</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Apakah</div>
                <div class="font-h3 text-primary mb-3">Kegiatan Saudara membutuhkan bangunan baru?</div>
                <button class="btn btn-rounded btn-primary" data-id="6" data-val="1">Ya</button>
                <button class="btn btn-rounded btn-danger" data-id="6" data-val="2">Tidak</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_7 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">07</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Bagaimana</div>
                <div class="font-h3 text-primary mb-3">Kondisi tanah di sertifikat Saudara?</div>
                <button class="btn btn-rounded btn-primary" data-id="7" data-val="1">Pertanian</button>
                <button class="btn btn-rounded btn-danger" data-id="7" data-val="2">Non Pertanian</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_8 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">08</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">Koordinat</div>
                <div class="font-h3 text-primary mb-3">Pilih lokasi usaha anda</div>
                <button class="btn btn-rounded btn-primary" data-id="8">Simpan</button>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_9 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">09</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">KBLI</div>
                <div class="font-h3 text-primary mb-3">Pilih kbli usaha anda</div>
                <button class="btn btn-rounded btn-primary mb-2" data-id="9" data-val="1">Real Estate KBLI 68111</button><br>
                <button class="btn btn-rounded btn-primary mb-2" data-id="9" data-val="2">Minimarket KBLI 47111</button><br>
                <button class="btn btn-rounded btn-primary mb-2" data-id="9" data-val="3">Klinik/Rumah Sakit</button><br>
                <div class="back mt-3"><i class="fa fa-arrow-left mr-1"></i>Kembali</div>
            </div>
        </div>
        <div class="soal soal_10 row">
            <div class="col-lg-2">
                <div class="font-h3 text-primary mt-3">SI-TIMBUL</div>
                <div class="font-h4 text-primary">10</div>
            </div>
            <div class="col-lg-7">
                <div class="font-h2 bold text-primary">HASIL</div>
                <div class="font-h3 text-primary mb-3">Alur Perizinan</div>
                <ul id="hasil"></ul>
                <div class="back top mt-3"><i class="fa fa-arrow-left mr-1"></i>Ulangi dari awal</div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>assets/front/js/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $('.soal').hide();
        $('.soal').first().show();
        jawab = [];
        $('.soal').on('click', '.btn', function(){
            id = $(this).data('id');
            val = $(this).data('val');
            jawab.push({index: id, value: val});
            if(id){
                if ($.inArray(id, [1,4,5,7,8,9]) !== -1) {
                    next = Number(id)+1;
                }else if (id == 2) {
                    if(val == 1){
                        next = 21;
                    }else{
                        next = 3;
                    }
                }else if (id == 21) {
                    if(val == 1){
                        next = 22;
                    }else{
                        next = 3;
                    }
                }else if (id == 22) {
                    next = 3;
                }else if (id == 3) {
                    if(val == 1){
                        next = 4;
                    }else{
                        next = 6;
                    }
                }else if (id == 6) {
                    if(val == 1){
                        next = 7;
                    }else{
                        next = 10;
                    }
                }
                $('.soal').hide();
                $('.soal_'+next).show();
                if(next == 10){
                    hasil();
                }
            }
        })
        $('.soal').on('click', '.back', function(){
            $('.soal').hide();
            id = jawab[jawab.length - 1].index;
            jawab.pop();
            $('.soal_'+id).show();
        })
        $('.soal').on('click', '.top', function(){
            jawab = [];
            $('.soal').hide();
            $('.soal').first().show();
        });

        function hasil(){
            $('#hasil').html(null);
            $.each(jawab, function(index, value) {
                i = value.index;
                v = value.value;
                isi = '';
                if(i == 1 && v == 2){
                    isi = `
                        Dibutuhkan bukti penguasan lahan yang sah dapat berupa <br>
                        1. Hak Milik<br>
                        2. Hak Guna Bangunan yang masih berlaku<br>
                        2. Hak Pakai<br>
                        3. Letter C<br>
                        4. Surat Sewa yang masih berlaku (Jika bukan tanah Pemerintah Kota maka dilampikan Sertifikat Pemilik)<br>
                        <br>
                        Saudara dapat menghubungi Kantor Pertanahan ATR/BPN Kota Tegal dengan Alamat Sementara berada di Komplek Balaikota Tegal, Jalan Ki Gede Sebayu (Depan Aula Dekranas)<br>
                        Call center : (0283) 343428<br>
                        Instagram : https://www.instagram.com/kantahkotategal/
                    `;
                }else if(i == 21){
                    if(v == 1){
                        isi = 'Izin SLF';
                    }else{
                        isi = 'Mengurus sampai PBG';
                    }
                }else if(i == 3){
                    if(v == 1){
                        isi = 'Mengikuti alur perizinan berusaha';
                    }else{
                        isi = 'Mengikuti alur non berusaha';
                    }
                }else if(i == 4 && v == 2){
                    isi = `
                        Saudara dapat mendaftarkan melalui https://oss.go.id atau dapat berkonsultasi melalui DPMPTSP Kota Tegal di Mall Pelayanan Publik Kota Tegal, Jalan Kolonel Sugiyono, Kemandungan Kota Tegal<br>
                        Call center : wa.me/628112970114<br>
                        instagram : https://www.instagram.com/dpmptsp.tegalkota/"
                    `;
                }else if(i == 5 && v == 2){
                    isi = 'Tidak perlu menampilkan semua syarat KKPR dan izin lingkungan';
                }else if(i == 6 && v == 2){
                    isi = 'Syarat sampai izin lingkungan';
                }else if(i == 7 && v == 2){
                    if(v == 1){
                        isi = 'Alur perizinan IPPT (tampilkan syarat dan alur KRK IPPT, PTP, KRK PBG, Izin lingkungan';
                    }else{
                        isi = 'Alur perizinan Non IPPT';
                    }
                }else if(i == 9 && v == 2){
                    if(v == 1){
                        isi = 'alur mengikuti perizinan perumahan';
                    }else if(v == 2){
                        isi = 'rekomendasi dari dinas UMKM';
                    }else {
                        isi = 'rekomendasi dari dinas kesehatan';
                    }
                }
                if(isi != ''){
                    var urlRegex = /((https?|ftp):\/\/[^\s/$.?#].[^\s]*)/gi;
                    var isi = isi.replace(urlRegex, function(url) {
                        return '<a href="' + url + '" target="_blank">' + url + '</a>';
                    });
                    $('#hasil').append('<li>'+isi+'</li>');
                }
            });
        }
    </script>
</body>
</html>
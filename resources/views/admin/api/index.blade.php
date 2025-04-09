@extends('layouts.wrapper')
<style>
.err{
    padding: 0px;
    color:red;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    background: #42a5f5;
    border: 1px solid #0088f6;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    color: #ffffff;
}

</style>
@section('contents')
<!-- Main Container -->
<main id="main-container">
    <!-- First Row -->
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
                
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-plus mr-2" style="font-size: 14px;"></i> Tambah Permohonan API</h3>
            </div>

            <div class="block-content">
                <form id="form_api" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-12" for="nama_pemohon">Nama Pemohon</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" placeholder="Masukkan nama pemohon" required>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="akses_layer">Akses Layer</label>
                        <div class="col-lg-12">
                            <select class="js-select2 form-control danger" id="akses_layer" name="akses_layer[]" style="width: 100%;" data-placeholder="Pilih Akses Layer" multiple>
                                <option></option>
                                <?php foreach($data_layer as $v):?>
                                    <option value="<?=$v['id_layer']?>"><?=$v['nama_layer']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12" style="text-align:right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus mr-2" style="font-size: 14px;"></i> Tambah Permohonan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
                
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="fa fa-link mr-2" style="font-size: 14px;"></i> Daftar Permohonan API Layer Peta</h3>
            </div>

            <div class="block-content">
            <!-- Table start -->
            <table class="table table-bordered table-striped" id="mydata" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Pemohon</th>
                        <th style="text-align: center;">Token</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">API</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <!-- Table end -->
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
@endsection

<!-- jQuery harus di-load lebih awal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="{{ asset('assets/js/pages/be_forms_plugins.js') }}"></script> --}}
<script>
    jQuery(function () {
        Codebase.helpers(['select2']);
    });
</script>


<script>

    $(document).ready(function(){
        var no = 0;
        $('#mydata').dataTable({
            pagingType: "full_numbers",
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            ajax: "{{ route('api.list') }}",
            
            columns: [
                    {'data': (d)=>{
                        no++;
                        return no;
                    }},
                    {'data': 'nama_pemohon'},
                    {'data': 'token'},
                    {'data': 'created_at'},
                    {'data': (d)=>{
                        return `<a href="{{ url('api/get') }}/${d.token}/d" target="_blank">{{ url('api/get') }}/${d.token}/d</a>`;
                    }},
                    {'data': (d)=>{
                            let btn  = '';
                                btn += '<button class="btn btn-sm btn-danger" onclick="hapus_api('+d.id_api+')">Hapus</button>' ;
                        return btn;
                    }}],
            columnDefs: [
                {
                    targets: [0,2,3,5],
                    className: 'dt_body_center'
                },
                { 
                    orderable: false, 
                    targets: [ 5 ] 
                }
                ],
        });
    
        $('#form_api').submit(function(e){
            e.preventDefault();
            var data = new FormData(this);
            
            $.ajax({
                url: "{{ route('api.store') }}",
                type: 'POST',
                data: data,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                cache: false
            })
            .then(res=>{
                if(res.status == 'success')
                {
                    Swal.fire({
                        title : 'Sukses!',
                        text : 'Permohonan API berhasil ditambahkan',
                        type: 'success',
                        timer: 1500
                    });
                    setTimeout(function(){
                        location.reload();
                    },1000);
                }
                else
                {
                    Swal.fire({
                        title : 'Gagal!',
                        text : res.message,
                        type: 'error'
                    });
                }
            })
        })
    
    });
             
    function hapus_api(id_api){
        Swal.fire({
            title: 'Apakah anda yakin!',
            text: "Apakah anda yakin akan menghapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Hapus sekarang!',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
    
                $.ajax({
                    type  : 'POST',
                    url: "{{ route('api.destroy') }}",
                    async : false,
                    dataType : 'JSON',
                    data  : {id_api : id_api},
                    success : function(res){
                        if(res.status == 'success')
                        {
                            Swal.fire({
                                title : 'Sukses!',
                                text : 'Permohonan API berhasil dihapus',
                                type: 'success',
                                timer: 1500
                            });
                            location.reload();
                        }
                        else
                        {
                            Swal.fire({
                                title : 'Gagal!',
                                text : 'Permohonan API gagal dihapus',
                                type: 'error'
                            });
                        }
                        
                    }
                });
                
            }
        });
    }
    
    </script>
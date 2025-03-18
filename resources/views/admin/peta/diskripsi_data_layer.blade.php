@extends('layouts.wrapper')
@section('contents')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form id="form_deskripsi">
        @csrf
    <div class="content row">
        <div class="col-12" style="padding:0px">
        <div class="block block-themed">
            <div class="block-header bg-earth">
                <h3 class="block-title">Diskripsi</h3>
            </div>
            <div class="block-content">
                <input type="hidden" class="form-control" id="id_collection" name="id_collection">
                <input type="hidden" class="form-control" id="id" name="id">

                <div class="form-group row">
                    <label class="col-12" for="nama">Nama</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Sanggar">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="website">Website</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="website" name="website" placeholder="Website Sanggar (Optional)">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea class="form-control summernote" name="deskripsi" id="deskripsi" cols="50" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <button type="submit" value="submit" name="submit" id="simpan" class="btn btn-square btn-primary btn-block">Simpan</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.peta.kelola_data_layer', request()->segment(4)) }}" class="btn btn-square btn-danger btn-block" >Batal</a>
                    </div>
                </div>
            </div>
        </div>      
    </div>   
    </form>
    <!-- END Page Content -->
    
</main>
<!-- END Main Container -->
@endsection

<!-- jQuery harus di-load lebih awal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        var id_layer = {{ request()->segment(4) }};
        var id_collection = {{ request()->segment(5) }};
    
        $('#id_collection').val(id_collection);
    
    
        $('.summernote').summernote({
            placeholder: 'Tulis sesuatu...',
            height: 300,   //set editable area's height
            codemirror: { // codemirror options
                theme: 'monokai'
            }
        });
    
        $.ajax({
          type: 'GET',
          url: '{{ route("admin.peta.ambil_diskripsi") }}',
          data: {id_collection: id_collection},
          dataType: 'JSON',
          success: function(data){
    
                if (data) {
                $('#id').val(data.id); // Simpan ID untuk update
                $('#nama').val(data.nama);
                $('#website').val(data.website);
                $('#deskripsi').summernote('code', data.deskripsi);
            }
          }
        });

        // form tambah deskripsi
        $('#form_deskripsi').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}'); // Tambahkan CSRF token

            $.ajax({
                url: '{{ route("admin.peta.insert_diskripsi") }}',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(res) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: "Berhasil Disimpan",
                        icon: 'success',
                        timer: 1500
                    });
                    window.location.href = "{{ route('admin.peta.kelola_data_layer', request()->segment(4)) }}";
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Debug jika error
                }
            });
        });
    });
    
    
    


    
    function kembali(){
        window.location.href = "{{ route('admin.peta.kelola_data_layer', request()->segment(4)) }}";
    }
    
    </script>

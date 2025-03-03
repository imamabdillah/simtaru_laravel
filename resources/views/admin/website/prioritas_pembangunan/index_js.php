<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
let datatable, validator = {};
$(() => {
    load_datatable()
})

const load_datatable = () => {
    datatable = $('#table-data').DataTable({
        serverSide: true,
        processing: true,
        scrollX: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
            url: "<?= base_url('admin/website/prioritas_pembangunan/data')?>",
            type: 'POST',
            dataType: 'json',
            data: function (d) {
            },
            error: function (error) {
                console.error(error)
                if (error.status === 403) {
                    Swal.fire({
                        title: 'Perhatian',
                        type: 'info',
                        html: 'Terjadi kesalahan di server.<br>Halaman akan reload dalam <b></b> milliseconds...',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then(() => {
                        location.reload();
                    })
                }
            },
            complete: function ({ responseJSON }) {
            }
        },
        order: [],
        columnDefs: [{
            targets: [0, 1, -1],
            searchable: false,
            orderable: false,
            className: 'text-center align-top w-5'
        }, {
            targets: [1],
            className: 'text-left align-top'
        }],
        columns: [{
            data: 'no',
            render: (data) => {
                return data + '.'
            }
        }, {
            data: 'foto',
            render: (data) => {
              return data ? `<img src="<?= base_url()?>${data.path}" class="img-fluid">`:''
            }
        }, {
            data: 'nama',
        },{
            data: 'deskripsi',
        }, {
            data: 'id',
            render: (data, type, row) => {
                let button_link = '', button_edit = '', button_delete = '';

                button_link = $('<button>', {
                    html: $('<i>', {
                        class: 'si si-link'
                    }).prop('outerHTML'),
                    class: 'btn btn-outline-dark btn-preview',
                    "data-link": row.link,
                    type: 'button',
                    'data-toggle': 'tooltip',
                    'data-placement': 'top',
                    title: 'Preview Data'
                })

                  button_edit = $('<button>', {
                      html: $('<i>', {
                          class: 'si si-pencil'
                      }).prop('outerHTML'),
                      class: 'btn btn-outline-info btn-update',
                      type: 'button',
                      'data-toggle': 'tooltip',
                      'data-placement': 'top',
                      title: 'Ubah Data'
                  })

                  button_delete = $('<button>', {
                      html: $('<i>', {
                          class: 'si si-trash'
                      }).prop('outerHTML'),
                      class: 'btn btn-outline-danger btn-remove',
                      'data-toggle': 'tooltip',
                      'data-placement': 'top',
                      title: 'Hapus Data'
                  });

                return $('<div>', {
                    class: 'btn-group',
                    html: [button_link, button_edit, button_delete]
                }).prop('outerHTML');
            }
        }],
        initComplete: async function () {

            $('.btn-preview').on('click', function (event) {
              event.preventDefault()
              open($(this).data('link'))
            })

            $('#modal-tambah').on('hide.bs.modal', function (event) {
                $('#form-tambah').trigger('reset')
                $('#form-tambah').find('input').removeClass('is-invalid is-valid')
                $('#form-tambah').find('div.invalid-feedback').remove()
            })

            $('#form-tambah').on('submit', function (event) {
                event.preventDefault();
                if (!$(this).valid()) {
                    validator.tambah.focusInvalid()
                    return;
                }

                let formData = new FormData(this);

                $.ajax({
                    url: "<?= base_url('admin/website/prioritas_pembangunan/store')?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: () => {
                        $(this).find('.btn-submit').fadeOut();
                        $(this).LoadingOverlay('show')
                    },
                    complete: () => {
                        $(this).find('.btn-submit').fadeIn();
                        $(this).LoadingOverlay('hide')
                    },
                    success: (res) => {
                        $(this)[0].reset();
                        $('#modal-tambah').modal('hide');

                        let { message, csrf } = res

                        toastr.success(message, 'Sukses');

                        datatable.ajax.reload(null, false);
                    },
                    error: (err) => {
                        if (!err.responseJSON) {
                            toastr.error('Terjadi kesalahan di server', 'Gagal');
                            return;
                        }

                        let { message, csrf } = err.responseJSON;
                        toastr.error(message ?? 'Terjadi kesalahan di server', 'Gagal');
                    }
                })
            })

            $(this).on('click', '.btn-update', function (event) {
                let tr = $(this).closest('tr');
                let data = datatable.row(tr).data();
                console.log(data)

                $('#form-ubah').data('id', data.id)
                $('#ubah-nama').val(data.nama)
                $('#ubah-link').val(data.link)
                $('#ubah-deskripsi').val(data.deskripsi)
                $('#modal-ubah').modal('show')
            })

            $('#modal-ubah').on('hide.bs.modal', function (event) {
                $('#form-ubah').trigger('reset')
                $('#form-ubah').find('input').removeClass('is-invalid is-valid')
                $('#form-ubah').find('div.invalid-feedback').remove()
                $('#form-ubah').data('id', null)
                console.clear()
            })

            $('#form-ubah').on('submit', function (event) {
                event.preventDefault();
                if (!$(this).valid()) {
                    validator.ubah.focusInvalid()
                    return;
                }

                let formData = new FormData(this);

                formData.append('id', $(this).data('id'))

                $.ajax({
                    url: "<?= base_url('admin/website/prioritas_pembangunan/update')?>",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: () => {
                        $(this).find('.btn-submit').fadeOut();
                        $(this).LoadingOverlay('show')
                    },
                    complete: () => {
                        $(this).find('.btn-submit').fadeIn();
                        $(this).LoadingOverlay('hide')
                    },
                    success: (res) => {
                        $(this)[0].reset();
                        $('#modal-ubah').modal('hide');

                        let { message } = res

                        toastr.success(message, 'Sukses');
                        datatable.ajax.reload(null, false);
                    },
                    error: (err) => {
                        if (!err.responseJSON) {
                            toastr.error('Terjadi kesalahan di server', 'Gagal');
                            return;
                        }

                        let { message} = err.responseJSON;
                        toastr.error(message ?? 'Terjadi kesalahan di server', 'Gagal');
                    }
                })
            })

            $(this).on('click', '.btn-remove', function (event) {
                event.preventDefault()

                let tr = $(this).closest('tr');
                let data = datatable.row(tr).data();

                let { id } = data;

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    html: `Data akan segera dihapus!`,
                    footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post("<?= base_url('admin/website/prioritas_pembangunan/delete')?>", { id })
                            .then((res) => {
                                let { message } = JSON.parse(res)

                                console.log(res)
                                toastr.success(message, 'Sukses');
                                datatable.ajax.reload(null, false);
                            }).catch((err) => {
                                if (!err.responseJSON) {
                                    toastr.error('Terjadi kesalahan di server', 'Gagal');
                                    return;
                                }

                                let { message } = err.responseJSON;
                                toastr.error(message ?? 'Terjadi kesalahan di server', 'Gagal');
                            })
                    }
                })
            })
        }
    })
}

validator.tambah = $('#form-tambah').validate({
    errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
    errorElement: 'div',
    errorPlacement: (error, element) => $(element).closest('.form-group').find('.col-md-12').append(error),
    highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
    unhighlight: (element) => $(element).removeClass('is-invalid').addClass('is-valid'),
    success: (element) => $(element).remove(),
    rules: {
        nama: "required",
        link: "required",
        foto: "required",
        deskripsi: "required",
    },
    messages: {
        nama: "Nama prioritas pembangunan tidak boleh kosong",
        link: "Link peta tidak boleh kosong",
        foto: "Foto tidak boleh kosong",
        deskripsi: "Deskripsi prioritas pembangunan tidak boleh kosong",
    }
});

validator.ubah = $('#form-ubah').validate({
    errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
    errorElement: 'div',
    errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
    highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
    unhighlight: (element) => $(element).removeClass('is-invalid').addClass('is-valid'),
    success: (element) => $(element).remove(),
    rules: {
        nama: "required",
    },
    messages: {
        nama: "Nama prioritas pembangunan tidak boleh kosong",
    }
});
</script>

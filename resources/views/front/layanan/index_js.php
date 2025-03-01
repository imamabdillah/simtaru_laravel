<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
let datatable;
$(() => {
    load_datatable()
})

const load_datatable = () => {
    datatable = $('#table-data').DataTable({
        serverSide: true,
        processing: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
            url: "<?= base_url('prioritas_pembangunan/data')?>",
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
              return data ? `<img src="<?= base_url()?>${data.path}" style="max-width: none; width: 300px !important; height: 200px; object-fit: cover;">`:''
            }
        }, {
            data: 'nama',
        }, {
            data: 'deskripsi',
        }, {
            data: 'link',
            render: (data) => {
              return data ? `<a href="${data}" style="
	font-size: smaller;
	padding: 3px 10px;
	background: #e6262d;
	color: #ffffff;
	border: 1px solid #e6262d;
  border-radius: 50em;
">Lihat</a>`:''
            }
        }],
        initComplete: async function () {

        }
    })
}

</script>

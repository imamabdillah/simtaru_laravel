
<table class="table table-striped" id="table-data-perbaikan">
                    <thead>
                        <tr>
                            <th class="th-background-dark-blue" style=""></th>
                            <th class="th-background-dark-blue" style="">Tahun</th>
                            <th class="th-background-dark-blue" style="">Pekerjaan</th>
                            <th class="th-background-dark-blue" style="">Lokasi</th>
                            <th class="th-background-dark-blue" style="">Pelaksanaan</th> 
                        </tr>
                    </thead>
                    <tbody id="show_data_perbaikan">
                    </tbody>
                </table>

<script>
    $(document).ready(function() {
let id = '<? @$id?>'
        load_table(id); 
    });

    function load_table(id) {
    $('#table-data-perbaikan').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        lengthMenu: [
            [10, 25, -1],
            [10, 25, "All"]
        ],
        order: [],
        ajax: {
            url: "<?php echo base_url('peta/data_perbaikan/') ?>"+id,
            type: "POST",
            dataType: "json"
        },
        columnDefs: [{
                targets: [0,3],
                orderable: false
            },
            {
                targets: [0],
                className: 'text-center'
            },
        ],
    });
    }
</script>
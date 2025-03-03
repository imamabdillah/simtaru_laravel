<link rel="stylesheet" href="<?= base_url(); ?>assets/css/leaflet.measure.css">
<!-- CSS -->
<link rel="stylesheet" href="<?= base_url() ?>_assets_front/css/leaflet.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


<!-- Main Container -->
<main id="main-container">
    <div class="container-fluid" style="max-width: 1200px;">
        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title"><i class="si si-map mr-2" style="font-size: 14px;"></i> Peta </h3>
            </div>
            <div class="block-content">
                <iframe src="<?= base_url('admin/peta_preview/iframe') ?>" style="width:100%;height:80vh;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</main>
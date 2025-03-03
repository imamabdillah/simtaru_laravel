<footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="#"></a> &copy; Sistem Informasi PU Terpadu
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/codebase.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?= base_url(); ?>assets/js/plugins/chartjs/Chart.bundle.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/select2/i18n/id.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/sweetalert2/new.js"></script>
        <script src="<?= base_url(); ?>assets/js/leaflet.measure.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
        <script src="<?=base_url()?>assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?= base_url(); ?>assets/js/pages/be_pages_dashboard.js"></script>


        <script>
            jQuery(function () {
                // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
                Codebase.helpers(['colorpicker']);
            });
        </script>

        <?php if(isset($extra_js)){echo $extra_js;}?>
    </body>
</html>
<script type="text/javascript">
	var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

	function tombol_edti(){
		window.location.replace("<?= base_url('admin/website/layanan/edit');?>");
	}
</script>
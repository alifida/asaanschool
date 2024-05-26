<?php if(isset($footerPage)){ ?>

<aside class="ms-footbar">
	<div class="container">
		
		<?php 
		$pageData = array();
		$pageData["page"] = $footerPage;
		$this->load->view ( 'webtemplates/public/page', $pageData );
		?>
		
		
		
		
		
		
		
		
		
		 
	</div>
</aside>
<?php }?>





<div class="btn-back-top back-show">
	<a href="#" data-scroll="" id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised "> <i class="zmdi zmdi-long-arrow-up"></i>
		<div class="ripple-container"></div></a>
</div>


<?php $this->load->view('common/global_modal'); ?>




<!-- DataTables JavaScript -->
    <script src="<?= base_url() ?>webtemplates/red-theme/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>webtemplates/red-theme/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>webtemplates/red-theme/bower_components/datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>webtemplates/red-theme/js/multiple_select/jquery.bootstrap-duallistbox.js"></script>
<script src="<?= base_url() ?>webtemplates/red-theme/js/colorpicker/bootstrap-colorpicker.js"></script>
<script src="<?= base_url() ?>webtemplates/red-theme/js/custom.js"></script>
<script src="<?= base_url() ?>webtemplates/red-theme/js/index.js"></script>
<script src="<?= base_url() ?>webtemplates/red-theme/js/nestable/jquery.nestable.js"></script>
<script src="<?= base_url() ?>webtemplates/red-theme/js/ckeditor/ckeditor.js"></script>

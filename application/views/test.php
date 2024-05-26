<?php ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	   <?php $this->load->view('common/common_include_head'); ?>
	</head>
	<body class="skin-blue">
	 		<?php $this->load->view('common/nav_top'); ?>
	    <div  class="wrapper row-offcanvas row-offcanvas-left" >
	 		<?php $this->load->view('common/nav_left_side'); ?>
	        <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>File upload test</h1>
                </section>

                <!-- Main content -->
                <section class="content">
	            <div class="row">
	                <div class="col-lg-12">
	                     
						<div id="userpic" class="userpic">
							<div class="js-preview userpic__preview"></div>
							<div class="btn btn-primary js-fileapi-wrapper">
								<div class="js-browse" onclick="">
									<span class="btn-txt">Choose</span>
									<input type="file" name="filedata" id="select_file_1"/>
								</div>
								<div class="js-upload" style="display: none;">
									<div class="progress progress-success"><div class="js-progress bar"></div></div>
									<span class="btn-txt">Uploading</span>
								</div>
							</div>
						</div>
							 
						<script>
						var examples = [];
							examples.push(function (){
								$('#userpic').fileapi({
									url: '<?php echo site_url('fileupload/upload'); ?>',
									accept: 'image/*',
									imageSize: { minWidth: 200, minHeight: 200 },
									elements: {
										active: { show: '.js-upload', hide: '.js-browse' },
										preview: {
											el: '.js-preview',
											width: 200,
											height: 200
										},
										progress: '.js-progress'
									},
									onSelect: function (evt, ui){
										$('#userpic').css('background-image', 'none');
										var file = ui.files[0];
										if( !FileAPI.support.transform ) {
											alert('Your browser does not support Flash :(');
										}
										else if( file ){
											$('#popup').modal({
												closeOnEsc: true,
												closeOnOverlayClick: false,
												onOpen: function (overlay){
													$(overlay).on('click', '.js-upload', function (){
														$.modal().close();
														$('#userpic').css('background-image', 'none');
														$('#userpic').fileapi('upload');
													});
						
													$('.js-img', overlay).cropper({
														file: file,
														bgColor: '#fff',
														maxSize: [$(window).width()-100, $(window).height()-100],
														minSize: [200, 200],
														selection: '90%',
														onSelect: function (coords){
															$('#userpic').fileapi('crop', file, coords);
														}
													});
												}
											}).open();
										}
									}
								});
							});
						</script>
					
					
						<div id="popup" class="popup" style="display: none;">
							<div class="popup__body"><div class="js-img"></div></div>
							<div style="margin: 0 0 5px; text-align: center;">
								<div class="js-upload btn btn-primary ">Upload</div>
							</div>
						</div>
	                     
	                     
	                </div>
	                <!-- /.col-lg-12 -->
	                
	            </div>
	            <!-- /.row -->
	        </section>
	        </aside>
	    </div>
		<?php $this->load->view('common/common_include_body'); ?>
	

		
		
		
	</body>

</html>

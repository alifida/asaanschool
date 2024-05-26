<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php $this->load->view('common/common_include_head'); ?>
</head>
<body>
<div id="wrapper">

		<div id="page-wrapper">
            <div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-6  col-sm-12  col-xs-12">
						<img alt="" src="<?= site_url("public/images/top_banner1.png") ?>" style="width: inherit;">
						<?php 
							$this->load->view('common/top_menu');
						
						
						?>            	
					</div>
				</div>
            
            
   				<?php $this->load->view('common/app_messages'); ?>
                <?php echo $body; ?>
            </div>
            <!-- /.container-fluid -->
        </div>        


</div>

<?php $this->load->view('common/common_include_body'); ?>
</body>
</html>
















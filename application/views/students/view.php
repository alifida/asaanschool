<?php ?>
                <section class="content-header">
	                
	                    <h1 class=""><?= $student["first_name"] ?> <?= $student["last_name"] ?> </h1>
	                
                    
                </section>

                <!-- Main content -->
                <section class="content">        	
           
           
            			<!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#dues_detail" data-toggle="tab">Dues</a></li>
                                <li class=""><a href="#guardians" data-toggle="tab">Guardians</a></li>
                                <li class=""><a href="#history" data-toggle="tab">History</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content custom">
                            	<br/>
                                <div class="tab-pane active" id="dues_detail">
                                    <div class="row">
                                    	<div class="col-lg-8">
						            		<?php $this->load->view('students/detail'); ?>
                                    	</div>
                                    	<div class="col-lg-4">
						            		<?php $this->load->view('students/total_dues'); ?>
						            	</div>
                                    
                                    
						            	<div class="col-lg-8">
						                     <?php $this->load->view('students/fee_detail'); ?>
						                     <?php $this->load->view('students/stationary_detail'); ?>
						               	</div>
						            	
						            </div>
                                </div>
                                <div class="tab-pane active" id="guardians">
                                	<div class="row">
						                <div class="col-lg-12">
						                    <?php $this->load->view('guardians/list'); ?>
						                </div>
						            </div>
                                </div>
                                <div class="tab-pane active" id="history">
                                    <div class="row">
						            	<div class="col-lg-12">
						            		<?php $this->load->view('students/fee_list');?>
						            	</div>
						            </div>
						             <div class="row">
						            	<div class="col-lg-12">
						            		<?php $this->load->view('students/stationary_list');?>
						            	</div>
						            </div>
                                </div>
                            </div>
        </section>
		<?php $this->load->view('students/fee_payment_modal'); ?>
	
	<script  src="<?= base_url() ?>public/js/student.js?v=<?= get_app_message("release.version")?>"></script>
<script>
	$(document).ready(function() {
    	$('#stationaryList').dataTable( {
    		"order": [[ 1, "desc" ]],
    		responsive: true
    	});
    	$('.dataTables_filter').addClass("pull-right");
    	$('.table-responsive .col-sm-5').addClass("col-xs-5");
    	$('.table-responsive .col-sm-7').addClass("col-xs-7");
    	$('.pagination').addClass("pull-right");

	$("#history").removeClass("active").addClass("fade");;
	$("#guardians").removeClass("active").addClass("fade");;

    	});


</script>

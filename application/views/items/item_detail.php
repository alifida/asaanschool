<?php ?>

        	<section class="content-header">
                    <h1></h1>
                </section>
            
            
           <section class="content">
	            <div class="row" data-columns="" id="columns">
	                
	            	 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	            		<?php $this->load->view('items/detail_view'); ?>
	            	</div>
	                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	            		<?php $this->load->view('items/item_pie_chart'); ?>
	            	</div>
	            </div>
	            <div class="row" data-columns="" id="columns">
	                <div class="col-lg-12">
	            		<?php $this->load->view('items/item_issued_list'); ?>
	            	</div>
	                
	            </div>
	            <div class="row" data-columns="" id="columns">
	                <div class="col-lg-12">
	            		<?php $this->load->view('items/available_items'); ?>
	            	</div>
	               
	            </div>
          </section>
        
<script>
	$(document).ready(function() {
    	$('#employees_salaries').dataTable( {
    		"order": [[ 0, "desc" ]],
    		responsive: true
    	});
    	$('.dataTables_filter').addClass("pull-right");
    	$('.table-responsive .col-sm-5').addClass("col-xs-5");
    	$('.table-responsive .col-sm-7').addClass("col-xs-7");
    	$('.pagination').addClass("pull-right");
	});
</script>

	
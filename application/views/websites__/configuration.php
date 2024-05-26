<?php ?>
<section class="content-header">
<h1>Website Configuration</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12">
	<?php $this->load->view('websites/edit_website_form'); ?>
	</div>
</div>
<!-- /.row --> </section>

<script	src="<?= base_url() ?>public/js/websites.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		toggleDomainControles();
	});
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#website_update_form').bootstrapValidator({
            fields: {
            	site_title: {
            		message: 'Site title is required',
            		validators: {
                        notEmpty: {
                            message: 'Site title is required and can\'t be empty'
                        }
                    }
                },
                domain_type: {
            		message: 'Domain Type is required',
            		validators: {
                        notEmpty: {
                            message: 'Domain Type is required and can\'t be empty'
                        }
                    }
                },
                subdomain: {
            		message: 'Domain is not valid. Allowed Format: abc-xyz',
            		validators: {
            			 regexp: {
                             regexp: /^(?!-)(?!.*--)^[A-Za-z0-9]+(-[A-Za-z0-9]+)*$/,
                             message: 'Domain is not valid. Allowed Format: abc-xyz'
                         }
                    }
                },
                domain: {
            		message: 'Domain is not valid. Allowed Format: example.com or www.example.com',
            		validators: {
            			 regexp: {
            				 regexp: /^(([a-zA-Z]{1})|([a-zA-Z]{1}[a-zA-Z]{1})|([a-zA-Z]{1}[0-9]{1})|([0-9]{1}[a-zA-Z]{1})|([a-zA-Z0-9][a-zA-Z0-9-_]{1,61}[a-zA-Z0-9]))\.([a-zA-Z]{2,6}|[a-zA-Z0-9-]{2,30}\.[a-zA-Z]{2,3})$/,
                             message: 'Domain is not valid. Allowed Format: example.com or www.example.com'
                         }
                    }
                }
                
                
                
                
                
            }
        });

        $(".my-colorpicker2").colorpicker();
    });


   
    
</script>

<?php ?>

	             <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Update Campus</h1>
                </section>
                <section class="content">
		            <div class="row">
		                <div class="col-lg-12">
		                     <?php $this->load->view('campuses/editForm'); ?>
		                </div>
		                <!-- /.col-lg-12 -->
		                
		            </div>
	            </section>
	            <!-- /.row -->
	        
<script>
$(document).ready(function() {
    $('#campus_update_form').bootstrapValidator({
        fields: {
        	campus_name: {
        		message: 'Campus Name is required',
        		validators: {
                    notEmpty: {
                        message: 'Campus Name is required and can\'t be empty'
                    	}
                	}
        		},
                primary_email: {
            		message: 'Primary Email is required',
            		validators: {
                        notEmpty: {
                            message: 'Primary Email is required and can\'t be empty'
                        },
                        regexp: {
    	                    regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,9})$/,
    	                    message: 'Email is not valid. Format: xxx@xx.xx'
    	                }
                    }
                },
                
                secondary_email: {
            		validators: {
            			regexp: {
    	                    regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,9})$/,
    	                    message: 'Email is not valid. Format: xxx@xx.xx'
    	                }
                    }
                },
                website: {
            		validators: {
            			regexp: {
                            regexp: /(?:(?:http|https):\/\/)?([-a-zA-Z0-9.]{2,256}\.[a-z]{2,4})\b(?:\/[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)?/,
                            message: 'Website address is not valid. Format: http://example.com '
                        } 
                    }
                },
                primary_phone: {
            		message: 'Primary Phone is required',
            		validators: {
                        notEmpty: {
                            message: 'Primary Phone is required and can\'t be empty'
                        },
                        digit: {
                            message: 'Only digits are allowed.'
                        },
                        stringLength: {
                            max: 15,
                            min: 10,
                            message: 'Phone No is not valid.'
                        }
                        
                    }
                },
                secondary_phone: {
            		validators: {
            			digit: {
                            message: 'Only digits are allowed.'
                        },
                        stringLength: {
                            max: 15,
                            min: 10,
                            message: 'Phone No is not valid.'
                        }
                    }
                },
                fax: {
            		
            		validators: {
            			digit: {
                            message: 'Only digits are allowed.'
                        },
                        stringLength: {
                            max: 15,
                            min: 10,
                            message: 'Fax is not valid.'
                        }
                    }
                },
                city: {
            		message: 'City is required',
            		validators: {
                        notEmpty: {
                            message: 'City is required and can\'t be empty'
                        }
                    }
                },
                state: {
            		message: 'State is required',
            		validators: {
                        notEmpty: {
                            message: 'State is required and can\'t be empty'
                        }
                    }
                },
                post_code: {
            		message: 'Post Code is required',
            		validators: {
                        notEmpty: {
                            message: 'Post Code is required and can\'t be empty'
                        },
		                
		                stringLength: {
		                    max: 9,
		                    min: 4,
		                    message: 'Post Code is not valid.'
		                }
                    }
                }
            
        	}
    	});
	});
</script>			
	
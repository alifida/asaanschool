<?php ?>

<section class="content-header">
<h1>Defaulters</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- /.row -->
<div class="row">
	<div class="col-lg-12">
	
<?php
	if($action =='bulk'){
	   $this->load->view('students/defaulters_bulk_list');
	}else{
	   $this->load->view('students/defaulters_list');
	}
	    
?>

	</div>
</div>
</section>

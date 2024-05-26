<?php ?>
<section class="content-header">
<h1>Students</h1>
</section>

<!-- Main content -->
<script type="text/javascript">
<!--
$(document).ready(function() {
    $('#example').DataTable( {
        "ajax": "http://localhost/asaanschool/user/ajaxdata",
        "columns": [
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "extn" },
            { "data": "start_date" },
            { "data": "salary" }
        ]
    } );
} );

//-->
</script>
<section class="content"> <!-- /.row -->
<div class="row">
	<div class="col-lg-12">

<div class="box box-success">
	<div class="box-header">
		Students

		
	</div>

	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table id="example" class="table  table-hover table-responsive " cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Extn.</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</thead>
				
			</table>


		</div>

	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>
</section>


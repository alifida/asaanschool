<?php
?>
<div class="box box-danger">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-3">
				<i class="fa fa-tasks fa-5x"></i>
			</div>
			<div class="col-xs-9 text-right">
				<div class="huge" id="student_total_dues"></div>
				<div>Total Dues</div>
			</div>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			
			<div class="col-xs-12 " id="payment_summary_container">
				
			</div>
		</div>
	</div>
	<a href="#">
		<div class="box-footer">
			<button type="button" class="btn btn-success btn-xs"  onclick="show_payment_dialog();">
				<span class="glyphicon glyphicon-usd"></span> Pay Now
			</button>
		  

			<span class="pull-right"> <?= date("Y-m-d") ?></span>
			<div class="clearfix"></div>
		</div>
	</a>
</div>				
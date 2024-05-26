<?php ?>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
	Employee Attendance
</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- Main row -->
<div class="row">
	<div class="col-lg-8">
	<?php $this->load->view('attendance/employee/employeeAttendance'); ?>
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-lg-4">
	<?php $this->load->view('attendance/employee/employeeTypes'); ?>
	</div>
	<!-- /.col-lg-4 -->
</div>

</section>
<!-- /.content -->


<script type="text/javascript">
	$(function() {
		var nowDate = new Date();
		$('#attendance_date_wrapper').datetimepicker({
			pickTime: false,
			useCurrent:false,
		}).on("change.db", function(e){
	       load_by_date();
	    });
	});

function load_by_date(){
	<?php if(isset($enableLoadByDate) && $enableLoadByDate == true){?>
		$date = $("#attendance_date").val();
		<?php $empType =  (isset($employeeTypeId)&& !empty($employeeTypeId))? $employeeTypeId : ""; ?>
		$url = '<?= site_url("eattendance/old")."/".$empType."/" ?>'+$date;
		window.location.href = $url;
	<?php }?>
}





</script>














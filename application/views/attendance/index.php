<?php ?>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
	Attendance Register
</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- Main row -->
<div class="row">
	<div class="col-lg-8">
	<?php $this->load->view('attendance/classAttendance'); ?>
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-lg-4">
	<?php $this->load->view('attendance/classList'); ?>
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
		$class= "<?= $classId ?>";
		$url = '<?= site_url("attendance/old")."/".$classId."/" ?>'+$date;
		window.location.href = $url;
	<?php }?>
}





</script>














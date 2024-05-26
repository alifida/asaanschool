<?php ?>


<div class="row">
	<div class="col-lg-12">
		<div class="box box-danger">
			<div class="box-header">timetable</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="col-centered">
					<table class="table table-hover" id="">
						<tr>
							<td>Class:</td>
							<td><strong> <?=   (isset($timetable["subject"]["class"]))?$timetable["subject"]["class"]["name"]:""; ?> </strong></td>
						</tr>
						<tr>
							<td>Subject:</td>
							<td><strong> <?=   (isset($timetable["subject"]))?$timetable["subject"]["name"]:""; ?> </strong></td>
						</tr>
						<tr>
							<td>Start Time:</td>
							<td><strong> <?=   (isset($timetable["start_time"]))?$timetable["start_time"]:''; ?> </strong></td>
						</tr>
						<tr>
						<td>End Time:</td>
							<td><strong> <?=   (isset($timetable["end_time"]))?$timetable["end_time"]:''; ?> </strong></td>
						</tr>
						<tr>
						<td>Week Day:</td>
							<td><strong> <?=   (isset($timetable["week_day"]))?$timetable["week_day"]:''; ?> </strong></td>
						</tr>
						<tr>
						<td>Status:</td>
							<td><strong> <?=   (isset($timetable["status"]))?$timetable["status"]:''; ?> </strong></td>
						</tr>
						<tr>
						 
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>





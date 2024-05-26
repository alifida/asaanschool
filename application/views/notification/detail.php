<?php ?>

		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Subject: </td>
					<td><strong><?= (isset($notification["subject"]))? $notification["subject"]:"" ?></strong></td>
				</tr>
				<tr>
					<td>Body: </td>
					<td><strong><?= (isset($notification["body"]))? $notification["body"]:"" ?></strong></td>
				</tr>
				<tr>
					<td>Start Date: </td>
					<td><strong><?= (isset($notification["start_date"]))? $notification["start_date"]:"" ?></strong></td>
				</tr>
				<tr>
					<td>End Date: </td>
					<td><strong><?= (isset($notification["end_date"]))? $notification["end_date"]:"" ?></strong></td>
				</tr>
				<tr>
					<td>Status: </td>
					<td><strong><?= (isset($notification["status"]))? $notification["status"]:"" ?></strong></td>
				</tr>
			</table>
		</div>
		
		<br/> 
	 
		  	
		
		
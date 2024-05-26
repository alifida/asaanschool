<?php ?>

				<form class="form-horizontal" action="<?= site_url('appadmin/saveLicenseStatus')?>" method="post" id="licenseStatusForm">
					<fieldset>
					
						<div class="col-centered">
							<table class="table table-hover" id="">
								<tr>
									<td>School Name: </td>
									<td><strong><?= $school["school_name"] ?></strong></td>
								</tr>
								<tr>
									<td>Registration No.</td>
					    			<td><strong><?= $school["registration_no"] ?></strong></td>
								</tr>
								<tr>
									<td>User Since</td>
					    			<td><strong><?= $school["created_at"] ?></strong></td>
								</tr>
							</table>
						</div>
						
					
						<div class="form-group">
						  
							  <div class="col-md-5 col-centered">
								  	<select id="licenseStatus" name="licenseStatus"  class="form-control"  required="required" >
				    					<option value=""></option>
				    					<option <?= ($school["status"]==get_app_message("db.status.licenced"))?" selected ":" "  ?> value="<?= get_app_message("db.status.licenced") ?>"><?= get_app_message("db.status.licenced") ?></option>
				    					<option <?= ($school["status"]==get_app_message("db.status.trail"))?" selected ":" "  ?> value="<?= get_app_message("db.status.trail") ?>"><?= get_app_message("db.status.trail") ?></option>
				    					<option <?= ($school["status"]==get_app_message("db.status.expired"))?" selected ":" "  ?> value="<?= get_app_message("db.status.expired") ?>"><?= get_app_message("db.status.expired") ?></option>
				    				</select>
							    
							  </div>
						</div>
					
											
						<div class="form-group">
						  	
						  	<div class="col-centered">
						  		<div class="">
						    		<button id="school_status_btn_save" type="submit" name="school_status_btn_save" class="btn btn-danger">Save</button>
						  		</div>
						  	</div>
						</div>
					</fieldset>
					<input type="hidden" name="school_id" id="school_id" value="<?= isset($school["id"])? encodeID($school["id"]):"" ?>" />
				</form>
			
<?php ?>

<form class="form-horizontal" action="<?= site_url('employee/issueSalary') ?>" method="post" id="issue_salary_form">
	<fieldset>
	
		<div class="form-group">
		  <label class="col-md-4 control-label" for="salary_date">Salary month</label>  
		  <div class="col-md-6 date" data-date-format="YYYY-MM" >
			  <div class="input-group">
			  	<input id="salary_date" name="salary_date" type="text"   readonly="readonly"  required=""
			  		placeholder="Salary month" class="form-control input-md" >
		  			<span class="input-group-addon" style="padding: 6px;">
				  		<span class="glyphicon glyphicon-calendar"></span>
				  </span>
			  </div>
		  </div>
		</div>
	
		<div class="form-group">
			<div class="col-lg-12 col-centered ">
				<select id="salary_multiple_employees" name = "salary_multiple_employees[]" class="form-control dual_list_box" multiple="multiple" >
					<?php if(!empty($employees)){
						foreach($employees as $employee){ ?>
							
							<option value="<?= $employee["id"] ?>"  <?= (!empty($selectedEmployeeId) && $selectedEmployeeId == $employee["id"]  )? " selected = 'true'":"" ?>   ><?= $employee["first_name"]." ".$employee["last_name"] ." (".$employee["salary"].")"?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-3 control-label" for="salary_comments">Comments</label>
		  <div class="col-md-7">                     
			<textarea class="form-control" id="salary_comments" name="salary_comments" rows="5" ></textarea>
		  </div>
		</div>
		
		<div class="row" >
		  	<div class="col-lg-1 col-centered">
		  		<div style="display: table-cell;"><button id="salary_reset" name="salary_reset" class="btn btn-default" type="reset">Reset</button></div>
		  		<div style="display: table-cell;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		  		<div style="display: table-cell;"><button id="salary_save" name="salary_save" class="btn btn-primary" type="submit">Save</button></div>
		  	</div>
		</div>
	</fieldset>
	
	
</form>
<script type="text/javascript">
	$(function() {
		var nowDate = new Date();
		$('.date').datetimepicker({
			useCurrent:false,
			pickTime: false,
			viewMode: "months",
			minViewMode: "months"
		});
	});
	
	create_dual_list_boxes();

	$(document).ready(function() {
		// enable revalidation of date
    	dateTimePickerRevalidator();
        $('#issue_salary_form').bootstrapValidator({
            fields: {
            	salary_date: {
                    message: 'Salary month is required',
                    validators: {
                    	notEmpty: {
                            message: 'Salary month is required and can\'t be empty'
                        }
                    }
                }
            }
        });
    });

	
</script>	

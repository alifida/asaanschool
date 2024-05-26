<?php 

$userType = "public";


$formAction = site_url('user/activiateAccount');
if(isset($_SESSION["sessionUser"]) && !empty($_SESSION["sessionUser"])){
	$formAction = site_url('admin/activiateAccount');
	$userType = "registered";
}
?>

<form class="form-horizontal" action="<?= $formAction ?>" method="post" id="package_selection_form">
	<fieldset>
	<?php $currentPackage = "Not Set";
		if(isset($packages)){
			foreach($packages as $package){
				if($activePackageId == $package["id"]) {
					$currentPackage = $package;
				}
			}
		}
	?>
	
	<?php if($userType != "registered"){?>
			<div class="form-group">
			  <label class="col-md-4 control-label" for="login_email">Email</label>  
			  <div class="col-md-6">
			  <input id="login_email" name="login_email" type="text" placeholder="Email" class="form-control input-md" required="required"/>
			    
			  </div>
			</div>
			
			<div class="form-group">
			  <label class="col-md-4 control-label" for="school_reg_no">School Reg No.</label>  
			  <div class="col-md-6">
			  <input id="school_reg_no" name="school_reg_no" type="text" placeholder="School Reg No." class="form-control input-md" />
			    
			  </div>
			</div>
	<?php }?>
	
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="package_id">Current Package</label>  
		  <div class="col-md-6">
		  	<button class="btn   btn-block btn-primary  " type="button">TRAIL</button>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="package_id">New Package</label>  
		  <div class="col-md-6">
		  	<select id="package_id" name="package_id"  class="form-control"  required="required" >
		    	<option value=""></option>
		    	<?php if(isset($packages)){ ?>
		    		<?php foreach($packages as $package){ ?>
		    			<?php if($activePackageId != $package["id"]) {?>
		    				<option value="<?= $package["id"]?>" ><?= $package["name"]?> (<?= $package["price"]["price"]?> <?= $package["price"]["currency"]?>) </option>
		    			<?php } ?> 
		    		<?php } ?> 
				<?php }		?>
		      
		    </select>
		  </div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="comments">Comments</label>  
		  <div class="col-md-6">
		  	<textarea id="comments" name="comments" rows="4" class="form-control"></textarea>
		  </div>
		</div>
				
		
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="package_btn_reset"></label>
		  <div class="col-md-6 ">
			  <div class="pull-right">
			    <button id="package_btn_reset" name="package_btn_reset" class="btn btn-default" type="reset">Reset</button>
			    <button type="submit" id="package_btn_save" name="package_btn_save" class="btn btn-primary">Save</button>
			  </div>
		  </div>
		</div>
		
		
	</fieldset>
</form>



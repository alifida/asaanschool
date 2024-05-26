<?php 
$relatedStudent = array();

if(!empty($transaction["studentFee"])){
	foreach($transaction["studentFee"] as $key=> $studentFee){
		if(isset($studentFee["student"])&& !empty($studentFee["student"])){
			$relatedStudent= $studentFee["student"];
			break;
		}
	}
}
// if student not found in studentFee then search in $studentItems
if(empty($relatedStudent)){
	if(!empty($transaction["studentItems"])){
		foreach($transaction["studentItems"] as $key=> $studentItem){
			if(isset($studentItem["student"])&& !empty($studentItem["student"])){
				$relatedStudent= $studentItem["student"];
				break;
			}
		}
	}
}

?>
<?php if(!empty($relatedStudent)) { ?>
	
			<div class="col-lg-10 col-md-offset-1">
				<div  class="alert alert-warning">
					<div class="col-centered">
						<h4 class="">Related Student</h4>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-offset-3">
							<table class="table table-hover" id="">
								<tr>
									<td >Name: </td>
									<td><strong><?= $relatedStudent["first_name"]." ".$relatedStudent["last_name"]	?></strong></td>
								</tr>
								<tr>
									<td>Class &#38; Roll No.: </td>
									<td><strong><?= $relatedStudent["class"]["name"]." (".$relatedStudent["roll_no"].")" ?></strong></td>
								</tr>
								<tr>
									<td>Father Name: </td>
									<td><strong><?= $relatedStudent["father_name"]	?></strong></td>
								</tr>
							</table>
						</div>
					</div>
					
				
					<?php if(!empty($transaction["studentFee"]) || !empty($transaction["studentItems"])){?> 
						<div class="row">
							<?php $this->load->view('profit/transaction_details/student_discounts'); ?>
							<?php $this->load->view('profit/transaction_details/student_fee'); ?>
							<?php $this->load->view('profit/transaction_details/student_items'); ?>
						</div>
					<?php }?>
				</div>
			</div>
		
	
<?php }?>
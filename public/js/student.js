$(document).ready(function() {
	$stationaryDues = parseInt($("#student_total_stationary").html());
	$feeDues = parseInt($("#student_total_fee").html());
	$("#student_total_dues").html($stationaryDues + $feeDues + " PKR");
	$("#totaldues").val($stationaryDues + $feeDues);
	$("#remaing_dues").val($stationaryDues + $feeDues);

});

var summaryItems = new Array();

function show_payment_dialog(){
	// clear existing messages from list 
	clear_app_error_and_messages();

	if(summaryItems.length > 0){
		
		$('#feePaymentModal').modal('show');
	}else{
		
		$("#appNotifications .message_container").append("<ul  class='custom_ul'><li>Please clear atleast one Due Item.</li></ul>");
		show_app_error_and_messages();
	}
	
}

function update_payment_summary() {

	var html = "<div>Payment Summary</div>";
	var payment_for = JSON.stringify(summaryItems);
	
	if (summaryItems.length > 0) {
		$total = 0;
		html = html + "	<table class='table table-hover'>" + "		<tr>"
				+ "			<th>#</th>" + "			<th>Desc</th>" + "			<th>Amount</th>"
				+ "		</tr>";
		for ( var index = 0; index < summaryItems.length; index++) {
			html = html + "	<tr>" 
					+ "			<td>" + (index + 1) + "</td>"
					+ "			<td>" + summaryItems[index]["desc"] + "</td>"
					+ "			<td>" + summaryItems[index]["amount"] + " PKR</td>"
					+ "		</tr>";
			$total = $total + parseInt(summaryItems[index]["amount"]);
		}
		html = html + "	<tr>" + "					<th></th>" + "					<th>Total</th>"
				+ "					<th>" + $total + " PKR</th>" + "				</tr>";
		html = html + "	</table>";

//		$("#remaing_dues").val($("#current_payable").val() - $total);
		$("#remaing_dues").val("0");
		$("#payment").val($total);
		$("#current_payable").val($total);
	}

	$("#payment_summary_container").html(html);
	$("#payment_summary_on_model").html(html);
	$("#payment_for").val(payment_for);

}

function toggle_clear_due(prefix, id, action) {
	// prefix = prefix of ID
	// id = last digit of element ID for toggling
	// action = red/green
	// $elementID = prefix + action + id;

	$elementID = prefix + "_" + action + "_" + id;
	// hide both of elements first then show requested one.

	$("#" + prefix + "_green_" + id).hide();
	$("#" + prefix + "_red_" + id).hide();
	// $("#" + prefix + "_yellow_" + id).hide();
	// $("#" + prefix + "_blue_" + id).hide();
	// $("#" + prefix + "_black_" + id).hide();
	$("#" + $elementID).show();

	if ("green" == action) {
		addToSummaryItems(id, prefix);

	}
	if ("red" == action) {
		removeFromSummaryItems(id, prefix);
	}

	update_payment_summary();

}

function toggle_clear_due_by_component(prefix, action) {
	// prefix = prefix of ID
	// action = red/green

	$('[id*="' + prefix + '_green_' + '"]').hide();
	$('[id*="' + prefix + '_red_' + '"]').hide();

	$('[id*="' + prefix + '_' + action + '_' + '"]').show();

	if (action == "red") {
		// remove Multiple items from SummaryItems Array
		removeMiltipleItemsFromSummary(prefix);
	}

	if (action == "green") {
		// add Multiple items to SummaryItems Array
		addMiltipleItemsToSummary(prefix);

	}

	update_payment_summary();
}

function addToSummaryItems(id, type) {
	// Add the item to SummaryItems Array
	var item = {};
	item["id"] = id;
	item["type"] = type;
	item["desc"] = $("#" + type + "_desc_" + id).val();
	item["amount"] = $("#" + type + "_amount_" + id).val();
	var alreadyExist = false;
	if (summaryItems.length > 0) {
		for ( var index = 0; index < summaryItems.length; index++) {
			if (summaryItems[index]["id"] == id
					&& summaryItems[index]["type"] == type) {
				alreadyExist = true;
				break;
			}
		}
	}

	if (!alreadyExist && id != "") {
		summaryItems[summaryItems.length] = item;
	}
}

// add Multiple items to SummaryItems Array
function addMiltipleItemsToSummary(prefix) {
	$all_ids = $("#" + prefix + "_all_ids").val();
	var ids = $all_ids.split(',');
	if (ids.length > 0) {
		for ( var index = 0; index < ids.length; index++) {
			addToSummaryItems(ids[index], prefix);
		}
	}

}

// remove an Item from summaryItems Array
function removeFromSummaryItems(id, type) {
	// Add the item to SummaryItems Array
	var item = {};

	var itemIndex = -1;
	if (summaryItems.length > 0) {
		for ( var index = 0; index < summaryItems.length; index++) {
			if (summaryItems[index]["id"] == id
					&& summaryItems[index]["type"] == type) {
				itemIndex = index;
				break;
			}
		}
	}

	if (itemIndex > -1) {
		// summaryItems[summaryItems.length] = item;
		summaryItems.splice(itemIndex, 1);
	}
}

// remove Multiple items from SummaryItems Array
function removeMiltipleItemsFromSummary(prefix) {
	$fee_detail_all_ids = $("#" + prefix + "_all_ids").val();
	var ids = $all_ids.split(',');
	if (ids.length > 0) {
		for ( var index = 0; index < ids.length; index++) {
			removeFromSummaryItems(ids[index], prefix);
		}
	}

}

function promote_get_students_by_class() {

	$('#promote_student_students_container').slideUp();
	$('#promote_student_multiple_students').html("");

	var d = $('#promote_student_multiple_students').bootstrapDualListbox({
		nonSelectedListLabel : 'Available',
		selectedListLabel : 'Selected',
		preserveSelectionOnMove : 'moved',
		moveOnSelect : false,
		nonSelectedFilter : ''
	});
	$class_id = $('#class_from_id').val();
	var url = site_url + "student/getStudentsByClass";
	if ($class_id != "") {

		url = url + "?class_id=" + $class_id;
		$.ajax({
			url : url,
			type : "get",
			success : function(result) {

				$json = JSON.parse(result);

				for (i in $json) {
					var options = options + "<option value='" + $json[i].index
							+ "'>" + $json[i].name + "</option>";
				}
				$('#promote_student_multiple_students').html(options);

				d.bootstrapDualListbox('refresh', true);
				$('#promote_student_students_container').slideDown();
			}
		});
	}
}

function submit_promote_student_from() {
	if($("#class_from_id").val()=="" || $("#class_to_id").val()=="" ){
		return;
	}
	if($("#class_from_id").val()== $("#class_to_id").val()){
		return;
	}
	$actionUrl = site_url + "student/promoteStudentsConfirmForm";
	$formData = $("#promote_students_from").serialize();
	load_remote_model($actionUrl, "Confirm Students Promotion", $formData);
}

function calculate_fee_payment() {
	$currentPayable = $("#current_payable").val();
	//$totalDues = $("#totaldues").val();
	$payment = $("#payment").val();
	$remainingDues = $("#remaing_dues").val();
	$discount = $("#discount").val();

	if ($remainingDues == "") {
		$remainingDues = 0;
	}
	if ($currentPayable == "") {
		$currentPayable = 0;
	}
	if ($payment == "") {
		$payment = 0;
	}
	if ($discount == "") {
		$discount = 0;
	}

	$remainingDues = $currentPayable - $payment - $discount;


	if($remainingDues < 0){
		// if remaining amount is in minus than subtract it from the payment amount.
		$currentPayable = $currentPayable - ($remainingDues * (-1)); 
		//$("#current_payable").val($currentPayable);
		//$remainingDues = 0;
	}
	
	
	
	$("#remaing_dues").val($remainingDues);
	$('#student_payment_form').bootstrapValidator('revalidateField', 'remaing_dues');

}

function calculate_on_payment_onchange() {
	$("#discount").val("0");
	$currentPayable = $("#current_payable").val();
	
	//$totalDues = $("#totaldues").val();
	$payment = $("#payment").val();
	$remainingDues = $("remaing_dues").val();

	if ($remainingDues == "") {
		$remainingDues = 0;
	}
	if ($currentPayable == "") {
		$currentPayable = 0;
	}
	if ($payment == "") {
		$payment = 0;
	}

	$remainingDues = $currentPayable - $payment;

	
	$("#remaing_dues").val($remainingDues);
	
	$('#student_payment_form').bootstrapValidator('revalidateField', 'remaing_dues');

}

// Validations

$(document).ready(function() {

	$('#student_payment_form').bootstrapValidator({

		fields : {
			totaldues : {
				message : 'Total Dues is required',
				validators : {
					notEmpty : {
						message : 'Total Dues is required and can\'t be empty'
					},

					numeric : {
						message : 'Total Dues can only be a numeric value.'
					}

				}
			},
			payment : {
				message : 'Payment is required',
				validators : {
					notEmpty : {
						message : 'Payment is required and can\'t be empty'
					},

					numeric : {
						message : 'Payment can only be a numeric value.'
					},
					greaterThan:{
						value: -1,
						inclusive : 'true',
						message : 'Payment should be greater than zero.'
					}

				}
			},
			discount : {
				validators : {
					numeric : {
						message : 'Discount can only be a numeric value.'
					}
				}
			},
			paidby : {
				message : 'Paid by is required',
				validators : {
					notEmpty : {
						message : 'Paid by is required and can\'t be empty'
					}
				}
			},
			remaing_dues : {
				message : 'Remaining Dues is required',
				validators : {
					notEmpty : {
						message : 'Remaining Dues is required and can\'t be empty'
					},
					numeric : {
						message : 'Remaining Dues can only be a numeric value.'
					},
					/*greaterThan:{
						value: -1,
						inclusive : 'true',
						message : 'Remaining Dues should be zero.'
					},
					lessThan:{
						value: 1,
						inclusive : 'true',
						message : 'Remaining Dues should be zero.'
					}*/
				}
			}
		}
	});

});



$(document).ready(function() {
    
    $('#promote_students_from').bootstrapValidator({
    	
        fields: {
        	class_from_id: {
                message: 'Load Studetns of Class is required',
                validators: {
                    notEmpty: {
                        message: 'Load Studetns of Class is required and can\'t be empty'
                    }
                    
                }
            },
		    class_to_id: {
		    	message: 'Promote To is required',
		    	validators: {
		    		notEmpty: {
		    			message: 'Promote To is required and can\'t be empty'
		    		}
		            
		    	}
		    }
            
        }
    });

});


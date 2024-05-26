/**
 * 
 */

function init_fee_dates() {
	
	$fee_type_id = $("#due_fee_type_id").val();
	$class_id = $("#due_fee_class_id").val();
	
	var url =site_url+"classes/getDueFeeDates";
	if($fee_type_id!="" && $class_id!=""){
		url = url + "?";
		if($fee_type_id!=""){
			url = url + "fee_type_id="+$fee_type_id +"&";
		}
		if($class_id!=""){
			url = url + "class_id="+$class_id;
		}
	}
	$.ajax({
		url : url,
		type : "get",
		success : function(result) {
			$json = JSON.parse(result);
			$options = "<option></option>";
			for (i in $json){
				$options = $options + "<option value='"+$json[i].fee_date+"'>"+$json[i].fee_date+"</option>";
			}
			$("#due_fee_date").html($options);
		}
	});

}


function get_students_for_due_fee_deletion() {
	
	// hide students area
	$('#delete_due_fee_students_container').slideUp();
	
	
	$fee_type_id = $("#due_fee_type_id").val();
	$class_id = $("#due_fee_class_id").val();
	$due_fee_date = $("#due_fee_date").val();
	
	
	
	var url =site_url+"student/getStudentsByFeeDate";
	if($fee_type_id!="" && $class_id!="" && due_fee_date!=""){
		url = url + "?";
		if($fee_type_id!=""){
			url = url + "fee_type_id="+$fee_type_id +"&";
		}
		if($due_fee_date!=""){
			url = url + "due_fee_date="+$due_fee_date +"&";
		}
		if($class_id!=""){
			url = url + "class_id="+$class_id;
		}
	}
	
	$.ajax({
		url : url,
		type : "get",
		success : function(result) {
			
			$json = JSON.parse(result);
			
			for (i in $json){
				var options = options + "<option value='"+$json[i].index+"'>"+$json[i].name+"</option>";
			}
			$("#delete_due_fee_multiple_students").html(options);
			
	        var d = $('#delete_due_fee_multiple_students').bootstrapDualListbox({
	          nonSelectedListLabel: 'Available',
	          selectedListLabel: 'Selected',
	          preserveSelectionOnMove: 'moved',
	          moveOnSelect: false,
	          nonSelectedFilter: ''
	        });
	        d.bootstrapDualListbox('refresh', true);
	        $('#delete_due_fee_students_container').slideDown();
		}
	});
	

}







function show_home_page_controles() {
	$(".home_page_contents").slideDown();
}
function hide_home_page_controles() {
	$(".home_page_contents").slideUp();
}

function toggle_home_page_controles() {

	$("#contactUsFormContainer").slideUp();
	
	if ($("#page_type").val() == "1") {// 1 is for home page.
		show_home_page_controles();
	} else {
		hide_home_page_controles();
	}
	
	if ($("#page_type").val() == "4") {// 4 is for Contact us Form.
		$("#contactUsFormContainer").slideDown();
	}

}

function toggleDomainControles() {

	$("#domain_container").slideUp();
	$("#subdomain_container").slideUp();

	if ($("#domain_type").val() == "freesubdomain") {
		$("#subdomain_container").slideDown();
	}
	if ($("#domain_type").val() == "domain") {
		$("#domain_container").slideDown();
	}

}

function checkDmainAvailability() {
	 
	$requestedDomain ="";
	$domainType = $("#domain_type").val();
	if ($("#domain_type").val() == "freesubdomain") {
		$requestedDomain = $("#subdomain").val();
	}
	if ($("#domain_type").val() == "domain") {
		$requestedDomain = $("#domain").val();
	}
	
	clear_app_error_and_messages();
	
	var form_data = new FormData();
	form_data.append("requestedDomain", $requestedDomain);
	form_data.append("domainType", $domainType);
	var url = site_url +  "website/isDomainAvailable";
	$.ajax({
		url : url,
		type : "post",
		cache:false,
	    processData:false,
	    contentType:false,
		data : form_data,
		success : function(result) {
			
			var json = jQuery.parseJSON(result);
			$server_message = "<ul  class='custom_ul'><li>"+json.message+"</li></ul>";
			if(json.status == "success"){
				if ($("#domain_type").val() == "freesubdomain") {
					$("#subdomain_validity_status").html('<span class="glyphicon glyphicon-ok-circle text-success" style="font-size:28px" ></span>');
				}
				if ($("#domain_type").val() == "domain") {
					$("#domain_validity_status").html('<span class="glyphicon glyphicon-ok-circle text-success" style="font-size:28px" ></span>');
				}
				$("#appMessages .message_container").append($server_message);
			}else{
				if ($("#domain_type").val() == "freesubdomain") {
					$("#subdomain_validity_status").html('<span class="glyphicon glyphicon-remove-circle text-danger" style="font-size:28px" ></span>');
				}
				if ($("#domain_type").val() == "domain") {
					$("#domain_validity_status").html('<span class="glyphicon glyphicon-remove-circle text-danger" style="font-size:28px" ></span>');
				}
				$("#appErrors .message_container").append($server_message);
			}
			
			
			show_app_error_and_messages();
		},
		error: function(result){
			$("#"+preview_container_id).html("");
			$("#appErrors .custom_ul").html("Error Occured. Please Re-login and try again.");
			show_app_error_and_messages();
			
		}
		
	});
	
	
	
}
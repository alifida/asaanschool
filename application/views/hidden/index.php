<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/common_include_head'); ?>
</head>
<body>
<form method="post" name="testP" id="testP">
<input type="text" id="path" name="path"/>
<input type="button" onclick="loaddata();" value="click me"/>
</form>

<?php $this->load->view('common/common_include_body'); ?>
	<script type="text/javascript">
function loaddata(){
	$data = $('#testP').serialize();
	$.ajaxSetup({
		 url: '/hidden/proxy',
		 contentType:"application/x-www-form-urlencoded",
		 type:"POST",
		 data: $data,
		 cache:false,
		 dataType:"json",
		});

		$.ajax({
		 data: $data ,
		 success:function(data) {
		  if(data.response[0].answer === 'true') {
		   loggedin = true;
		   isAdmin = data.response[0].isAdmin;
		   if(isAdmin) {
		    loadJS("admintools.js");
		   }
		   fullName = data.response[0].userFullName;
		  }
		 }      
		});
}
	</script>
</body>
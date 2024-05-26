<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php $this->load->view('common/common_include_head'); ?>
</head>
<body class="skin-blue">
<?php $this->load->view('common/nav_top'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
		<?php $this->load->view('common/nav_left_side'); ?>
			<aside class="right-side">
                <?php echo $body; ?>
				<?php $this->load->view('common/server_messages'); ?>
            </aside>
		</div>
<?php $this->load->view('common/global_modal'); ?>
<?php $this->load->view('common/common_include_body'); ?>
<?php $this->load->view('common/common_include_rich_editor'); ?>
<script>
	   /*  $(document).ready(function(){
		    $.ajax({
				url : 'http://ipinfo.io',
				type : "get",
				dataType: 'jsonp',
				success : function(result) {
					 document.cookie = "SL_COUNTRY="+result.country;
				}
			});
		}); */
	    </script>
</body>
</html>
















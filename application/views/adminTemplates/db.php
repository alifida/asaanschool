<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php $this->load->view('common/common_include_head'); ?>
</head>
<body class="skin-blue">
<?php $this->load->view('common/nav_top'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
        	<aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
				<?php $this->load->view('dbtool/left_menu'); ?>
				</section>
			</aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" id="content_area" >
                <?php echo $body; ?>
				<?php $this->load->view('common/server_messages'); ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


<!--  GLOBAL MODAL CONTAINER STARTS -->
<?php $this->load->view('common/global_modal'); ?>
<!--  GLOBAL MODAL CONTAINER ENDS -->

	<!--  Application Errors area   -->
<?php $this->load->view('common/common_include_body'); ?>


</body>
</html>














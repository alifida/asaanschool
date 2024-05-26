

<div class="footer text-center">
2015 Asaanschool Technologies. All Rights Reserved. Terms & Privacy
</div>

 
 
 
 
 
 
 	
        <script src="<?= base_url() ?>public/js/bootstrap.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>public/js/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?= base_url() ?>public/js/plugins/morris/morris.js"></script>
        
         
        
        <script src="<?= base_url() ?>public/js/plugins/morris/raphael.min.js"></script>
        <!-- Sparkline -->
        <script src="<?= base_url() ?>public/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?= base_url() ?>public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= base_url() ?>public/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?= base_url() ?>public/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?= base_url() ?>public/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= base_url() ?>public/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck 
        <script src="<?= base_url() ?>public/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        -->

        <!-- AdminLTE App
         -->
        <script src="<?= base_url() ?>public/js/app.js" type="text/javascript"></script>


      
      

 
<!-- jQuery Version 1.11.0 -->

<!-- Bootstrap Core JavaScript -->

<!-- Metis Menu Plugin JavaScript -->


<!-- DataTables JavaScript -->
<script src="<?= base_url() ?>public/js/plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>public/js/plugins/dataTables/dataTables.responsive.min.js"></script>

 
 
 <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js" type="text/javascript"></script>
 
 
 

<script src="<?= base_url() ?>public/js/moment.js"></script>
<script src="<?= base_url() ?>public/js/bootstrap-datetimepicker.js"></script>







<!--  TOken Input -->
<script src="<?= base_url() ?>public/js/plugins/tokeninput/jquery.tokeninput.js"></script>
<script src="<?= base_url() ?>public/js/bootstrapValidator.js?v=<?= get_app_message("release.version")?>"></script>


<!-- Multiple Select -->
<script src="<?= base_url() ?>public/js/plugins/multiple_select/jquery.bootstrap-duallistbox.js"></script>
<script src="<?= base_url() ?>public/js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
<script src="<?= base_url() ?>public/js/plugins/nestable/jquery.nestable.js"></script>


<?php 
if(isset($_SESSION["print_student_transaction"]) && !empty($_SESSION["print_student_transaction"])){ ?>
 <script>
	 var url ='<?= base_url()."report/student_payment_receipt/".encodeID($_SESSION["print_student_transaction"]) ?>';
	 	var win = window.open(url, '_self');
	  win.focus();
 </script>
<?php 
unset($_SESSION["print_student_transaction"]);
} ?>
<?php 
if(isset($_SESSION["print_student_transactions"]) && !empty($_SESSION["print_student_transactions"])){ ?>
 <script>
	 var url ='<?= base_url()."report/bulk_student_payment_receipt/".$_SESSION["print_student_transactions"] ?>';
	 	var win = window.open(url, '_self');
	  win.focus();
 </script>
<?php 
unset($_SESSION["print_student_transactions"]);
} ?>





<!-- 
	<div class="loading-spinner" style="width: 500px; margin-left: -100px;">
       <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning " style="width: 100%;"></div>
        </div>
    </div>
 -->


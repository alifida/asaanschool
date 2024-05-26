
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard<small>Control box</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">

	<?php $this->load->view('dashboard/guardian/widgets'); ?>

	<!-- Main row -->
	<div class="row">
		<div class="col-lg-12">
			<?php $this->load->view('dashboard/guardian/charts'); ?>
		</div>
	</div>
<div class="row">
	<?php $this->load->view('dashboard/guardian/notifications'); ?>
</div>

</section>
<!-- /.content -->


<script type="text/javascript">



$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
    //jQuery UI sortable for the todo list
    $(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    ;

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    $('.daterange').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                startDate: moment().subtract('days', 29),
                endDate: moment()
            },
    function(start, end) {
        alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    /* jQueryKnob */
    $(".knob").knob();



    

    //The Calender
    $("#calendar").datepicker();

     
    /* The todo list plugin */
    $(".todo-list").todolist({
        onCheck: function(ele) {
            //console.log("The element has been checked")
        },
        onUncheck: function(ele) {
            //console.log("The element has been unchecked")
        }
    });

});

</script>


</body>
</html>












































<!-- 
 < ? = //isset($profitChartJSON)?$profitChartJSON:""?>
 -->



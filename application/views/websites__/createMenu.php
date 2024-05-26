<?php ?>
<section class="content-header">
<h1>Website Configuration</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12">
	<?php $this->load->view('websites/menuForm'); ?>
	</div>


</div>
<!-- /.row --> </section>

<script>

$(document).ready(function()
{

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    $('#menuItems').nestable({
        group: 1
    })
    .on('change', updateOutput);
    updateOutput($('#menuItems').data('output', $('#menuSortOrder')));

});
</script>

<?php ?>
<div class="modal fade " id="global_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"  onclick="onModelCloseBtn();">x</button>
            <h4 class="modal-title" id="global_modal_label"></h4>
            </div>
            <div class="modal-body" id="global_modal_body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="onModelCloseBtn();">Close</button>
        	</div>
    	</div>
  	</div>
</div>
<div class="modal fade " id="local_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="local_modal_label"></h4>
            </div>
            <div class="modal-body" id="local_modal_body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
    	</div>
  	</div>
</div>
<div class="modal fade " id="global_image_lighbox" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"  onclick="onModelCloseBtn();">x</button>
            <h4 class="modal-title" id="global_image_lighbox_title"></h4>
            </div>
            <div class="modal-body" id="global_image_lighbox_body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="onModelCloseBtn();">Close</button>
        	</div>
    	</div>
  	</div>
</div>

	<div class="modal fade " id="ajax_loader_wrapper" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="outer">
			<div class="middle">
				<div class="inner">
		            <div class="col-centered">
						<img src="<?= site_url("public/images/loader_gif.gif")?>" class="img-circle circle_border"/>
					</div>
				</div>
			</div>
		</div>
	</div>
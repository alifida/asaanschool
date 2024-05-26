<?php  ?>
<section class="content-header">
	<h1>Webpage</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
<?php $itemIds =""; ?>
<br />
			<script>
	var itemCount = 0;
</script>
			<div class="box box-primary wow zoomInUp">

				<div class="box-header">
					Slider
					<div class="pull-right ">
						<div class="btn-group  col-centered">
							<button type="button" onclick="getNewSliderItem();" class="btn btn-raised  btn-danger btn-raised  btn-xs ">New Slide</button>
						</div>
					</div>
				</div>
				<div class="box-body">

					<div class="row">

						<div class="col-lg-12 col-md-12  col-sm-12  col-xs-12 col-centered">
							<form class="" action="<?= site_url("website/saveSlider")?>" method="post">
								<fieldset>
									<!-- Text input-->
									<div class="form-group">
										<label class="col-md-12 control-label pull-left" for="name">Name</label>
										<div class="col-md-12">
											<input value="<?= isset($slider["name"])?$slider["name"]:"" ?>" id="name" name="name" type="text" class="form-control input-md  " required="">
										</div>
									</div>
									<div id="slider_wrapper">
										<?php
										$itemIdsArray = array ();
										if (isset ( $slider ["slides"] ) && ! empty ( $slider ["slides"] )) {
											?>
											<script>
												itemCount = <?= sizeof($slider["slides"]) ?>;
											</script>
											<?php
											
											foreach ( $slider ["slides"] as $key => $item ) {
												$itemIdsArray [] = $key+1;
												$data ["item"] = $item;
												$data ['itemId'] = $key+1;
												?>
												<div class="form-group">
													<?php $this->load->view('websites/slider/item_form', $data); ?>
												</div>
											<?php } ?>
										<?php
											$itemIds = implode ( ",", $itemIdsArray );
										}
										?>
						</div>
									<!-- Button -->
									<div class="form-group">
										<div class="col-md-12  ">
											<br /> <input type="hidden" name="id" value="<?= isset($slider["id"])?$slider["id"]:"" ?>" /> <input type="hidden" name="itemIds" id="itemIds" value="<?= $itemIds ?>" />
											<button id="submit" name="submit" class="btn btn-danger btn-raised  ">Save</button>
										</div>
									</div>

								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="slideItemReferenceHTML" style="visibility: hidden; display: none;">
	<?php
	
	$ref = array ();
	$ref ["itemId"] = "";
	$ref ["item"] ["title"] = "";
	$ref ["item"] ["text"] = "";
	$ref ["item"] ["thumbnail"] = "";
	
	$this->load->view ( 'websites/slider/item_form', $ref );
	?>
</div>

<script>


function getNewSliderItem(){
	itemCount++;
	$itemIds = $("#itemIds").val();
	if($itemIds!=""){
		$itemIds = $itemIds+",";
	}
	$itemIds = $itemIds+itemCount;
	$("#itemIds").val($itemIds);
	$itemHTML = $("#slideItemReferenceHTML").html();
	$postFix = "___"+itemCount;
	$itemHTML = $itemHTML.replace(/___/g, $postFix);
	$itemHTML = $itemHTML.replace("removeSlideItem('", "removeSlideItem('"+itemCount);
	$("#slider_wrapper").append($itemHTML);
	
}

function removeSlideItem(slideId){
	console.log(slideId);
	$itemIds = $("#itemIds").val();
	
	var idsArray = $itemIds.split(',');
	var index = idsArray.indexOf(slideId);
	if (index > -1) {
		idsArray.splice(index, 1);
	}
	$itemIds = idsArray.join();
	$("#itemIds").val($itemIds);


	
	$("#slide_wrapper___"+slideId).remove();
}


</script>


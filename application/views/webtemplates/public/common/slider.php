<?php //pre($slider);?>

<div class="card">
	<div id="slider_<?= $slider["id"]?>" class="ms-carousel carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php foreach ($slider["slides"] as $key=> $slide){?>
				<li data-target="#slider_<?= $slider["id"]?>" data-slide-to="<?= $key ?>" class=""></li>
			<?php }?>
		</ol>
		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<?php foreach ($slider["slides"] as $key=> $slide){?>
				<div class="item <?= $key == 0?' active ':''?>">
					<img src="<?= $slide['thumbnail']?>" alt="slide_<?= $key ?>">
					<div class="carousel-caption">
						<h3><?= $slide['title']?></h3>
						<p><?= $slide['text']?></p>
					</div>
				</div>
			<?php } ?>
		</div>
		<!-- Controls -->
		<a href="#slider_<?= $slider["id"]?>" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary left carousel-control" role="button" data-slide="prev"> <i class="zmdi zmdi-chevron-left"></i>
		</a> <a href="#slider_<?= $slider["id"]?>" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary right carousel-control" role="button" data-slide="next"> <i class="zmdi zmdi-chevron-right"></i>
			<div class="ripple-container"></div></a>
	</div>
</div>

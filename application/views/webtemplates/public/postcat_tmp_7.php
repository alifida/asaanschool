<?php 
$animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}
foreach ($postsWrapper["posts"]  as $post) { ?>
	<div class="card wow <?= $animationClass ?>" style="visibility: visible; animation-name: <?= $animationClass ?>;">
		<div class="card-block">
			<div class="row">
			<?php $col = 'col-lg-12 col-md-12 col-sm-12 col-xs-12'; ?>
			<?php if(isset($post['thumbnail_path']) && !empty($post['thumbnail_path'])){?>
				<?php $col = 'col-lg-8 col-md-8 col-sm-12 col-xs-12'; ?>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<img src="<?= $post['thumbnail_path'] ?>" alt="" class="img-responsive mb-4" style="max-width: 340px; margin-top: 10px;"	>
				</div>
			<?php } ?>
				<div class="<?= $col ?>">
					<a href="<?= site_url('site/post/'.seoUrl($post['title'])."/".encodeID($post["post_id"])."/1")?>" class="btn btn-info btn-raised btn-block animate-icon"><?= $post['title'] ?><i class="ml-1 no-mr zmdi zmdi-long-arrow-right"></i>
						<div class="ripple-container"></div>
					</a>
					<?= $post['html'] ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
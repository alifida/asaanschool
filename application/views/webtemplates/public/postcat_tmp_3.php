<?php $animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}
?>
<div class="card wow <?= $animationClass ?>" style="visibility: visible; animation-name: <?= $animationClass ?>;">
	<div class="card-block">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="no-mt">
					<?php $pcURL ="" ;
					//seoUrl($cat["name"])."/". encodeID($cat ["id"])
					$pcURL = site_url('site/pc/'.seoUrl($postsWrapper["category"]["name"])."/". encodeID($postsWrapper["category"] ["id"]).'/'.$postsWrapper['post_template'].'/1')
				?>
					<a href="<?= $pcURL ?>"><?= $postsWrapper["category"]["name"] ?></a>
				</h3>
			</div>
		</div>
		<div class="row">
		<?php foreach ($postsWrapper["posts"]  as $post) {  ?>
			<div class="col-sm-6 mb-2">
				<div class="ms-thumbnail-container">
					<figure class="ms-thumbnail ms-thumbnail-horizontal ms-thumbnail-light">
						<?php if(isset($post['thumbnail_path']) && !empty($post['thumbnail_path'])){ ?>
							<img src="<?= $post['thumbnail_path'] ?>" alt="" class="img-responsive" style="width:330px; height: 250px;">
						<?php } ?>
						<figcaption class="ms-thumbnail-caption text-center">
							<div class="ms-thumbnail-caption-content">
								<h3 class="ms-thumbnail-caption-title color-info"><?= trimRightString($post['title'],15) ?></h3>
								<?=  trimRightString(strip_tags($post['html']), 80) ?>
								<br/>
								<a href="<?= site_url('site/post/'.seoUrl($post['title'])."/".encodeID($post["post_id"])."/".$postsWrapper["post_template"])?>" class="btn btn-info btn-raised"> <i class="zmdi zmdi-eye"></i> Detail
								</a>
							</div>
						</figcaption>
					</figure>
				</div>
			</div>
			<?php } ?>
			
		</div>
	</div>
</div>

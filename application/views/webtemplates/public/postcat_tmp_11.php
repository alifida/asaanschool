<?php 
$animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}?>
<?php if(isset($postsWrapper["posts"]) && !empty($postsWrapper["posts"])){?>
<?php foreach ($postsWrapper["posts"]  as $post) {  ?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<div class="card wow <?= $animationClass?>" style="visibility: visible; animation-name: <?= $animationClass?>;">
	<div class="ms-hero-bg-info ms-hero-img-coffee">
		<a href="<?= site_url('site/post/'.seoUrl($post['title'])."/".encodeID($post["post_id"])."/2")?>"><h3 class="color-white index-1 text-center no-m pt-4"><?= $post['title'] ?></h3></a>
		<?php if(isset($post['thumbnail_path']) && !empty($post['thumbnail_path'])){ ?>
			<a href="<?= site_url('site/post/'.seoUrl($post['title'])."/".encodeID($post["post_id"])."/2") ?>"><img src="<?= $post['thumbnail_path'] ?>" alt="..." class="img-avatar-circle"></a>
		<?php } ?>
	</div>
	<div class="card-block pt-4 text-center">
		<?= trimRightString(strip_tags($post['html']), 400)?>
	</div>
</div>
</div>
<?php } ?>
<?php } ?>


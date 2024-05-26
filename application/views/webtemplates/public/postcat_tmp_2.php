<?php 
$animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}
foreach ($postsWrapper["posts"]  as $post) { 

	?>
<div class="card wow <?= $animationClass?>" style="visibility: visible; animation-name: <?= $animationClass?>;">
	<div class="ms-hero-bg-info ms-hero-img-coffee">
		<a href="<?= site_url('site/post/'.seoUrl($post['title'])."/".encodeID($post["post_id"])."/".$postsWrapper["post_template"])?>"><h3 class="color-white index-1 text-center no-m pt-4"><?= $post['title'] ?></h3></a>
		<?php if(isset($post['thumbnail_path']) && !empty($post['thumbnail_path'])){ ?>
			<a href="<?= site_url('site/post/'.seoUrl($post['title'])."/".encodeID($post["post_id"])."/".$postsWrapper["post_template"])?>"><img src="<?= $post['thumbnail_path'] ?>" alt="..." class="img-avatar-circle"></a>
		<?php } ?>
	</div>
	<div class="card-block pt-4 text-center">
		<?= trimRightString(strip_tags($post['html']), 400)?>
	</div>
</div>
<?php } ?>


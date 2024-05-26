<?php $animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}
?>

<?php $pcURL = site_url('site/pc/'.seoUrl($postsWrapper["category"]["name"])."/". encodeID($postsWrapper["category"] ["id"]).'/'.$postsWrapper['post_template'].'/1'); ?>
<div class="card wow <?= $animationClass ?>">
	<div class="list-group">
		<a href="<?= $pcURL ?>" class="list-group-item withripple active"><?= $postsWrapper["category"]["name"] ?>
			<div class="ripple-container"></div>
		</a> 
		<?php foreach ($postsWrapper["posts"]  as $post) {  ?>
		<a href="<?= site_url('site/post/'.trimRightString(seoUrl($post['title']),10)."/".encodeID($post["post_id"])."/1")?>" class="list-group-item withripple"> <?= trimRightString($post["title"],45) ?>
			<div class="ripple-container"></div>
		</a> 
		<?php }?>
	</div>
</div>

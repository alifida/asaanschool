<?php $animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}
?>

<?php $pcURL = site_url('site/pc/'.seoUrl($postsWrapper["category"]["name"])."/". encodeID($postsWrapper["category"] ["id"]).'/'.$postsWrapper['post_template'].'/1'); ?>
<div class=" wow <?= $animationClass ?>">
	<div class="">
		<a href="<?= $pcURL ?>" class="btn btn-info btn-raised btn-block animate-icon"><?= $postsWrapper["category"]["name"] ?><i class="ml-1 no-mr zmdi zmdi-long-arrow-right"></i>
			<div class="ripple-container"></div>
		</a>
		<ul >
		<?php foreach ($postsWrapper["posts"]  as $post) {  ?>
		<li>
			<a href="<?= site_url('site/post/'.trimRightString(seoUrl($post['title']),10)."/".encodeID($post["post_id"])."/1")?>" class=""  > <?= trimRightString($post["title"],45) ?>
				<div class="ripple-container"></div>
			</a>
		</li> 
		<?php }?>
		</ul>
	</div>
</div>

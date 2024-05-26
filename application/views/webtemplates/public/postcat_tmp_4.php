<?php 
$animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}
	$uniId = getUniqueString();
?>
<div class="card wow <?= $animationClass ?>">
	<div class="card-block">
		<div class="row">
			<div class="col-lg-12 text-left">
			<?php $pcURL = site_url('site/pc/'.seoUrl($postsWrapper["category"]["name"])."/". encodeID($postsWrapper["category"] ["id"]).'/'.$postsWrapper['post_template'].'/1'); ?>
				<a href="<?= $pcURL ?>" class="btn btn-info btn-raised btn-block animate-icon"><?= $postsWrapper["category"]["name"] ?><i class="ml-1 no-mr zmdi zmdi-long-arrow-right"></i>
					
					<ol class="carousel-indicators" style="width: 420px; float:right;top:11px;">
						<?php $counter =0; ?>
						<?php for($i=0;$i < sizeof($postsWrapper["posts"]); $i+=4){?>
							<li data-target="#<?= $uniId ?>" data-slide-to="<?= $counter ?>" class=""></li>
						<?php 
							$counter++;
							}
						?>
						
					</ol>
				</a>
			</div>
		</div>
		<div id="<?= $uniId ?>" class="ms-carousel carousel slide" data-ride="carousel">
			
			<div class="carousel-inner" role="listbox">
				<?php $today = getCurrentDate(); ?>
				<?php for($i=0;$i < sizeof($postsWrapper["posts"]); $i+=4){?>
					<div class="item <?= $i==0?'active':'' ?>">
						<?php if(isset($postsWrapper['posts'][$i])){
							$post = $postsWrapper["posts"][$i];
							?>
							<p>
							<?php if(getDateDifference($post['publish_at'], $today) < 8){?>
								<div class="pull-right" style="">
									<img  alt="latest" src="<?= site_url('public/images/new-animated.gif')?>" >
								</div>
							<?php } ?>
							
							<a href="<?= site_url('site/post/'.trimRightString(seoUrl($post['title']),10)."/".encodeID($post["post_id"])."/".$postsWrapper["post_template"])?>"><?=  trimRightString($post["title"] , 100)?></a>
							<span class="label label-default pull-right" style="background-color: #607d8b;color: #fff; margin:10px "><?= $post['publish_at']?></span>
							</p>
							
							<hr class="color dotted">
						<?php } ?>
						<?php if(isset($postsWrapper['posts'][$i+2])){
							$post = $postsWrapper["posts"][$i+2];
							?>
							<p><a href="<?= site_url('site/post/'.trimRightString(seoUrl($post['title']),10)."/".encodeID($post["post_id"])."/".$postsWrapper["post_template"])?>"><?=  trimRightString($post["title"] , 100)?></a>
							<span class="label label-default pull-right" style="background-color: #607d8b;color: #fff; margin:10px "><?= $post['publish_at']?></span>
							</p>
							
							<hr class="color dotted">
						<?php } ?>
						<?php if(isset($postsWrapper['posts'][$i+3])){
							$post = $postsWrapper["posts"][$i+3];
							?>
							<p><a href="<?= site_url('site/post/'.trimRightString(seoUrl($post['title']),10)."/".encodeID($post["post_id"])."/".$postsWrapper["post_template"])?>"><?=  trimRightString($post["title"] , 100)?></a>
							<span class="label label-default pull-right" style="background-color: #607d8b;color: #fff; margin:10px "><?= $post['publish_at']?></span>
							</p>
							<hr class="color dotted">
						<?php } ?>
						<?php if(isset($postsWrapper['posts'][$i+4])){
							$post = $postsWrapper["posts"][$i+4];
							?>
							<p><a href="<?= site_url('site/post/'.trimRightString(seoUrl($post['title']),10)."/".encodeID($post["post_id"])."/".$postsWrapper["post_template"])?>"><?=  trimRightString($post["title"] , 100)?></a>
							<span class="label label-default pull-right" style="background-color: #607d8b;color: #fff; margin:10px "><?= $post['publish_at']?></span>
							</p>
						<?php } ?>
						
					</div>
				<?php }?>
				
				

			</div>
			<a href="#<?= $uniId ?>" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-info left carousel-control" role="button" data-slide="prev"> <i class="zmdi zmdi-chevron-left"></i></a> 
			<a href="#<?= $uniId ?>" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-info right carousel-control" role="button" data-slide="next"> <i class="zmdi zmdi-chevron-right"></i>
				<div class="ripple-container"></div>
			</a>
		</div>


	</div>
</div>

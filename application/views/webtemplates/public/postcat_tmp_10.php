<?php $animationClass = " zoomInUp ";
if(isset($postsWrapper["animationClass"])){
	$animationClass = $postsWrapper["animationClass"];
}

$elemId = "post_slid_id_".$postsWrapper["category"] ["id"];
?>

<?php $pcURL = site_url('site/pc/'.seoUrl($postsWrapper["category"]["name"])."/". encodeID($postsWrapper["category"] ["id"]).'/'.$postsWrapper['post_template'].'/1'); ?>

			<div class="card card-info-inverse wow <?= $animationClass ?>">
                        <div class="card-header">
                          <h3 class="card-title">
                            <a href="<?= $pcURL ?>" class="btn btn-info btn-raised btn-block animate-icon"><i class="zmdi zmdi-graduation-cap"></i><?= $postsWrapper["category"]["name"] ?>
								<div class="ripple-container"></div>
							</a>
                          </h3>
                        </div>
                        <div id="<?= $elemId ?>" class="ms-carousel carousel slide" data-ride="carousel">
                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">
                           <?php foreach ($postsWrapper["posts"]  as $key=> $post) {  ?>
                           
                           
                           <?php if(isset($post['thumbnail_path']) && !empty($post['thumbnail_path'])){?>
							<div class="item <?= $key==0?' active ':''?>">
                              <img src="<?= $post['thumbnail_path'] ?>" alt="..."> 
                            </div>
							<?php }?>
                           
                           
                            <?php } ?>
                          </div>
                          <!-- Controls -->
                          <a href="#<?= $elemId ?>" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-info left carousel-control" role="button" data-slide="prev">
                            <i class="zmdi zmdi-chevron-left"></i>
                          </a>
                          <a href="#<?= $elemId ?>" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-info right carousel-control" role="button" data-slide="next">
                            <i class="zmdi zmdi-chevron-right"></i>
                          </a>
                        </div>
                        <div class="card-block text-center">
							<?= $postsWrapper["category"]["description"] ?>
                        </div>
                      </div>
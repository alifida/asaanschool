
<div class="col-md-12">
	<br />
	<article class="card card-info wow zoomInRight animation-delay-5 mb-4" style="visibility: visible; animation-name: zoomInRight;">
			<div class="card-block card-block-big">
				<div class="row">
				 	<h3 class="no-mt">
						<a href="javascript:void(0)"><?= isset($post['title'])?$post['title']:"ERROR 404"?></a>
					</h3>
                  	 <?php if(isset($post['thumbnail_path']) && !empty($post['thumbnail_path'])){ ?>
		                   <img src="<?= $post['thumbnail_path'] ?>" alt="..." class="img-responsive mb-4 text-center"  style="float: left; margin: 0 50px 0 15px; max-width: 97%;">
		             <?php } ?>
                   
                   <?= isset($post['html'])?$post['html']:""?>
                  </div>
			</div>

	</article>
</div>


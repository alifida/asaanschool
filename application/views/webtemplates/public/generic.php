<?php  pre($page);?>


	<?php
	$animationClass = " fadeInLeft ";
	if ($page ["layout"] == get_app_message ( "db.website.template.layout.1" )) {
		$layoutCss = " col-lg-12 col-md-12 col-sm-12 col-xs-12 ";
	}
	?>

<div class="row">
	<div class="<?= $layoutCss ?>">
		<div class="card wow  <?= $animationClass?>" style="visibility: visible; animation-name: <?= $animationClass?>;">
			<div class="card-block">
				<h2 class="color-primary"><?= $page['page_title'] ?></h2>
				<?php echo $page['html']; ?>
			</div>
		</div>
	</div>
</div>

<?php if(isset($page['posts']) && !empty($page['posts'])){?>
	<div class="row">
		<?php foreach ($page['posts'] as $post) {
			$postData = array();
			$postData["animationClass"] = $animationClass;
			$postData["post"] = $post;
			?>
				<?php $this->load->view('webtemplates/public/post_1',$postData); ?>	
		<?php }?>
	</div>
<?php }?>








<?php  	 
  ?>

	<?php

	$animationClass = " fadeInLeft ";
	$col_1_css = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	$col_2_css = "";
	$col_3_css = "";
	if(!isset($page ["layout"])){
		echo "layout not set.";
		die;
	}
	if ($page ["layout"] == get_app_message ( "db.website.template.layout.1" )) {
		$col_1_css = " col-lg-12 col-md-12 col-sm-12 col-xs-12 ";
	} elseif ($page ["layout"] == get_app_message ( "db.website.template.layout.2" )) {
		$col_1_css = " col-lg-8 col-md-8 col-sm-12 col-xs-12 ";
		$col_2_css = " col-lg-4 col-md-4 col-sm-12 col-xs-12 ";
	} elseif ($page ["layout"] == get_app_message ( "db.website.template.layout.3" )) {
		$col_1_css = " col-lg-6 col-md-6 col-sm-12 col-xs-12 ";
		$col_2_css = " col-lg-6 col-md-6 col-sm-12 col-xs-12 ";
	} elseif ($page ["layout"] == get_app_message ( "db.website.template.layout.4" )) {
		$col_1_css = " col-lg-6 col-md-6 col-sm-12 col-xs-12 ";
		$col_2_css = " col-lg-3 col-md-3 col-sm-12 col-xs-12 ";
		$col_3_css = " col-lg-3 col-md-3 col-sm-12 col-xs-12 ";
	} elseif ($page ["layout"] == get_app_message ( "db.website.template.layout.5" )) {
		$col_1_css = " col-lg-4 col-md-4 col-sm-12 col-xs-12 ";
		$col_2_css = " col-lg-4 col-md-4 col-sm-12 col-xs-12 ";
		$col_3_css = " col-lg-4 col-md-4 col-sm-12 col-xs-12 ";
	}
	?>
<div class="row">
	<?php if(!empty($page['html']) ||  (isset ( $page ['col_1'] ) && ! empty ( $page ['col_1'] )) ){?>
		<div class="<?= $col_1_css ?>">
		<?php if(!empty($page['html']) ){?>
			<div class="card wow  <?= $animationClass?>" style="visibility: visible; animation-name: <?= $animationClass?>;">
				<div class="card-block">
					<h2 class="color-primary"><?= $page['page_title'] ?></h2>
					<?php echo $page['html']; ?>
				</div>
			</div>
		<?php } ?>
		<?php
		 
		if (isset ( $page ['col_1'] ) && ! empty ( $page ['col_1'] )) {
			$animationClass = " zoomInUp ";
				foreach ( $page ["col_1"] as $postsWrapper ) {
					
					if($animationClass == " zoomInUp "){
						$animationClass = " fadeInLeft ";
					}else{
						$animationClass = " zoomInUp ";
					}
					$postsWrapper ["animationClass"] = $animationClass;
					$this->load->view ( 'webtemplates/public/postcat_tmp_'.$postsWrapper ["post_template"], array ("postsWrapper" => $postsWrapper) );
				}

		}
			?>
			
		</div>
	<?php }?>
	<?php if(isset ( $page ['col_2'] ) && ! empty ( $page ['col_2'] ) ){?>
	
		<div class="<?= $col_2_css ?>">
			<?php
			$animationClass = " fadeInRight ";
				foreach ( $page ["col_2"] as $postsWrapper ) {
					if($animationClass == " zoomInUp "){
						$animationClass = " fadeInRight ";
					}else{
						$animationClass = " zoomInUp ";
					}
					$postsWrapper ["animationClass"] = $animationClass;
					$this->load->view ( 'webtemplates/public/postcat_tmp_'.$postsWrapper ["post_template"], array ("postsWrapper" => $postsWrapper) );
				}
			?>
		</div>
	<?php }?>
	
	<?php if(isset ( $page ['col_3'] ) && ! empty ( $page ['col_3'] ) ){?>
	
		<div class="<?= $col_3_css ?>">
			<?php
			$animationClass = " zoomInUp ";
				foreach ( $page ["col_3"] as $postsWrapper ) {
					if($animationClass == " zoomInUp "){
						$animationClass = " fadeInRight ";
					}else{
						$animationClass = " zoomInUp ";
					}
					$postsWrapper ["animationClass"] = $animationClass;
					$this->load->view ( 'webtemplates/public/postcat_tmp_'.$postsWrapper ["post_template"], array ("postsWrapper" => $postsWrapper) );
				}
			?>
		</div>
	<?php }?>
	
	
	
	
	
</div>
 













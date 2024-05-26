
        <div class="col-md-12">
          <div class="card mt-4 card-info wow zoomInUp animation-delay-7" style="visibility: visible; animation-name: zoomInUp;">
            <div class="ms-hero-bg-info ms-hero-img-city">
             <?php if(isset($post['thumbnail_path']) && !empty($post['thumbnail_path'])){ ?>
                   <img src="<?= $post['thumbnail_path'] ?>" alt="..." class="img-avatar-circle">
             <?php } ?>
            </div>
            <div class="card-block pt-6 text-center">
              <h3 class="color-info"><?= isset($post['title'])?$post['title']:"ERROR 404"?></h3>
              <?= isset($post['html'])?$post['html']:"ERROR 404"?>
              
            </div>
          </div>
        </div>
        
     
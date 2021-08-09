<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */

$this->title = 'ข่าวประชาสัมพันธ์';
\yii\web\YiiAsset::register($this);
?>
<div class="public-relations-view">
  <section class="bg-dark-overlay-4" style="background-image:url(../../themes/template/assets/images/blog/16by9/big/02.jpg); background-position: center left; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 py-md-5 my-lg-5">
          <a href="#" class="badge bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Travel</a>
          <a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Photography</a>
          <h1 class="text-white"><?= $model->topic ?></h1>
        </div>
      </div>
    </div>
  </section>
  <!-- =======================
Inner intro END -->

  <!-- =======================
Main START -->
  <section>
    <div class="container position-relative" data-sticky-container>
      <div class="row">
        <!-- Main Content START -->
        <div class="col-lg-9 mb-5">
          <p><span class="dropcap">I</span><?= $model->details ?></p>

          <!-- Divider -->
          <div class="text-center h5 mb-4">. . .</div>

          <!-- Images -->
          <div class="row g-2">
            <?php foreach ($modelImage as $modelImage) :  ?>
              <a href="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" data-glightbox data-gallery="image-popup">
                <img class="rounded" src="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" alt="Image">
              </a>
            <?php endforeach  ?>
          </div>



        </div>
        <!-- Main Content END -->
        <!-- Right sidebar START -->
        <div class="col-lg-3">
          <div data-sticky data-margin-top="80" data-sticky-for="991">
            <!-- Most read -->
            <div>
              <h5 class="mb-3">Related post </h5>
              <div class="tiny-slider dots-creative mt-3 mb-5">
                <div class="tiny-slider-inner" data-autoplay="false" data-hoverpause="true" data-gutter="0" data-arrow="false" data-dots="true" data-items="1">
                  <!-- Card item START -->
                  <div class="card">
                    <!-- Card img -->
                    <div class="position-relative">
                      <img class="card-img" src="../../themes/template/assets/images/blog/4by3/07.jpg" alt="Card image">
                      <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                        <!-- Card overlay Top -->
                        <div class="w-100 mb-auto d-flex justify-content-end">
                          <div class="text-end ms-auto">
                            <!-- Card format icon -->
                            <div class="icon-md bg-white-soft bg-blur text-white fw-bold rounded-circle" title="8.5 rating">8.5</div>
                          </div>
                        </div>
                        <!-- Card overlay bottom -->
                        <div class="w-100 mt-auto">
                          <a href="#" class="badge bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Marketing</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-0 pt-3">
                      <h5 class="card-title"><a href="post-single-5.html" class="btn-link text-reset fw-bold">7 common mistakes everyone makes while traveling</a></h5>
                    </div>
                  </div>
                  <!-- Card item END -->
                  <!-- Card item START -->
                  <div class="card">
                    <!-- Card img -->
                    <div class="position-relative">
                      <img class="card-img" src="../../themes/template/assets/images/blog/4by3/08.jpg" alt="Card image">
                      <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                        <!-- Card overlay bottom -->
                        <div class="w-100 mt-auto">
                          <a href="#" class="badge bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Sports</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-0 pt-3">
                      <h5 class="card-title"><a href="post-single-5.html" class="btn-link text-reset fw-bold">Skills that you can learn from business</a></h5>
                    </div>
                  </div>
                  <!-- Card item END -->
                  <!-- Card item START -->
                  <div class="card">
                    <!-- Card img -->
                    <div class="position-relative">
                      <img class="card-img" src="../../themes/template/assets/images/blog/4by3/09.jpg" alt="Card image">
                      <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                        <!-- Card overlay bottom -->
                        <div class="w-100 mt-auto">
                          <a href="#" class="badge bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Marketing</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-0 pt-3">
                      <h5 class="card-title"><a href="post-single-5.html" class="btn-link text-reset fw-bold">10 tell-tale signs you need to get a new business</a></h5>
                    </div>
                  </div>
                  <!-- Card item END -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Right sidebar END -->
      </div>
    </div>
  </section>
  <!-- =======================
Main END -->

</div>
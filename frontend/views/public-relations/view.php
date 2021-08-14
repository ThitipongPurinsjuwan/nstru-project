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
        <div class="col-lg-12 mb-5">
          <p><?= $model->details ?></p>

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
      </div>
    </div>
  </section>
  <!-- =======================
Main END -->

</div>
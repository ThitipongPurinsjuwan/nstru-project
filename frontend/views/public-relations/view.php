<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */

$this->title = 'ข่าวประชาสัมพันธ์';
\yii\web\YiiAsset::register($this);
?>
<div class="public-relations-view">

  <section class="hero py-6 py-lg-7 text-white dark-overlay"><img class="bg-image" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt="...">
    <div class="container overlay-content">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb text-white justify-content-center no-border mb-0">
        <li class="breadcrumb-item"><a href="index.html">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">ข่าวประชาสัมพันธ์ </li>
      </ol>
      <h1 class="hero-heading"><?= $model->topic ?></h1>
    </div>
  </section>


  <section class="py-6">
    <div class="container">

      <div class="row">
        <div class="col-xl-8 col-lg-10 mx-auto">
          <div class="text-content">
            <?= $model->details ?>
          </div>
        </div>
      </div>

      <div class="row my-5">
        <div class="col-xl-8 col-lg-10 mx-auto">


          <h3 class="mb-4">รูปภาพ</h3>
          <div class="row ms-n1 me-n1">

            <section class="position-relative pt-0">
              <div class="row filter-container overflow-hidden" data-isotope='{"layoutMode": "masonry"}'>

                <?php if (count($modelImage) > 0) :  ?>
                  <?php foreach ($modelImage as $modelImage) :  ?>
                    <!-- Card item START -->
                    <div class="col-lg-4 col-6 px-1 mb-2 grid-item">
                      <div class="card">
                        <!-- Card img -->
                        <div class="card-fold position-relative">
                          <a href="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" data-glightbox data-gallery="image-popup">
                            <img class="img-fluid" src="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" alt="...">
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- Card item END -->
                  <?php endforeach  ?>
                <?php endif ?>

              </div>
            </section>

          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<?php

use common\util\StringCustom;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PublicRelationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
  .img-knowing {
    height: 21em !important;
    width: 100% !important;
    object-fit: cover;
  }
</style>
<div class="banner">
  <div class="swiper-container my-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img class="" src="../assets/img/download/1.png" alt="..."></div>
      <div class="swiper-slide"><img class="" src="../assets/img/download/2.png" alt="..."></div>
      <div class="swiper-slide"><img class="" src="../assets/img/download/3.png" alt="..."></div>
      <!-- <div class="swiper-slide"><img class="" src="../assets/img/download/5.jpg" alt="..."></div> -->
    </div>
    <div class="swiper-button-next d-flex justify-content-center align-items-center"><i class="fas fa-chevron-left"></i></div>
    <div class="swiper-button-prev d-flex justify-content-center align-items-center"><i class="fas fa-chevron-right"></i></div>
    <div class="swiper-pagination"></div>
  </div>
</div>
<section class="py-6">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-8">
        <h2 class="underline "> <i class=" fas fa-bullhorn" style=color:mediumvioletred></i> ข้อควรรู้สำหรับนักท่องเที่ยว</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-12 item-box">

        <?php if (count($model) > 0) :  ?>
          <?php foreach ($model as $model) : ?>

            <!-- Card item START -->
            <div class="card shadow border-0 rounded-3 up-hover  mb-4 item-prop hover-animate">
              <div class="row g-3">

                <div class="col-lg-5 order-1 order-lg-0 p-4">
                  <!-- Title -->
                  <div class="card-body">
                    <h5 class="my-2">
                      <a class="text-dark" href="<?= \Yii::$app->getUrlManager()->createUrl(['public-relations/info-view', 'id' => $model->id]) ?>" class="btn-link text-reset stretched-link"> <?= $model->topic ?></a>
                    </h5>
                    <p class="text-gray-500 text-sm my-3"><i class="far fa-clock me-2"></i> <?= $model->date_imparting ?></p>
                    <p class="my-2 text-muted text-sm"><?= StringCustom::showLess($model->details) ?></p>
                    <a class="btn btn-link ps-0" href="post.html">Read more<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                  </div>
                </div>
                <!-- Image -->
                <div class="col-md-12 col-lg-7 order-0 order-lg-1">
                  <img class="img-fluid card-img-top img-knowing" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt="Card image">
                </div>

              </div>
            </div>
            <!-- Card item END -->

          <?php endforeach ?>
        <?php endif ?>

        <!-- Card item END -->
        <!-- Pagination START -->
        <nav class="my-5 d-flex justify-content-center" aria-label="navigation">
          <?= LinkPager::widget([
            'pagination' => $pages,
            'options' => [
              'class' => 'pagination pagination-bordered',
            ],
            'linkOptions' => ['class' => 'page-link'],
            'linkContainerOptions' => ['class' => 'page-item'],
            'nextPageLabel' => "next",
            'prevPageLabel' => "pre",
            // 'maxButtonCount' => 3,
          ]); ?>
        </nav>
        <!-- Pagination END -->
      </div>
    </div>

  </div>
</section>
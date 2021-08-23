<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PublicRelationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
  .img-knowing {
    height: 30em !important;
    width: 100% !important;
    object-fit: cover;
  }
</style>
<div class="public-relations-index">

  <section class="pt-0 card-grid">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="tiny-slider arrow-hover arrow-blur arrow-white arrow-round rounded-3 overflow-hidden">
            <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="0" data-arrow="true" data-dots="false" data-items="1">
              <!-- Slide 1 -->
              <div class="card card-overlay-bottom card-bg-scale h-400 h-sm-500 h-md-600 rounded-0" style="background-image:url(../../themes//template/assets/images/blog/16by9/04.jpg); background-position: center left; background-size: cover;">
                <!-- Card Image overlay -->
                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-5">
                  <div class="w-100 mt-auto">
                    <div class="col-md-10 col-lg-7">
                      <!-- Card category -->
                      <a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Trick</a>
                      <!-- Card title -->
                      <h2 class="text-white display-5"><a href="post-single-4.html" class="btn-link text-reset fw-normal">ข้อควรรู้สำหรับนักท่องเที่ยว</a></h2>
                      <!-- Card info -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- Row END -->
    </div>
  </section>

  <section class="pt-0">
    <div class="container">
      <div class="row">
        <div class="col-12 item-box">

          <?php foreach ($model as $model) : ?>
            <!-- Card item START -->
            <div class="card border rounded-3 up-hover p-4 mb-4 item-prop">
              <div class="row g-3">
                <div class="col-lg-5">
                  <!-- Title -->
                  <h2 class="card-title">
                    <a href="<?= \Yii::$app->getUrlManager()->createUrl(['public-relations/info-view', 'id' => $model->id]) ?>" class="btn-link text-reset stretched-link"> <?= $model->topic ?></a>
                  </h2>
                  <div class="d-flex align-items-center position-relative mt-3">
                    <p><?= $model->details ?></p>
                  </div>
                  <div class="d-flex mt-1">
                    <p><?= $model->date_imparting ?></p>
                  </div>
                </div>
                <!-- Image -->
                <div class="col-md-12 col-lg-7">
                  <img class="rounded-3 img-knowing" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt="Card image">
                </div>
              </div>
            </div>
            <!-- Card item END -->
          <?php endforeach ?>

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
</div>
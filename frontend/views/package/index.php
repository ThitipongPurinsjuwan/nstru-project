<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แพ็คเกจ';
?>
<div class="package-index">
  <?= $this->render('_search', ['model' => $searchModel, 'listOfDateMoment' => $listOfDateMoment]); ?>

  <section class="position-relative py-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <h2 class="underline "> แพ็คเกจแนะนำ <span class="head-title-custom">
              <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_jqenj9df.json" background="transparent" speed="1" style="width: 60px; height: 60px;" loop autoplay></lottie-player>
            </span></h2>

          <!-- <h2>Our guides</h2> -->
        </div>
      </div>
      <div class="col-12">
        <div class="row gy-4">
          <?php if (count($model) > 0) :  ?>
            <?php foreach ($model as $model) :  ?>
              <!-- Card item START -->
              <div class="col-lg-4 col-sm-6 mb-8 hover-animate">
                <div class="card shadow border-0 h-100">
                  <!-- Card img -->
                  <div class="position-relative">
                    <img class="img-fluid card-img-top" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt=" Card image">
                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                      <!-- Card overlay bottom -->
                    </div>
                  </div>
                  <!-- Card img -->
                  <div class="card-body d-flex align-items-center">
                    <div class="w-100">
                      <h6 class="card-title"><a class="text-decoration-none text-dark" href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $model->id]) ?>"><?= $model->name ?></a></h6>
                      <div class="d-flex card-subtitle mb-3">
                        <p class="flex-grow-1 mb-0 text-muted text-sm">ทัวร์ <?= $model->date_moment ?> วัน</p>
                      </div>
                      <p class="card-text text-muted"><span class="h4 text-primary">฿<?= $model->price ?></span> ต่อแพ็คเกจ</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card item END -->
            <?php endforeach  ?>
          <?php endif ?>

          <!-- Pagination START -->
          <div style="margin-top:100px">
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
          </div>
          <!-- Pagination END -->

        </div>
      </div>
    </div>
  </section>
</div>
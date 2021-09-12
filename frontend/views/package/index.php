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

  <section class="position-relative pt-0" style="margin-top: 50px">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">

          <h2 class="underline "> <i class=" fas fa-bullhorn" style=color:mediumvioletred></i> แพ็คเกจแนะนำ</h2>

          <!-- <h2>Our guides</h2> -->
        </div>
      </div>
      <div class="col-11">
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
                  <div class="card-body">
                    <h5 class="my-2"><a class="text-dark" <a href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $model->id]) ?>" class="btn-link text-reset fw-bold"><?= $model->name ?></a>
                    </h5>
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
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

  <h1><?= Html::encode($this->title) ?></h1>


  <section class="position-relative pt-0">
    <div class="row">
      <div class="col-12">
        <div class="row gy-4">
          <?php if (count($model) > 0) :  ?>
            <?php foreach ($model as $model) :  ?>
              <!-- Card item START -->
              <div class="col-sm-6 col-lg-4">
                <div class="card">
                  <!-- Card img -->
                  <div class="position-relative">
                    <img class="card-img img-md-box" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt=" Card image">
                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                      <!-- Card overlay bottom -->
                    </div>
                  </div>
                  <!-- Card img -->
                  <div class="card-body px-0 pt-3">
                    <h4 class="card-title">
                      <a href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $model->id]) ?>" class="btn-link text-reset fw-bold"><?= $model->name ?></a>
                    </h4>
                  </div>
                </div>
              </div>
              <!-- Card item END -->
            <?php endforeach  ?>
          <?php endif ?>

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
  </section>

</div>
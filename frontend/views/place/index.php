<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $nameOfType;
?>
<div class="place-index">
  <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

  <!-- Main Post START -->
  <div class="col-lg-12">
    <div class="row gy-4">

      <?php foreach ($model as $model) :  ?>
        <!-- Card item START -->
        <div class="col-sm-6">
          <div class="card">
            <!-- Card img -->
            <div class="position-relative">
              <img class="card-img" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt="Card image">

              <?php if ($type == 3) : ?>
                <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                  <!-- Card overlay bottom -->
                  <div class="w-100 mt-auto">
                    <!-- Card category -->
                    <a href="#" class="badge bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>THB <?= $model->price ?></a>
                  </div>
                </div>
              <?php endif ?>

            </div>
            <div class="card-body px-0 pt-3">
              <h4 class="card-title"><a href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $model->id]) ?>" class="btn-link text-reset fw-bold"><?= $model->name ?></a></h4>
            </div>
          </div>
        </div>
        <!-- Card item END -->
      <?php endforeach  ?>

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
  <!-- Main Post END -->

</div>
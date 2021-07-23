<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "แหล่งท่องเที่ยวเชิงเกษตร";
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
              <img class="card-img" src="../../themes/template/assets/images/blog/4by3/01.jpg" alt="Card image">
              <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                <!-- Card overlay bottom -->
                <div class="w-100 mt-auto">
                  <!-- Card category -->
                  <a href="#" class="badge bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>type</a>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-3">
              <h4 class="card-title"><a href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $model->id]) ?>" class="btn-link text-reset fw-bold"><?= $model->name ?></a></h4>
              <p class="card-text"><?= $model->details ?></>
                <!-- Card info -->
              <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                <li class="nav-item">
                  <div class="nav-link">
                    <div class="d-flex align-items-center position-relative">
                      <div class="avatar avatar-xs">
                        <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/01.jpg" alt="avatar">
                      </div>
                      <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Samuel</a></span>
                    </div>
                  </div>
                </li>
                <li class="nav-item">Jan 22, 2021</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Card item END -->
      <?php endforeach  ?>

      <!-- Load more START -->
      <div class="col-12 text-center mt-5">
        <button type="button" class="btn btn-primary-soft">Load more post <i class="bi bi-arrow-down-circle ms-2 align-middle"></i></button>
      </div>
      <!-- Load more END -->

    </div>
  </div>
  <!-- Main Post END -->

</div>
<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PackageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-search">
  <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
  ]); ?>
  <section class="hero-home">
    <div class="swiper-container hero-slider">
      <div class="swiper-wrapper dark-overlay">
        <div class="swiper-slide" style="background-image:url(../assets/img/photo/photo-1501621965065-c6e1cf6b53e2.jpg)"></div>
        <div class="swiper-slide" style="background-image:url(../assets/img/photo/photo-1519974719765-e6559eac2575.jpg)"></div>
        <div class="swiper-slide" style="background-image:url(../assets/img/photo/photo-1490578474895-699cd4e2cf59.jpg)"></div>
        <div class="swiper-slide" style="background-image:url(../assets/img/photo/photo-1534850336045-c6c6d287f89e.jpg)"></div>
      </div>
    </div>
    <div class="container py-6 py-md-7 text-white z-index-20">
      <div class="row">
        <div class="col-xl-10">
          <div class="text-center text-lg-start">
            <p class="subtitle letter-spacing-4 mb-2 text-secondary text-shadow">The best holiday experience</p>
            <h1 class="display-3 fw-bold text-shadow"><?= Html::encode($this->title) ?></h1>
          </div>
          <div class="search-bar mt-5 p-3 p-lg-1 ps-lg-4">

            <div class="row">
              <!-- <div class="col-lg-7 d-flex align-items-center form-group"> -->
              <div class="col-md-7 col-sm-12 my-1">
                <?= $form->field($model, 'name')->input('text', ['placeholder' => "ค้นหาชื่อแพ็คเกจ", 'class' => 'form-control border-0 shadow-0'])->label(false) ?>
              </div>
              <div class="col-md-3 d-flex align-items-center ">
                <?= $form->field($model, 'date_moment')->dropdownList(ArrayHelper::map($listOfDateMoment, "date_moment", "date_moment"), ['prompt' => 'เลือกจำนวนวัน', 'class' => 'selectpicker', 'style'])->label(false) ?>
              </div>
              <div class="col-lg-2 d-grid">
                <?= Html::submitButton(Yii::t('app', 'ค้นหา'), ['class' => 'btn btn-primary rounded-pill h-100']) ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <?php ActiveForm::end(); ?>
</div>
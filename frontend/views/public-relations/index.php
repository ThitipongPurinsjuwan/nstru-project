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

<?php if ($type == 2) : ?>

  <?= $this->render('knowing-page', [
    'pages' => $pages,
    'model' => $model,
  ]) ?>

<?php elseif ($type == 1) : ?>

  <?= $this->render('news', [
    'pages' => $pages,
    'model' => $model,
  ]) ?>

<?php endif ?>
<?php

use common\util\StringCustom;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
?>

<section class="py-6">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-8">
        <h2 class="underline "> <i class=" fas fa-bullhorn" style=color:mediumvioletred></i> ข่าวประชาสัมพันธ์</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-12 item-box">

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
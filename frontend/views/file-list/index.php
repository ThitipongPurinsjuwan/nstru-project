<?php

use common\util\DateTimeCustom;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FileListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Video';
?>
<style>
  .h-em {
    height: 21em !important;
  }

  .card-img-overlay {
    padding: 0;
    ;
  }
</style>
<div class="file-list-index">
  <section class="position-relative py-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <h2 class="underline "> <i class=" fas fa-bullhorn"></i> วีดิโอแนะนำ</h2>
        </div>
      </div>
      <div class="row g-4">
        <?php if (count($models) > 0) :  ?>
          <?php foreach ($models as $model) :  ?>

            <!-- Card item START -->
            <div class="col-lg-4 col-sm-6 mb-4 hover-animate">
              <div class="card shadow border-0 border h-100">
                <div class="rounded-top">
                  <div class="ratio ratio-16x9">
                    <iframe width="560" height="315" src="<?= str_replace("watch?v=", "embed/", $model->file_name) ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="my-2"><a class="text-dark" href="<?= $model->file_name ?>"><?= $model->download_name ?> </a></h5>
                  <p class="text-gray-500 text-sm my-3"><i class="far fa-clock me-2"></i><?= DateTimeCustom::getDateThai($model->date_create) ?></p>
                </div>
                <!-- </div> -->
              </div>
            </div>
            <!-- Card item END -->

          <?php endforeach  ?>
        <?php endif  ?>
      </div>
      <!-- Row end -->

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
        ]); ?>
      </nav>
      <!-- Pagination END -->
    </div>
  </section>

</div>
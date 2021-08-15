<?php

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
</style>
<div class="file-list-index">

  <!-- **************** MAIN CONTENT START **************** -->
  <main>

    <!-- ======================= Inner intro START -->
    <section class="pb-4 pt-3">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card bg-dark-overlay-3 h-300 overflow-hidden card-bg-scale text-center" style="background-image:url(../../themes/template/assets/images/blog/16by9/06.jpg); background-position: center left; background-size: cover;">
              <!-- Card Image overlay -->
              <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                <div class="col-md-8 m-auto bg-blur p-5 rounded-3 shadow-lg">
                  <h1 class="text-white">Video</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======================= Inner intro END -->

    <!-- ======================= Main content START -->
    <section class="position-relative pt-0">
      <div class="container">
        <div class="row g-4">

          <?php foreach ($models as $model) :  ?>
            <!-- Card item START -->
            <div class="col-sm-6 col-lg-4">
              <div class="card bg-light border h-em h-sm-100">
                <!-- Card Image overlay -->
                <div class="card-img-overlay d-flex flex-column p-3 p-md-4">
                  <div>
                    <!-- Card category -->
                    <!-- Card title -->
                    <h5><a href="<?= $model->file_name ?>" target="_blank" class="btn-link text-reset"><?= $model->download_name ?></a></h5>
                    <div class="mt-3 rounded overflow-hidden">
                      <div class="ratio ratio-16x9">
                        <iframe width="560" height="315" src="<?= str_replace("watch?v=", "embed/", $model->file_name) ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      </div>
                    </div>
                  </div>
                  <div class="w-100 mt-auto">
                    <ul class="nav nav-divider align-items-center small">
                      <li class="nav-item"><?= $model->date_create ?></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card item END -->
          <?php endforeach  ?>
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
            'maxButtonCount' => 8,
          ]); ?>
        </nav>
        <!-- Pagination END -->
      </div>
    </section>
    <!-- =======================
Main content END -->

  </main>
  <!-- **************** MAIN CONTENT END **************** -->

</div>
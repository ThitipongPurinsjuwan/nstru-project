<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use common\models\Place;
use common\util\DateTimeCustom;

use function PHPSTORM_META\type;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $nameOfType;
?>
<div class="place-index">
  <?= $this->render('_search', ['model' => $searchModel, 'type' => $type]); ?>

  <div class="place-index">
    <section class="py-5">
      <div class="container">
        <h2 class="underline "> <i class=" fas fa-bullhorn" style=color:#4E66F8></i> สถานที่แนะนำ</h2>
        <div class="row" style="margin-top: 50px;">
          <?php if (count($model) > 0) :  ?>
            <?php foreach ($model as $model) :  ?>
              <!-- venue item-->
              <div class="col-sm-6 col-lg-4 mb-5 hover-animate" data-marker-id="59c0c8e33b1527bfe2abaf92">
                <div class="card h-100 border-0 shadow">
                  <div class="card-img-top overflow-hidden dark-overlay bg-cover" style="background-image: url(<?= '../../images/images_upload_forform/' . $model->name_img_important ?>); min-height: 300px;"><a class="tile-link" href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $model->id]) ?>"></a>
                  </div>
                  <div class="card-body d-flex align-items-center">
                    <div class="w-100">
                      <h5 class="card-title"><a href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $model->id]) ?>" class="btn-link text-reset fw-bold"><?= $model->name ?></a></h5>
                      <div class="text-uppercase text-muted text-sm ">
                        <p class="text-gray-500 text-sm my-3"><i class="far fa-clock me-2"></i> วันเปิดทำการ <?= $model->business_day ?></p>
                        <?php if ($type != 3) :  ?>
                          <p class="my-2 text-muted text-sm"><?= Place::showLess($model->details) ?></p>
                        <?php endif ?>
                        <?php if ($type == 3) :  ?>
                          <p class="card-text text-muted"><span class="h4 text-primary">฿<?= $model->price ?></span> ต่อคืน</p>
                        <?php endif ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach  ?>
          <?php endif ?>
        </div>
      </div>
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
    </section>
  </div>
</div>
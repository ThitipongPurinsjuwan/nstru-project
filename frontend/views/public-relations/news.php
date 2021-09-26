<?php


use common\models\Place;
use common\util\DateTimeCustom;
use yii\widgets\LinkPager;
?>

<section class="py-5 position-relative">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-12">
        <h2 class="underline "> ข่าวประชาสัมพันธ์ <span class="head-title-custom">
            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_jqenj9df.json" background="transparent" speed="1" style="width: 60px; height: 60px;" loop autoplay></lottie-player>
          </span></h2>
        <div class="row">
          <?php if (count($model) > 0) :  ?>
            <?php foreach ($model as $model) : ?>
              <!-- blog item-->
              <div class="col-lg-4 col-sm-6 mb-4 hover-animate" style="margin-top: 50px;">
                <div class="card shadow border-0 h-100">
                  <a href="<?= \Yii::$app->getUrlManager()->createUrl(['public-relations/view', 'id' => $model->id]) ?>">
                    <img class="img-fluid card-img-top" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt="..." />
                  </a>
                  <div class="card-body">
                    <a class="text-uppercase text-muted text-sm letter-spacing-2" href="#">Travel </a>
                    <h5 class="my-2"><a class="text-dark" href="<?= \Yii::$app->getUrlManager()->createUrl(['public-relations/view', 'id' => $model->id]) ?>"><?= $model->topic ?> </a></h5>
                    <p class="text-gray-500 text-sm my-3"><i class="far fa-clock me-2"></i><?= DateTimeCustom::getDateThai($model->date_create) ?></p>
                    <p class="my-2 text-muted text-sm"><?= Place::showLess($model->details) ?></p>
                    <a class="btn btn-link ps-0" href=" <?= \Yii::$app->getUrlManager()->createUrl(['public-relations/view', 'id' => $model->id]) ?>">Read more<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                  </div>
                </div>
              </div>
            <?php endforeach  ?>
          <?php endif  ?>
        </div>

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
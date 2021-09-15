<?php

use common\models\Place;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Package */


$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<style>
  .img-h-sm {
    height: 11em;
    object-fit: cover;
  }
</style>

<div class="package-view">
  <section class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover" style="background-image: url('<?= '../../images/images_upload_forform/' . $model->name_img_important ?>');">
    <div class="container overlay-content">
      <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
        <div class="text-white mb-4 mb-lg-0">
          <div class="badge badge-pill badge-transparent px-3 py-2 mb-4">Package &amp; Travel</div>
          <h1 class="text-shadow verified"><?= $model->name ?></h1>
          <p><i class="fa-map-marker-alt fas me-2"></i><?= $model->contact ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="text-block">
            <h3 class="mb-3">รายละเอียด</h3>
            <p class="text-muted"><?= $model->details ?></p>
          </div>
          <div class="text-block">
            <h5 class="mb-4">รูปภาพ</h5>
            <div class="row mb-3 ms-n1 me-n1">

              <?php if (count($modelImage) > 0) :  ?>
                <?php foreach ($modelImage as $modelImage) :  ?>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" data-glightbox data-gallery="image-popup"><img class="img-fluid" src="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" alt="..."></a></div>
                <?php endforeach  ?>
              <?php endif ?>

            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="ps-xl-4">
            <div class="card border-0 shadow mb-5">
              <div class="card-header bg-gray-100 py-4 border-0">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <p class="subtitle text-sm text-primary">จำนวนวันสำหรับท่องเที่ยว</p>
                    <h4 class="mb-0">Traveling </h4>
                  </div>
                  <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ms-3 text-muted flex-shrink-0">
                    <use xlink:href="#wall-clock-1"> </use>
                  </svg>
                </div>
              </div>
              <div class="card-body">
                <table class="table text-sm mb-0">
                  <tr>
                    <th class="ps-0 border-0">travel</th>
                    <td class="pe-0 text-end border-0"><?= $model->date_moment ?> day</td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="card border-0 shadow mb-5">
              <div class="card-header bg-gray-100 py-4 border-0">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <p class="subtitle text-sm text-primary">ช่องทางติดต่อ</p>
                    <h4 class="mb-0">Contact</h4>
                  </div>
                  <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ms-3 text-muted flex-shrink-0">
                    <use xlink:href="#telephone-operator-1"></use>
                  </svg>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled mb-4">
                  <?php if ($model->phone !== '') : ?>
                    <li class="mb-2">
                      <a class="text-gray-00 text-sm text-decoration-none" href="tel:<?= Place::customizePhoneCall($model->phone) ?>"><i class="fa fa-phone me-3"></i><span class="text-muted"><?= $model->phone ?></span></a>
                    </li>
                  <?php endif ?>

                  <?php if ($model->facebook_link !== '') : ?>
                    <li class="mb-2">
                      <a class="text-blue text-sm text-decoration-none" href="<?= $model->facebook_link ?>"><i class="fab fa-facebook me-3"></i><span class="text-muted">Facebook</span></a>
                    </li>
                  <?php endif ?>

                  <?php if ($model->line_id !== '') : ?>
                    <li class="mb-2">
                      <a class="text-blue text-sm text-decoration-none" href="<?= 'http://line.me/ti/p/' . $model->line_id ?>"><i class="fab fa-line me-3"></i><span class="text-muted">Line</span></a>
                    </li>
                  <?php endif ?>
                </ul>
              </div>
            </div>
            <div class="card border-0 shadow mb-5">
              <div class="card-header bg-gray-100 py-4 border-0">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="text-muted"><span class="text-primary h2">฿<?= $model->price ?></span> ต่อคืน</p>
                  <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ms-3 text-muted flex-shrink-0">
                    <use xlink:href="#calls-1"> </use>
                  </svg>
                </div>
                <hr class="my-4">
                <form class="form" id="booking-form" action="tel:<?= Place::customizePhoneCall($model->phone) ?>" autocomplete="off">
                  <div class="d-grid mb-4">
                    <button class="btn btn-primary" type="submit">จองเลย</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="text-center">
              <p><a class="text-secondary" href="#"> <i class="fa fa-heart"></i> <?= count($modelPlace) ?> Landmark This Package</a></p><span> contact us now </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6 bg-gray-100">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <p class="subtitle text-secondary">สถานที่ท่องเที่ยวในแพ็คเกจ </p>
          <h2>From our travel place</h2>
        </div>
        <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a class="text-muted text-sm" href="<?= \Yii::$app->getUrlManager()->createUrl(['place/index', 'type' => 1]) ?>">
            สถานที่ท่องเที่ยวทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a></div>
      </div>
      <!-- Slider main container-->
      <div class="swiper-container swiper-container-mx-negative swiper-init pt-3" data-swiper="{&quot;slidesPerView&quot;:4,&quot;spaceBetween&quot;:20,&quot;loop&quot;:true,&quot;roundLengths&quot;:true,&quot;breakpoints&quot;:{&quot;1200&quot;:{&quot;slidesPerView&quot;:3},&quot;991&quot;:{&quot;slidesPerView&quot;:2},&quot;565&quot;:{&quot;slidesPerView&quot;:1}},&quot;pagination&quot;:{&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;clickable&quot;:true,&quot;dynamicBullets&quot;:true}}">
        <!-- Additional required wrapper-->
        <div class="swiper-wrapper pb-5">
          <!-- Slides-->

          <?php if (count($modelPlace) > 0) :  ?>
            <?php foreach ($modelPlace as $modelPlace) : ?>
              <div class="swiper-slide h-auto px-2">
                <!-- place item-->
                <div class="w-100 h-100 hover-animate">
                  <div class="card shadow border-0 h-100">
                    <a href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $modelPlace->id]) ?>">
                      <img class="img-fluid img-h-sm card-img-top" src="<?= '../../images/images_upload_forform/' . $modelPlace->name_img_important ?>" alt="..." />
                    </a>
                    <div class="card-body"><a class="text-uppercase text-muted text-sm letter-spacing-2" href="#">Travel </a>
                      <h5 class="my-2"><a class="text-dark" href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $modelPlace->id]) ?>"><?= $modelPlace->name ?> </a></h5>
                      <p class="text-gray-500 text-sm my-3"><i class="far fa-clock me-2"></i>January 16, 2016</p>
                      <p class="my-2 text-muted text-sm">Pellentesque habitant morbi tristique senectus. Vestibulum tortor quam, feugiat vitae, ultricies ege...</p><a class="btn btn-link ps-0" href="post.html">Read more<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                    </div>
                  </div>
                </div>
                <!-- place item-->
              </div>
            <?php endforeach ?>
          <?php endif ?>

        </div>
        <!-- If we need pagination-->
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

</div>
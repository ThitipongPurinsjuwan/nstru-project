<?php

use common\models\Place;
use common\util\DateTimeCustom;

?>
<div class="banner">
  <div class="swiper-container my-swiper">
    <div class="swiper-wrapper">
      <?php if (count($modelBannerIMG) > 0) :  ?>
        <?php foreach ($modelBannerIMG as $modelBannerIMG) : ?>
          <div class="swiper-slide"><img class="" src="<?= '../../images/images_upload_forform/' . $modelBannerIMG->name ?>" alt="..." /></div>
        <?php endforeach  ?>
      <?php endif  ?>
      <!-- <div class="swiper-slide"><img class="" src="../assets/img/download/5.jpg" alt="..."></div> -->
    </div>
    <div class="swiper-button-next d-flex justify-content-center align-items-center"><i class="fas fa-chevron-left"></i></div>
    <div class="swiper-button-prev d-flex justify-content-center align-items-center"><i class="fas fa-chevron-right"></i></div>
    <div class="swiper-pagination"></div>
  </div>
</div>
<!-- NEWS START -->
<section class="py-5 position-relative">
  <!-- <div class="lottie-bg">
    <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_2m1smtya.json" background="transparent" speed="1" style="position: absolute; right: 0; left: 0;" loop autoplay></lottie-player>
  </div> -->
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-8">
        <h2>ข่าวประชาสัมพันธ์<span class="head-title-custom">
            <lottie-player src="https://assets6.lottiefiles.com/private_files/lf30_4rmx4y8w.json" background="transparent" speed="1" style="width: 60px; height: 60px;" loop autoplay></lottie-player>
          </span>
        </h2>
      </div>
      <div class="col-md-4 d-md-flex align-items-center justify-content-end">
        <a class="text-muted text-sm" href="<?= \Yii::$app->getUrlManager()->createUrl(['public-relations/index', 'type' => 1]) ?>">ดูข่าวทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a>
      </div>
    </div>
    <div class="row">
      <?php if (count($modeNews) > 0) :  ?>
        <?php foreach ($modeNews as $modeNews) : ?>
          <!-- blog item-->
          <div class="col-lg-4 col-sm-6 mb-4 hover-animate">
            <div class="card shadow border-0 h-100">
              <a href="<?= \Yii::$app->getUrlManager()->createUrl(['public-relations/view', 'id' => $modeNews->id]) ?>">
                <img class="img-fluid card-img-top" src="<?= '../../images/images_upload_forform/' . $modeNews->name_img_important ?>" alt="..." />
              </a>
              <div class="card-body">
                <a class="text-uppercase text-muted text-sm letter-spacing-2" href="#">Travel </a>
                <h5 class="my-2"><a class="text-dark" href="<?= \Yii::$app->getUrlManager()->createUrl(['public-relations/view', 'id' => $modeNews->id]) ?>"><?= $modeNews->topic ?> </a></h5>
                <p class="text-gray-500 text-sm my-3"><i class="far fa-clock me-2"></i><?= DateTimeCustom::getDateThai($modeNews->date_create) ?></p>
                <p class="my-2 text-muted text-sm"><?= Place::showLess($modeNews->details) ?></p>
                <a class="btn btn-link ps-0" href=" <?= \Yii::$app->getUrlManager()->createUrl(['public-relations/view', 'id' => $modeNews->id]) ?>">Read more<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach  ?>
      <?php endif  ?>
      <!-- blog item-->
    </div>
  </div>
</section>
<!-- NEWS END -->

<!-- RECOMMEND VDO START -->
<section class="py-5 bg-gray-100">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-8">
        <h2>วีดีโอแนะนำ</h2>
      </div>
      <div class="col-md-4 d-md-flex align-items-center justify-content-end">
        <a class="text-muted text-sm" href=" index.php?r=file-list/index">ดูวีดีโอทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a>
      </div>
    </div>
    <div class="row">

      <?php if (count($modelVDO) > 0) : ?>
        <?php foreach ($modelVDO as $vdo) : ?>

          <!-- Card item START -->
          <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card shadow border-0 h-100 overflow-hidden" style="height: 40em !important;" data-jarallax-video="<?= str_replace("watch?v=", "embed/", $vdo->file_name) ?>" data-speed="1.2">
              <!-- Card Image overlay -->
              <div class="card-img-overlay d-flex flex-column p-3 p-md-4 hover-animate">
                <div class="w-100 mt-auto">
                  <!-- Card title -->
                  <h4 class="text-white"><a href="<?= $vdo->file_name ?>" target="_blank" class="btn-link text-reset stretched-link"><?= $vdo->download_name ?></a></h4>
                  <!-- Card info -->
                </div>
              </div>
            </div>
          </div>
          <!-- Card item END -->

        <?php endforeach ?>
      <?php else : ?>

        <div class="col-12">
          <div class="row d-flex justify-content-center" style="text-align-last: center;">
            <h4>ไม่มีข้อมูล</h4>
          </div>
        </div>

      <?php endif ?>

    </div>
  </div>
</section>
<!-- RECOMMEND VDO END -->

<!-- TRAVEL START -->
<section class="py-5 bg-banner bg-banner-left">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-8">
        <h2>สถานที่ท่องเที่ยว<span class="head-title-custom">
            <lottie-player src="https://assets10.lottiefiles.com/datafiles/cnP9oh2DZFEzaA3/data.json" background="transparent" speed="1" style="width: 60px; height: 60px;" loop autoplay></lottie-player>
          </span></h2>
      </div>
      <!-- <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a class="text-muted text-sm" href="index.php?r=place/index&amp;type=1">
          ดูสถานที่ท่องเที่ยวทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a></div> -->
    </div>
    <div class="swiper-container guides-slider mx-n2 pt-3">
      <!-- Additional required wrapper-->
      <div class="swiper-wrapper pb-5">
        <?php if (count($model) > 0) :  ?>
          <?php foreach ($model as $model) :  ?>
            <!-- Slides-->
            <div class="swiper-slide h-auto px-2">
              <div class="card card-poster gradient-overlay hover-animate mb-4 mb-lg-0">
                <a class="tile-link" href="<?= \Yii::$app->getUrlManager()->createUrl(['place/index', 'type' => $model->id]) ?>"></a>
                <img class="bg-image" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt="Card image">
                <div class="card-body overlay-content">
                  <h6 class="card-title text-shadow text-uppercase"><?= $model->name ?></h6>
                </div>
              </div>
            </div>
          <?php endforeach  ?>
        <?php endif  ?>
      </div>
      <div class="swiper-pagination d-md-none"> </div>
    </div>
  </div>
</section>
<!-- TRAVEL END -->

<!-- POPULAR START -->
<section class="pt-5 bg-gray-100">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-8">
        <h2>สถานที่ท่องเที่ยวแนะนำ</h2>
        <p class="text-muted mb-0">สถานที่กำลังเป็นที่นิยมและพูดถึงอยู่ในขณะนี้</p>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <?php if (count($topPlace) > 0) : ?>
        <?php for ($i = 0; $i < count($topPlace); $i++) : ?>

          <div class="col-6 col-lg-3 col-xl-3 px-0">
            <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="<?= '../../images/images_upload_forform/' . $topPlace[$i]['img'] ?>" alt="">
              <div class="p-3 p-sm-5 text-white z-index-20">
                <h4><?= $topPlace[$i]['name'] ?></h4>
                <a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="<?php echo \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $topPlace[$i]['id']]) ?>">รายละเอียดเพิ่มเติม<i class="fa fa-chevron-right ms-2"></i></a>
              </div>
            </div>
          </div>

        <?php endfor ?>
      <?php endif ?>
    </div>
  </div>
</section>
<!-- POPULAR END -->

<!-- PACKAGE START -->
<section class="py-5 bg-banner">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-8">
        <h2>แพ็คเกจท่องเที่ยว<span class="head-badge"></span></h2>
      </div>
      <div class="col-md-4 d-lg-flex align-items-center justify-content-end">
        <a class="text-muted text-sm" href="index.php?r=package/index">ดูแพ็คเกจทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a>
      </div>
    </div>
    <!-- Slider main container-->
    <div class="swiper-container swiper-container-mx-negative swiper-init pt-3" data-swiper="{&quot;slidesPerView&quot;:4,&quot;spaceBetween&quot;:20,&quot;loop&quot;:true,&quot;roundLengths&quot;:true,&quot;breakpoints&quot;:{&quot;1200&quot;:{&quot;slidesPerView&quot;:3},&quot;991&quot;:{&quot;slidesPerView&quot;:2},&quot;565&quot;:{&quot;slidesPerView&quot;:1}},&quot;pagination&quot;:{&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;clickable&quot;:true,&quot;dynamicBullets&quot;:true}}">
      <!-- Additional required wrapper-->
      <div class="swiper-wrapper pb-5">
        <?php if (count($modelPackage) > 0) :  ?>
          <?php foreach ($modelPackage as $modelPackage) :  ?>
            <!-- Slides-->
            <div class="swiper-slide h-auto px-2">
              <!-- place item-->
              <div class="w-100 h-100 hover-animate" data-marker-id="<?= $modelPackage->id ?>">
                <div class="card h-100 border-0 shadow">
                  <div class="card-img-top overflow-hidden gradient-overlay">
                    <img class="img-fluid" src="<?= '../../images/images_upload_forform/' . $modelPackage->name_img_important ?>" alt="..." />
                    <a class="tile-link" href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $modelPackage->id]) ?>"></a>
                    <div class="card-img-overlay-top text-end">
                      <a class="card-fav-icon position-relative z-index-40" href="javascript: void();">
                        <svg class="svg-icon text-white">
                          <use xlink:href="#heart-1"> </use>
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div class="card-body d-flex align-items-center">
                    <div class="w-100">
                      <h6 class="card-title"><a class="text-decoration-none text-dark" href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $modelPackage->id]) ?>"><?= $modelPackage->name ?></a></h6>
                      <div class="d-flex card-subtitle mb-3">
                        <p class="flex-grow-1 mb-0 text-muted text-sm">ทัวร์ <?= $modelPackage->date_moment ?> วัน</p>
                      </div>
                      <p class="card-text text-muted"><span class="h4 text-primary">฿<?= $modelPackage->price ?></span> ต่อแพ็คเกจ</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach  ?>
        <?php endif  ?>
      </div>
      <!-- If we need pagination-->
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<!-- PACKAGE END -->
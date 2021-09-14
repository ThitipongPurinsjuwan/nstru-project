<?php

use common\models\Place;
use common\util\DateTimeCustom;

?>
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
<!-- NEWS START -->
<section class="py-5 bg-banner">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-8">
        <h2>ข่าวประชาสัมพันธ์<span class="head-badge"></span></h2>
      </div>
      <!-- <div class="col-md-4 d-md-flex align-items-center justify-content-end">
        <a class="text-muted text-sm" href="blog.html">ดูข่าวทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a>
      </div> -->
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
      <!-- <div class="col-lg-4 col-sm-6 mb-4 hover-animate">
        <div class="card shadow border-0 h-100"><a href="post.html"><img class="img-fluid card-img-top" src="../assets/img/photo/photo-1512917774080-9991f1c4c750.jpg" alt="..." /></a>
          <div class="card-body"><a class="text-uppercase text-muted text-sm letter-spacing-2" href="#">Travel </a>
            <h5 class="my-2"><a class="text-dark" href="post.html">Autumn fashion tips and tricks </a></h5>
            <p class="text-gray-500 text-sm my-3"><i class="far fa-clock me-2"></i>January 16, 2016</p>
            <p class="my-2 text-muted text-sm">Pellentesque habitant morbi tristique senectus. Vestibulum tortor quam, feugiat vitae, ultricies ege...</p><a class="btn btn-link ps-0" href="post.html">Read more<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
          </div>
        </div>
      </div> -->
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
      <!-- Card item START -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card shadow border-0 h-100 overflow-hidden" style="height: 40em !important;" data-jarallax-video="https://www.youtube.com/embed/MPg-b3reh_g" data-speed="1.2">
          <!-- Card Image overlay -->
          <div class="card-img-overlay d-flex flex-column p-3 p-md-4 hover-animate">
            <div class="w-100 mt-auto">
              <!-- Card title -->
              <h4 class="text-white"><a href="#" class="btn-link text-reset stretched-link">Travel</a></h4>
              <!-- Card info -->
            </div>
          </div>
        </div>
      </div>
      <!-- Card item END -->
      <!-- Card item START -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card shadow border-0 h-100 overflow-hidden" style="height: 40em !important;" data-jarallax-video="https://www.youtube.com/embed/406d6ez-0rk" data-speed="1.2">
          <!-- Card Image overlay -->
          <div class="card-img-overlay d-flex flex-column p-3 p-md-4 hover-animate">
            <div class="w-100 mt-auto">
              <!-- Card title -->
              <h4 class="text-white"><a href="#" class="btn-link text-reset stretched-link">Travel</a></h4>
              <!-- Card info -->
            </div>
          </div>
        </div>
      </div>
      <!-- Card item END -->
      <!-- Card item START -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card shadow border-0 h-100 overflow-hidden" style="height: 40em !important;" data-jarallax-video="https://www.youtube.com/embed/x95oX5wmJO0" data-speed="1.2">
          <!-- Card Image overlay -->
          <div class="card-img-overlay d-flex flex-column p-3 p-md-4 hover-animate">
            <div class="w-100 mt-auto">
              <!-- Card title -->
              <h4 class="text-white"><a href="#" class="btn-link text-reset stretched-link">Travel</a></h4>
              <!-- Card info -->
            </div>
          </div>
        </div>
      </div>
      <!-- Card item END -->
    </div>
  </div>
</section>
<!-- RECOMMEND VDO END -->

<!-- TRAVEL START -->
<section class="py-5 bg-banner bg-banner-left">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-8">
        <h2>สถานที่ท่องเที่ยว<span class="head-badge"></span></h2>
      </div>
      <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a class="text-muted text-sm" href="index.php?r=place/index&amp;type=1">
          ดูสถานที่ท่องเที่ยวทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a></div>
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

          <div class="col-6 col-lg-4 col-xl-3 px-0">
            <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="<?= '../../images/images_upload_forform/' . $topPlace[$i]['img'] ?>" alt="">
              <div class="p-3 p-sm-5 text-white z-index-20">
                <h4><?= $topPlace[$i]['name'] ?></h4>
                <a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="<?php echo \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $topPlace[$i]['id']]) ?>">รายละเอียดเพิ่มเติม<i class="fa fa-chevron-right ms-2"></i></a>
              </div>
            </div>
          </div>

        <?php endfor ?>
      <?php endif ?>

      <!-- <div class="col-6 col-lg-4 col-xl-3 px-0">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/medellin.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">Medellín</h4>
            <p class="mb-4">Tropical paradise</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div> -->
      <!-- <div class="col-6 col-lg-4 col-xl-3 px-0">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/bangkok.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">Bangkok</h4>
            <p class="mb-4">Temples and street food</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-4 col-xl-3 px-0">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/kyoto.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">Kyoto</h4>
            <p class="mb-4">Imperial capital</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-4 col-xl-3 px-0">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/los-angeles.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">Los Angeles</h4>
            <p class="mb-4">City of angeles</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-4 col-xl-3 px-0">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/london.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">London</h4>
            <p class="mb-4">Galleries and shopping</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-4 col-xl-3 px-0">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/madrid.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">Madrid</h4>
            <p class="mb-4">Aquí no hay playa</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-4 col-xl-3 px-0">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/havana.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">Havana</h4>
            <p class="mb-4">La Havana</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div> -->
      <div class="col-6 col-lg-4 col-xl-3 px-0 d-none d-lg-block d-xl-none">
        <div class="d-flex align-items-center dark-overlay hover-scale-bg-image" style="min-height: 400px;"><img class="bg-image" src="../assets/img/photo/barcelona.jpg" alt="">
          <div class="p-3 p-sm-5 text-white z-index-20">
            <h4 class="h2">Barcelona</h4>
            <p class="mb-4">Dalí, Gaudí, Barrio Gotico</p><a class="btn btn-link text-reset ps-0 stretched-link text-decoration-none" href="#">Take me there<i class="fa fa-chevron-right ms-2"></i></a>
          </div>
        </div>
      </div>
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
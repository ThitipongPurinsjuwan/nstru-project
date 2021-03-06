<div class="col-lg-9">
  <div class="row">
    <div class="col-12">
      <div class="tiny-slider arrow-hover arrow-blur arrow-white arrow-round rounded-3 overflow-hidden">
        <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="1" data-arrow="true" data-dots="false" data-items="1">
          <?php if (count($modelPlace) > 0) : ?>
            <?php foreach ($modelPlace as $modelPlace) :  ?>
              <!-- Slide 1 -->
              <div class="card bg-dark-overlay-3 h-300 h-sm-300 h-md-300 rounded-0" style="background-image:url(<?= '../../images/images_upload_forform/' . $modelPlace->name_img_important ?>); background-position: center left; background-size: cover;">
                <!-- Card Image overlay -->
                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-5">
                  <div class="w-100 my-auto">
                    <div class="col-md-10 col-lg-7 mx-auto text-center">
                      <!-- Card category -->
                      <a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Travel</a>
                      <!-- Card title -->
                      <h3 class="text-white display-6"><a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $modelPlace->id]) ?>" class="btn-link text-reset fw-normal"><?= $modelPlace->name ?></a></h3>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Slide 2 -->
            <?php endforeach  ?>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
  <br>
  <!-- Title -->
  <div class="mb-4">
    <h2 class="m-0"><i class="bi bi-hourglass-top me-2"></i>กำลังฮิต</h2>
    <p>ข่าวประชาสัมพันธ์ล่าสุด, รูปภาพ, วีดิโอ, กิจกรรมพิเศษ</p>
  </div>
  <div class="row gy-4">
    <?php if (count($modelVDO) > 0) :  ?>
      <?php foreach ($modelVDO as $modelVDO) :  ?>
        <!-- Card item START -->
        <div class="col-sm-6">
          <div class="card card-overlay-bottom bg-parallax h-400 h-lg-100" style="height: 40em !important;" data-jarallax-video="<?= str_replace("watch?v=", "embed/", $modelVDO->file_name) ?>" data-speed="1.2">
            <!-- Card Image overlay -->
            <div class="card-img-overlay d-flex flex-column p-3 p-md-4">
              <div class="w-100 mt-auto">
                <!-- Card title -->
                <h4 class="text-white"><a href="#" class="btn-link text-reset stretched-link"><?= $modelVDO->download_name ?></a></h4>
                <!-- Card info -->
              </div>
            </div>
          </div>
        </div>
        <!-- Card item END -->
      <?php endforeach ?>
    <?php endif ?>

  </div>
</div>
<!-- Sidebar START -->
<div class="col-lg-3 mt-5 mt-lg-0">
  <div data-sticky data-margin-top="80" data-sticky-for="767">
    <!-- Trending topics widget START -->
    <div>
      <h4 class="mt-4 mb-3">สถานที่</h4>
      <!-- Category item -->
      <?php if (count($model) > 0) :  ?>
        <?php foreach ($model as $model) :  ?>
          <div class="text-center mb-3 card-bg-scale position-relative overflow-hidden rounded bg-dark-overlay-4 " style="background-image:url(<?= '../../images/images_upload_forform/' . $model->name_img_important ?>); background-position: center left; background-size: cover;">
            <div class="p-3">
              <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['place/index', 'type' => $model->id]) ?>" class="stretched-link btn-link fw-bold text-white h5"><?= $model->name ?></a>
            </div>
          </div>
        <?php endforeach  ?>
      <?php endif  ?>

    </div>
    <!-- Trending topics widget END -->
    <div class="d-flex">
      <!-- Recent post widget START -->
      <div class="col-12 col-sm-6 col-lg-12">
        <h4 class="mt-4 mb-3">แพ็คเกจ</h4>
        <!-- Recent post item -->
        <?php if (count($modelPackage) > 0) :  ?>
          <?php foreach ($modelPackage as $modelPackage) :  ?>

            <div class="card mb-3">
              <div class="d-flex g-3">
                <div class="col-4">
                  <img class="rounded img-sm-box" src="<?= '../../images/images_upload_forform/' . $modelPackage->name_img_important ?>" alt="">
                </div>
                <div class="col-8" style="padding-left: 0.7em;">
                  <h5 class="card-title">
                    <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $modelPackage->id]) ?>" class="btn-link text-reset fw-bold"><?= $modelPackage->name ?></a>
                  </h5>
                  <p>
                    <?= $modelPackage->date_create ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach  ?>
        <?php endif  ?>
      </div>
      <!-- Recent post widget END -->
    </div>
  </div>
</div>
<!-- Sidebar END -->
<div class="col-lg-9">
  <div class="row">
    <div class="col-12">
      <div class="tiny-slider arrow-hover arrow-blur arrow-white arrow-round rounded-3 overflow-hidden">
        <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="1" data-arrow="true" data-dots="false" data-items="1">
          <?php foreach ($modelPlace as $modelPlace) :  ?>
            <!-- Slide 1 -->
            <div class="card bg-dark-overlay-3 h-400 h-sm-500 h-md-600 rounded-0" style="background-image:url(<?= '../../images/images_upload_forform/' . $modelPlace->name_img_important ?>); background-position: center left; background-size: cover;">
              <!-- Card Image overlay -->
              <div class="card-img-overlay d-flex align-items-center p-3 p-sm-5">
                <div class="w-100 my-auto">

                  <div class="col-md-10 col-lg-7 mx-auto text-center">
                    <!-- Card category -->
                    <a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Business</a>
                    <!-- Card title -->

                    <h2 class="text-white display-5"><a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $modelPlace->id]) ?>" class="btn-link text-reset fw-normal"><?= $modelPlace->name ?></a></h2>
                    <p class="text-white">For who thoroughly her boy estimating conviction.
                      Removed demands expense account in outward tedious do.</p>
                    <!-- Card info -->

                    <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                      <li class="nav-item">
                        <div class="nav-link">
                          <div class="d-flex align-items-center text-white position-relative">
                            <div class="avatar avatar-sm">
                              <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/14.jpg" alt="avatar">
                            </div>
                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Carolyn</a></span>
                          </div>
                        </div>
                      </li>
                      <li class="nav-item">Jan 26, 2021</li>
                      <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-comment-alt me-1"></i> 5 Comments</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Slide 2 -->
          <?php endforeach  ?>
        </div>
      </div>
    </div>
  </div>
  <br>
  <!-- Title -->
  <div class="mb-4">
    <h2 class="m-0"><i class="bi bi-hourglass-top me-2"></i>Today's top highlights</h2>
    <p>Latest breaking news, pictures, videos, and special reports</p>
  </div>
  <div class="row gy-4">
    <!-- Card item START -->
    <div class="col-sm-6">
      <div class="card">
        <!-- Card img -->
        <div class="position-relative">
          <img class="card-img" src="../../themes/template/assets/images/blog/4by3/01.jpg" alt="Card image">
          <div class="card-img-overlay d-flex align-items-start flex-column p-3">
            <!-- Card overlay bottom -->
            <div class="w-100 mt-auto">
              <!-- Card category -->
              <a href="#" class="badge bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Technology</a>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pt-3">
          <h4 class="card-title"><a href="post-single.html" class="btn-link text-reset fw-bold">12 worst types
              of business accounts
              you follow on Twitter</a></h4>
          <p class="card-text">He moonlights difficult engrossed it, sportsmen. Interested
            has all Devonshire difficulty gay assistance joy. Unaffected at ye of
            compliment alteration to</p>
          <!-- Card info -->
          <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
            <li class="nav-item">
              <div class="nav-link">
                <div class="d-flex align-items-center position-relative">
                  <div class="avatar avatar-xs">
                    <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/01.jpg" alt="avatar">
                  </div>
                  <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Samuel</a></span>
                </div>
              </div>
            </li>
            <li class="nav-item">Jan 22, 2021</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Card item END -->
    <!-- Card item START -->
    <div class="col-sm-6">
      <div class="card card-overlay-bottom bg-parallax h-400 h-lg-100" style="height: 40em !important;" data-jarallax-video="https://youtu.be/JpiCiU9wnSI" data-speed="1.2">
        <!-- Card Image overlay -->
        <div class="card-img-overlay d-flex flex-column p-3 p-md-4">
          <div>
            <!-- Card category -->
            <a href="#" class="badge bg-dark fs-6 mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Travel</a>
          </div>
          <div class="w-100 mt-auto">
            <!-- Card title -->
            <h4 class="text-white"><a href="#" class="btn-link text-reset stretched-link">5 investment doubts you should clarify</a></h4>
            <!-- Card info -->
            <ul class="nav nav-divider text-white-force align-items-center small">
              <li class="nav-item position-relative">
                <div class="nav-link">by <a href="#" class="stretched-link text-reset btn-link">Dennis</a>
                </div>
              </li>
              <li class="nav-item">Jan 28, 2021</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Card item END -->
  </div>
</div>
<!-- Sidebar START -->
<div class="col-lg-3 mt-5 mt-lg-0">
  <div data-sticky data-margin-top="80" data-sticky-for="767">
    <!-- Social widget START -->
    <div class="d-flex g-2">
      <div class="col-4">
        <a href="#" class="rounded text-center text-white-force p-3 d-block">
          <img class="logo-support" src="../../images/TSRI.png" alt="">
        </a>
      </div>
      <div class="col-4">
        <a href="#" class="rounded text-center text-white-force p-3 d-block">
          <img class="logo-support" src="../../images/Logo_nstru.png" alt="">
        </a>
      </div>
    </div>
    <!-- Social widget END -->
    <!-- Trending topics widget START -->
    <div>
      <h4 class="mt-4 mb-3">Topics</h4>
      <!-- Category item -->
      <?php foreach ($model as $model) :  ?>
        <div class="text-center mb-3 card-bg-scale position-relative overflow-hidden rounded bg-dark-overlay-4 " style="background-image:url(../../themes/template/assets/images/blog/4by3/01.jpg); background-position: center left; background-size: cover;">
          <div class="p-3">
            <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['place/index', 'type' => $model->id]) ?>" class="stretched-link btn-link fw-bold text-white h5"><?= $model->name ?></a>
          </div>
        </div>
      <?php endforeach  ?>

    </div>
    <!-- Trending topics widget END -->
    <div class="d-flex">
      <!-- Recent post widget START -->
      <div class="col-12 col-sm-6 col-lg-12">
        <h4 class="mt-4 mb-3">Package</h4>
        <!-- Recent post item -->
        <?php foreach ($modelPackage as $modelPackage) :  ?>

          <div class="card mb-3">
            <div class="d-flex g-3">
              <div class="col-4">
                <img class="rounded" src="../../themes/template/assets/images/blog/packges/c1.jpg" alt="">
              </div>
              <div class="col-8" style="padding-left: 0.7em;">
                <h6 class="card-title">
                  <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $modelPackage->id]) ?>" class="btn-link text-reset fw-bold"><?= $modelPackage->name ?></a>
                </h6>
                <div class="small mt-1"><?= $modelPackage->date_create ?></div>
              </div>
            </div>
          </div>
        <?php endforeach  ?>
      </div>
      <!-- Recent post widget END -->
    </div>
  </div>
</div>
<!-- Sidebar END -->
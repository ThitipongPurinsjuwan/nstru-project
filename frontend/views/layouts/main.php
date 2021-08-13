<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
 /*  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "1fc41a7e-c22d-4c94-9359-dcda7892d553",
    });
  }); */

  var zoom = 1;
  var width = 100;

  function bigger() {
    zoom = zoom + 0.1;
    width = 100 / zoom;
    document.body.style.transformOrigin = "left top";
    document.body.style.transform = "scale(" + zoom + ")";
    document.body.style.width = width + "%";
  }

  function smaller() {
    zoom = zoom - 0.1;
    width = 100 / zoom;
    document.body.style.transformOrigin = "left top";
    document.body.style.transform = "scale(" + zoom + ")";
    document.body.style.width = width + "%";
  }
</script>
<?php
if (!isset($_SESSION)) {
  session_start();
}
/* @var $this \yii\web\View */
/* @var $content string */

use common\models\PublicRelations;
use common\models\TypePlace;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\models\MenuMain;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;


AppAsset::register($this);


$modeNews = PublicRelations::find()->where(['type' => 2])->all();
$modelTypePlace = TypePlace::find()->all();
$menuMain = MenuMain::find()->where(['m_status' => 'Y'])->all();
?>


<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>" dir="ltr">

<head>
  <meta charset="<?= Yii::$app->charset; ?>">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="../../images/rajabhat-logo.png" type="image/x-icon" />
  <?php $this->registerCsrfMetaTags(); ?>
  <title> ระบบสารสนเทศภูมิศาสตร์​แหล่งท่องเที่ยวเชิงเกษตร​</title>
  <title><?= Html::encode($this->title); ?></title>
  <?php $this->head(); ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="../../images/rajabhat-logo.png">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Plugins CSS -->
  <link rel="stylesheet" type="text/css" href="../../themes/template/assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../../themes/template/assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="../../themes/template/assets/vendor/tiny-slider/tiny-slider.css">
  <link rel="stylesheet" type="text/css" href="../../themes/template/assets/vendor/glightbox/css/glightbox.css">

  <!-- Theme CSS -->
  <link id="style-switch" rel="stylesheet" type="text/css" href="../../themes/template/assets/css/style.css">

  <!-- Leaflet Map -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src="../../js/mapBox/Leaflet.Control.Custom.js"></script>
</head>

<style>
  .navbar-light .navbar-nav .nav-link {
    color: #595d69;
    width: 100%;
    padding-right: 0;
  }

  .yii-debug-toolbar:not(.yii-debug-toolbar_active) .yii-debug-toolbar__bar,
  .yii-debug-toolbar.yii-debug-toolbar_animating .yii-debug-toolbar__bar {
    height: 40px;
    display: none;
  }

  .leaflet-control-layers section {
    padding-top: 1em !important;
    padding-bottom: 1em !important;
  }

  /* .container {
    max-width: 100% !important;
  } */

  .logo-support {
    height: 6em;
    width: auto;
    min-width: 4em;
  }

  .min-w-7 {
    min-width: 7em;
  }

  .navbar-sticky-custom {
    background-color: #0d6efd !important;
  }

  .nav-link-custom {
    color: white !important;
  }

  .navbar-light .navbar-nav .nav-link:hover,
  .navbar-light .navbar-nav .nav-link:focus {
    /* color: #ECF0F1; */
    color: #2163e8;
    background-color: transparent;
  }

  .navbar-nav .nav-link,
  .nav-link-text {
    font-size: 1.1em !important;
  }

  .img-box-news {
    height: 17em;
    object-fit: cover;
  }

  .img-sm-box {
    height: 6em;
    object-fit: cover;
  }

  .img-md-box {
    height: 23em;
    object-fit: cover;
  }

  .img-lg-box {
    height: 30em;
    object-fit: cover;
  }
</style>

<?php $this->beginBody() ?>

<body>
  <!-- ======================= Header START -->
  <header class="navbar-light navbar-sticky header-static">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <!-- Logo START -->
        <a class="navbar-brand" href="index.php">
          <img class="navbar-brand-item light-mode-item" src="../../themes/template/assets/images/logo.svg" alt="logo">
          <img class="navbar-brand-item dark-mode-item" src="../../themes/template/assets/images/logo-light.svg" alt="logo">
        </a>
        <!-- ระบบสารสนเทศภูมิศาสตร์​แหล่งท่องเที่ยวเชิงเกษตร​ -->

        <!-- Responsive navbar toggler -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="text-body h6 d-none d-sm-inline-block">Menu</span>
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Main navbar START -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav navbar-nav-scroll mx-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="homeMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-street-view"></i> สถานที่</a>
              <ul class="dropdown-menu" aria-labelledby="homeMenu">

                <?php foreach ($modelTypePlace as $modelType) : ?>
                  <li><a class="dropdown-item nav-link-text" href="index.php?r=place/index&amp;type=<?= $modelType->id ?>"><i class="<?= $modelType->m_icon ?>"></i> <?= $modelType->name ?></a></li>
                <?php endforeach ?>

              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="index.php?r=travel-map/index"><i class="fas fa-map-marked-alt"></i> แผนที่</a></li>
            <?php foreach ($menuMain as $menu) : ?>
              <li class="nav-item"><a class="nav-link" href="<?= $menu->m_link ?>"><i class="<?= $menu->m_icon ?>"></i> <?= $menu->m_name ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>
        <!-- Main navbar END -->
        <!-- Nav right START -->
        <div class="nav flex-nowrap align-items-center">
          <!-- Nav Search -->
          <div class="nav-item dropdown dropdown-toggle-icon-none nav-search">
            <a class="nav-link dropdown-toggle" role="button" href="#" id="navSearch" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-search fs-4"> </i>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow p-2" aria-labelledby="navSearch">

              <?php $form = ActiveForm::begin([
                'action' => ['package/index'],
                'method' => 'get',
                'options' => [
                  'class' => 'input-group',
                  'style' => 'margin-bottom: 0px;'
                ]
              ]); ?>

              <input class="form-control border-success" name="name" value="" type="search" placeholder="Package ท่องเที่ยว" aria-label="Search">
              <button class="btn btn-success m-0" type="submit">ค้นหา</button>

              <?php ActiveForm::end(); ?>

            </div>
          </div>
        </div>
        <!-- Nav right END -->
      </div>
    </nav>
    <!-- Logo Nav END -->
  </header>
  <!-- ======================= Header END -->
  <!-- **************** MAIN CONTENT START **************** -->
  <main>
    <!-- ======================= Main content START -->
    <section class="position-relative">
      <div class="container" data-sticky-container>
        <div class="row">
          <!-- Main Post START -->
          <!-- <div class="col-lg-12"> -->

          <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>
          <?= Alert::widget() ?>
          <?= $content ?>

          <!-- </div> -->
          <!-- Main Post END -->

        </div> <!-- Row end -->
      </div>
    </section>
    <!-- ======================= Main content END -->

    <!-- Divider -->
    <div class="container">
      <div class="border-bottom border-primary border-2 opacity-1"></div>
    </div>

    <!-- ======================= Section START -->
    <section class="pt-4">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Title -->
            <div class="mb-4 d-md-flex justify-content-between align-items-center">
              <h2 class="m-0"><i class="bi bi-megaphone"></i> ข่าวประชาสัมพันธ์</h2>
            </div>
            <div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round">
              <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="24" data-arrow="true" data-dots="false" data-items-xl="4" data-items-md="3" data-items-sm="2" data-items-xs="1">

                <!-- Card item START -->
                <?php foreach ($modeNews as $modeNews) :  ?>
                  <div class="card">
                    <!-- Card img -->
                    <div class="position-relative">
                      <img class="card-img img-box-news" src="<?= '../../images/images_upload_forform/' . $modeNews->name_img_important ?>" alt="Card image">
                      <div class="card-img-overlay d-flex align-items-start flex-column p-3">

                        <div class="w-100 mt-auto">
                          <a href="#" class="badge bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>News</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body px-0 pt-3">
                      <h5 class="card-title"><a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['public-relations/view', 'id' => $modeNews->id]) ?>" class="btn-link text-reset fw-bold"><?= $modeNews->topic ?></a></h5>
                      <!-- Card info -->
                      <p>
                        <?= $modeNews->date_imparting ?>
                      </p>
                    </div>
                  </div>
                <?php endforeach  ?>
                <!-- Card item END -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======================= Section END -->

  </main>
  <!-- **************** MAIN CONTENT END **************** -->

  <!-- ======================= Footer START -->
  <footer class="bg-dark pt-5">
    <div class="container">
      <!-- About and Newsletter START -->
      <div class="row pt-3 pb-4">
        <div class="col-md-3">
          <img src="../../themes/template/assets/images/logo-footer.svg" alt="footer logo">
        </div>
      </div>
      <!-- About and Newsletter END -->

      <!-- Divider -->
      <hr>

      <!-- Widgets START -->
      <div class="row pt-5">
        <!-- Footer Widget -->
        <div class="col-md-6 col-lg-3 mb-4">
          <h5 class="mb-4 text-white">Recent post</h5>
          <!-- Item -->
          <div class="mb-4 position-relative">
            <div><a href="#" class="badge bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Business</a></div>
            <a href="post-single-3.html" class="btn-link text-white fw-normal">Up-coming business bloggers,
              you need to watch</a>
            <ul class="nav nav-divider align-items-center small mt-2 text-muted">
              <li class="nav-item position-relative">
                <div class="nav-link">by <a href="#" class="stretched-link text-reset btn-link">Dennis</a>
                </div>
              </li>
              <li class="nav-item">Apr 06, 2021</li>
            </ul>
          </div>
          <!-- Item -->
          <div class="mb-4 position-relative">
            <div><a href="#" class="badge bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Marketing</a></div>
            <a href="post-single-3.html" class="btn-link text-white fw-normal">How did we get here? The
              history of the business told through tweets</a>
            <ul class="nav nav-divider align-items-center small mt-2 text-muted">
              <li class="nav-item position-relative">
                <div class="nav-link">by <a href="#" class="stretched-link text-reset btn-link">Larry</a>
                </div>
              </li>
              <li class="nav-item">May 29, 2021</li>
            </ul>
          </div>
        </div>

        <!-- Footer Widget -->
        <div class="col-md-6 col-lg-3 mb-4">
          <h5 class="mb-4 text-white">Navigation</h5>
          <div class="row">
            <div class="col-6">
              <ul class="nav flex-column text-primary-hover">
                <li class="nav-item"><a class="nav-link pt-0" href="#">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Style Guide</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Get Theme</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Support</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Privacy Policy</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Newsletter</a></li>
              </ul>
            </div>
            <div class="col-6">
              <ul class="nav flex-column text-primary-hover">
                <li class="nav-item"><a class="nav-link pt-0" href="#">News</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Career <span class="badge bg-danger ms-2">2 Job</span></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Technology</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Startups</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Gadgets</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Inspiration</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Footer Widget -->
        <div class="col-sm-6 col-lg-3 mb-4">
          <h5 class="mb-4 text-white">Get Regular Updates</h5>
          <ul class="nav flex-column text-primary-hover">
            <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-whatsapp fa-fw me-2"></i>WhatsApp</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-youtube fa-fw me-2"></i>YouTube</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-bell fa-fw me-2"></i>Website
                Notifications</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-envelope fa-fw me-2"></i>Newsletters</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-headphones-alt fa-fw me-2"></i>Podcasts</a></li>
          </ul>
        </div>

        <!-- Footer Widget -->
        <div class="col-sm-6 col-lg-3 mb-4">
          <h5 class="mb-4 text-white">Our mobile App</h5>
          <p class="text-muted">Download our App and get the latest Breaking News Alerts and latest headlines
            and daily articles near you.</p>
          <div class="row g-2">
            <div class="col">
              <a href="#"><img class="w-100" src="../../themes/template/assets/images/app-store.svg" alt="app-store"></a>
            </div>
            <div class="col">
              <a href="#"><img class="w-100" src="../../themes/template/assets/images/google-play.svg" alt="google-play"></a>
            </div>
          </div>
        </div>
      </div>
      <!-- Widgets END -->

      <!-- Hot topics START -->
      <div class="row">
        <h5 class="mb-2 text-white">Hot topics</h5>
        <ul class="list-inline text-primary-hover lh-lg">
          <li class="list-inline-item"><a href="#">Covid-19</a></li>
          <li class="list-inline-item"><a href="#">Politics</a></li>
          <li class="list-inline-item"><a href="#">Entertainment</a></li>
          <li class="list-inline-item"><a href="#">Media</a></li>
          <li class="list-inline-item"><a href="#">Royalist</a></li>
          <li class="list-inline-item"><a href="#">World</a></li>
          <li class="list-inline-item"><a href="#">Half Full</a></li>
          <li class="list-inline-item"><a href="#">Scouted</a></li>
          <li class="list-inline-item"><a href="#">Travel</a></li>
          <li class="list-inline-item"><a href="#">Beast Inside</a></li>
          <li class="list-inline-item"><a href="#">Crossword</a></li>
          <li class="list-inline-item"><a href="#">Newsletters</a></li>
          <li class="list-inline-item"><a href="#">Podcasts</a></li>
          <li class="list-inline-item"><a href="#">Auction 2021</a></li>
          <li class="list-inline-item"><a href="#">Protests</a></li>
          <li class="list-inline-item"><a href="#">NewsCyber</a></li>
          <li class="list-inline-item"><a href="#">Education</a></li>
          <li class="list-inline-item"><a href="#">Sports</a></li>
          <li class="list-inline-item"><a href="#">Tech And Auto</a></li>
          <li class="list-inline-item"><a href="#">Opinion</a></li>
          <li class="list-inline-item"><a href="#">Share Market</a></li>
        </ul>
      </div>
      <!-- Hot topics END -->
    </div>

    <!-- Footer copyright START -->
    <div class="bg-dark-overlay-3 mt-5">
      <div class="container">
        <div class="row align-items-center justify-content-md-between py-4">
          <div class="col-md-6">
            <!-- Copyright -->
            <div class="text-center text-md-start text-primary-hover text-muted">©2021 <a href="https://www.webestica.com/" class="text-reset btn-link" target="_blank">Webestica</a>. All rights reserved
            </div>
          </div>
          <!-- <div class="col-md-6 d-sm-flex align-items-center justify-content-center justify-content-md-end">
            <div class="dropup me-0 me-sm-3 mt-3 mt-md-0 text-center text-sm-end">
              <a class="dropdown-toggle text-primary-hover" href="#" role="button" id="languageSwitcher" data-bs-toggle="dropdown" aria-expanded="false">
                English Edition
              </a>
              <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                <li><a class="dropdown-item" href="#">English</a></li>
                <li><a class="dropdown-item" href="#">German </a></li>
                <li><a class="dropdown-item" href="#">French</a></li>
              </ul>
            </div>
            <ul class="nav text-primary-hover text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
              <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
              <li class="nav-item"><a class="nav-link pe-0" href="#">Cookies</a></li>
            </ul>
          </div> -->
        </div>
      </div>
    </div>
    <!-- Footer copyright END -->
  </footer>
  <!-- ======================= Footer END -->

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

  <!-- ======================= JS libraries, plugins and custom scripts -->

  <!-- Bootstrap JS -->
  <script src="../../themes/template/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Vendors -->
  <script src="../../themes/template/assets/vendor/tiny-slider/tiny-slider.js"></script>
  <script src="../../themes/template/assets/vendor/sticky-js/sticky.min.js"></script>
  <script src="../../themes/template/assets/vendor/glightbox/js/glightbox.js"></script>
  <script src="../../themes/template/assets/vendor/jarallax/jarallax.min.js"></script>
  <script src="../../themes/template/assets/vendor/jarallax/jarallax-video.min.js"></script>

  <!-- Template Functions -->
  <script src="../../themes/template/assets/js/functions.js"></script>
  <script src="../../js/myJS/functions.js"></script>

  <?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>
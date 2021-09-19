<!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script> -->
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

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


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

  <title> ระบบสารสนเทศเพื่อการจัดการแหล่งท่องเที่ยวเกษตรเชิงนิเวศ​</title>
  <title><?= Html::encode($this->title); ?></title>

  <?php $this->head(); ?>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../../images/rajabhat-logo.png">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Price Slider Stylesheets -->
  <link rel="stylesheet" href="../assets/vendor/nouislider/nouislider.css">

  <!-- swiper-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">

  <!-- Magnigic Popup-->
  <link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css">

  <!-- theme stylesheet-->
  <link rel="stylesheet" href="../assets/css/style.default.css" id="theme-stylesheet">

  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="../assets/css/custom.css">

  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <!-- Plugins CSS -->
  <link rel="stylesheet" type="text/css" href="../../themes/template/assets/vendor/glightbox/css/glightbox.css">

  <!-- Leaflet Map -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src="../../js/mapBox/Leaflet.Control.Custom.js"></script>
</head>
<?php $this->beginBody() ?>

<body class="body-content-custom">
  <header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <a class="navbar-brand py-0" style="margin-right: 30px;" href="index.php">
            <img class="logo-support" src="../../images/TSRI.png" alt="">
            <img class="logo-support" src="../../images/Logo_nstru.png" alt="">
            <a>ระบบสารสนเทศเพื่อการจัดการแหล่งท่องเที่ยวเกษตรเชิงนิเวศ​</a>
          </a>
        </div>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="homeDropdownMenuLink" href="index.html" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">สถานที่</a>
              <div class="dropdown-menu" aria-labelledby="homeDropdownMenuLink">
                <?php foreach ($modelTypePlace as $modelType) : ?>
                  <a class="dropdown-item" href="index.php?r=place/index&amp;type=<?= $modelType->id ?>"> <?= $modelType->name ?></a>
                <?php endforeach ?>
                <!-- <a class="dropdown-item" href="">Real Estate <span class="badge badge-info-light ms-1 mt-n1">New</span></a> -->
              </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="index.php?r=travel-map/index">แผนที่</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?r=file-list/index">วีดิโอน่าสนใจ</a></li>
            <?php foreach ($menuMain as $menu) : ?>
              <li class="nav-item"><a class="nav-link" href="<?= $menu->m_link ?>"><?= $menu->m_name ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- /Navbar -->
  </header>

  <?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
  ]) ?>
  <?= Alert::widget() ?>
  <?= $content ?>

  <!-- ======================= Footer START -->
  <footer class="position-relative z-index-10 d-print-none">
    <!-- Main block - menus, subscribe form-->
    <div class="py-0 bg-gray-100 text-muted">
      <section>
        <div class="container-fluid px-0">
          <div class="swiper-container instagram-slider">
            <div class="swiper-wrapper" style="height: 26%;">
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-1.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-1.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-2.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-2.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-3.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-3.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-4.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-4.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-5.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-5.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-6.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-6.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-7.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-7.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-8.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-8.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-9.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-9.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-10.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-10.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-11.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-11.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-12.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-12.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-13.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-13.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-14.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-14.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-10.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-10.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-11.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-11.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-12.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-12.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-13.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-13.jpg" alt=" "></a></div>
              <div class="swiper-slide overflow-hidden"><a href="../assets/img/instagram/instagram-14.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid hover-scale" src="../assets/img/instagram/instagram-14.jpg" alt=" "></a></div>
            </div>
          </div>
        </div>
      </section>
      <div class="container py-4">
        <div class="wrap-footer-address">
          <div class="footer-address">
            <div class="wrap-address">
              <div class="label">ระบบสารสนเทศเพื่อการจัดการแหล่งท่องเที่ยวเกษตรเชิงนิเวศ​</div>
              <p class="address">มหาวิทยาลัยราชภัฏนครศรีธรรมราช 1 ม. 4 ต.ท่างิ้ว อ.เมืองนครศรีธรรมราช จ.นครศรีธรรมราช 80280 </p>
              <p class="address">โทร. 075-392039</p>
              <p class="address">แฟ็กซ์. 075-392031​</p>
              <p class="address">อีเมล. www@nstru.ac.th​</p>
              <p class="address">ติดต่อ.​ คุณพรศิลป์​ บัวงาม​ 091-8262827​</p>
            </div>
          </div>
          <div class="footer-logo">
            <img class="logo" src="../../images/TSRI.png" alt="">
            <img class="logo" src="../../images/Logo_nstru.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright section of the footer-->
    <div class="py-4 fw-light bg-gray-800 text-gray-300">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 text-center text-md-start">
            <p class="text-sm mb-md-0">&copy; 2021 All rights reserved.</p>
          </div>
          <div class="col-md-6">
            <ul class="list-inline mb-0 mt-2 mt-md-0 text-center text-md-end">
              <li class="list-inline-item"><img class="w-2rem" src="../assets/img/visa.svg" alt="..."></li>
              <li class="list-inline-item"><img class="w-2rem" src="../assets/img/mastercard.svg" alt="..."></li>
              <li class="list-inline-item"><img class="w-2rem" src="../assets/img/paypal.svg" alt="..."></li>
              <li class="list-inline-item"><img class="w-2rem" src="../assets/img/western-union.svg" alt="..."></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ======================= Footer END -->


  <!-- ======================= JS libraries, plugins and custom scripts -->

  <!-- JavaScript files-->
  <script>
    function injectSvgSprite(path) {

      var ajax = new XMLHttpRequest();
      ajax.open("GET", path, true);
      ajax.send();
      ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
      }
    }

    injectSvgSprite('https://demo.bootstrapious.com/directory/1-4/icons/orion-svg-sprite.svg');
  </script>
  <!-- jQuery-->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <!-- Bootstrap JS bundle - Bootstrap + PopperJS-->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Magnific Popup - Lightbox for the gallery-->
  <script src="../assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Smooth scroll-->
  <script src="../assets/vendor/smooth-scroll/smooth-scroll.polyfills.min.js"></script>
  <!-- Bootstrap Select-->
  <script src="../assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
  <!-- Object Fit Images - Fallback for browsers that don't support object-fit-->
  <script src="../assets/vendor/object-fit-images/ofi.min.js"></script>
  <!-- Swiper Carousel                       -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/js/swiper.min.js"></script>
  <script src="../assets/js/theme.js"></script>

  <script src="../../themes/template/assets/vendor/jarallax/jarallax.min.js"></script>
  <script src="../../themes/template/assets/vendor/jarallax/jarallax-video.min.js"></script>
  <script src="../../themes/template/assets/vendor/glightbox/js/glightbox.js"></script>

  <!-- glightbox script -->
  <script>
    const isVariableDefined = (el) => {
      return typeof !!el && (el) != 'undefined' && el != null;
    }

    const light = document.querySelector('[data-glightbox]');
    if (isVariableDefined(light)) {
      GLightbox({
        selector: '*[data-glightbox]',
        openEffect: 'fade',
        closeEffect: 'fade'
      });
    }
  </script>
  <!-- glightbox strip end -->


  <!-- Vendors -->
  <script src="../../themes/template/assets/vendor/isotope/isotope.pkgd.min.js"></script>
  <script src="../../themes/template/assets/vendor/imagesLoaded/imagesloaded.js"></script>

  <!-- Template Functions -->
  <script src="../../themes/template/assets/js/functions.js"></script>


  <!-- Initialize Swiper -->
  <script>
    const swiper = new Swiper(".my-swiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      roundLengths: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      // ex4: {
      //   width: 110,
      //   height: 110,
      //   overflow: visible,
      // }
    });

    const handlePagination = () => {
      const pre = document.querySelector('.page-item.prev.disabled');
      const next = document.querySelector('.page-item.next.disabled');

      if (pre !== null) {
        pre.innerHTML = '<a class="page-link">pre</a>'
      }

      if (next !== null) {
        next.innerHTML = '<a class="page-link">next</a>'
      }
    }

    handlePagination();
  </script>
  <!-- Main Theme JS file    -->
  <?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>
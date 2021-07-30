<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "1fc41a7e-c22d-4c94-9359-dcda7892d553",
    });
  });

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

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

use app\models\EformTemplate;
use app\models\Eform;
use app\models\Users;
use app\models\Unit;
use app\models\Setting;
use app\models\Notification;

AppAsset::register($this);

if (empty($_SESSION['user_id'])) {
  echo "<script>window.location='index.php?r=site/logout_clear'</script>";
}

// Start :: User Website Usaged
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
$active_url = str_replace("http://45.127.62.51:7000/textx/frontend/web/", "", $actual_link);
$users_now = Users::find()->where("id = '" . $_SESSION['user_id'] . "'")->one();
$unit_now = Unit::find()->where("unit_id = '" . $users_now['unit_id'] . "'")->one();
$ip = $_SERVER['REMOTE_ADDR'];
$log_date = date("Y-m-d H:i:s");
$date_now = date("Y-m-d");
$command = Yii::$app->db->createCommand("INSERT INTO `user_website_usaged`(`user_id`, `user_name`, `unit_id`, `unit_name`, `url_website`, `create_date`,`ip_address`) VALUES ('" . $users_now['id'] . "','" . $users_now['name'] . "','" . $unit_now['unit_id'] . "','" . $unit_now['unit_name'] . "','" . $active_url . "','" . $log_date . "','" . $ip . "')")->execute();
// Stop :: User Website Usaged

$sql_user_role = ($_SESSION['user_role'] != '3') ? "SELECT * FROM `user_role` WHERE id = '" . $_SESSION['user_role'] . "'" : "SELECT * FROM `user_group` WHERE id = '" . $_SESSION['user_group'] . "'";
$menu = Yii::$app->db->createCommand($sql_user_role)->queryOne();
$menu_main_role = str_replace('[', '', $menu['allow_access_main']);
$menu_main_role = str_replace(']', '', $menu_main_role);
$menu_main_role = str_replace('"', '\'', $menu_main_role);

if (!empty($menu_main_role)) {
  $where_main_id = "AND id IN (" . $menu_main_role . ")";
} else {
  $where_main_id = "";
}
$_SESSION['where_main_id'] =  $menu_main_role;

$menu_sub_role = str_replace('[', '', $menu['allow_access_sub']);
$menu_sub_role = str_replace(']', '', $menu_sub_role);
$menu_sub_role = str_replace('"', '\'', $menu_sub_role);

if (!empty($menu_sub_role)) {
  $where_sub_id = "AND submenu_id IN (" . $menu_sub_role . ")";
} else {
  $where_sub_id = "";
}

$ALL_URL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$PHP_SELF = explode("/", $ALL_URL);
$rr = array_slice($PHP_SELF, 4);
$r_url = implode("/", $rr);

$check_isn_database_main = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `menu_main` WHERE m_link = '" . $r_url . "' AND m_status = 'Y'")->queryScalar();

$check_isn_database_sub = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `menu_sub` WHERE submenu_link = '" . $r_url . "' AND submenu_active = 'Y'")->queryScalar();

$check_isn_database = $check_isn_database_sub + $check_isn_database_main;

if ($check_isn_database > 0) {
  if (!empty($where_main_id)) {
    $check_url_main = Yii::$app->db->createCommand("SELECT * FROM `menu_main` WHERE m_link != '' AND m_status = 'Y' $where_main_id")->queryAll();

    $check_main_count = 0;
    foreach ($check_url_main as $url_main) {
      if (strstr($ALL_URL, $url_main['m_link'])) {
        $check_main_count = $check_main_count + 1;
      } else {
        $check_main_count = $check_main_count + 0;
      }
    }
  } else {
    $check_main_count = 0;
  }


  if (!empty($where_sub_id)) {
    $check_url_sub = Yii::$app->db->createCommand("SELECT * FROM `menu_sub` WHERE submenu_active = 'Y' $where_sub_id")->queryAll();
    $check_sub_count = 0;
    foreach ($check_url_sub as $url_sub) {
      if (strstr($ALL_URL, $url_sub['submenu_link'])) {
        $check_sub_count = $check_sub_count + 1;
      } else {
        $check_sub_count = $check_sub_count + 0;
      }
    }
  } else {
    $check_sub_count = 0;
  }

  $check_all_count =  $check_main_count + $check_sub_count;


  if ($check_all_count == 0) {
    echo "<script>window.location='index.php?r=site/pages&view=alert_permission'</script>";
  }
}


$user_font_size = Yii::$app->db->createCommand("SELECT font_size FROM `users` WHERE id = '" . $_SESSION['user_id'] . "'")->queryone();
?>


<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>" dir="ltr">

<head>
  <meta charset="<?= Yii::$app->charset; ?>">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="../../images/favicon_io/favicon.ico" type="image/x-icon" />
  <?php $this->registerCsrfMetaTags(); ?>
  <title> ระบบสารสนเทศภูมิศาสตร์​แหล่งท่องเที่ยวเชิงเกษตร​</title>
  <title><?= Html::encode($this->title); ?></title>
  <?php $this->head(); ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="../../themes/template/assets/images/favicon.ico">

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

  .container {
    max-width: 100% !important;
  }
</style>

<?php $this->beginBody() ?>

<body>

  <!-- Top alert START -->
  <div class="alert alert-warning py-2 m-0 bg-primary border-0 rounded-0 alert-dismissible fade show text-center overflow-hidden" role="alert">
    <!-- SVG shape START -->
    <figure class="position-absolute top-50 start-50 translate-middle">
      <svg width="1848" height="481" viewBox="0 0 1848.9 481.8" xmlns="http://www.w3.org/2000/svg">
        <path class="fill-success" d="m779.4 251c-10.3-11.5-19.9-23.8-29.4-36.1-9-11.6-18.4-22.8-27.1-34.7-15.3-21.2-30.2-45.8-54.8-53.3-10.5-3.2-21.6-3.2-30.6 2.5-7.6 4.8-13 12.6-17.3 20.9-10.8 20.6-16.1 44.7-24.6 66.7-7.9 20.2-19.4 38.6-33.8 54.3-14.7 16.2-31.7 30-50.4 41-15.9 9.4-33.4 17.2-52 19.3-18.4 2-38-2.5-56.5-6.2-22.4-4.4-45.1-9.7-67.6-10.9-9.8-0.5-19.8-0.3-29.1 2.3-9.8 2.8-18.7 8.6-26.6 15.2-17.3 14.5-30.2 34.4-43.7 52.9-12.9 17.6-26.8 34.9-45.4 45.4-19.5 11-42.6 12.1-65 6.6-52.3-13.1-93.8-56.5-127.9-101.5-8.8-11.6-17.3-23.4-25.6-35.4-0.6-0.9-1.1-1.8-1.6-2.7-1.1-2.4-0.9-2.6 0.6-1.2 1 0.9 1.9 1.9 2.7 3 35.3 47.4 71.5 98.5 123.2 123.9 22.8 11.2 48.2 17.2 71.7 12.2 23-5 40.6-21.2 55.3-39.7 24.5-30.7 46.5-75.6 87.1-83 19.5-3.5 40.7 0.1 60.6 3.7 21.2 3.9 42.3 9.1 63.6 11.7 17.8 2.3 35.8-0.1 52.2-7 20-8.1 38.4-20.2 54.8-34.6 16.2-14.1 31-30.7 41.8-50.4 11.1-20.2 17-43.7 24.9-65.7 6.1-16.9 13.8-36.2 29.3-44.5 16.1-8.6 37.3-1.9 52.3 10.6 18.7 15.6 31.2 39.2 46.7 58.2" />
        <path class="fill-warning" d="m1157.9 344.9c9.8 7.6 18.9 15.8 28.1 24 8.6 7.7 17.6 15.2 26 23.2 14.8 14.2 29.5 30.9 51.2 34.7 9.3 1.6 18.8 0.9 26.1-3.8 6.1-3.9 10.2-9.9 13.2-16.2 7.6-15.6 10.3-33.2 15.8-49.6 5.2-15.1 13.6-29 24.7-41.3 11.4-12.6 24.8-23.6 40-32.8 12.9-7.8 27.3-14.6 43.1-17.3 15.6-2.6 32.8-0.7 49 0.7 19.6 1.7 39.4 4 58.8 3.4 8.4-0.3 17-1.1 24.8-3.6 8.2-2.7 15.4-7.4 21.6-12.7 13.7-11.6 23.1-26.7 33.3-40.9 9.6-13.5 20.2-26.9 35.3-35.6 15.8-9.2 35.6-11.6 55.2-9.1 45.7 5.8 84.8 34.3 117.6 64.4 8.7 8 17.2 16.2 25.6 24.6 2.5 3.2 1.9 3-1.2 1-34.3-32-69.7-66.9-116.5-81.9-20.5-6.5-42.7-9.2-62.4-4-19.3 5.1-33.1 17.9-44.3 32.2-18.5 23.7-33.9 57.5-68.1 65.5-16.5 3.8-34.9 2.6-52.3 1.3-18.5-1.4-37-3.7-55.4-4.2-15.5-0.5-30.7 2.5-44.2 8.5-16.5 7.2-31.3 17.1-44.3 28.5-12.8 11.2-24.1 24.1-31.9 39-7.9 15.3-11.1 32.5-16.2 48.9-3.9 12.6-9 26.9-21.6 33.9-13.1 7.3-31.9 3.8-45.7-4.1-17.2-10-29.9-26.1-44.6-38.8" />
        <path class="fill-warning" d="m1840.8 379c-8.8 40.3-167.8 79.9-300.2 45.3-42.5-11.1-91.4-32-138.7-11.6-38.7 16.7-55 66-90.8 67.4-25.1 1-48.6-20.3-58.1-39.8-31-63.3 50.7-179.9 155.7-208.1 50.4-13.5 97.3-3.2 116.1 1.6 36.3 9.3 328.6 87.4 316 145.2z" />
        <path class="fill-success" d="M368.3,247.3C265.6,257.2,134,226,110.9,141.5C85,47.2,272.5-9.4,355.5-30.7s182.6-31.1,240.8-18.6    C677.6-31.8,671.5,53.9,627,102C582.6,150.2,470.9,237.5,368.3,247.3z" />
      </svg>
    </figure>
    <!-- SVG shape END -->
    <button type="button" class="btn-close btn-close-white opacity-9 p-3" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <!-- Top alert END -->

  <!-- Offcanvas START -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header">
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column pt-0">
      <div>
        <img class="light-mode-item my-3" src="../../themes/template/assets/images/logo.svg" alt="logo">
        <img class="dark-mode-item my-3" src="../../themes/template/assets/images/logo-light.svg" alt="logo">
        <p>The next-generation blog, news, and magazine theme for you to start sharing your stories today! </p>
        <!-- Nav START -->
        <ul class="nav d-block flex-column my-4">

          <li class="nav-item">
            <a href="index.html" class="nav-link h5">Home</a>
          <li class="nav-item">
            <a class="nav-link h5" href="about-us.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h5" href="post-grid.html">Our Journal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link h5" href="contact-us.html">Contact Us</a>
          </li>
        </ul>
        <!-- Nav END -->
        <div class="bg-primary-soft p-4 mb-4 text-center w-100 rounded">
          <span>The Blogzine</span>
          <h3>Save on Premium Membership</h3>
          <p>Get the insights report trusted by experts around the globe. Become a Member Today!</p>
          <a href="#" class="btn btn-warning">View pricing plans</a>
        </div>
      </div>
      <div class="mt-auto pb-3">
        <!-- Address -->
        <p class="text-body mb-2 fw-bold">New York, USA (HQ)</p>
        <address class="mb-0">750 Sing Sing Rd, Horseheads, NY, 14845</address>
        <p class="mb-2">Call: <a href="#" class="text-body"><u>469-537-2410</u> (Toll-free)</a> </p>
        <a href="#" class="text-body d-block">hello@blogzine.com</a>
      </div>
    </div>
  </div>
  <!-- Offcanvas END -->

  <!-- =======================
Header START -->
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

            <li class="nav-item"><a class="nav-link" href="index.php?r=public-relations%2Findex&type=1"><i class="fas fa-newspaper"></i> ข่าวประชาสัมพันธ์</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?r=public-relations%2Findex&amp;type=2"><i class="fas fa-user-tie"></i> ข้อควรรู้สำหรับนักท่องเที่ยว (infographic)</a></li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="homeMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-street-view"></i> สถานที่</a>
              <ul class="dropdown-menu" aria-labelledby="homeMenu">
                <li><a class="dropdown-item" href="index.php?r=place/index&amp;type=1"><i class="fas fa-map-marked-alt"></i> แหล่งท่องเที่ยวเชิงเกษตร</a></li>
                <li><a class="dropdown-item" href="index.php?r=place%2Findex&amp;type=2"><i class="fas fa-utensils"></i> ร้านอาหาร</a></li>
                <li><a class="dropdown-item" href="index.php?r=place%2Findex&amp;type=3"><i class="fas fa-bed"></i> ที่พัก</a></li>
              </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="index.php?r=travel-map/index"><i class="fas fa-map-marked-alt"></i> แผนที่</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?r=package%2Findex"><i class="far fa-list-alt"></i> Package ท่องเที่ยว</a></li>

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
            <div class="dropdown-menu dropdown-menu-end shadow rounded p-2" aria-labelledby="navSearch">
              <form class="input-group">
                <input class="form-control border-success" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success m-0" type="submit">Search</button>
              </form>
            </div>
          </div>
          <!-- Offcanvas menu toggler -->
          <div class="nav-item">
            <a class="nav-link p-0" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
              <i class="bi bi-text-right rtl-flip fs-2" data-bs-target="#offcanvasMenu"> </i>
            </a>
          </div>
        </div>
        <!-- Nav right END -->
      </div>
    </nav>
    <!-- Logo Nav END -->
  </header>
  <!-- =======================
Header END -->

  <!-- **************** MAIN CONTENT START **************** -->
  <main>




    <!-- =======================
Main content START -->
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
    <!-- =======================
Main content END -->

    <!-- Divider -->
    <div class="container">
      <div class="border-bottom border-primary border-2 opacity-1"></div>
    </div>

    <!-- =======================
Section START -->
    <section class="pt-4">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Title -->
            <div class="mb-4 d-md-flex justify-content-between align-items-center">
              <h2 class="m-0"><i class="bi bi-megaphone"></i> Sponsored news</h2>
              <a href="#" class="text-body small"><u>Content by: Bootstrap</u></a>
            </div>
            <div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round">
              <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="24" data-arrow="true" data-dots="false" data-items-xl="4" data-items-md="3" data-items-sm="2" data-items-xs="1">

                <!-- Card item START -->
                <div class="card">
                  <!-- Card img -->
                  <div class="position-relative">
                    <img class="card-img" src="../../themes/template/assets/images/blog/4by3/07.jpg" alt="Card image">
                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                      <!-- Card overlay Top -->
                      <div class="w-100 mb-auto d-flex justify-content-end">
                        <div class="text-end ms-auto">
                          <!-- Card format icon -->
                          <div class="icon-md bg-white-soft bg-blur text-white fw-bold rounded-circle" title="8.5 rating">8.5</div>
                        </div>
                      </div>
                      <!-- Card overlay bottom -->
                      <div class="w-100 mt-auto">
                        <a href="#" class="badge bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Marketing</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body px-0 pt-3">
                    <h5 class="card-title"><a href="post-single-3.html" class="btn-link text-reset fw-bold">7 common mistakes everyone makes
                        while traveling</a></h5>
                    <!-- Card info -->
                    <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                      <li class="nav-item">
                        <div class="nav-link">
                          <div class="d-flex align-items-center position-relative">
                            <div class="avatar avatar-xs">
                              <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/07.jpg" alt="avatar">
                            </div>
                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Lori</a></span>
                          </div>
                        </div>
                      </li>
                      <li class="nav-item">Mar 07, 2021</li>
                    </ul>
                  </div>
                </div>
                <!-- Card item END -->
                <!-- Card item START -->
                <div class="card">
                  <!-- Card img -->
                  <div class="position-relative">
                    <img class="card-img" src="../../themes/template/assets/images/blog/4by3/08.jpg" alt="Card image">
                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                      <!-- Card overlay bottom -->
                      <div class="w-100 mt-auto">
                        <a href="#" class="badge bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Sports</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body px-0 pt-3">
                    <h5 class="card-title"><a href="post-single-3.html" class="btn-link text-reset fw-bold">Skills that you can learn from
                        business</a></h5>
                    <!-- Card info -->
                    <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                      <li class="nav-item">
                        <div class="nav-link">
                          <div class="d-flex align-items-center position-relative">
                            <div class="avatar avatar-xs">
                              <div class="avatar-img rounded-circle bg-warning">
                                <span class="text-dark position-absolute top-50 start-50 translate-middle fw-bold small">MK</span>
                              </div>
                            </div>
                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Joan</a></span>
                          </div>
                        </div>
                      </li>
                      <li class="nav-item">Aug 15, 2022</li>
                    </ul>
                  </div>
                </div>
                <!-- Card item END -->
                <!-- Card item START -->
                <div class="card">
                  <!-- Card img -->
                  <div class="position-relative">
                    <img class="card-img" src="../../themes/template/assets/images/blog/4by3/09.jpg" alt="Card image">
                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                      <!-- Card overlay bottom -->
                      <div class="w-100 mt-auto">
                        <a href="#" class="badge bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Marketing</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body px-0 pt-3">
                    <h5 class="card-title"><a href="post-single-3.html" class="btn-link text-reset fw-bold">10 tell-tale signs you need to get a
                        new business</a></h5>
                    <!-- Card info -->
                    <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                      <li class="nav-item">
                        <div class="nav-link">
                          <div class="d-flex align-items-center position-relative">
                            <div class="avatar avatar-xs">
                              <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/09.jpg" alt="avatar">
                            </div>
                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Bryan</a></span>
                          </div>
                        </div>
                      </li>
                      <li class="nav-item">Jun 01, 2021</li>
                    </ul>
                  </div>
                </div>
                <!-- Card item END -->
                <!-- Card item START -->
                <div class="card">
                  <!-- Card img -->
                  <div class="position-relative">
                    <img class="card-img" src="../../themes/template/assets/images/blog/4by3/10.jpg" alt="Card image">
                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                      <!-- Card overlay Top -->
                      <div class="w-100 mb-auto d-flex justify-content-end">
                        <div class="text-end ms-auto">
                          <!-- Card format icon -->
                          <div class="icon-md bg-white-soft bg-blur text-white rounded-circle" title="This post has images"><i class="fas fa-image"></i></div>
                        </div>
                      </div>
                      <!-- Card overlay bottom -->
                      <div class="w-100 mt-auto">
                        <a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Photography</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body px-0 pt-3">
                    <h5 class="card-title"><a href="post-single-3.html" class="btn-link text-reset fw-bold">This is why this year will be the
                        year of startups</a></h5>
                    <!-- Card info -->
                    <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                      <li class="nav-item">
                        <div class="nav-link">
                          <div class="d-flex align-items-center position-relative">
                            <div class="avatar avatar-xs">
                              <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/10.jpg" alt="avatar">
                            </div>
                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Samuel</a></span>
                          </div>
                        </div>
                      </li>
                      <li class="nav-item">Dec 07, 2022</li>
                    </ul>
                  </div>
                </div>
                <!-- Card item END -->
                <!-- Card item START -->
                <div class="card">
                  <!-- Card img -->
                  <div class="position-relative">
                    <img class="card-img" src="../../themes/template/assets/images/blog/4by3/11.jpg" alt="Card image">
                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                      <!-- Card overlay bottom -->
                      <div class="w-100 mt-auto">
                        <a href="#" class="badge bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Technology</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body px-0 pt-3">
                    <h5 class="card-title"><a href="post-single-3.html" class="btn-link text-reset fw-bold">Best Pinterest Boards for learning
                        about business</a></h5>
                    <!-- Card info -->
                    <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                      <li class="nav-item">
                        <div class="nav-link">
                          <div class="d-flex align-items-center position-relative">
                            <div class="avatar avatar-xs">
                              <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/12.jpg" alt="avatar">
                            </div>
                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Dennis</a></span>
                          </div>
                        </div>
                      </li>
                      <li class="nav-item">Sep 07, 2021</li>
                    </ul>
                  </div>
                </div>
                <!-- Card item END -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- =======================
Section END -->

  </main>
  <!-- **************** MAIN CONTENT END **************** -->

  <!-- =======================
Footer START -->
  <footer class="bg-dark pt-5">
    <div class="container">
      <!-- About and Newsletter START -->
      <div class="row pt-3 pb-4">
        <div class="col-md-3">
          <img src="../../themes/template/assets/images/logo-footer.svg" alt="footer logo">
        </div>
        <div class="col-md-5">
          <p class="text-muted">The next-generation blog, news, and magazine theme for you to start sharing
            your stories today! This Bootstrap 5 based theme is ideal for all types of sites that deliver
            the news.</p>
        </div>
        <div class="col-md-4">
          <!-- Form -->
          <form class="row row-cols-lg-auto g-2 align-items-center justify-content-end">
            <div class="col-12">
              <input type="email" class="form-control" placeholder="Enter your email address">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary m-0">Subscribe</button>
            </div>
            <div class="form-text mt-2">By subscribing you agree to our
              <a href="#" class="text-decoration-underline text-reset">Privacy Policy</a>
            </div>
          </form>
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
          <div class="col-md-6 d-sm-flex align-items-center justify-content-center justify-content-md-end">
            <!-- Language switcher -->
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
            <!-- Links -->
            <ul class="nav text-primary-hover text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
              <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
              <li class="nav-item"><a class="nav-link pe-0" href="#">Cookies</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer copyright END -->
  </footer>
  <!-- =======================
Footer END -->

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

  <!-- =======================
JS libraries, plugins and custom scripts -->

  <!-- Bootstrap JS -->
  <script src="../../themes/template/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Vendors -->
  <script src="../../themes/template/assets/vendor/tiny-slider/tiny-slider.js"></script>
  <script src="../../themes/template/assets/vendor/sticky-js/sticky.min.js"></script>
  <script src="../../themes/template/assets/vendor/glightbox/js/glightbox.js"></script>

  <!-- Template Functions -->
  <script src="../../themes/template/assets/js/functions.js"></script>

  <?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Package */


$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>

<style>
  .image2 {


    object-fit: cover;
    border-radius: 10px;
    box-shadow: 2px 3px 7px #00000096;
    margin: auto;
  }

  .rounded {

    height: 20vh;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 2px 3px 7px #00000096;
    width: 70vh;
    margin: auto;
  }

  .Namemann {
    color: black !important;
  }

  .text-line {
    color: #00c10f;
  }

  .text-phone {
    color: #f85f4f;
  }

  .phone-box {
    border: 1px solid transparent;
    background-color: transparent;
    padding: 0;
  }
</style>

<div class="package-view">

  <!-- Card item START -->
  <section class="pt-0 card-grid">
    <div class="row">
      <div class="col-12">
        <div class="tiny-slider arrow-hover arrow-blur arrow-white arrow-round rounded-3 overflow-hidden">
          <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="1" data-arrow="true" data-dots="false" data-items="1">
            <div class="card bg-dark-overlay-3 h-400 h-sm-500 h-md-600 rounded-0" style="background-image:url(<?= '../../images/images_upload_forform/' . $model->name_img_important ?>); background-position: center left; background-size: cover;">
              <div class="card-img-overlay d-flex align-items-center p-3 p-sm-5">
                <div class="w-100 my-auto">
                  <div class="col-md-10 col-lg-7 mx-auto text-center">
                    <h2 class="text-white display-5"><?= Html::encode($this->title) ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="position-relative pt-0">
    <div class="container" data-sticky-container>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="row">

              <div class="col-md-9 mt-3 mt-5 md-6">

                <!-- Detail -->
                <p><span class="dropcap bg-dark text-white px-2">I</span> <?= $model->details ?> </p>
                <!-- Images -->
                <div class="row g-2 my-5">
                  <?php foreach ($modelImage as $modelImage) :  ?>
                    <div class="col-md-4">
                      <a href="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" data-glightbox data-gallery="image-popup">
                        <img class="rounded" src="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" alt="Image">
                      </a>
                    </div>
                  <?php endforeach  ?>
                </div>

              </div>

              <div class="col-md-3 mt-3 mt-5 md-0">
                <div data-sticky data-margin-top="80" data-sticky-for="991">
                  <div class="row">
                    <h3>Contact</h3>
                  </div>
                  <!-- Contact START -->
                  <ul class="nav flex-column">

                    <li class="nav-item">
                      <a class="nav-link pt-0" target="_brank" href="#"><i class="fab fa-facebook-square fa-fw me-2 text-facebook"></i>Facebook</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="http://line.me/ti/p/"><i class="fab fa-line fa-fw me-2 text-line"></i>@Test_00</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="tel:"><i class="fas fa-phone-square-alt fa-fw me-2 text-phone"></i>080-00000</a>
                    </li>

                  </ul>
                </div>

                <h4 class="mt-4 mb-3">สถานที่ท่องเที่ยว</h4>
                <?php foreach ($modelPlace as $modelPlace) :  ?>
                  <!-- Recent post item -->
                  <div class="card border rounded-3 up-hover p-2 mb-2 mt-2">
                    <div class="card mb-1">
                      <a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $modelPlace->id]) ?>">
                        <div class="row g-3">
                          <div class="col-6">
                            <div class="image2">
                              <img class="rounded" src="<?= '../../images/images_upload_forform/' . $modelPlace->name_img_important ?>" alt="">
                            </div>
                          </div>
                          <div class="col-6 ">
                            <h5 class=" btn-link text-reset fw-normal Namemann"><?= $modelPlace->name ?></h5>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                <?php endforeach  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Card item END -->

</div>
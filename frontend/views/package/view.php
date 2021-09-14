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
  <section class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover" style="background-image: url('../assets/img/photo/restaurant-1515164783716-8e6920f3e77c.jpg');">
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
              <div class="col-lg-4 col-6 px-1 mb-2"><a href="../assets/img/photo/photo-1426122402199-be02db90eb90.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid" src="../assets/img/photo/photo-1426122402199-be02db90eb90.jpg" alt="..."></a></div>
              <div class="col-lg-4 col-6 px-1 mb-2"><a href="../assets/img/photo/photo-1512917774080-9991f1c4c750.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid" src="../assets/img/photo/photo-1512917774080-9991f1c4c750.jpg" alt="..."></a></div>
              <div class="col-lg-4 col-6 px-1 mb-2"><a href="../assets/img/photo/photo-1494526585095-c41746248156.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid" src="../assets/img/photo/photo-1494526585095-c41746248156.jpg" alt="..."></a></div>
              <div class="col-lg-4 col-6 px-1 mb-2"><a href="../assets/img/photo/photo-1484154218962-a197022b5858.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid" src="../assets/img/photo/photo-1484154218962-a197022b5858.jpg" alt="..."></a></div>
              <div class="col-lg-4 col-6 px-1 mb-2"><a href="../assets/img/photo/photo-1522771739844-6a9f6d5f14af.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid" src="../assets/img/photo/photo-1522771739844-6a9f6d5f14af.jpg" alt="..."></a></div>
              <div class="col-lg-4 col-6 px-1 mb-2"><a href="../assets/img/photo/photo-1488805990569-3c9e1d76d51c.jpg" data-glightbox data-gallery="image-popup"><img class="img-fluid" src="../assets/img/photo/photo-1488805990569-3c9e1d76d51c.jpg" alt="..."></a></div>
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
                    <use xlink:href="#fountain-pen-1"> </use>
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
            <div class="text-center">
              <p><a class="text-secondary" href="#"> <i class="fa fa-heart"></i> Bookmark This Listing</a></p><span>79 people bookmarked this place </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <section class="pt-0">
    <div class="container position-relative" data-sticky-container>
      <div class=" row">

        <div class="col-lg-8 mb-5">

          <p><?php $model->details ?> </p>

          <div class="row g-2 my-5">
            <?php if (count($modelImage) > 0) :  ?>
              <?php foreach ($modelImage as $modelImage) :  ?>
                <div class="col-md-4">
                  <a href="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" data-glightbox data-gallery="image-popup">
                    <img class="rounded" src="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" alt="Image">
                  </a>
                </div>
              <?php endforeach  ?>
            <?php endif ?>
          </div>
        </div>

        <div class="col-lg-4">
          <div data-sticky data-margin-top="80" data-sticky-for="991">
            <div class="row">
              <h3>Contact</h3>
            </div>
            <ul class="nav flex-column">
              <?php if ($model->facebook_link !== '') : ?>
                <li class="nav-item">
                  <a class="nav-link pt-0" target="_brank" href="<?= $model->facebook_link ?>"><i class="fab fa-facebook-square fa-fw me-2 text-facebook"></i>Facebook</a>
                </li>
              <?php endif ?>

              <?php if ($model->line_id !== '') : ?>
                <li class="nav-item">
                  <a class="nav-link" href="http://line.me/ti/p/<?= $model->line_id ?>"><i class="fab fa-line fa-fw me-2 text-line"></i><?= $model->line_id ?></a>
                </li>
              <?php endif ?>

              <?php if ($model->phone !== '') : ?>
                <li class="nav-item">
                  <a class="nav-link" href="tel:<?= Place::customizePhoneCall($model->phone) ?>"><i class="fas fa-phone-square-alt fa-fw me-2 text-phone"></i><?= $model->phone ?></a></form>
                </li>
              <?php endif ?>
            </ul>

            <div>
              <h4 class="mt-4 mb-3">สถานที่ท่องเที่ยว</h4>

              <?php if (count($modelPlace) > 0) :  ?>
                <?php foreach ($modelPlace as $modelPlace) : ?>
                  <div class="card mb-4">
                    <div class="row g-3">
                      <div class="col-4">
                        <img class="rounded-3" src="<?= '../../images/images_upload_forform/' . $modelPlace->name_img_important ?>" alt="">
                      </div>
                      <div class="col-8">
                        <h5><a href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => $modelPlace->id]) ?>" class="btn-link text-reset stretched-link fw-bold"><?= $modelPlace->name ?></a></h5>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
</div>
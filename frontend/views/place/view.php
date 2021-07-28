<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Place */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>

<style>
  .rounded {

    height: 20vh;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 2px 3px 7px #00000096;
    width: 70vh;
    margin: auto;
  }

  .text-line {
    color: #00c10f;
  }

  .text-phone {
    color: #f85f4f;
  }
</style>


<div class="place-view">
  <main>
    <!-- ======================= Inner intro START -->
    <section class="pt-2">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card bg-dark-overlay-5 overflow-hidden card-bg-scale h-400 text-center" style="background-image:url(../../themes/template/assets/images/blog/16by9/06.jpg); background-position: center left; background-size: cover;">
              <!-- Card Image overlay -->
              <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                <div class="w-100 my-auto">
                  <!-- Card category -->
                  <a href="#" class="badge bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Lifestyle</a>
                  <!-- Card title -->
                  <h2 class="text-white display-5"><?= $model->name ?></h2>
                  <!-- Card info -->
                  <ul class="nav nav-divider text-white-force align-items-center justify-content-center">
                    <li class="nav-item">
                      <div class="nav-link">
                        <div class="d-flex align-items-center text-white position-relative">
                          <div class="avatar avatar-sm">
                            <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/11.jpg" alt="avatar">
                          </div>
                          <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Louis</a></span>
                        </div>
                      </div>
                    </li>
                    <li class="nav-item">Nov 15, 2021</li>
                    <li class="nav-item">5 min read</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======================= Inner intro END -->

    <!-- ======================= Main START -->
    <section class="pt-0">
      <div class="container position-relative" data-sticky-container>
        <div class="row">
          <!-- Main Content START -->
          <div class="col-lg-9 mb-5">
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

            <h4 class="mt-4">Productive rant about business</h4>
            <div class="row mb-4">
              <div class="col-md-6">
                <p>Fulfilled direction use continual set him propriety continued. Saw met applauded favorite deficient engrossed concealed and her. Concluded boy perpetual old supposing. Farther related bed and passage comfort civilly. Dashwoods see frankness objection abilities. As hastened oh produced prospect formerly up am. Placing forming nay looking old married few has. Margaret disposed of add screened rendered six say his striking confined.
                </p>
              </div>
              <div class="col-md-6">
                <p>Meant balls it if up doubt small purse. Required his you put the outlived answered position. A pleasure exertion if believed provided to. All led out world this music while asked. Paid mind even sons does he door no. Attended overcame repeated it is perceived Marianne in. I think on style child of. Servants moreover in sensible it ye possible.</p>
              </div>
            </div>

            <p>Meant balls it if up doubt small purse. Required his you put the outlived answered position. A pleasure exertion if believed provided to. All led out world this music while asked. Paid mind even sons does he door no. Attended overcame repeated it is perceived Marianne in. I think on style child of. Servants moreover in sensible it ye possible. </p>
            <p> All led out world this music while asked. Paid mind even sons does he door no. Attended overcame repeated it is perceived Marianne in. I think on style child of. Servants moreover in sensible it ye possible. Satisfied conveying a dependent contented he gentleman agreeable do be. </p>

          </div>
          <!-- Main Content END -->
          <!-- Right sidebar START -->
          <div class="col-lg-3">
            <div data-sticky data-margin-top="80" data-sticky-for="991">
              <div class="row">
                <h5>Contact</h5>
              </div>

              <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link pt-0" target="_brank" href="<?= $model->facebook_link ?>"><i class="fab fa-facebook-square fa-fw me-2 text-facebook"></i>Facebook</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-line fa-fw me-2 text-line"></i><?= $model->line_id ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-phone-square-alt fa-fw me-2 text-phone"></i><?= $model->phone ?></a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-youtube-square fa-fw me-2 text-youtube"></i>YouTube</a></li> -->
              </ul>
              <!-- Newsletter START -->
              <div class="bg-primary-soft p-3 mt-4 rounded-3 text-center">
                <?= $model->contact ?>
              </div>
              <!-- Newsletter END -->

              <!-- Advertisement -->
              <div class="mt-4">
                <a href="#" class="d-block card-img-flash">
                  <img src="../../themes/template/assets/images/adv.png" alt="">
                </a>
              </div>
            </div>
          </div>
          <!-- Right sidebar END -->
        </div>
      </div>
    </section>
    <!-- ======================= Main END -->

    <!-- ======================= Sticky post START -->
    <div class="sticky-post bg-light border p-4 mb-5 text-sm-end rounded d-none d-xxl-block">
      <div class="d-flex align-items-center">
        <!-- Title -->
        <div class="me-3">
          <span>Next post<i class="bi bi-arrow-right ms-3"></i></span>
          <h6 class="m-0"> <a href="javascript:void(0)" class="stretched-link btn-link text-reset">Bad habits that people in the industry need to quit</a></h6>
        </div>
        <!-- image -->
        <div class="col-4 d-none d-md-block">
          <img src="../../themes/template/assets/images/blog/4by3/05.jpg" alt="Image">
        </div>
      </div>
    </div>
    <!-- ======================= Sticky post END -->
  </main>
</div>
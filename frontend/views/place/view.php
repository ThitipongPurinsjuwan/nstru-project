<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Place */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
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
          <div class="col-lg-12 mb-5">
            <p><span class="dropcap bg-dark text-white px-2">I</span> <?= $model->details ?> </p>
            <!-- Images -->
            <div class="row g-2 my-5">
              <div class="col-md-4">
                <a href="../../themes/template/assets/images/blog/3by4/01.jpg" data-glightbox data-gallery="image-popup">
                  <img class="rounded" src="../../themes/template/assets/images/blog/3by4/01.jpg" alt="Image">
                </a>
              </div>
              <div class="col-md-4">
                <a href="../../themes/template/assets/images/blog/3by4/02.jpg" data-glightbox data-gallery="image-popup">
                  <img class="rounded" src="../../themes/template/assets/images/blog/3by4/02.jpg" alt="Image">
                </a>
              </div>
              <div class="col-md-4">
                <a href="../../themes/template/assets/images/blog/3by4/03.jpg" data-glightbox data-gallery="image-popup">
                  <img class="rounded" src="../../themes/template/assets/images/blog/3by4/03.jpg" alt="Image">
                </a>
              </div>
              <div class="col-md-4">
                <a href="../../themes/template/assets/images/blog/3by4/04.jpg" data-glightbox data-gallery="image-popup">
                  <img class="rounded" src="../../themes/template/assets/images/blog/3by4/04.jpg" alt="Image">
                </a>
              </div>
              <div class="col-md-4">
                <a href="../../themes/template/assets/images/blog/3by4/05.jpg" data-glightbox data-gallery="image-popup">
                  <img class="rounded" src="../../themes/template/assets/images/blog/3by4/05.jpg" alt="Image">
                </a>
              </div>
              <div class="col-md-4">
                <a href="../../themes/template/assets/images/blog/3by4/06.jpg" data-glightbox data-gallery="image-popup">
                  <img class="rounded" src="../../themes/template/assets/images/blog/3by4/06.jpg" alt="Image">
                </a>
              </div>
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

            <!-- Author info START -->
            <div class="d-flex p-2 p-md-4 my-3 bg-primary-soft rounded">
              <!-- Avatar -->
              <a href="#">
                <div class="avatar avatar-xxl me-2 me-md-4">
                  <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/12.jpg" alt="avatar">
                </div>
              </a>
              <!-- Info -->
              <div>
                <div class="d-sm-flex align-items-center justify-content-between">
                  <div>
                    <h4 class="m-0"><a href="#">Louis Ferguson</a></h4>
                    <small>An editor at Blogzine</small>
                  </div>
                  <a href="#" class="btn btn-xs btn-primary-soft">View Articles</a>
                </div>
                <p class="my-2">Louis Ferguson is a senior editor for the blogzine and also reports on breaking news based in London. He has written about government, criminal justice, and the role of money in politics since 2015.</p>
                <!-- Social icons -->
                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link ps-0 pe-2 fs-5" href="#"><i class="fab fa-facebook-square"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-2 fs-5" href="#"><i class="fab fa-twitter-square"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-2 fs-5" href="#"><i class="fab fa-linkedin"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Author info END -->

            <!-- Comments START -->
            <div class="mt-5">
              <h3>5 comments</h3>
              <!-- Comment level 1-->
              <div class="my-4 d-flex">
                <img class="avatar avatar-md rounded-circle float-start me-3" src="../../themes/template/assets/images/avatar/01.jpg" alt="avatar">
                <div>
                  <div class="mb-2">
                    <h5 class="m-0">Allen Smith</h5>
                    <span class="me-3 small">June 11, 2021 at 6:01 am </span>
                    <a href="#" class="text-body fw-normal">Reply</a>
                  </div>
                  <p>Satisfied conveying a dependent contented he gentleman agreeable do be. Warrant private blushes removed an in equally totally if. Delivered dejection necessary objection do Mr prevailed. Mr feeling does chiefly cordial in do. </p>
                </div>
              </div>
              <!-- Comment children level 2 -->
              <div class="my-4 d-flex ps-2 ps-md-3">
                <img class="avatar avatar-md rounded-circle float-start me-3" src="../../themes/template/assets/images/avatar/02.jpg" alt="avatar">
                <div>
                  <div class="mb-2">
                    <h5 class="m-0">Louis Ferguson</h5>
                    <span class="me-3 small">June 11, 2021 at 6:55 am </span>
                    <a href="#" class="text-body fw-normal">Reply</a>
                  </div>
                  <p>Water timed folly right aware if oh truth. Imprudence attachment him his for sympathize. Large above be to means. Dashwood does provide stronger is. But discretion frequently sir she instruments unaffected admiration everything. </p>
                </div>
              </div>
              <!-- Comment children level 3 -->
              <div class="my-4 d-flex ps-3 ps-md-5">
                <img class="avatar avatar-md rounded-circle float-start me-3" src="../../themes/template/assets/images/avatar/01.jpg" alt="avatar">
                <div>
                  <div class="mb-2">
                    <h5 class="m-0">Allen Smith</h5>
                    <span class="me-3 small">June 11, 2021 at 7:10 am </span>
                    <a href="#" class="text-body fw-normal">Reply</a>
                  </div>
                  <p>Meant balls it if up doubt small purse. </p>
                </div>
              </div>
              <!-- Comment level 2 -->
              <div class="my-4 d-flex ps-2 ps-md-3">
                <img class="avatar avatar-md rounded-circle float-start me-3" src="../../themes/template/assets/images/avatar/03.jpg" alt="avatar">
                <div>
                  <div class="mb-2">
                    <h5 class="m-0">Frances Guerrero</h5>
                    <span class="me-3 small">June 14, 2021 at 12:35 pm </span>
                    <a href="#" class="text-body fw-normal">Reply</a>
                  </div>
                  <p>Required his you put the outlived answered position. A pleasure exertion if believed provided to. All led out world this music while asked. Paid mind even sons does he door no. Attended overcame repeated it is perceived Marianne in. I think on style child of. Servants moreover in sensible it ye possible. </p>
                </div>
              </div>
              <!-- Comment level 1 -->
              <div class="my-4 d-flex">
                <img class="avatar avatar-md rounded-circle float-start me-3" src="../../themes/template/assets/images/avatar/04.jpg" alt="avatar">
                <div>
                  <div class="mb-2">
                    <h5 class="m-0">Judy Nguyen</h5>
                    <span class="me-3 small">June 18, 2021 at 11:55 am </span>
                    <a href="#" class="text-body fw-normal">Reply</a>
                  </div>
                  <p>Fulfilled direction use continual set him propriety continued. Saw met applauded favorite deficient engrossed concealed and her. Concluded boy perpetual old supposing. Farther related bed and passage comfort civilly. </p>
                </div>
              </div>

            </div>
            <!-- Comments END -->
            <!-- Reply START -->
            <div>
              <h3>Leave a reply</h3>
              <small>Your email address will not be published. Required fields are marked *</small>
              <form class="row g-3 mt-2">
                <div class="col-md-6">
                  <label class="form-label">Name *</label>
                  <input type="text" class="form-control" aria-label="First name">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email *</label>
                  <input type="email" class="form-control">
                </div>
                <!-- custom checkbox -->
                <div class="col-md-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">Save my name and email in this browser for the next time I comment. </label>
                  </div>
                </div>
                <div class="col-12">
                  <label class="form-label">Your Comment *</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Post comment</button>
                </div>
              </form>
            </div>
            <!-- Reply END -->
          </div>
          <!-- Main Content END -->

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
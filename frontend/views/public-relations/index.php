<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PublicRelationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
  .img-knowing {
    height: 22em !important;
    width: 100% !important;
  }
</style>
<div class="public-relations-index">

  <section class="pt-0 card-grid">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="tiny-slider arrow-hover arrow-blur arrow-white arrow-round rounded-3 overflow-hidden">
            <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="0" data-arrow="true" data-dots="false" data-items="1">
              <!-- Slide 1 -->
              <div class="card card-overlay-bottom card-bg-scale h-400 h-sm-500 h-md-600 rounded-0" style="background-image:url(../../themes//template/assets/images/blog/16by9/04.jpg); background-position: center left; background-size: cover;">
                <!-- Card Image overlay -->
                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-5">
                  <div class="w-100 mt-auto">
                    <div class="col-md-10 col-lg-7">
                      <!-- Card category -->
                      <a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Trick</a>
                      <!-- Card title -->
                      <h2 class="text-white display-5"><a href="post-single-4.html" class="btn-link text-reset fw-normal">ข้อควรรู้สำหรับนักท่องเที่ยว</a></h2>
                      <!-- Card info -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- Row END -->
    </div>
  </section>

  <section class="pt-0">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Card item START -->
          <div class="card border rounded-3 up-hover p-4 mb-4">
            <div class="row g-3">
              <div class="col-lg-5">
                <!-- Title -->
                <h2 class="card-title">
                  <a href="post-single-6.html" class="btn-link text-reset stretched-link">7 common mistakes everyone makes while traveling</a>
                </h2>
                <div class="d-flex align-items-center position-relative mt-3">
                  <p>For who thoroughly her boy estimating conviction. Removed demands expense account in outward tedious do. Particular way thoroughly unaffected projection favorable Mrs can be projecting own. Thirty it matter enable become admire in giving. See resolved goodness felicity shy civility domestic had but. Drawings offended yet answered Jennings perceive laughing six did far. </p>
                </div>
              </div>
              <!-- Image -->
              <div class="col-md-12 col-lg-7">
                <img class="rounded-3 img-knowing" src="../../themes//template/assets/images/blog/4by3/07.jpg" alt="Card image">
              </div>
            </div>
          </div>
          <!-- Card item END -->
          <!-- Card item START -->
          <div class="card border rounded-3 up-hover p-4 mb-4">
            <div class="row">
              <div class="col-md-5">
                <img class="rounded-3" src="../../themes/template/assets/images/blog/4by3/03.jpg" alt="">
              </div>
              <div class="col-md-7 mt-3 mt-md-0">
                <h3><a href="post-single-2.html" class="btn-link stretched-link text-reset">Five unbelievable facts about money.</a></h3>
                <p>Organization the if relations go work after mechanic But we've area wasn't everything needs of and doctor where would a of Go he prisoners And mountains in just switching city steps Might rung line what Mr Bulk; Was or between towards the have phase were its world my samples are the was royal he luxury the about trying And on he to my enough is was</p>
              </div>
            </div>
          </div>
          <!-- Card item END -->
          <!-- Load more -->
          <button type="button" class="btn btn-primary-soft w-100">Load more post <i class="bi bi-arrow-down-circle ms-2 align-middle"></i></button>
        </div>
      </div>
    </div>
  </section>
</div>
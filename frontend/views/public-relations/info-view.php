<?php

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */

$this->title = 'ข่าวประชาสัมพันธ์';
\yii\web\YiiAsset::register($this);
?>
<!-- **************** MAIN CONTENT START **************** -->
<main>
  <!-- Divider -->
  <div class="border-bottom border-primary border-1 opacity-1"></div>

  <!-- =======================
Inner intro START -->
  <section id="item-1" class="pb-3 pb-lg-5">
    <div class="container">
      <div class="row align-items-center">
        <!-- Image -->
        <div class="col-md-6 position-relative">
          <img class="rounded" src="<?= '../../images/images_upload_forform/' . $model->name_img_important ?>" alt="Image">
          <!-- Card format icon -->
          <h5 class="p-3 pe-4 position-absolute top-0 end-0">
            <span class="badge bg-success text-white fw-bold rounded-pill"> News</span>
          </h5>
        </div>
        <!-- Content -->
        <div class="col-md-6 mt-4 mt-md-0">
          <h1 class="display-6"><?= $model->topic ?></h1>
        </div>
      </div>
    </div>
  </section>
  <!-- =======================
Inner intro END -->

  <!-- =======================
Main START -->
  <section class="pt-0">
    <div class="container position-relative" data-sticky-container>
      <div class="row">
        <!-- Left sidebar START -->
        <div class="col-md-1">
          <div class="text-start text-lg-center mb-5" data-sticky data-margin-top="80" data-sticky-for="767">
          </div>
        </div>
        <!-- Left sidebar END -->

        <!-- Main Content START -->
        <div class="col-md-10 col-lg-8 mb-5">
          <div>
            <p>
              <span class="dropcap bg-success-soft text-success px-2 rounded">N</span><?= $model->details ?>
            </p>
          </div>

          <!-- Divider -->
          <div class="text-center h5 mb-4">. . .</div>
          <!-- Images and video START -->
          <div id="item-3" class="row g-3">
            <h4>อัลบัมรูปภาพ</h4>
            <?php for ($i = 0; $i < count($modelImages); $i++) : ?>

              <?php if ($modelImages[$i] === end($modelImages)) : ?>

                <div class="col-md-12">
                  <figure class="figure mb-1">
                    <a href="<?= '../../images/images_upload_forform/' . $modelImages[$i]['name'] ?>" data-glightbox data-gallery="image-popup">
                      <img class="rounded" src="<?= '../../images/images_upload_forform/' . $modelImages[$i]['name'] ?>" alt="Image">
                    </a>
                  </figure>
                </div>

              <?php else : ?>

                <div class="col-md-6">
                  <a href="<?= '../../images/images_upload_forform/' . $modelImages[$i]['name'] ?>" data-glightbox data-gallery="image-popup">
                    <img class="rounded" src="<?= '../../images/images_upload_forform/' . $modelImages[$i]['name'] ?>" alt="Image">
                  </a>
                </div>

              <?php endif ?>

            <?php endfor ?>
          </div>
          <!-- Images and video END -->

        </div>
        <!-- Main Content END -->
        <!-- Right sidebar START -->
        <div class="col-lg-3 d-none d-lg-block">
          <div data-sticky data-margin-top="80" data-sticky-for="991">
            <nav id="nav-scroll" class="navbar">
              <nav class="nav nav-pills flex-column">
                <a class="nav-link" href="#item-1">ข้อมูล</a>
                <a class="nav-link" href="#item-3">รูปภาพ</a>
              </nav>
            </nav>
          </div>
        </div>
        <!-- Right sidebar END -->
      </div>
    </div>
  </section>
  <!-- =======================
Main END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->
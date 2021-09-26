<?php

use common\models\Place;
use common\util\DateTimeCustom;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Place */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>

<style>
  #mapM {
    height: 100%;
    width: 100%;
  }

  #mapid {
    height: 26em;
  }

  .infoBox {
    -webkit-animation: fadeIn 300ms;
    animation: fadeIn 300ms;
  }

  .map-box {
    background-color: #fff;
    min-height: 90px;
    box-shadow: 0 0 22px rgb(0 0 0 / 7%);
  }

  .map-box a {
    text-decoration: none;
    border: 0px;
    max-height: 190px;
  }

  .map-box-image {
    position: relative;
    overflow: hidden;
    display: block;
  }

  .map-box a img {
    width: 100%;
    height: 100%;
    object-fit: fill;
    display: inline-block;
    image-rendering: auto;
    image-rendering: crisp-edges;
    image-rendering: pixelated;
  }

  img {
    width: auto;
    border: 0;
    -ms-interpolation-mode: bicubic;
    max-width: 100%;
  }

  .infoBox .date {
    padding: 0 25px 0 25px;
    color: #888;
    font-weight: 500;
    margin: 0;
    display: block;
    text-transform: uppercase;
    font-size: 13px;
    margin-top: -4px;
  }

  .map-box ul,
  .map-box p {
    padding: 6px 25px 25px;
    font-size: 15px;
    margin: 0 0 15px 0;
    line-height: 25px;
  }

  .infoBox-close {
    position: absolute;
    top: 0;
    right: 0;
    display: inline-block;
    z-index: 999;
    text-align: center;
    line-height: 38px;
    cursor: pointer;
    font-size: 15px;
    font-weight: 500;
    height: 38px;
    width: 38px;
    background-color: #fff;
    color: #333;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    font-family: "FontAwesome";
  }

  .map-box h2,
  .map-box a h2 {
    padding: 5px 25px 0 25px;
    margin: 20px 0px 0px 0px;
    font-size: 15px;
    text-transform: uppercase;
    line-height: 21px;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    display: inline-block;
    font-weight: 600;
    font-size: 14px;
  }

  /* Popup Map */
  .leaflet-popup-content {
    margin: 0px 0px !important;
  }

  .leaflet-container a.leaflet-popup-close-button {
    background-color: white;
    width: 2em;
    height: 2em;
  }

  .leaflet-popup-content-wrapper {
    border-radius: 0px !important;
    padding: 0px;
  }

  .place-box {
    padding: 2em;
  }

  .tool-icon {
    width: 2em;
    height: 2em;
    margin-right: 1em;
    margin-left: 0.5em;
    margin-bottom: 0.5em;
  }

  .full-screen {
    width: 100% !important;
    height: 100% !important;
    max-width: 100% !important;
  }

  .btn-map {
    border: 2px solid rgba(0, 0, 0, 0.2) !important;
    background-clip: padding-box !important;
    background-color: #fff !important;
  }

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

  .phone-box {
    border: 1px solid transparent;
    background-color: transparent;
    padding: 0;
  }
</style>

<div class="place-view">
  <section class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover" style="background-image: url('<?= '../../images/images_upload_forform/' . $model->name_img_important ?>');">
    <div class="container overlay-content">
      <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
        <div class="text-white mb-4 mb-lg-0">
          <div class="badge badge-pill badge-transparent px-3 py-2 mb-4">Place &amp; Travel</div>
          <h1 class="text-shadow verified"><?= $model->name ?></h1>
          <p><i class="fa-map-marker-alt fas me-2"></i> <?= $model->contact ?></p>
        </div>
      </div>
    </div>
  </section>
  <section class="py-6">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <!-- About Listing-->
          <div class="text-block">
            <h3 class="mb-3">รายละเอียด</h3>
            <p class="text-muted"><?= $model->details ?> </p>
          </div>
          <div class="text-block">
            <h3 class="mb-3">กิจกรรม</h3>
            <p class="text-muted"><?= $model->activity ?> </p>
          </div>
          <div class="text-block">
            <!-- Listing Location-->
            <h3 class="mb-4">แผนที่</h3>
            <div class="map-wrapper-300 mb-3">
              <div class="h-100" id="mapid"></div>
            </div>
          </div>
          <div class="text-block">
            <!-- Gallery-->
            <h3 class="mb-4">รูปภาพ</h3>
            <div class="row ms-n1 me-n1">

              <section class="position-relative pt-0">
                <div class="row filter-container overflow-hidden" data-isotope='{"layoutMode": "masonry"}'>

                  <?php if (count($modelImage) > 0) :  ?>
                    <?php foreach ($modelImage as $modelImage) :  ?>
                      <!-- Card item START -->
                      <div class="col-lg-4 col-6 px-1 mb-2 grid-item">
                        <div class="card">
                          <!-- Card img -->
                          <div class="card-fold position-relative">
                            <a href="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" data-glightbox data-gallery="image-popup">
                              <img class="img-fluid" src="<?= '../../images/images_upload_forform/' . $modelImage->name ?>" alt="...">
                            </a>
                          </div>
                        </div>
                      </div>
                      <!-- Card item END -->
                    <?php endforeach  ?>
                  <?php endif ?>

                </div>
              </section>

            </div>
          </div>
          <div class="text-block">
            <p class="subtitle text-sm text-primary">รีวิวจากนักท่องเที่ยว </p>
            <h5 class="mb-4">Listing Reviews </h5>
            <?php if (count($modelReview) > 0) : ?>

              <?php
              $indexPost = 0;
              foreach ($modelReview as $review) :
                $indexPost += 1;
              ?>
                <div class="d-flex d-block d-sm-flex review">
                  <div class="text-md-center flex-shrink-0 me-4 me-xl-5">
                    <img class="d-block avatar avatar-xl p-2 mb-2" src="<?= Place::randomImg() ?>" alt="avatar">
                    <span class="text-uppercase text-muted text-sm"><?= DateTimeCustom::getDateThai($review->created_at) ?></span>
                  </div>
                  <div>
                    <h6 class="mt-2 mb-1">Post <?= $indexPost ?></h6>
                    <p class="text-muted text-sm"><?= $review->message ?> </p>
                  </div>
                </div>
              <?php endforeach ?>

            <?php else : ?>
              <div class="d-flex d-block d-sm-flex review">
                <p class="text-muted text-sm">No Comments </p>
              </div>
            <?php endif ?>

            <div class="py-5">
              <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#leaveReview" aria-expanded="false" aria-controls="leaveReview">Leave a review</button>
              <div class="collapse mt-4" id="leaveReview">
                <h5 class="mb-4">Leave a review</h5>
                <form class="form" id="contact-form" action="<?= \Yii::$app->getUrlManager()->createUrl(['place/save-comment', 'id' => $model->id]) ?>" method="post">
                  <div class="mb-4">
                    <label class="form-label" for="review">Review text *</label>
                    <textarea class="form-control" rows="4" name="comment_message" placeholder="Enter your review" required="required"></textarea>
                  </div>
                  <button class="btn btn-primary" type="submit" name="save_comment" value="save">Post review</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="ps-xl-4 sticky-top" style="top: 110px;">
            <!-- Opening Hours      -->
            <div class="card border-0 shadow mb-5">
              <div class="card-header bg-gray-100 py-4 border-0">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <p class="subtitle text-sm text-primary">วันเวลาเปิดทำการ</p>
                    <h4 class="mb-0">Opening Hours </h4>
                  </div>
                  <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ms-3 text-muted flex-shrink-0">
                    <use xlink:href="#wall-clock-1"> </use>
                  </svg>
                </div>
              </div>
              <div class="card-body">
                <table class="table text-sm mb-0">
                  <?php if ($openDay !== null && count($openDay) > 0) : ?>

                    <?php foreach ($openDay as $data) : ?>
                      <tr>
                        <th class="ps-0 border-0"><?= $data ?></th>
                        <td class="pe-0 text-end border-0"><?= $openHour ?></td>
                      </tr>
                    <?php endforeach ?>

                  <?php else : ?>
                    <tr>
                      <th class="ps-0 border-0">ไม่มีข้อมูล</th>
                      <td class="pe-0 text-end border-0"> - น.</td>
                    </tr>
                  <?php endif ?>
                </table>
              </div>
            </div>
            <!-- Contact-->
            <div class="card border-0 shadow mb-5">
              <div class="card-header bg-gray-100 py-4 border-0">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <p class="subtitle text-sm text-primary">ช่องทางการติดต่อ</p>
                    <h4 class="mb-0">Contact</h4>
                  </div>
                  <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ms-3 text-muted flex-shrink-0">
                    <use xlink:href="#telephone-operator-1"></use>
                  </svg>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled mb-4">
                  <li class="mb-2 text-sm"> <i class="fa fa-user me-3" style="color:royalblue"></i> <span class="text-muted"><?= $model->contact ?></span></li>

                  <?php if ($model->phone !== '') : ?>
                    <li class="mb-2"> <a class="text-blue text-sm text-decoration-none" href="tel:<?= Place::customizePhoneCall($model->phone) ?>"><i class="fa fa-phone me-3"></i><span class="text-muted"><?= $model->phone ?></span></a></li>
                  <?php endif ?>

                  <?php if ($model->facebook_link !== '') : ?>
                    <li class="mb-2"> <a class="text-blue text-sm text-decoration-none" href="<?= $model->facebook_link ?>"><i class="fab fa-facebook me-3"></i><span class="text-muted">Facebook</span></a></li>
                  <?php endif ?>

                  <?php if ($model->line_id !== '') : ?>
                    <li class="mb-2"> <a class=" text-sm text-decoration-none" href="http://line.me/ti/p/<?= $model->line_id ?>"><i class="fab fa-line me-3"></i><span class="text-muted"><?= $model->line_id ?></span></a></li>
                  <?php endif ?>

                  <li class="mb-2"> <a class=" text-sm text-decoration-none" target="_blank" href="https://www.google.com/maps/dir/?api=1&travelmode=driving&layer=traffic&destination=<?= $model->latitude ?>,<?= $model->longitude ?>"><i class="fa fa-location-arrow me-3" aria-hidden="true"></i><span class="text-muted">ขอเส้นทาง</span></a></li>
                </ul>
              </div>
            </div>

            <?php if ($model->type == 3) :  ?>
              <div class="card border-0 shadow mb-5">
                <div class="card-header bg-gray-100 py-4 border-0">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="text-muted"><span class="text-primary h2">฿<?= $model->price ?></span> ต่อคืน</p>
                    <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ms-3 text-muted flex-shrink-0">
                      <use xlink:href="#calls-1"> </use>
                    </svg>
                  </div>
                  <hr class="my-4">
                  <form class="form" id="booking-form" action="tel:<?= Place::customizePhoneCall($model->phone) ?>" autocomplete="off">
                    <div class="d-grid mb-4">
                      <button class="btn btn-primary" type="submit">จองเลย</button>
                    </div>
                  </form>
                </div>
              </div>
            <?php endif ?>

          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-6 bg-banner">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <h2>แพ็คเกจท่องเที่ยว<span class="head-badge"></span></h2>
        </div>
        <div class="col-md-4 d-lg-flex align-items-center justify-content-end">
          <a class="text-muted text-sm" href="index.php?r=package/index">ดูแพ็คเกจทั้งหมด<i class="fas fa-angle-double-right ms-2"></i></a>
        </div>
      </div>
      <!-- Slider main container-->
      <div class="swiper-container swiper-container-mx-negative swiper-init pt-3" data-swiper="{&quot;slidesPerView&quot;:4,&quot;spaceBetween&quot;:20,&quot;loop&quot;:true,&quot;roundLengths&quot;:true,&quot;breakpoints&quot;:{&quot;1200&quot;:{&quot;slidesPerView&quot;:3},&quot;991&quot;:{&quot;slidesPerView&quot;:2},&quot;565&quot;:{&quot;slidesPerView&quot;:1}},&quot;pagination&quot;:{&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;clickable&quot;:true,&quot;dynamicBullets&quot;:true}}">
        <!-- Additional required wrapper-->
        <div class="swiper-wrapper pb-5">
          <?php if (count($modelPackage) > 0) :  ?>
            <?php foreach ($modelPackage as $modelPackage) :  ?>
              <!-- Slides-->
              <div class="swiper-slide h-auto px-2">
                <!-- place item-->
                <div class="w-100 h-100 hover-animate" data-marker-id="<?= $modelPackage->id ?>">
                  <div class="card h-100 border-0 shadow">
                    <div class="card-img-top overflow-hidden gradient-overlay">
                      <img class="img-fluid" src="<?= '../../images/images_upload_forform/' . $modelPackage->name_img_important ?>" alt="..." />
                      <a class="tile-link" href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $modelPackage->id]) ?>"></a>
                      <div class="card-img-overlay-top text-end">
                        <a class="card-fav-icon position-relative z-index-40" href="javascript: void();">
                          <svg class="svg-icon text-white">
                            <use xlink:href="#heart-1"> </use>
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="card-body d-flex align-items-center">
                      <div class="w-100">
                        <h6 class="card-title"><a class="text-decoration-none text-dark" href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $modelPackage->id]) ?>"><?= $modelPackage->name ?></a></h6>
                        <div class="d-flex card-subtitle mb-3">
                          <p class="flex-grow-1 mb-0 text-muted text-sm">ทัวร์ <?= $modelPackage->date_moment ?> วัน</p>
                        </div>
                        <p class="card-text text-muted"><span class="h4 text-primary">฿<?= $modelPackage->price ?></span> ต่อแพ็คเกจ</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach  ?>
          <?php endif  ?>
        </div>
        <!-- If we need pagination-->
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <!-- modal -->
  <div class="modal fade" id="mapModalToggle" aria-hidden="true" aria-labelledby="mapModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered full-screen">
      <div class="modal-content full-screen">
        <div class="modal-header">
          <h5 class="modal-title" id="mapModalToggleLabel">แผนที่</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="mapM"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
</div>

<script>
  const newPopup = ({
    id = 1,
    img,
    name = 'No Name',
    bussinessDay = 'open day'
  }) => {
    const popup = `<div class="infoBox">` +
      `<div>` +
      `<a href="#" class="map-box-image">` +
      `<img src="${img}">` +
      `<i class="map-box-icon"></i>` +
      `</a>` +
      `<div class="place-box">` +
      `<a href="#">` +
      `<h3>${name}</h3>` +
      `</a>` +
      `<span class="date"><time class="entry-date published updated">${bussinessDay}</time></span>` +
      `</div></div></div>`;

    return popup;
  }

  const isInitMapAlready = () => {
    const container = L.DomUtil.get('mapM');

    return !container || container._leaflet_id;
  }

  const initTopRightFullScreen = (mymap) => {
    L.control.custom({
        position: 'topright',
        content: '<button data-bs-toggle="modal" href="#mapModalToggle" type="button" class="btn btn-map">' +
          '    <i class="fas fa-expand"></i>' +
          '</button>',
        classes: '',
        style: {
          cursor: 'pointer',
        },
        datas: {
          'foo': 'bar',
        },
        events: {
          click: function() {
            initMap({
              mapId: 'mapM'
            });
          },
        }
      })
      .addTo(mymap);
  }

  const initMapLayer = (mymap, mapboxUrl, accessToken) => {
    L.tileLayer(mapboxUrl, {
      id: 'mapbox/streets-v11',
      attribution: '',
      maxZoom: 18,
      tileSize: 512,
      zoomOffset: -1,
      accessToken
    }).addTo(mymap);
  }

  const initMap = ({
    mapId,
    mapOption = {}
  }) => {
    const {
      showTopRight
    } = mapOption;

    if (isInitMapAlready()) {
      return;
    }

    const accessToken = 'pk.eyJ1IjoiYXRtYXRtNDAzMyIsImEiOiJja3JleXd5MHk1NXRiMm9xdWg1ZmNwZWM3In0.19AF64hbIhSmQ_ukdR7EyA';
    const mapboxUrl = `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${accessToken}`;
    const mymap = L.map(mapId).setView([<?= $model->latitude ?>, <?= $model->longitude ?>], 13);

    if (!!showTopRight) {
      initTopRightFullScreen(mymap);
    }

    initMapLayer(mymap, mapboxUrl, accessToken);

    const latlng = [<?= $model->latitude ?>, <?= $model->longitude ?>];
    const popup = newPopup({
      img: '<?= '../../images/images_upload_forform/' . $model->name_img_important ?>',
      bussinessDay: '<?= $model->business_day ?>',
      name: '<?= $model->name ?>',
    });

    L.marker(latlng).bindPopup(popup).addTo(mymap).openPopup();

    const layerOption = {
      collapsed: false
    }

    L.control.layers(null, layerOption).addTo(mymap);

    setTimeout(() => {
      mymap.invalidateSize(true);
    }, 450);
  }

  initMap({
    mapId: 'mapid',
  });
</script>
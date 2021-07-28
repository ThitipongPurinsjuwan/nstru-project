<?php

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
                    <a class="nav-link" href="callto://<?= $model->phone ?>"><i class="fas fa-phone-square-alt fa-fw me-2 text-phone"></i><?= $model->phone ?></a></form>
                  </li>
                <?php endif ?>
              </ul>
              <!-- Newsletter START -->
              <div class="bg-primary-soft p-3 mt-4 rounded-3 text-center">
                <?= $model->contact ?>
              </div>
              <!-- Newsletter END -->

              <!-- Map START -->
              <div id="mapid" class="mt-4"></div>
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
              <!-- Map END -->

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

<script>
  const initMap = ({
    mapId,
    mapOption = {}
  }) => {
    const newPopup = ({
      img,
      name = 'name',
      detail = 'detail',
      bussinessDay = 'open day'
    }) => {
      const popup = `<div class="infoBox">` +
        `<div>` +
        `<a href="http://wpvoyager.purethe.me/2017/07/06/two-days-in-budapest/" class="map-box-image">` +
        `<img src="${img}">` +
        `<i class="map-box-icon"></i>` +
        `</a>` +
        `<div class="place-box">` +
        `<a href="http://wpvoyager.purethe.me/2017/07/06/two-days-in-budapest/">` +
        `<h3>${name}</h3>` +
        `</a>` +
        `<span class="date"><time class="entry-date published updated">${bussinessDay}</time></span>` +
        `<p>${detail}</p>` +
        `</div></div></div>`;

      return popup;
    }

    const {
      showTopRight
    } = mapOption;

    const container = L.DomUtil.get('mapM');

    if (!container || container._leaflet_id) {
      return;
    }

    const accessToken = 'pk.eyJ1IjoiYXRtYXRtNDAzMyIsImEiOiJja3JleXd5MHk1NXRiMm9xdWg1ZmNwZWM3In0.19AF64hbIhSmQ_ukdR7EyA';
    const mapboxUrl = `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${accessToken}`;
    const mymap = L.map(mapId).setView([<?= $model->latitude ?>, <?= $model->longitude ?>], 13);

    if (!!showTopRight) {
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
            click: function(data) {
              initMap({
                mapId: 'mapM'
              });
            },
          }
        })
        .addTo(mymap);
    }

    L.tileLayer(mapboxUrl, {
      id: 'mapbox/streets-v11',
      attribution: '',
      maxZoom: 18,
      tileSize: 512,
      zoomOffset: -1,
      accessToken
    }).addTo(mymap);


    L.marker([<?= $model->latitude ?>, <?= $model->longitude ?>])
      .bindPopup(newPopup({
        name: '<?= $model->name ?>',
        bussinessDay: '<?= $model->business_day ?>',
        img: '<?= '../../images/images_upload_forform/' . $model->name_img_important ?>',
      }))
      .addTo(mymap);


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
    // mapOption: {
    //   showTopRight: true
    // }
  });
</script>
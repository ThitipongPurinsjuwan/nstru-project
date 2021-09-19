<?php

$this->title = "แผนที่ท่องเที่ยว";
?>
<style>
  #mapM {
    height: 100%;
    width: 100%;
  }

  #mapid {
    height: 91.5vh;
  }

  @media only screen and (max-width: 609px) {
    #mapid {
      height: 87vh;
    }
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

  .infoBox img {
    width: 100%;
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

  /* End Popup Map */
</style>
<div class="travel-map-index">
  <div id="mapid"></div>
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
      `<a href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => '']) ?>${id}" class="map-box-image">` +
      `<img src="${img}">` +
      `<i class="map-box-icon"></i>` +
      `</a>` +
      `<div class="place-box">` +
      `<a href="<?= \Yii::$app->getUrlManager()->createUrl(['place/view', 'id' => '']) ?>${id}">` +
      `<h4>${name}</h4>` +
      `</a>` +
      `<span class="date"><time class="entry-date published updated">เปิดทำการ ${bussinessDay}</time></span>` +
      `</div></div></div>`;

    return popup;
  }

  const initTypeMarker = (mymap, keys, objMarker) => {
    keys.map((obj) => {
      objMarker[obj] = L.layerGroup().addTo(mymap);
    });

    return objMarker;
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

  const loadMarkerToMap = (objMarker) => {
    let latlng = [];
    let iconOption = {};
    let popup = '';

    const LeafIcon = L.Icon.extend({
      options: {
        iconSize: [38, 40],
      }
    });

    <?php for ($i = 0; $i < count($modelPlace); $i++) : ?>
      latlng = [
        <?= $modelPlace[$i]['latitude'] ?>,
        <?= $modelPlace[$i]['longitude'] ?>
      ];

      iconOption = {
        icon: new LeafIcon({
          iconUrl: '<?= $modelPlace[$i]['icon'] ?>'
        })
      };

      popup = newPopup({
        id: '<?= $modelPlace[$i]['id'] ?>',
        name: '<?= $modelPlace[$i]['name'] ?>',
        bussinessDay: '<?= $modelPlace[$i]['business_day'] ?>',
        img: '<?= '../../images/images_upload_forform/' . $modelPlace[$i]['name_img_important'] ?>',
      });

      L.marker(latlng, iconOption)
        .bindPopup(popup)
        .addTo(objMarker.<?= $modelPlace[$i]['type_name'] ?>)
        .on('mouseover', function(e) {
          e.target.openPopup();
        })
        .on('mouseout', function(e) {
          setTimeout(() => {
            e.target.closePopup()
          }, 3500);
        });

    <?php endfor ?>
  }

  const getOverlay = (keys, val, objMarker) => {
    const overlays = {};
    const iconOnMap = <?= json_encode($iconsMap); ?>;

    let templateIcon = '';

    for (let i = 0; i < keys.length && i < val.length; i++) {
      templateIcon = `<img src="${iconOnMap[i]}" class="tool-icon">`;
      overlays[`${templateIcon}${val[i]}`] = objMarker[keys[i]];
    }

    return overlays;
  }

  const initMap = ({
    mapId,
    mapOption = {}
  }) => {
    const accessToken = 'pk.eyJ1IjoiYXRtYXRtNDAzMyIsImEiOiJja3JleXd5MHk1NXRiMm9xdWg1ZmNwZWM3In0.19AF64hbIhSmQ_ukdR7EyA';
    const mapboxUrl = `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${accessToken}`;
    const mymap = L.map(mapId, {
      scrollWheelZoom: false
    }).setView([8.44425, 99.95037], 13);

    let objMarker = JSON.parse('<?= json_encode($objTypePlace) ?>');

    const keys = Object.keys(objMarker);
    const val = Object.values(objMarker);

    objMarker = initTypeMarker(mymap, keys, objMarker);

    initMapLayer(mymap, mapboxUrl, accessToken);

    loadMarkerToMap(objMarker);

    const overlays = getOverlay(keys, val, objMarker);

    const layerOption = {
      collapsed: false
    }

    L.control.layers(null, overlays, layerOption).addTo(mymap);

    setTimeout(() => {
      mymap.invalidateSize(true);
    }, 450);
  }

  initMap({
    mapId: 'mapid',
    mapOption: {
      showTopRight: true
    }
  });
</script>
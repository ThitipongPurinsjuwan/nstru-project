<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "แผนที่ท่องเที่ยว";
?>
<style>
  #mapid {
    height: 60em;
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

  /* End Popup Map */
</style>
<div class="travel-map-index">
  <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>
  <div id="mapid"></div>

</div>

<script>
  const newPopup = () => {
    const popup = '<div class="infoBox">' +
      '<div>' +
      '<a href="http://wpvoyager.purethe.me/2017/07/06/two-days-in-budapest/" class="map-box-image">' +
      '<img src="http://wpvoyager.purethe.me/files/2015/07/budapest-1959378_640-300x200.jpg" alt="">' +
      '<i class="map-box-icon"></i>' +
      '</a>' +
      '<div class="place-box">' +
      '<a href="http://wpvoyager.purethe.me/2017/07/06/two-days-in-budapest/">' +
      '<h3>5 Reasons You Need To Visit Budapest</h3>' +
      '</a>' +
      '<span class="date"><time class="entry-date published updated" datetime="2017-07-06T15:55:48+00:00">July 6, 2017</time></span>' +
      '<p>Phasellus rhoncus metus sed neque efficitur vestibulum. Suspendisse lacinia lacus vel ante scelerisqu.</p>' +
      '</div></div></div>';

    return popup;
  }

  const mymap = L.map('mapid').setView([8.78194858715432, 99.66638324253091], 13);
  const accessToken = 'pk.eyJ1IjoiYXRtYXRtNDAzMyIsImEiOiJja3JleXd5MHk1NXRiMm9xdWg1ZmNwZWM3In0.19AF64hbIhSmQ_ukdR7EyA';
  const mapboxUrl = `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${accessToken}`;

  L.tileLayer(mapboxUrl, {
    id: 'mapbox/streets-v11',
    attribution: '',
    maxZoom: 18,
    tileSize: 512,
    zoomOffset: -1,
    accessToken
  }).addTo(mymap);

  L.marker([8.773971781389085, 99.7232031318622]).addTo(mymap).bindPopup(newPopup());
  L.marker([8.773457, 99.66754]).addTo(mymap).bindPopup(newPopup());


  const cities = L.layerGroup().addTo(mymap);

  L.marker([8.773457, 99.7232]).bindPopup(newPopup()).addTo(cities),
    L.marker([8.773457, 99.7332]).bindPopup(newPopup()).addTo(cities),
    L.marker([8.773457, 99.7432]).bindPopup(newPopup()).addTo(cities),
    L.marker([8.773457, 99.7532]).bindPopup(newPopup()).addTo(cities);


  const overlays = {
    'Location': cities,
  }

  const layerOption = {
    collapsed: false
  }

  L.control.layers(null, overlays, layerOption).addTo(mymap)
</script>
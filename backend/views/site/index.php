<?php
use yii\helpers\Html;
use common\models\Place;
use common\models\Package;
use common\models\PublicRelations;
use common\models\Images;

$this->title = 'แหล่งท่องเที่ยวเชิงเกษตรอำเภอนบพิตำ';

?>

<style>
.card-counter {
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
}

.card-counter:hover {
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
}

.card-counter.primary {
    background-color: #007bff;
    color: #FFF;
}

.card-counter.danger {
    background-color: #ef5350;
    color: #FFF;
}

.card-counter.success {
    background-color: #66bb6a;
    color: #FFF;
}

.card-counter.info {
    background-color: #26c6da;
    color: #FFF;
}

.card-counter.warning {
    background-color: #F39C11;
    color: #FFF;
}

.card-counter.violet {
    background-color: #98789A;
    color: #FFF;
}


.card-counter i {
    font-size: 5em;
    opacity: 0.2;
}

.card-counter .count-numbers {
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
}

.card-counter .count-name {
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
}

.img-set-inmarker {
    width: 100%;
    height: 150px;
    object-fit: cover;
}
</style>

<link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
<script data-require="leaflet@0.7.3" data-semver="0.7.3"
    src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>


<div class="row">

    <div class="col-md-3">
        <a href="index.php?r=public-relations%2Findex&type=1">
            <div class="card-counter primary">
                <i class="fas fa-newspaper"></i>
                <span class="count-numbers"><?=PublicRelations::find()->where(['type'=>1])->count();?></span>
                <span class="count-name"><?=titleNews(1);?></span>
            </div>
        </a>
    </div>


    <div class="col-md-3">
        <a href="index.php?r=public-relations%2Findex&type=2">
            <div class="card-counter danger">
                <i class="fas fa-user-tie"></i>
                <span class="count-numbers"><?=PublicRelations::find()->where(['type'=>2])->count();?></span>
                <span class="count-name"><?=titleNews(2);?></span>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="index.php?r=place%2Findex&type=1">
            <div class="card-counter success">
                <i class="fa fa-database"></i>
                <span class="count-numbers"><?=Place::find()->where(['type'=>1])->count();?></span>
                <span class="count-name"><?=titlePlace(1);?></span>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="index.php?r=place%2Findex&type=2">
            <div class="card-counter warning">
                <i class="fa fa-users"></i>
                <span class="count-numbers"><?=Place::find()->where(['type'=>2])->count();?></span>
                <span class="count-name"><?=titlePlace(2);?></span>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="index.php?r=place%2Findex&type=3">
            <div class="card-counter info">
                <i class="fa fa-users"></i>
                <span class="count-numbers"><?=Place::find()->where(['type'=>3])->count();?></span>
                <span class="count-name"><?=titlePlace(3);?></span>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="index.php?r=package%2Findex">
            <div class="card-counter violet">
                <i class="fa fa-users"></i>
                <span class="count-numbers"><?=Package::find()->count();?></span>
                <span class="count-name">Package ท่องเที่ยว</span>
            </div>
        </a>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <dt>แผนที่แสดงตำแหน่งสถานที่ท่องเที่ยว</dt>
                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>


<script>
var setlat = 13.732564;
var setlon = 100.515000;
var setzoom = 5;

const loadmap = (arr) => {

    if (arr.length > 0) {
        setlat = arr[0].latitude;
        setlon = arr[0].longitude;
        setzoom = 13;
    }

    var map = L.map('map').setView([setlat, setlon], setzoom);
    mapLink =
        '<a href="http://openstreetmap.org">OpenStreetMap</a>';
    L.tileLayer(
        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
        }).addTo(map);

    for (var i = 0; i < arr.length; i++) {

        marker =
            L.marker([arr[i].latitude, arr[i].longitude], {
                icon: new L.Icon({
                    iconSize: [50, 50],
                    iconAnchor: [25, 45],
                    shadowAnchor: [4, 62],
                    iconUrl: '../../images/image_maker/' + arr[i].icon_marker,
                })
            }).bindPopup(`
                <h6><b>${arr[i].name}</b></h6><br>
                <img src="../../images/images_upload_forform/${arr[i].name_img_important}" class="img-set-inmarker">
                <br><br>
                <b>วันทำการ : </b>${arr[i].business_day}<br>
                <b>เวลาเปิด-ปิด : </b>${arr[i].business_hours}<br>
                <b>ช่องทางติดต่อ : </b> ${arr[i].contact}
                `).addTo(map)
    }

}

const getdata_place = () => {
    var data = null;
    var data = $.ajax({
        async: false,
        crossDomain: true,
        url: "index.php?r=package/get-data-place&type=alldata",
        method: "POST",
        global: false,
        dataType: "json",
    }).done(function(response) {
        return response;
    }).responseJSON;

    // console.log(data);

    loadmap(data);

}
getdata_place();
</script>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Place;
use app\models\Users;
/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
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

<div class="package-view">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-body ribbon">

                            <p>
                                <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('app', 'ยกเลิก'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
                            </p>

                            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'details:html',
            'date_moment',
           [
                                    'attribute'=>'place',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->place))
                                        {
                                   $myArray = str_replace('"',"",$model->place);
                                 $myArray = explode(',', $myArray);               
 $query =  Place::find()->where(['id'=>$myArray])
                    ->orderBy([
                        'name'=>SORT_ASC,
                    ])
                    ->all();
$showplace = "";
foreach ($query as $row) {
    $showplace .= "- ".$row['name']."<br>";
}
$showplace = substr($showplace, 0, -4);
                                            return  $showplace;
                                        }
                                    },
                                ],
            'price',
               'contact',
                                  'facebook_link',
                                   'line_id',
                                    'phone',
            // 'status',
            // 'key_images',
            [
                                    'attribute'=>'date_create',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->date_create))
                                        {
                                            return DateThaiTime($model->date_create);
                                        }
                                    },
                                ],
                                 [
                                    'attribute'=>'user_create',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->user_create))
                                        {
                                            $query = Users::find()
                                            ->where(['id'=>$model->user_create])->one();
                                            return $query->name;
                                        }
                                    },
                                ],
        ],
    ]) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-body ribbon">
                            <h6><b>ภาพประกอบ</b></h6>
                            <input type="hidden" class="get_key_images" value="<?=$model->key_images;?>">
                            <?php
                    $manage = 0; 
                    include('../../js/dropzone-4.3.0/page-uploadfile.php');
                    ?>
                        </div>
                    </div>
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

        </div>
    </div>
</div>
</div>

<div id="package-place">
<?=$model->place;?>
</div>

<script>

    var setlat = 13.732564;
    var setlon = 100.515000;
    var setzoom = 5;

const loadmap = (arr) => {

     if (arr.length > 0) {
            setlat = arr[0].latitude;
            setlon = arr[0].longitude;
            setzoom = 12;
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

const getdata_place = (arr_id) => {
    console.log(arr_id);
    var data = null;
    var data = $.ajax({
        async: false,
        crossDomain: true,
        url: "index.php?r=package/get-data-place&type=somedata",
        method: "POST",
        global: false,
        dataType: "json",
        data: {
            arr_id: arr_id,
        },
    }).done(function(response) {
        return response;
    }).responseJSON;

    // console.log(data);

    loadmap(data);

}


let val = $('#package-place').html();
var array = JSON.parse("[" + val + "]");
getdata_place(array);
</script>
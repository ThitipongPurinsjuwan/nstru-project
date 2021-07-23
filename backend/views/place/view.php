<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Amphures; 
use common\models\Districts; 
use common\models\Provinces; 
use app\models\Users; 
use app\models\TypePlace; 
/* @var $this yii\web\View */
/* @var $model common\models\Place */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูล'.titlePlace($model->type)), 'url' => ['index','type'=>$model->type]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="place-view">

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
            // 'type',
            'name',
            'details:html',
            'activity:html',
           
            // 'key_images',
            // 'amphure',
             [
                                    'attribute'=>'amphure',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->amphure))
                                        {
                                            $query = Amphures::find()
                                            ->where(['id'=>$model->amphure])->one();
                                            return $query->name_th;
                                        }
                                    },
                                ],
                                 [
                                    'attribute'=>'district',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->district))
                                        {
                                            $query = Districts::find()
                                            ->where(['id'=>$model->district])->one();
                                            return $query->name_th;
                                        }
                                    },
                                ],
                                   [
                                    'attribute'=>'province',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->province))
                                        {
                                            $query = Provinces::find()
                                            ->where(['id'=>$model->province])->one();
                                            return $query->name_th;
                                        }
                                    },
                                ],
                                 'contact',
            'latitude',
            'longitude',
           
           
            'business_day',
            [
                                    'attribute'=>'business_hours',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->business_hours))
                                        {
                                            return str_replace(","," - ",$model->business_hours)." น."; 
                                        }
                                    },
                                ],
              'price',
               [
                                    'attribute'=>'status',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->status))
                                        {
                                            return ($model->status==0) ? 'ปิดร้านแล้ว':'ร้านเปิดปกติตามเวลาทำการ';
                                        }
                                    },
                                ],
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
                        <dt>แผนที่แสดงพิกัด (ละติจูด , ลองจิจูด)</dt>
                    </h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                class="fe fe-maximize"></i></a>
                    </div>
                </div>
                <div class="card-body">

                   <?php $icon_marker = TypePlace::find()->where(['id'=>$model->type])->one();
                        $iconmarker = '../../images/image_maker/'.$icon_marker->images;
                   ?>
                    <link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
                    <script data-require="leaflet@0.7.3" data-semver="0.7.3"
                        src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>


                    <div id="mapshow" style="width: 100%; height: 500px;"></div>
                    <script>
                    var mymap = L.map('mapshow').setView([<?=$model->latitude;?>, <?=$model->longitude;?>],
                        15);

                    L.tileLayer(
                        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                            maxZoom: 18,
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                            id: 'mapbox/streets-v11',
                            tileSize: 512,
                            zoomOffset: -1
                        }).addTo(mymap);

                    L.marker([<?=$model->latitude;?>, <?=$model->longitude;?>], 
                    {
                            icon: new L.Icon({
                                iconSize: [50, 50],
                                iconAnchor: [25, 45],
                                shadowAnchor: [4, 62],
                                iconUrl: '<?=$iconmarker;?>',
                            })
                        }
                        ).addTo(mymap)
                        .bindPopup("<b><?=$model->name;?></b> <br> พิกัด (<?=$model->latitude;?>, <?=$model->longitude;?>)")
                        .openPopup();

                    var popup = L.popup();
                    </script>
                </div>
            </div>
                </div>
            </div>
        </div>

         <div class="col-xl-12 col-lg-12">
          
        </div>
    </div>


</div>
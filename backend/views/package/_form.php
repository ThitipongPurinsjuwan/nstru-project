<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Place;
/* @var $this yii\web\View */
/* @var $model app\models\Package */
/* @var $form yii\widgets\ActiveForm */
?>

<link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet" href="../../leaflet-0.7.3/leaflet.css" />
<script data-require="leaflet@0.7.3" data-semver="0.7.3" src="../../leaflet-0.7.3/leaflet.js"></script>

<style>
.img-set-inmarker {
    width: 100%;
    height: 150px;
    object-fit: cover;
}
</style>

<div class="package-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-12">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-12">

            <?= $form->field($model, 'details')->textarea(['rows' => '3','class'=>'summernote']) ?>

        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'date_moment')->textInput(['type' => 'number','min'=>0,'maxlength' => true,'max'=>20]) ?>
        </div>

        <div class="col-md-8">
            <?php
                 $myArray = str_replace('"',"",$model->place);
                                 $myArray = explode(',', $myArray); 
            ?>
            <label class="control-label" for="place-package">สถานที่</label>
            <select class="form-control select__package" multiple>
                <!-- onchange="getID_place(this.value);" -->
                <option value="">
                    เลือกสถานที่
                </option>
                <?php 
                  
                    $Place =  Place::find()
                    ->orderBy([
                        'name'=>SORT_ASC,
                    ])
                    ->all();

					?>

                <?php foreach ($Place as $pla): 
						$selected = (in_array($pla['id'],$myArray)) ? 'selected' : '' ;
						?>
                <option value="<?=$pla['id'];?>" data-type="<?=$pla['type'];?>" data-id="<?=$pla['id'];?>"
                    <?=$selected;?>>
                    <?=$pla['name'];?></option>
                <?php endforeach ?>
            </select>

            <?= $form->field($model, 'place')->hiddenInput()->label(false); ?>
        </div>

        <div class="col-md-12">
            <div id="map" style="width: 100%; height: 500px;"></div>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'price')->textInput(['readonly'=>true]) ?>
        </div>

        <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false); ?>

        <?php $key_images = (!$model->isNewRecord) ? $model->key_images : time();?>
        <?= $form->field($model, 'key_images')->hiddenInput(['maxlength' => true,'value'=>$key_images, 'class'=>'get_key_images'])->label(false);?>

        <?= $form->field($model, 'date_create')->hiddenInput(['maxlength' => true, 'value'=>date("Y-m-d H:i:s")])->label(false); ?>

        <?= $form->field($model, 'user_create')->hiddenInput(['value'=>$_SESSION['user_id']])->label(false); ?>

        <div class="form-group text-center col-md-12 mt-3">
            <?= Html::submitButton(Yii::t('app', 'บันทึกข้อมูล'), ['class' => 'btn btn-success']) ?>
        </div>


    </div>

    <?php ActiveForm::end(); ?>



</div>

<script>
$(document).ready(function() {

    
    var mymap = null;
    var setlat = 13.732564;
    var setlon = 100.515000;
    var setzoom = 5;
    var arr = [];
    var count_price = 0;

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

        console.log(data);

        loadmap(data);

    }

 

    var arr_id = [];
    $('select').select2({
    multiple: true,
  });

  <?php if(!$model->isNewRecord):?>
    let val = $('#package-place').val();
    var array = JSON.parse("[" + val + "]");
    arr_id = array;
getdata_place(arr_id);
  $('select').val(array).trigger('change');

<?php else: //(!$model->isNewRecord): ?>
loadmap(arr);
<?php endif; //(!$model->isNewRecord): ?>

    $('select').on('select2:select', function(e) {
        var data = e.params.data;
        arr_id.push(data.id);
          mymap.off();
        mymap.remove();
        mymap = null;
        getdata_place(arr_id);
        $('#package-place').val('"' + arr_id.join('","') + '"');

    });

    $('select').on('select2:unselect', function(e) {
         mymap.off();
        mymap.remove();
        mymap = null;
        var data = e.params.data;
        arr_id.splice($.inArray(data.id, arr_id), 1);
        if (arr_id.length > 0) {
            $('#package-place').val('"' + arr_id.join('","') + '"');
            getdata_place(arr_id);
        } else {
            $('#package-place').val('');
            getdata_place([]);
        }

    });

    

    

    function loadmap(arr) {
        count_price = 0;
        if (arr.length > 0) {
            setlat = arr[0].latitude;
            setlon = arr[0].longitude;
            setzoom = 15;
        }else{
              setlat = 13.732564;
     setlon = 100.515000;
     setzoom = 5;
        }

        mymap = L.map('map').setView([setlat, setlon], setzoom);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 15,
            }).addTo(mymap);


        for (var i = 0; i < arr.length; i++) {
            count_price = count_price + arr[i].price;

            marker =
                L.marker([arr[i].latitude, arr[i].longitude], {
                    icon: new L.Icon({
                        iconSize: [50, 50],
                        iconAnchor: [25, 45],
                        shadowAnchor: [4, 62],
                        iconUrl: '../../images/image_maker/' + arr[i].icon_marker,
                    })
                }).addTo(mymap)
                .bindPopup(`
                <h6><b>${arr[i].name}</b></h6><br>
                <img src="../../images/images_upload_forform/${arr[i].name_img_important}" class="img-set-inmarker">
                <br><br>
                <b>วันทำการ : </b>${arr[i].business_day}<br>
                <b>เวลาเปิด-ปิด : </b>${arr[i].business_hours}<br>
                <b>ช่องทางติดต่อ : </b> ${arr[i].contact}
                `)
                .openPopup();
        }
        console.log(count_price);
        $("#package-price").val(count_price);


    }




});
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Provinces;
/* @var $this yii\web\View */
/* @var $model common\models\Place */
/* @var $form yii\widgets\ActiveForm */

$type = $_GET['type'];
?>

	<link
		data-require="leaflet@0.7.3"
		data-semver="0.7.3"
		rel="stylesheet"
		href="../../leaflet-0.7.3/leaflet.css"
		/>
		<script
		data-require="leaflet@0.7.3"
		data-semver="0.7.3"
		src="../../leaflet-0.7.3/leaflet.js"
		></script>


<div class="place-form">


    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <?= $form->field($model, 'type')->hiddenInput(['maxlength' => true,'value'=>75])->label(false); ?>
        <?php $key_images = (!$model->isNewRecord) ? $model->key_images : time();?>
        <?= $form->field($model, 'key_images')->hiddenInput(['maxlength' => true,'value'=>$key_images, 'class'=>'get_key_images'])->label(false);?>


        <?= $form->field($model, 'date_create')->hiddenInput(['maxlength' => true, 'value'=>date("Y-m-d H:i:s")])->label(false); ?>

        <?= $form->field($model, 'user_create')->hiddenInput(['value'=>$_SESSION['user_id']])->label(false); ?>

        <div class="col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?><?= $form->field($model, 'facebook_link')->textInput(['maxlength' => true,'class'=>'form-control engOnly']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true,'class'=>'form-control getlat']) ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true,'class'=>'form-control getlon']) ?>
        </div>

      
       
        <?= $form->field($model, 'details')->hiddenInput(['maxlength' => true,'value'=>"-"])->label(false); ?>

<?= $form->field($model, 'activity')->hiddenInput(['maxlength' => true,'value'=>"-"])->label(false); ?>

<?php echo $form->field($model, 'price')->hiddenInput(['maxlength' => true,'value'=>"1"])->label(false); ?>

<?php echo $form->field($model, 'contact')->hiddenInput(['maxlength' => true,'value'=>"-"])->label(false); ?>

<?php echo $form->field($model, 'business_hours')->hiddenInput(['maxlength' => true,'value'=>"-"])->label(false); ?>
<?php echo $form->field($model, 'line_id')->hiddenInput(['maxlength' => true,'value'=>"-"])->label(false); ?>

<?php echo $form->field($model, 'phone')->hiddenInput(['maxlength' => true,'value'=>"-"])->label(false); ?>
<?php echo $form->field($model, 'amphure')->hiddenInput(['maxlength' => true,'value'=>1])->label(false); ?>

<?php echo $form->field($model, 'district')->hiddenInput(['maxlength' => true,'value'=>1])->label(false); ?>

<?php echo $form->field($model, 'province')->hiddenInput(['maxlength' => true,'value'=>1])->label(false); ?>

<?php echo $form->field($model, 'status')->hiddenInput(['maxlength' => true,'value'=>1])->label(false); ?>
<?php echo $form->field($model, 'business_day')->hiddenInput(['maxlength' => true,'value'=>1])->label(false); ?>

       
        <div class="col-md-12">
<div class="card card-collapsed remove_collapsed">
	<div class="card-header">
		<h3 class="card-title"><dt><i class="fa fa-map-marker" style="color: #dc3545 !important;"></i> เลือกพิกัดจากแผนที่ (ละติจูด , ลองจิจูด)</dt></h3>
		<div class="card-options">
			<div class="show-hide">
				<a href="#showmap" class="card-options-collapse open_map"><i class="fe fe-chevron-up"></i></a>
			</div>
		</div>
	</div>
	<div class="card-body">

		<div id="mapid" style="width: 100%; height: 500px;"></div>    
	</div>
</div>

        </div>


        <div class="form-group text-center col-md-12 mt-3">
            <?= Html::submitButton(Yii::t('app', 'บันทึกข้อมูล'), ['class' => 'btn btn-success']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>


</div>


<script>
// $(document).ready(function() {

    

	var mymap = null;
                var setlat = 13.732564;
                var setlon = 100.515000;
                var setzoom = 5;

let arr_day_check = [];





	
				$(document).on('click', '.open_map', function(){
					$(".show-hide").html(`
						<a href="#showmap" class="card-options-collapse close_mep"><i class="fa fa-angle-up"></i></a>
						`);

					$(".remove_collapsed").removeClass("card-collapsed");
					if (mymap==null) {loadmap();}else{
					}
				});


				$(document).on('focusin', '.getlat', function(){
					$(".show-hide").html(`
						<a href="#showmap" class="card-options-collapse close_mep"><i class="fa fa-angle-up"></i></a>
						`);

					$(".remove_collapsed").removeClass("card-collapsed");
					if (mymap==null) {loadmap();}else{
					}
				});

				$(document).on('focusin', '.getlon', function(){
					$(".show-hide").html(`
						<a href="#showmap" class="card-options-collapse close_mep"><i class="fa fa-angle-up"></i></a>
						`);

					$(".remove_collapsed").removeClass("card-collapsed");
					if (mymap==null) {loadmap();}else{
					}
				});

				$(document).on('click', '.close_mep', function(){
					$(".show-hide").html(`
						<a href="#showmap" class="card-options-collapse open_map"><i class="fe fe-chevron-up"></i></a>
						`);
					$(".remove_collapsed").addClass("card-collapsed");
				});

				function loadmap(){
					mymap = L.map('mapid').setView([setlat, setlon], setzoom);

					L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
						maxZoom: 19,
						attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
						'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
						'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
						id: 'mapbox/streets-v11',
						tileSize: 512,
						zoomOffset: -1
					}).addTo(mymap);



					var popup = L.popup();

					function onMapClick(e) {
						popup
						.setLatLng(e.latlng)
						.setContent("ตำแหน่งที่ตั้ง " + e.latlng.toString())
						.openOn(mymap);
						var latlng = e.latlng.toString().replace('LatLng(', "");
						latlng = latlng.toString().replace(')', "");
						latlng = latlng.toString().split(",");
                        document.getElementsByClassName("getlat")[0].value = latlng[0];
                        document.getElementsByClassName("getlon")[0].value = latlng[1];
					}

					mymap.on('click', onMapClick);

				}


</script>
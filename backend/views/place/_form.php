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

        <?= $form->field($model, 'type')->hiddenInput(['maxlength' => true,'value'=>$type])->label(false); ?>
        <?php $key_images = (!$model->isNewRecord) ? $model->key_images : date("Ymd_his");?>
        <?= $form->field($model, 'key_images')->hiddenInput(['maxlength' => true,'value'=>$key_images, 'class'=>'get_key_images'])->label(false);?>

        <?= $form->field($model, 'date_create')->hiddenInput(['maxlength' => true, 'value'=>date("Y-m-d H:i:s")])->label(false); ?>

        <?= $form->field($model, 'user_create')->hiddenInput(['value'=>$_SESSION['user_id']])->label(false); ?>

        <div class="col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'details')->textArea(['maxlength' => true,'rows' => '3','class'=>'summernote']) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'activity')->textArea(['maxlength' => true,'rows' => '3','class'=>'summernote']) ?>
        </div>


        <div class="col-md-6">

            <label class="control-label" for="place-province">จังหวัด</label>
            <select class="form-control select__province" onchange="getID_province(this.value);">
                <option value="">
                    เลือกจังหวัด
                </option>
                <?php 
                  
                    $Provinces =  Provinces::find()
                    ->orderBy([
                        'name_th'=>SORT_ASC,
                    ])
                    ->all();

					?>

                <?php foreach ($Provinces as $prov): 
						$selected = ($model->province==$prov['id']) ? 'selected' : '' ;
						?>
                <option value="<?=$prov['id'];?>" data-province_lat="<?=$prov['province_lat'];?>"
                    data-province_lon="<?=$prov['province_lon'];?>" <?=$selected;?>>
                    <?=$prov['name_th'];?></option>
                <?php endforeach ?>
            </select>

            <?= $form->field($model, 'province')->hiddenInput()->label(false); ?>
        </div>

        <div class="col-md-6">
            <label class="control-label" for="place-amphure">อำเภอ</label>
            <select id="get_amphoe" class="form-control select__amphoe">
                <option value="">
                    เลือกอำเภอ
                </option>
            </select>
            <?= $form->field($model, 'amphure')->hiddenInput()->label(false); ?>
        </div>

        <div class="col-md-6">
            <label class="control-label" for="place-district">ตำบล</label>
            <select id="get_tombon" class="form-control select__tombon">
                <option value="">
                    เลือกตำบล
                </option>
            </select>
            <?= $form->field($model, 'district')->hiddenInput()->label(false); ?>
        </div>



        <div class="col-md-6"> </div>

        <div class="col-md-12">
            <?= $form->field($model, 'contact')->textArea(['maxlength' => true,'rows' => '2']) ?>
        </div>


        <div class="col-md-6">
            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true,'class'=>'form-control getlat']) ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true,'class'=>'form-control getlon']) ?>
        </div>

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

        <div class="col-md-6">
            <label class="" for="place-business_day">วันที่เปิดให้บริการ</label> <br>
            <label class="checkbox-inline mr-2">
                <input class="daytype_1 checkday" type="checkbox" value="จ-ศ" id="checkday1" data-daytype="1"> จ-ศ
            </label>
            <label class="checkbox-inline mr-2">
                <input class="daytype_1 checkday" type="checkbox" value="จ-ส" id="checkday2" data-daytype="1"> จ-ส
            </label> 
            <label class="checkbox-inline mr-2">
                <input class="daytype_1 checkday" type="checkbox" value="ส-อา" id="checkday3" data-daytype="1"> ส-อา
            </label>
              <label class="checkbox-inline mr-2">
                <input class="daytype_1 checkday" type="checkbox" value="ทุกวัน" id="checkday2" data-daytype="1"> ทุกวัน
            </label>

            <br>

            <label class="checkbox-inline mr-2">
                <input class="daytype_2 checkday" type="checkbox" value="จ" id="checkday4" data-daytype="2"> จ
            </label>
            <label class="checkbox-inline mr-2">
                <input class="daytype_2 checkday" type="checkbox" value="อ" id="checkday5" data-daytype="2"> อ
            </label>
            <label class="checkbox-inline mr-2">
                <input class="daytype_2 checkday" type="checkbox" value="พ" id="checkday6" data-daytype="2"> พ
            </label>
            <label class="checkbox-inline mr-2">
                <input class="daytype_2 checkday" type="checkbox" value="พฤ" id="checkday7" data-daytype="2"> พฤ
            </label>
            <label class="checkbox-inline mr-2">
                <input class="daytype_2 checkday" type="checkbox" value="ศ" id="checkday8" data-daytype="2"> ศ
            </label>

            <label class="checkbox-inline mr-2">
                <input class="daytype_2 checkday" type="checkbox" value="ส" id="checkday9" data-daytype="2"> ส
            </label>
            <label class="checkbox-inline mr-2">
                <input class="daytype_2 checkday" type="checkbox" value="อา" id="checkday10" data-daytype="2"> อา
            </label>

            <?= $form->field($model, 'business_day')->hiddenInput(['maxlength' => true])->label(false);  ?>
            <span id="show-business_day"></span>
        </div>



        <div class="col-md-6 row" style="margin-left: 0.5px !important;">
            <label class="control-label col-md-12" for="place-business_hours">เวลาทำการ
                (เปิด-ปิด)</label>

            <div class="col-md-6">
                <input id="open_time" type="time" class="form-control checkinputtime" min="00:00" max="12:00"
                    placeholder="เปิด">
            </div>

            <div class="col-md-6">
                <input id="close_time" type="time" class="form-control checkinputtime" min="13:00" max="24:00"
                    placeholder="ปิด">
            </div>



            <span class="error_checkinputtime" style="color:#dc3545 !important;">

            </span>

            <?= $form->field($model, 'business_hours')->hiddenInput(['maxlength' => true])->label(false);  ?>
        </div>


        <div class="col-md-6 pt-3">
            <?= $form->field($model, 'price')->textInput(['type' => 'number','min'=>0,'maxlength' => true]) ?>
        </div>

        <div class="col-md-6 pt-3">
            <?= $form->field($model, 'status')->radioList([0 => 'ปิดร้านแล้ว', 1 => 'ร้านเปิดปกติตามเวลาทำการ']); ?>
        </div>
        <div class="form-group text-center col-md-12 mt-3">
            <?= Html::submitButton(Yii::t('app', 'บันทึกข้อมูล'), ['class' => 'btn btn-success']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>


</div>


<script>
$(document).ready(function() {

    

<?php if(!$model->isNewRecord):?>
    const business_hours = $("#place-business_hours").val();
    if (business_hours != '') {
        const myArr = business_hours.split(",");
        $("#open_time").val(myArr[0]);
        $("#close_time").val(myArr[1]);
    }
    <?php endif; //(!$model->isNewRecord): ?>

    $(document).on('change', '.checkinputtime', function() {
        const open_time = $("#open_time").val();
    const close_time = $("#close_time").val();
         console.log(`${open_time} - ${close_time}`);
        if (close_time != '' && open_time != '') {
           
            $(".error_checkinputtime").html('');
            $("#place-business_hours").val(`${open_time},${close_time}`);
        } else {
            $(".error_checkinputtime").html('<b>กรุณาเลือกเวลา เปิด-ปิด ทำการให้ครบถ้วน</b>');
            $("#place-business_hours").val(``);
        }

    });

});

	var mymap = null;
                var setlat = 13.732564;
                var setlon = 100.515000;
                var setzoom = 5;

let arr_day_check = [];

<?php if(!$model->isNewRecord):?>
    let day_checked = $("#place-business_day").val();
    $("#show-business_day").html(day_checked);
    arr_day_check = day_checked.split(",");
<?php endif; //(!$model->isNewRecord): ?>

const checked_checkday = () => {
    console.log(arr_day_check);
    $(".checkday").each(function() {  
        let day = $(this).val();
        let type = $(this).data("daytype");
        arr_day_check.forEach(element => {
            if(day==element){
                 $(this).prop( "checked", true );
                if (type == 1) {
            arr_day_check = [];
            $(".daytype_2").each(function() {
                $(this).prop( "checked", false );
                $(this).prop("disabled", true);
            });

            $(".daytype_1").each(function() {
                if ($(this).val() != day) {
                    $(this).prop( "checked", false );
                    $(this).prop("disabled", true);
                }
            });
        }
            }
        });
    });
   
}

<?php if(!$model->isNewRecord):?>
checked_checkday();
<?php endif; //(!$model->isNewRecord): ?>


$(document).on('change', '.checkday', function() {
    let day = $(this).val();
    let type = $(this).data("daytype");
    let id = $(this).attr("id");
    if ($(this).is(':checked')) {
        if (type == 1) {
            arr_day_check = [];
            $(".daytype_2").each(function() {
                $(this).prop( "checked", false );
                $(this).prop("disabled", true);
            });

            $(".daytype_1").each(function() {
                if ($(this).val() != day) {
                    $(this).prop( "checked", false );
                    $(this).prop("disabled", true);
                }
            });
        }
        arr_day_check.push(day);
    } else {
        if (type == 1) {
            $(".daytype_2").each(function() {
                if ($(this).is(':checked')) {
                console.log($(this).val());
                $(this).removeAttr('checked');
                }
                
            });
        }
        $(".daytype_2,.daytype_1").each(function() {
            $(this).removeAttr('disabled');
        });
        
        arr_day_check.splice( $.inArray(day,arr_day_check) ,1 );
    }
    console.log(arr_day_check);
    let day_check = arr_day_check.toString();
    $("#place-business_day").val(day_check);
    $("#show-business_day").html(day_check);
});

const getlatlon_province = () => {
    setlat = $(".select__province").find(':selected').data('province_lat');
    setlon = $(".select__province").find(':selected').data('province_lon');
    setzoom = 13;
}

const getID_province = (val) => {
    if (val != undefined) {
        get_amphures(val, '');
        $("#place-province").val(val);
         setlat = $(".select__province").find(':selected').data('province_lat');
         setlon = $(".select__province").find(':selected').data('province_lon');
         setzoom = 13;
          mymap.off();
         mymap.remove();
         mymap = null;
        
         loadmap();
    }
}

const get_amphures = (id, idselect) => {
    $.ajax({
        url: "index.php?r=site/json_dynamic_select&type=get_amphures&province_id=" + id + "&idselect=" +
            idselect,
        method: "GET",
        success: function(data) {
            $(".select__amphoe").html(data);
        }
    });
}

$(document).on('click', '.select__amphoe', function() {
    var id = $(this).find(':selected').data('id');
    var code = $(this).find(':selected').data('code');
    var name_id = $(this).attr('id');
    $("#place-amphure").val(id);
    if (id != undefined) {
        get_districts(id, '');
    }
});

const get_districts = (id, idselect) => {
    $.ajax({
        url: "index.php?r=site/json_dynamic_select&type=get_districts&amphure_id=" + id + "&idselect=" +
            idselect,
        method: "GET",
        success: function(data) {
            $(".select__tombon").html(data);
        }
    });
}

$(document).on('click', '.select__tombon', function() {
    var id = $(this).find(':selected').data('id');
    var code = $(this).find(':selected').data('code');
    var name_id = $(this).attr('id');
    $("#place-district").val(id);
});


<?php
if(!$model->isNewRecord):?>
    getlatlon_province();
    get_amphures($("#place-province").val(), $("#place-amphure").val());
    get_districts($("#place-amphure").val(), $("#place-district").val()); 
<?php endif; //(!$model->isNewRecord): ?>
	
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
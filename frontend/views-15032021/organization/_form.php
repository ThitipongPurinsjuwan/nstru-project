<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\OrganizationType;
use app\models\Provinces;

/* @var $this yii\web\View */ 
/* @var $model app\models\Organization */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" href="../../html-version/assets/css/style_graph.css" />
<style>
.selectgroup-button {
    padding: 3px 15px !important;
}

input[type="file"] {
    display: none;
}
</style>

<div class="organization-form">
<?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="card">
        <div class="card-header bg-green-active text-white">
            <h3 class="card-title">ตั้งค่าแบบฟอร์ม - ข้อมูลทั่วไป</h3>
        </div>
        <div class="card-body row">
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?php
                $Organization =OrganizationType::find()->all();
                $type =ArrayHelper::map($Organization,'id','type');

                echo $form->field($model, 'type')->dropDownList($type,['prompt'=>'Select...'])->label();
                ?>

                <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-5">

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'village')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'province')->hiddenInput(['maxlength' => true])->label(false); ?>
                        <?php $provine = Yii::$app->db->createCommand("SELECT id,code,name_th FROM `provinces` ORDER BY name_th ASC")->queryAll(); 
                        ?>
                        <label>จังหวัด :</label>
                        <select name="province" id="province" class="form-control select__province">
                            <option value="">
                                เลือกจังหวัด
                            </option>
                            <?php foreach ($provine as $val_province): 
                                $selected = ($val_province['id']==$model->province) ? 'selected' : '';
                                ?>
                            <option value="<?=$val_province['name_th']?>" data-id="<?=$val_province['id']?>"
                                data-code="<?=$val_province['code']?>" <?=$selected;?>>
                                <?=$val_province['name_th']?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'amphure')->hiddenInput(['maxlength' => true])->label(false); ?>
                        <label> อำเภอ :</label>
                        <select name="amphure" id="amphure" class="form-control select__amphoe">

                            <option value="">
                                เลือกอำเภอ
                            </option>

                        </select>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'district')->hiddenInput(['maxlength' => true])->label(false); ?>
                        <label>ตำบล :</label>
                        <select name="district" id="district" class="form-control select__tombon">

                            <option value="">
                                เลือกตำบล
                            </option>

                        </select>
                    </div>
                </div>

                <script>
                $(document).ready(function() {
                    get_amphures($("#organization-province").val(), $("#organization-amphure").val());
                    get_districts($("#organization-amphure").val(), $("#organization-district").val());
                    $(document).on('change', '.select__province', function() {
                        var id = $(this).find(':selected').data('id');
                        var code = $(this).find(':selected').data('code');
                        var name_id = $(this).attr('id');
                        $("#organization-province").val(id);
                        if (id != undefined) {
                            get_amphures(id, '');
                        }
                    });

                    $(document).on('click', '.select__amphoe', function() {
                        var id = $(this).find(':selected').data('id');
                        var code = $(this).find(':selected').data('code');
                        var name_id = $(this).attr('id');
                        $("#organization-amphure").val(id);
                        if (id != undefined) {
                            get_districts(id, '');
                        }
                    });

                    function get_amphures(id, idselect) {
                        $.ajax({
                            url: "index.php?r=site/json_dynamic_select&type=get_amphures&province_id=" +
                                id + "&idselect=" + idselect,
                            method: "GET",
                            success: function(data) {
                                $(".select__amphoe").html(data);
                            }
                        });
                    }

                    function get_districts(id, idselect) {
                        $.ajax({
                            url: "index.php?r=site/json_dynamic_select&type=get_districts&amphure_id=" +
                                id + "&idselect=" + idselect,
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
                        $("#organization-district").val(id);
                    });

                });
                </script>


                <?php $model->unit_create = ($model->isNewRecord) ? $_SESSION['unit_id'] : $model->unit_create; ?>
                <?= $form->field($model, 'unit_create')->hiddenInput(['maxlength' => true])->label(false); ?>

                <?php $model->user_create = ($model->isNewRecord) ? $_SESSION['user_id'] : $model->user_create; ?>
                <?= $form->field($model, 'user_create')->hiddenInput(['maxlength' => true])->label(false); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'coor_lat')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'coor_lon')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>





                <div class="card card-collapsed remove_collapsed">
                    <div class="card-header">
                        <h3 class="card-title">
                            <dt><i class="fa fa-map-marker" style="color: #dc3545 !important;"></i> เลือกพิกัดจากแผนที่
                                (ละติจูด , ลองจิจูด)</dt>
                        </h3>
                        <div class="card-options">
                            <div class="show-hide">
                                <a href="#showmap" class="card-options-collapse open_map"><i
                                        class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet"
                            href="../../leaflet-0.7.3/leaflet.css" />
                        <script data-require="leaflet@0.7.3" data-semver="0.7.3" src="../../leaflet-0.7.3/leaflet.js">
                        </script>


                        <div id="mapid" style="width: 100%; height: 500px;"></div>
                        <script>
                        $(document).ready(function() {

                            var mymap = null;

                            $(document).on('click', '.open_map', function() {
                                $(".show-hide").html(`
                                          <a href="#showmap" class="card-options-collapse close_mep"><i class="fa fa-angle-up"></i></a>
                                          `);

                                $(".remove_collapsed").removeClass("card-collapsed");
                                if (mymap == null) {
                                    loadmap();
                                } else {}
                            });


                            $(document).on('focusin', '#organization-coor_lat', function() {
                                $(".show-hide").html(`
                                          <a href="#showmap" class="card-options-collapse close_mep"><i class="fa fa-angle-up"></i></a>
                                          `);

                                $(".remove_collapsed").removeClass("card-collapsed");
                                if (mymap == null) {
                                    loadmap();
                                } else {}
                            });

                            $(document).on('focusin', '#organization-coor_lon', function() {
                                $(".show-hide").html(`
                                          <a href="#showmap" class="card-options-collapse close_mep"><i class="fa fa-angle-up"></i></a>
                                          `);

                                $(".remove_collapsed").removeClass("card-collapsed");
                                if (mymap == null) {
                                    loadmap();
                                } else {}
                            });

                            $(document).on('click', '.close_mep', function() {
                                $(".show-hide").html(`
                                          <a href="#showmap" class="card-options-collapse open_map"><i class="fe fe-chevron-up"></i></a>
                                          `);

                                $(".remove_collapsed").addClass("card-collapsed");
                            });

                            function loadmap() {
                                mymap = L.map('mapid').setView([13.732564, 100.515000], 5);

                                L.tileLayer(
                                    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
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
                                    document.getElementById('organization-coor_lat').value = latlng[0];
                                    document.getElementById('organization-coor_lon').value = latlng[1];
                                }

                                mymap.on('click', onMapClick);

                            }



                        });
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <label for="">รูปภาพ</label>
                <div class="well">
                    <?= Html::img($model->getPhotoViewer(),['style'=>'width:170px;height:170px;object-fit: cover;border-radius:10px;box-shadow: 2px 3px 7px #00000096;','class'=>'img-rounded','id'=>'imgOld',"onerror"=>"this.onerror=null;this.src='img/none.png';"]); ?>
                    <img id="person_pic" style="height:170px;object-fit: cover;">
                </div><br>
                <label for="organization-images" class="custom-file-upload">
                    <i class="fe fe-upload"></i> เลือกไฟล์รูปภาพ
                </label>
                <?= $form->field($model, 'images')->fileInput(["onchange"=>"document.getElementById('person_pic').src = window.URL.createObjectURL(this.files[0]),document.getElementById('imgOld').style.display ='none'","accept"=>"image/*"])->label(false); ?>
                <div id="imgerror"></div>
                <?php if (!$model->isNewRecord): ?>
                <input type="hidden" name="file_name_old" value="<?=$model->images;?>" id="file_name_old">
                <?php endif ?>
            </div>
        </div>
    </div>




    <!-- <button type="button" class="btn btn-primary showdata_level mt-2" data-toggle="modal" data-target="#myModal_level">
        เพิ่มระดับภายในองค์กร
    </button>
-->
    <div class="card card-success">
        <div class="card-header">

            <div class="card-options">
                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                        class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div style="width:100%; height:109vh;" id="tree"> </div>
        </div>
    </div>

    <?= $form->field($model, 'data_json')->textArea(['maxlength' => true,'rows'=>'1','style'=>'visibility: hidden;height: 0px !important;'])->label(false); ?>

    <div class="form-group">
        <div class="row">
            <div id="show_error" class="col-md-12"></div>
        </div>

        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success savesort']) ?>
        <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-light']) ?>
    </div>
    <?php ActiveForm::end(); ?>


</div>



<!-- The Modal -->

<div class="modal" id="myModal_level">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="box_title_head">
                    <dt>เลือกระดับภายในองค์กร</dt>
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- <div class="box_show_data">

                </div> -->

            </div>

        </div>
    </div>

</div>


<div class="modal fade show" id="add_position" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog" style="z-index: inherit;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="box_title_head">
                    <dt>เลือกตำแหน่งภายในองค์กร</dt>
                </h5>
                <button type="button" class="close close-add_position" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">

                        <select name="select_position" id="select_position" class="form-control show_position"></select>

                        <a href="index.php?r=organization-position" class="btn btn-secondary mt-3 manage_position"
                            target="_blank" role="button">จัดการข้อมูตำแหน่งภายในองค์กร</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-backdrop show"></div>
</div>



<div class="modal fade show" id="showdata_person" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm" style="z-index: inherit;">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
                <button type="button" class="close close-showdata_person" data-dismiss="modal"></button>
                <div class="text-center mb-4">
                    <div id="rate"></div>
                    <div id="img_person"></div>
                </div>
                <span id="person_name"></span><br>
                <b>ตำแหน่ง : </b> <span id="position_name"></span>
            </div>

        </div>
    </div>
    <div class="modal-backdrop show"></div>
</div>


<div class="modal fade show" id="select_person" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg" style="z-index: inherit;">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="box_title_head">
                    <dt>เลือกบุคคลภายในองค์กร</dt>
                </h5>
                <button type="button" class="close close-select_person" data-dismiss="modal">&times;</button>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <a href="index.php?r=site/pages&view=eform_dataperson&form_id=21"
                    class="btn btn-info btn-sm close-select_person" role="button" style="float: right;"
                    target="_blank">เพิ่มข้อมูลบุคคล ผกร.</a>
                <table class="table table-hover js-basic-example dataTable table_custom border-style spacing5"
                    id="table_show_person">

                </table>
            </div>

        </div>
    </div>
    <div class="modal-backdrop show"></div>
</div>




<?php include ('js-org-form.php'); ?>




<script>
    $(document).ready(function(){
        $(".field-users-unit_id").addClass('multiselect_div');
        $('.multiselect-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200,
        });
    });

    $(document).on('click', '.checkimg', function(){
        <?php if (!$model->isNewRecord): ?>
            if (!$('#file_name_old').val()) {
                if (!$('#organization-images').val()) {
                  $("#imgerror").html('<span class="help-block">รูปภาพต้องไม่ว่างเปล่า</span>');
                  return false;
              }
          }
          <?php else: ?>
            if (!$('#organization-images').val()) {
              $("#imgerror").html('<span class="help-block">รูปภาพต้องไม่ว่างเปล่า</span>');
              return false;
          }
      <?php endif; ?>

  });
</script>
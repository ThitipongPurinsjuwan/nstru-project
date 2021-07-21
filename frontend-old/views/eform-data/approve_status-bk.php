

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\EformData */

//echo $model->data_json;
$data_edata = @json_decode($model->data_json,TRUE);
$val_eform = $data_edata[0];
// var_dump($val_eform);
$id = $model->form_id;

$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();

$sql_template = "SELECT * FROM `eform_template` WHERE id = '$id'";
$query_template = Yii::$app->db->createCommand($sql_template)->queryOne();
$data = @json_decode($query_template['form_element'],TRUE);
$data_loop = $data[0]['fieldGroup'];
sksort($data_loop, "sort", true);

$this->title = $query_template['detail'];
// $this->params['breadcrumbs'][] = ['label' => $query_template['detail'], 'url' => ['eform-data/index','form_id'=>$id]];
$this->params['breadcrumbs'][] = "รับทราบข้อมูล : ".$this->title;
\yii\web\YiiAsset::register($this);

$iconmarker = '';
?>
<style>
.list-design{
overflow-y: scroll;
overflow-x: hidden;
}
</style>
<link rel="stylesheet" href="../../html-version/assets/css/style_table.css"/>





<div class="eform-data-view">

<h1><?= Html::encode($this->title) ?></h1>





<div class="row">
<div class="col-md-8">
<div id="show_error"></div>
<div class="card">
<div class="card-header bg-secondary text-white">
<dt>รายละเอียดข้อมูล</dt>
</div>
<div class="card-body" id="check-height">

<div class="row">
<?php foreach ($data_loop as $col) : 
if ($col['templateOptions']['urlmarker']!=null) {
$iconmarker = $col['templateOptions']['urlmarker'];
}
?>

<div class="<?=$col['className'];?> mb-3">
<label for="<?=$col['key'];?>"><dt><?=$col['templateOptions']['label'];?> :</dt></label>
<?php if ($col['type']=='input'): ?>
<?php if ($col['templateOptions']['type']!=null): ?>
<?php if ($col['templateOptions']['type']=='date'): ?>
<?=DateThai($val_eform[$col['key']]);?>
<?php elseif($col['templateOptions']['type']=='radio'): ?>
<?php $arr = $col['templateOptions']['options'];
$key = array_search($val_eform[$col['key']], array_column($arr, 'value')); 
echo $col['templateOptions']['options'][$key]['label'];
?>
<?php elseif($col['templateOptions']['type']=='checkbox'): ?>
<?php 
foreach ($val_eform[$col['key']] as $key => $value) {
$arr = $col['templateOptions']['options'];
$key = array_search($value, array_column($arr, 'value'));
$show .= $col['templateOptions']['options'][$key]['label'].", ";
}
$string = rtrim($show, ", ");
echo $string;
?>
<?php else: ?>
5656
<?php endif ?>
<?php else: ?>
<?=$val_eform[$col['key']];?>
<?php endif ?>

<?php elseif($col['type']=='textarea'): ?>
<br><?=$val_eform[$col['key']];?>

<?php elseif($col['type']=='select'): ?>

<?php if ($col['templateOptions']['model']!=null): ?>
<?php 
$id_column = $col['templateOptions']['model']['id'];
$type_column = $col['templateOptions']['model']['type_name'];
$table_column = $col['templateOptions']['model']['table'];

$sql = "SELECT $id_column,$type_column FROM $table_column WHERE $id_column = '".$val_eform[$col['key']]."'";
$query = Yii::$app->db->createCommand($sql)->queryOne();
echo $query[$type_column];
?>

<?php else: ?>

<?php 
$arr = $col['templateOptions']['options'];
$key = array_search($val_eform[$col['key']], array_column($arr, 'value')); 
echo $col['templateOptions']['options'][$key]['label'];
?>

<?php endif; ?>
<?php else: ?>
<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>
<?php $have_map = 1; ?>
<?php endif; ?>

</div>



<?php endforeach ?>



</div>
<?= DetailView::widget([
'model' => $model,
'attributes' => [
[
'attribute'=>'date_time',
'format'=>'raw',
'value' => function($model, $key)
{
if(!empty($model->date_time))
{
return DateThaiTime($model->date_time);
}
},
],
],
]) ?>
</div>

</div>

<div class="card">
<div class="card-body">

<label for=""><dt>การเผยแพร่ข้อมูล</dt></label><br>
<div id="data_json" style="visibility: hidden;height: 0px;">
<?=$model->data_json;?>
</div>
<!-- <input type="text" value="" name="data_json" id="data_json"> -->
<input type="hidden" value="<?=$model->id;?>" name="eform_id" id="eform_id">
<input type="hidden" value="<?=$val_eform['stay_informed'];?>" name="stay_informed_old" id="stay_informed_old">
<input type="radio" name="stay_informed" value="1" class="check_stay_informed"  <?php echo ($val_eform['stay_informed']==1) ? 'checked' : ''; ?>> อนุญาต
<input type="radio" name="stay_informed" value="2" class="check_stay_informed" <?php echo ($val_eform['stay_informed']==2) ? 'checked' : ''; ?>> ไม่อนุญาต
<input type="button" class="btn btn-primary update_stay_informed" value="บันทึก" style="margin-left: 0.8em;"/>
</div>
</div>

</div>
<div class="col-md-4">
<div class="card" id="showfiles_card">
<div class="card-header bg-secondary text-white">
<dt>เอกสารประกอบ</dt>
</div>
<div class="card-body">

<input type="hidden" name="id_sql_eform" id="id_sql_eform" value="<?=$model->id;?>">
<div class="show-status text-center"></div>
<div class="list-design">
<ul class="list-group list-show-process" id="showfiles">
</ul>
</div>
</div>
</div>

</div>

<div class="col-md-12 text-center" id="insert_success">
</div>


<?php if ($have_map>0): ?>
<div class="col-xl-12 col-lg-12">
<div class="card">
<div class="card-header">
<h3 class="card-title"><dt>แผนที่แสดงพิกัด (ละติจูด , ลองจิจูด)</dt></h3>
<div class="card-options">
<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
</div>
</div>
<div class="card-body">
<link
data-require="leaflet@0.7.3"
data-semver="0.7.3"
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css"
/>
<script
data-require="leaflet@0.7.3"
data-semver="0.7.3"
src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"
></script>


<div id="mapshow" style="width: 100%; height: 500px;"></div>    
<script>

var mymap = L.map('mapshow').setView([<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>], 10);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
maxZoom: 15,
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
id: 'mapbox/streets-v11',
tileSize: 512,
zoomOffset: -1
}).addTo(mymap);

L.marker([<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>],{
icon: new L.Icon({
iconSize: [50, 50],
iconAnchor: [25, 45],
shadowAnchor: [4, 62],
iconUrl: '<?=$iconmarker;?>',
})
}).addTo(mymap)
.bindPopup("<b>พิกัด (<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>)</b>").openPopup();

var popup = L.popup();


</script>
</div>
</div>
</div>
<?php endif ?>



</div>

</div>


<script>

$(document).ready(function(){
$(document).on('click', '.update_stay_informed', function(){
var csrfToken = $('meta[name="csrf-token"]').attr("content");
var data_json = $("#data_json").html();
var id_sql_eform = $("#eform_id").val();
var stay_informed_old = $("#stay_informed_old").val();

var check_stay_informed = $("input[type='radio'].check_stay_informed:checked").val();

if (check_stay_informed === undefined || check_stay_informed === null) {
alert('กรุณาเลือกตัวเลือกการเผยแพร่ข้อมูล');
}else{
var res = data_json.replace('"stay_informed":"'+stay_informed_old+'"','"stay_informed":"'+check_stay_informed+'"');
var re1 = res.replace('[','');
var data_json_string = re1.replace(']','');

var data_object = JSON.parse(data_json_string);
console.log(data_object);

$.ajax({
url:"index.php?r=site/insert_file_upload_list&type=update_eform",
data:{id_sql_eform:id_sql_eform,data_json:data_json_string,data_object:data_object,_csrf : csrfToken},
type: 'post',
dataType: 'json',
success:function(data)
{
if (data.status==1) {
$("#show_error").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong><i class="fas fa-check-circle" aria-hidden="true"></i></strong> บันทึกข้อมูลสำเร็จ <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
}else{
$("#show_error").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong> ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่ <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
}
}
});
}

});

});
</script>

<script>
$(document).ready(function(){
var clientHeight = document.getElementById('check-height').clientHeight;
var height_inlist = parseInt(clientHeight-239.66);
// $('#showfiles').css({height: height_inlist});

var showlist_files = [];
load_data_files_show();
var count = 0;
function load_data_files_show(){
var id_sql_eform = <?=$model->id;?>;
$.ajax({
url:"index.php?r=site/insert_file_upload_list_type&type=showlistdata&eform_data_id="+id_sql_eform,
method:"GET",
dataType:"json",
contentType: "application/json; charset=utf-8",
success:function(data)
{

// console.log(data.length);
if (data.length>0) {
$.each(data, function(index) {
showfiles(data[index].file_name,data[index].file_id,data[index].bucket);
});
}else{
$("#showfiles").html("");
$("#showfiles_card").css({display: 'none'});
}
}
});
}

function showfiles(file_name,file_id,bucket) {
$.ajax({
url:"<?=$url_node['setting_value'];?>/filepathminio?namefile="+file_name+"&bucket="+bucket,
method:"GET",
dataType:"json",
contentType: "application/json; charset=utf-8",
success:function(data)
{
showlist_files.push('<li class="list-group-item d-flex justify-content-between align-items-center"><a href="'+data.url+'" target="_blank">'+file_name+'</a></li>');
$("#showfiles").html(showlist_files.join(""));
}


});

// console.log(showlist_files);

}

});
</script>

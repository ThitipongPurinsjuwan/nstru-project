<?php
use app\models\Setting;
use yii\helpers\Html;
use yii\widgets\DetailView;

$users_data = Yii::$app->db->createCommand("SELECT * FROM users,unit WHERE users.id = '".$_SESSION['user_id']."' AND users.unit_id = unit.unit_id")->queryOne();

/* @var $this yii\web\View */
/* @var $model app\models\EformData */

$data_edata = @json_decode($model->data_json,TRUE);
$val_eform = $data_edata[0];
// var_dump($val_eform);
$id = $model->form_id;

$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();

$sql_template = "SELECT * FROM `eform` WHERE form_id = '$id' AND id = '".$model->eform_id."'";
$query_template = Yii::$app->db->createCommand($sql_template)->queryOne();
$data = @json_decode($query_template['form_element'],TRUE);
$data_loop = $data[0]['fieldGroup'];
sksort($data_loop, "sort", true);

$this->title = $query_template['detail'];
$this->params['breadcrumbs'][] = ['label' => $query_template['detail'], 'url' => ['eform-data/index','form_id'=>$id]];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$iconmarker = '';


$eform_template = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '$id'")->queryOne();
$at = Yii::$app->db->createCommand("SELECT * FROM `approve_template` WHERE id = '".$eform_template['approve_type']."'")->queryOne();
$data_at = @json_decode($at['step'],TRUE);
$data_approve = $data_at[0];

$data_edata_approve = $val_eform['approve'];

$checked_approve = ($data_edata_approve!="") ? '' : 'checked';
?>
<style>
.list-design{
overflow-y: scroll;
overflow-x: hidden;
}
</style>
<link rel="stylesheet" href="../../html-version/assets/css/style_table.css"/>
<link rel="stylesheet" href="../../html-version/assets/css/style_eform-data.css"/>
<div class="eform-data-view">
<h4><dt><?= Html::encode($this->title) ?></dt></h4>
<hr>
<style>
input[data-description="เริ่ม"]:checked ~ #timeline-descriptions-wrapper p[data-description="เริ่ม"] {
display: block;
}
<?php foreach ($data_approve as $k => $v): ?>
input[type="radio"][data-description="<?=$k;?>"]:checked ~ #timeline-descriptions-wrapper p[data-description="<?=$k;?>"] {
display: block;
}
<?php endforeach; ?>
.input-flex-container {
margin-top: 5em;
display: flex;
justify-content: space-around;
align-items: center;
flex-wrap: wrap;
width: <?php echo 8.5+(count($data_approve)*5);?>vw;
/*width: 80vw;*/
max-width: 1000px;
position: relative;
z-index: 0;
margin-left: calc((80vw - 25px) / 20);
}
</style>
<!-- <div class="container_step">
<ul class="progressbar_step">
<li class="active">login</li>
<li>choose interest</li>
<li>add friends</li>
<li>View map</li>
</ul>
</div> -->
<div class="row">


<div class="col-md-8">

<div class="card">
<div class="card-body" id="check-height">

<h5><dt>การอนุมัติข่าว</dt></h5><br>
<div class="flex-parent">
<div class="input-flex-container">
<input type="radio" name="timeline-dot" data-description="เริ่ม" <?=$checked_approve;?>>
<div class="dot-info" data-description="เริ่ม">
<span class="year">เริ่ม</span>
<span class="label">นำเข้าข้อมูล</span>
</div>

<?php 
$n = 1;
foreach ($data_approve as $k => $v):
$checkbefore = (!empty($data_edata_approve)) ? count($data_edata_approve) : 0;
$ck_ap = ($checkbefore==$n) ? 'checked': '';

?>
<input type="radio" name="timeline-dot" data-description="<?=$k;?>" <?=$ck_ap;?>>
<div class="dot-info" data-description="<?=$k;?>">
<span class="year">ขั้นตอนที่ <?=$n;?></span>
<span class="label"><?=$v;?></span>
</div>
<?php $n++;
endforeach ?>

<div id="timeline-descriptions-wrapper">
<p data-description="เริ่ม"><b>วันที่นำเข้าข้อมูล</b> : <?=DateThaiTime($val_eform['date_record']);?><br><b>ผู้บันทึกข้อมูล </b>: <?=$val_eform['user_create_name'];?><br><b>หน่วยที่บันทึกข้อมูล</b> : <?=$val_eform['unit_name'];?></p>
<?php 
$n = 0;
foreach ($data_approve as $k => $v):
?>
<?php if ($data_edata_approve!=""): ?>

<p data-description="<?=$k;?>">
<b>วันที่<?=$v;?></b> : <?=DateThaiTime($data_edata_approve[$n]['date_time']);?><br>
<b>ผู้<?=$v;?></b> : <?=$data_edata_approve[$n]['user_approve'];?>
<?php if (!empty($data_edata_approve[$n]['unit_name'])): ?>
<br>
<b>หน่วยที่<?=$v;?></b> : <?=$data_edata_approve[$n]['unit_name'];?>
</p>
<?php endif ?>
<?php endif ?>
<?php 
$n++;
endforeach ?>
</div>
</div>
</div>
</div>
</div>

<div id="data_json" style="visibility: hidden;height: 0px;">
<?=$model->data_json;?>
</div>
<?php $data_edata_history = $val_eform['history']; 
	var_dump($data_edata_history);
?>
<div id="show_error"></div>

<script>

$(document).ready(function(){

function convertDate(date){
var date_auth =
date.getFullYear() + "-" +
("00" + (date.getMonth() + 1)).slice(-2) + "-" +
("00" + (date.getDate()+ 1)).slice(-2) + " " +
("00" + date.getHours()).slice(-2) + ":" +
("00" + date.getMinutes()).slice(-2) + ":" +
("00" + date.getSeconds()).slice(-2);

return date_auth;
}

var csrfToken = $('meta[name="csrf-token"]').attr("content");

var data_json = $("#data_json").html();
var id_sql_eform = "<?=$model->id;?>";

var data_object =  JSON.parse(data_json);
var obj = '';


if (data_object[0].history!=undefined) {
if (data_object[0].history.length>0) {
obj = JSON.stringify(data_object[0].history);
} else {
obj = '[]';
}
}else{
obj = '[]';
}

var date_view = convertDate(new Date());

var first = obj.replace("[", "");
var end = first.replace("]", "");
var history_use = '';
var res_use = `{"date_time":"${date_view}" , "user_view":"<?=$users_data['name'];?>","unit_name":"<?=$users_data['unit_name'];?>","action":"ดู"}`;
if (end.length>0) {
history_use = "["+end+","+res_use+"]";
}else{
history_use = "["+res_use+"]";
}

if (data_object[0].history!=undefined) {
data_object[0].history = JSON.parse(history_use);
}else{
var res = data_json.slice(0,-2);
var new_object = `${res},"history":${history_use}}]`
data_object = JSON.parse(new_object);
}


var data_json_real =  JSON.stringify(data_object);

var re1 = data_json_real.slice(1);
var re2 = re1.slice(0,-1);
data_json_real = re2;
var data_object_real = data_object;

console.log(data_json_real);
console.log(data_object_real);


$.ajax({
url:"index.php?r=site/insert_file_upload_list&type=update_eform",
data:{id_sql_eform:id_sql_eform,data_json:data_json_real,data_object:data_object_real,_csrf : csrfToken},
type: 'post',
dataType: 'json',
success:function(data)
{}
});


});


</script>

<div class="card">
<div class="card-header bg-secondary text-white">
<dt>รายละเอียดข้อมูล</dt>
</div>
<div class="card-body" id="check-height">

<div class="row" style="font-weight: 100 !important;">
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
<?php 
// $arr = $col['templateOptions']['options'];
// $key = array_search($val_eform[$col['key']], array_column($arr, 'value')); 
// echo $col['templateOptions']['options'][$key]['label'];
echo $val_eform[$col['key']];
?>
<?php elseif($col['templateOptions']['type']=='checkbox'): ?>
<?php 
foreach ($val_eform[$col['key']] as $key => $value) {
// $arr = $col['templateOptions']['options'];
// $key = array_search($value, array_column($arr, 'value'));
// $show .= $col['templateOptions']['options'][$key]['label'].", ";
$show .= $value.", ";
}
$string = rtrim($show, ", ");
echo $string;
?>
<?php else: ?>
<?=$val_eform[$col['key']];?>
<?php endif ?>
<?php else: ?>
<?=$val_eform[$col['key']];?>
<?php endif ?>

<?php elseif($col['type']=='textarea'): ?>
<br><?=$val_eform[$col['key']];?>

<?php elseif($col['type']=='select'): ?>

<?php if ($col['templateOptions']['model']!=null): ?>
<?php 
// $id_column = $col['templateOptions']['model']['id'];
// $type_column = $col['templateOptions']['model']['type_name'];
// $table_column = $col['templateOptions']['model']['table'];

// $sql = "SELECT $id_column,$type_column FROM $table_column WHERE $id_column = '".$val_eform[$col['key']]."'";
// $query = Yii::$app->db->createCommand($sql)->queryOne();
// echo $query[$type_column];
echo $val_eform[$col['key']];
?>

<?php else: ?>

<?php 
// $arr = $col['templateOptions']['options'];
// $key = array_search($val_eform[$col['key']], array_column($arr, 'value')); 
// echo $col['templateOptions']['options'][$key]['label'];
echo $val_eform[$col['key']];
?>

<?php endif; ?>
<?php elseif($col['type']=='idcard'): ?>
<?=$val_eform[$col['key']];?>
<?php elseif($col['type']=='address'): 
$nameaddress = $col["key"];
?>
<div class="row" style="font-weight: 100 !important;">
<div class="col-md-2 text-right-align">
เลขที่ : 
<?php $nameaddress_no = $nameaddress."_no"; ?>
</div>
<div class="col-md-9">
<?=$val_eform[$nameaddress_no];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
หมู่บ้าน : 
<?php $nameaddress_mooban = $nameaddress."_mooban"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_mooban];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
ตำบล : 
<?php $nameaddress_tombon = $nameaddress."_tombon"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_tombon];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
อำเภอ : 
<?php $nameaddress_amphoe = $nameaddress."_amphoe"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_amphoe];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
จังหวัด :
<?php $nameaddress_province = $nameaddress."_province"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_province];?>
</div>
</div>
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
'label'=>'ผู้บันทึกข้อมูล',
'format'=>'raw',
'value' => Yii::$app->db->createCommand("SELECT name FROM `users` WHERE id = '".$val_eform['user_create_id']."'")->queryScalar(),
],
[
'label'=>'วันที่บันทึก/แก้ไข',
'format'=>'raw',
'value' => (!empty($val_eform['date_record'])) ? DateThaiTime($val_eform['date_record']) : '',
],
[
'label'=>'Form Version',
'format'=>'raw',
'value' => $val_eform['eform_version'],
],
],
]) ?>
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



<div class="modal " id="myModal">
<div class="modal-dialog modal-xl">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<h4 class="modal-title">แปลงข้อมูลจากไฟล์</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body" id="data_show">
</div>

<!-- Modal footer -->
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
</div>

</div>
</div>
</div>

<?php if ($_SESSION['user_role']=='3'): ?>
<p>
<a class="btn btn-primary" href="index.php?r=site/pages&view=eform_information&eform_data=<?=$model->id;?>">แก้ไขข้อมูล</a>
<button class="btn btn-danger del_data" data-id="<?=$model->id;?>"> <i class="fas fa-trash"></i>  ลบ</button>
<a href="index.php?r=eform-data/print-pdf&id=<?=$model->id;?>" target="_blank" class="btn btn-success" role="button"><i class="fas fa-print"></i> พิมพ์รายงาน</a>
</p>


<?php endif ?>

<?php

$this->registerJs("
$('.del_data').on('click', function(e) {
if (confirm('ต้องการลบข้อมูลใช่หรือไม่?')) {
var id_sql_eform = $(this).data('id');
load_data_files(id_sql_eform);
}

});

function load_data_files(id_sql_eform){
$.ajax({
url:'index.php?r=site/insert_file_upload_list&type=show&form_id='+id_sql_eform,
method:'GET',
dataType:'json',
contentType: 'application/json; charset=utf-8',
success:function(data)
{
if (data.length>0) {
$.each(data, function(index) {
removefile_minio(data[index].file_name,data[index].file_id,data[index].bucket,id_sql_eform);
});
}else{
delete_eform_data(id_sql_eform);
}
}
});
}

function removefile_minio(file_name,file_id,bucket,id_sql_eform){
$.ajax({
url:'".$url_node['setting_value']."/removefileminio?namefile='+file_name+'&bucket='+bucket,
method:'GET',
dataType:'json',
contentType: 'application/json; charset=utf-8',
success:function(data)
{
deleteDatabase(file_id,id_sql_eform);
}
});
}


function deleteDatabase(file_id,id_sql_eform){
$.ajax({
url:'index.php?r=site/insert_file_upload_list&type=delete&file_id='+file_id,
method:'GET',
success:function(data)
{
load_data_files(id_sql_eform);
}
});
}

function delete_eform_data(id_sql_eform){
$.ajax({
url:'index.php?r=site/insert_file_upload_list&type=delete_eform&id_sql_eform='+id_sql_eform,
method:'GET',
dataType:'json',
contentType: 'application/json; charset=utf-8',
success:function(data)
{
alert('ลบข้อมูลสำเร็จ');
location.replace('index.php?r=site/pages&view=eform_information&form_id=".$id."');
}
});
}
");

?>

<script>
$(document).ready(function(){
var clientHeight = document.getElementById('check-height').clientHeight;
var height_inlist = parseInt(clientHeight-239.66);

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


			if (data.length>0) {
				$.each(data, function(index) {
					showfiles(data[index].file_name,data[index].file_id,data[index].bucket,data[index].origin_file_name);
				});
			}else{
				$("#showfiles").html("");
				$("#showfiles_card").css({display: 'none'});
			}
		}
	});
}

function showfiles(file_name,file_id,bucket,origin_file_name) {
	$.ajax({
		url:"<?=$url_node['setting_value'];?>/filepathminio?namefile="+file_name+"&bucket="+bucket,
		method:"GET",
		dataType:"json",
		contentType: "application/json; charset=utf-8",
		success:function(data)
		{
			showlist_files.push('<li class="list-group-item d-flex justify-content-between align-items-center"><a href="'+data.url+'" target="_blank">'+origin_file_name+'</a> <button class="btn btn-primary badge badge-primary badge-pill extractText" data-file-id="'+file_id+'" data-name-file="'+file_name+'" data-name-bucket="'+bucket+'" data-toggle="modal" data-target="#myModal">Extract</button></li>');
			$("#showfiles").html(showlist_files.join(""));
		}


	});



}

function switchColor(val) {
	var text = '';
	switch(val) {
		case 1:
		text = "display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #79bb0e !important;padding: 3px 5px;border-radius: 4px;";
		break;
		case 2:
		text = "display: inline-block !important;margin: 1px;color: #FFF !important;background-color: #9aa0ac !important;padding: 3px 5px;border-radius: 4px;";
		break;
	}
	return text;
}


$(document).on('click', '.extractText', function(){
	var file_id = $(this).data("file-id");
	var file_name = $(this).data("name-file");
	var bucket = $(this).data("name-bucket");
	var url = '<?=Setting::find()->where(['setting_name' => 'url_node'])->one()->setting_value?>/readfile?namefile='+file_name+'&bucket='+bucket;
	$('#data_show').html('กำลังประมวลผล... <br> <div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>');

	$.ajax({
		method: "GET",
		url: url,
	})
	.done(function(msg) {
		if(msg.text===null){
			$('#data_show').html('Can not extract text from file !!!');
			$.ajax({
				method: "POST",
				url: 'index.php?r=site/insert-extract-false',
				data: { file_id : file_id ,  file_name: file_name, text: JSON.stringify(msg.text) },
				success:function(data){

				}
			})
		}else{
			<?php
			$url_elasticsearch =  $Setting = Setting::find()->where(['setting_name' => 'url_elasticsearch'])->one()->setting_value;    
			?>

			var res2 = msg.text.replace(/-/g, ' ');
			var res3 = res2.replace(/,/g, ' ');
			var res4 = res3.replace(/"/g, ' ');
			var res5 = res4.replace(/\"/g, ' ');
			var res = res5.replace(/[&!@,'"^$*+?()[{\|/#\":;]/g, ' ');
			var settings = {
				"async": true,
				"crossDomain": true,
				"url": "<?=$url_elasticsearch?>/_analyze",
				"method": "POST",
				"headers": {
					"Authorization": "Basic " + btoa("elastic:changeme"),
					"content-type": "application/json",
				},
				"processData": false,
				"data": "{\r\n  \"tokenizer\": \"thai\",\r\n  \"text\": \""+res+"\"\r\n}"
			}
			$.ajax(settings).done(function (response) {
				var showdata = [];
				var data = response.tokens;
				var len_r = data.length;
				for (i = 0; i < len_r; i++) {
					var b = (i%2 == 0)? 1 : 2;
					showdata.push(`<span style="${switchColor(b)}">${data[i].token}</span>`
						);
				}


				$('#data_show').html(''+showdata.join(""));
			});


			$.ajax({
				method: "POST",
				url: 'index.php?r=site/insert-extract',
				data: { file_id : file_id ,  file_name: file_name, text: JSON.stringify(res) }
			})
			.done(function( msg ) {

			})

		}
	});
});

});

$( document ).ready(function() {

//$('#timeline').load('http://45.127.62.51:7000/textx/frontend/web/index.php?r=site/link-timeline-tab');
var data = [{"id":1,"topic":"Macaque, bonnet","content":"Shuangwang","date_time":"2020-09-03 07:47:04","detail":"leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis odio"},{"id":2,"topic":"Deer, savannah","content":"Lianhua","date_time":"2020-11-05 06:01:48","detail":"praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in imperdiet"},{"id":3,"topic":"Beisa oryx","content":"Milići","date_time":"2020-07-07 09:19:09","detail":"nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula"},{"id":4,"topic":"Snake, buttermilk","content":"Miyazu","date_time":"2020-07-20 02:53:16","detail":"convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id"},{"id":5,"topic":"Red-headed woodpecker","content":"Sangzhou","date_time":"2020-08-07 11:30:10","detail":"nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices phasellus"},{"id":6,"topic":"White-nosed coatimundi","content":"Batutulis","date_time":"2020-07-07 16:49:20","detail":"ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia"}];

$.ajax({
method: "POST",
url: 'index.php?r=site/link-timeline-tab',
data: data
})
.done(function( msg ) {
$('#timeline').html(msg);
})

});

</script>
<div id="timeline"></div>
<iframe src="index.php?r=site/link-timeline-tab" width="100%" height="500px;" 
style="border:0px solid black;"></iframe>

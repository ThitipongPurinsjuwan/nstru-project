<?php
use app\models\Setting;
use yii\helpers\Html;
use yii\widgets\DetailView;

if($_SESSION['user_role']!='1'){
$users_data = Yii::$app->db->createCommand("SELECT * FROM users,unit WHERE users.id = '".$_SESSION['user_id']."' AND users.unit_id = unit.unit_id")->queryOne();
}else{
$users_data = Yii::$app->db->createCommand("SELECT * FROM users WHERE users.id = '".$_SESSION['user_id']."'")->queryOne();
}

/* @var $this yii\web\View */
/* @var $model app\models\EformData */

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
$this->params['breadcrumbs'][] = ['label' => $query_template['detail'], 'url' => ['eform-data/index','form_id'=>$id]];
\yii\web\YiiAsset::register($this);

$iconmarker = '';
$eform_template = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '$id'")->queryOne();
$at = Yii::$app->db->createCommand("SELECT * FROM `approve_template` WHERE id = '".$eform_template['approve_type']."'")->queryOne();
$data_at = @json_decode($at['step'],TRUE);
$data_approve = $data_at[0];
//var_dump($data_approve);
$data_edata_approve = $val_eform['approve'];
//var_dump($data_edata_approve);


?>
<style>
.add_scrollbar{
overflow:auto;height:400px;
}
.list-design{
overflow-y: scroll;
overflow-x: hidden;
}
.user-accept-news{
display: inline-block;
}
.user-accept-news-right{
float: right;
}
#alertSuccess{
display: none;

}
.panel-success{
background-color: #188E49;
color: #ffffff;
padding: 10px;
margin-bottom: 10px;
border-radius: 5px;
font-weight: 900;
}
#accept_news_success{
background-color: #188E49;
color: #ffffff;
border: 1px solid #188E49;
opacity: 1;
display: none;
}
#accept_news_success_show{
background-color: #188E49;
color: #ffffff;
border: 1px solid #188E49;
opacity: 1;
display: block;
}
</style>
<link rel="stylesheet" href="../../html-version/assets/css/style_table.css"/>

<div class="eform-data-view">
<h4><dt><?= Html::encode($this->title);?></dt></h4>
<hr>
<div class="row">

<div class="col-md-8">
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

<div class="<?=$col['className'];?>">
<label for="<?=$col['key'];?>"><dt><?=$col['templateOptions']['label'];?> :</dt></label>
<?php if ($col['type']=='input'): ?>
<?php if ($col['templateOptions']['type']!=null): ?>
	<?php if ($col['templateOptions']['type']=='date'): ?>
		<?=DateThai($val_eform[$col['key']]);?>
		<?php elseif($col['templateOptions']['type']=='radio'): ?>
			<?php 

			echo $val_eform[$col['key']];
			?>
			<?php elseif($col['templateOptions']['type']=='checkbox'): ?>
				<?php 
				foreach ($val_eform[$col['key']] as $key => $value) {

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

							echo $val_eform[$col['key']];
							?>

							<?php else: ?>

								<?php 
								echo $val_eform[$col['key']];
								?>

							<?php endif; ?>
							<?php elseif($col['type']=='idcard'): ?>
								<?=$val_eform[$col['key']];?>
								<?php elseif($col['type']=='birthday'): ?>
									<?=DateThai($val_eform[$col['key']]);?>
									<?php $y2 = substr($val_eform[$col['key']],0,4);
									$age = date("Y")-$y2;
									echo ' ('.$age.' ปี)';
									?>
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
						<div class="mt-3">
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
							]) 
							?>
						</div>
						<div class="row">
							<div class="col-md-3"><b>ข่าวที่เกี่ยวข้อง :</b></div>
							<div class="col-md-9">
								<?php 
								if (!empty($val_eform['news-message'])) {

									$att_news = implode(",",$val_eform['news-message']);
									$att_newss = str_replace(",","','",$att_news);
									$query = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE id IN ('".$att_newss."')")->queryAll();
									$i = 1;
									foreach ($query as $cols){

										$show = '';
										$query = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '".$cols['form_id']."'")->queryOne();
										$data_main = @json_decode($query['form_element'],TRUE);

										$data_object = @json_decode($cols['data_json'],TRUE);
										$dta = $data_object[0];
										$approve_template = Yii::$app->db->createCommand("SELECT approve_template.step FROM eform_template,approve_template WHERE eform_template.id = '".$cols['eform_id']."' AND eform_template.approve_type = approve_template.id")->queryScalar();
										$object_approve_template = @json_decode($approve_template,TRUE);

										$count_row = 1;
										foreach ($data_main[0]['fieldGroup'] as $col){

											if ($count_row<=3) {

												if ($col['type']=='select') {
													if ($col['templateOptions']['model']!=null) {
														$show .= $col['templateOptions']['placeholder']." : ".$dta[$col['key']]."<br>";
													}else{
														$show .= $col['templateOptions']['placeholder']." : ".$dta[$col['key']]."<br>";
													}
												}else if ($col['type']=='input') {
													if ($col['templateOptions']['type']=='date'){
														$show .= $col['templateOptions']['placeholder']." : ".DateThai($dta[$col['key']])."<br>";
													}else if ($col['templateOptions']['type']=='radio'){
														$show .= $col['templateOptions']['placeholder']." : ".$dta[$col['key']]."<br>";
													}else if ($col['templateOptions']['type']=='checkbox'){
														if(count($dta[$col['key']])>0){
															$show_checkbox ='';
															foreach ($dta[$col['key']] as $value) {
																$show_checkbox .= $value.", ";
															}
															$show .=  $col['templateOptions']['placeholder']." : ".rtrim($show_checkbox, ", ")."<br>";
														}
													}else{
														$show .= $col['templateOptions']['placeholder']." : ".$dta[$col['key']]."<br>";
													}
												}else if ($col['type']=='latlong') {
													$show .= $col['templateOptions']['placeholder']." : ".$dta['latitude'].", ".$dta['longitude']."<br>";
												}else if ($col['type']=='address') {
													$nameaddress = $col["key"];
													$nameaddress_no = $nameaddress."_no";
													$nameaddress_mooban = $nameaddress."_mooban";
													$nameaddress_tombon = $nameaddress."_tombon";
													$nameaddress_amphoe = $nameaddress."_amphoe";
													$nameaddress_province = $nameaddress."_province";
													$show .= $col['templateOptions']['placeholder']." : เลขที่ ".$dta[$nameaddress_no]." หมู่บ้าน .".$dta[$nameaddress_mooban]." ต.".$dta[$nameaddress_tombon]." อ.".$dta[$nameaddress_amphoe]." จ.".$dta[$nameaddress_province]."<br>";
												}else{
													$show .= $col['templateOptions']['placeholder']." : ".$dta[$col['key']]."<br>";
												}

											}
											$count_row++;
										}
										echo $show.'<a class="btn btn-light btn-sm" onclick="window.open(\'index.php?r=eform-data/view&id='.$cols['id'].'\')" href="#">รายละเอียด <i class="fa fa-eye" title="รายละเอียด" target="_blank"></i></a><hr>';

										$i++;

									}

								}else{
									echo "-";
								}

								?>
								<br>
							</div>
							<div class="col-md-3"><b>หน่วยที่ถูกส่งถึง :</b></div>
							<div class="col-md-9">
								<?php 
								if (isset($val_eform['unit-send-news'])) {
									$att_group = implode(",",$val_eform['unit-send-news']);
									echo getList($att_group,'unit','unit_id','unit_name');
								}else{
									echo "-";
								}
								?>
							</div>

						</div>
						<?php $data_edata_history = $val_eform['history']; 
						?>

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

								var data_json = '<?=$model->data_json;?>';
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

// console.log(data_json_real);
// console.log(data_object_real);


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
</div>
</div>

<?php 
//var_dump($val_eform['unit-send-news']);
$check_show_btn_accept = 0;
$check_show_btn_success = 0;
if ($_SESSION['user_role']=='1'){
	$check_show_btn_accept = 0;
}else{
	$check_show_btn_accept = (in_array($_SESSION['unit_id'], $val_eform['unit-send-news'])) ? 1:0;
}

if ($check_show_btn_accept>0) {
if(!empty($val_eform['unit_accept_news'])){
$searchedValue = $_SESSION['user_id']; 
$neededObject = array_filter(
$val_eform['unit_accept_news'],
function ($e) use ($searchedValue) {
return $e['user_accept_id'] == $searchedValue;
}
);
if (count($neededObject)>0) {
$check_show_btn_success = 1;
}
}
}
?>

<?php if ($check_show_btn_accept>0): ?>
<?php if ($check_show_btn_success>0): ?>
<div id="alertSuccess">
<div class="panel panel-success">
<div class="panel-heading">รับทราบข่าวสำเร็จ!!</div>
</div>
</div>
<button class="btn btn-outline-primary btn-sm" id="accept_news_success_show" disabled="">
<span class="fa fa-check-square-o"></span> รับทราบแล้ว
</button>
<?php else: ?>	
<button class="btn btn-outline-primary btn-sm" id="accept_news">
<span class="fa fa-square-o"></span> รับทราบ
</button>
<div id="<?=$model->id;?>" class="accept_news_process" style="visibility: hidden;height: 0px;"><?=$model->data_json;?></div>
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



$(document).on('click', '#accept_news', function(){

$(".accept_news_process").each(function() {
var id_sql_eform = $(this).attr('id');
var data_json = $(this).html();


var data_object =  JSON.parse(data_json);
var obj = '';

if (data_object[0].unit_accept_news!=undefined) {
if (data_object[0].unit_accept_news.length>0) {
obj = JSON.stringify(data_object[0].unit_accept_news);
} else {
obj = '[]';
}
}else{
obj = '[]';
}

var date_view = convertDate(new Date());

var first = obj.replace("[", "");
var end = first.replace("]", "");
var unit_accept_news_use = '';
var res_use = `{"date_time":"${date_view}","user_accept_id":"<?=$_SESSION['user_id'];?>","user_accept":"<?=$users_data['name'];?>","unit_name":"<?=$users_data['unit_name'];?>","unit_id":"<?=$users_data['unit_id'];?>"}`;
if (end.length>0) {
unit_accept_news_use = "["+end+","+res_use+"]";
}else{
unit_accept_news_use = "["+res_use+"]";
}

if (data_object[0].unit_accept_news!=undefined) {
data_object[0].unit_accept_news = JSON.parse(unit_accept_news_use);
}else{
var res = data_json.slice(0,-2);
    //console.log(res);
    var new_object = `${res},"unit_accept_news":${unit_accept_news_use}}]`
    data_object = JSON.parse(new_object);
    //console.log(new_object);
}


var data_json_real =  JSON.stringify(data_object);

var re1 = data_json_real.slice(1);
var re2 = re1.slice(0,-1);
data_json_real = re2;
var data_object_real = data_object;

  //console.log(data_json_real);

  update_accept(id_sql_eform,data_object_real,data_json_real);

});

});

function update_accept(id_sql_eform,data_object,data_json){
$.ajax({
url:"index.php?r=site/insert_file_upload_list&type=update_eform",
data:{
id_sql_eform:id_sql_eform,
data_json:data_json,
data_object:data_object
},
type: 'post',
dataType: 'json',
success:function(data)
{
if (data.status > 0) {
$('#alertSuccess').css('display','block');
setTimeout(function(){
	$('#alertSuccess').css('display','none');
	$('#accept_news').css('display','none');
	$('#accept_news_success').css('display','block');
},2000);

}

}
});

}

});

</script>
<?php endif ?>
<?php endif ?>


<br>
<?php if ($val_eform['user_create_id'] == $_SESSION['user_id']): ?>
<a class="btn btn-primary" href="index.php?r=site/pages&view=process_news&eform_data=<?=$model->id;?>">แก้ไขข้อมูล</a>
<button class="btn btn-danger del_data" data-id="<?=$model->id;?>"> <i class="fas fa-trash"></i>  ลบ</button>

<?php endif ?>


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

<?php if (!empty($val_eform['request_information'])): ?>
<?php if (count($val_eform['request_information'])>0): ?>

<div class="card card-collapsed">
<div class="card-status card-status-left bg-blue"></div>
<div class="card-header">
<h3 class="card-title"><dt>ข้อมูลที่ต้องการเพิ่มเติม</dt></h3>
<div class="card-options">
<i class="fa fa-question-circle-o"></i>
<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
</div>
</div>
<div class="card-body">
<div class="input-group">
<input type="text" class="form-control form-control-sm" placeholder="ค้นหา..." id="search_request_information">
</div>
<div class="table-responsive add_scrollbar">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width: 10% !important;">#</th>
<th>รายละเอียด</th>
</tr>
</thead>
<tbody id="Table_request_information">
<?php 
$num_request_information = 1;
foreach ($val_eform['request_information'] as $val_request):
$unit_name_re = (!empty($val_request['unit_name'])) ? '('.$val_request['unit_name'].')' : '';
?>
<tr>
	<td><?=$num_request_information;?></td>
	<td class="text-left">
		<?=$val_request['detail']?>
		<br><span class="badge badge-dark"><b>ผู้บันทึก </b></span> : <span class="badge badge-light text-dark" style=""><?=$val_request['user_request']?> <?=$unit_name_re;?></span>
		<br><span class="badge badge-dark"><b>วันที่บันทึก </b></span> : <span class="badge badge-light text-dark" style=""><?=DateThaiTime($val_request['date_time']);?></span> 
	</td>
</tr>
<?php $num_request_information++; endforeach ?>
</tbody>
</table>
</div>
</div>
</div>

<script>
$(document).ready(function(){
$("#search_request_information").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#Table_request_information tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>

<?php endif ?>
<?php endif ?>

<?php if (!empty($val_eform['history'])): ?>
<?php if (count($val_eform['history'])>0): ?>
<div class="card card-collapsed">
<div class="card-status card-status-left bg-blue"></div>
<div class="card-header">
<h3 class="card-title"><dt>รายละเอียดการแก้ไขและการเรียกดูข้อมูล</dt></h3>
<div class="card-options">
<!-- <i class="fa fa-edit"></i> <i class="fa fa-eye"></i> -->
<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
</div>
</div>
<div class="card-body">
<div class="input-group">
<input type="text" class="form-control form-control-sm " placeholder="ค้นหา..." id="search_history">
</div>

<?php 
$view = 0;
$edit = 0;
foreach ($val_eform['history'] as $val_check){
if ($val_check['action']=='ดู') {
$view = $view+1;
}
if ($val_check['action']=='แก้ไข') {
$edit = $edit+1;
}
}

$all_total = $view+$edit;

?>
<br>
<input type="radio" value="" name="type_action" class="type_action">
<label for="">ทั้งหมด <span class="badge badge-light text-dark">(<?=$all_total;?>)</span></label> 
<input type="radio" value="ดู" name="type_action" class="type_action">
<label for="">เรียกดู <span class="badge badge-light text-dark">(<?=$view;?>)</span></label> 
<input type="radio" value="แก้ไข" name="type_action" class="type_action">
<label for="">แก้ไข <span class="badge badge-light text-dark">(<?=$edit;?>)</span></label>


<ul class="list-group list-group-flush add_scrollbar" id="Table_history">
<?php 
$num_history = 1;
foreach ($val_eform['history'] as $val_history):
$unit_name_his = (!empty($val_history['unit_name'])) ? '('.$val_history['unit_name'].')' : '';
$badge_type = ($val_history['action']=='ดู') ? 'primary' : 'warning';
$badge_text = ($val_history['action']=='ดู') ? 'light' : 'dark';
$icon_his = ($val_history['action']=='ดู') ? 'eye' : 'edit';
?>
<li class="list-group-item">
<span class="tag tag-<?=$badge_type;?>" style="position: absolute;padding: 0.8em;right: 10;" title="<?=$val_history['action'];?>"><i class="fa fa-<?=$icon_his;?>" style="font-size: 18px;"></i></span>
<span class="badge badge-<?=$badge_type;?> text-<?=$badge_text;?>"><b>วันที่ </b></span> : <span class="badge badge-light text-dark" style=""><?=DateThaiTime($val_history['date_time']);?></span>
<br><span class="badge badge-<?=$badge_type;?> text-<?=$badge_text;?>"><b>ชื่อ (หน่วยงาน) </b></span> : <span class="badge badge-light text-dark"><?=$val_history['user_view']?> <?=$unit_name_his;?></span>
<span style="color: rgba(0,0,0,0) !important;"><?=$val_history['action'];?></span>
</li>
<?php $num_history++; endforeach ?>
</ul>
</div>
</div>

<script>
$(document).ready(function(){
$(document).on('click', '.type_action', function(){
var type_action = $('input[name="type_action"]:checked').val().toLowerCase();
$("#Table_history li").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(type_action) > -1)
});
});
$("#search_history").on("keyup", function() {
;
var type_action = $('input[name="type_action"]:checked').val();
var value = $(this).val().toLowerCase();
$("#Table_history li").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
console.log($(this).text().toLowerCase().indexOf(type_action) > -1);
});

});
});
</script>

<?php endif ?>
<?php endif ?>

<div class="card card-collapsed">
<div class="card-status card-status-left bg-blue"></div>
<div class="card-header">
<h3 class="card-title"><dt>หน่วยที่รับทราบข่าว</dt></h3>
<div class="card-options">
<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
</div>
</div>
<div class="card-body">
<div class="row">
<?php 
if (isset($val_eform['unit_accept_news'])) {
$ac = 1;
foreach ($val_eform['unit_accept_news'] as $unit_accept) {
?>
<div class="col-md-12">
<div class="user-accept-news"><?php echo $ac.'. '; ?></div>
<div class="user-accept-news"><?php echo $unit_accept['user_accept']; ?></div>
<div class="user-accept-news user-accept-news-right">รับทราบข่าวเมื่อ <?php echo dateThai($unit_accept['date_time']); ?></div>
</div>
<?php
$ac++;
}
}
?>
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
<!-- Add by witthaya -->
<div class="col-md-4">
</div>
<!-- Add by witthaya -->
</div>
</div>


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
</script>

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
	location.replace('index.php?r=site/pages&view=process_news&form_id=".$id."');
}
});
}
");

?>
<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '['. $model->detail.']';
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์ม '.$model->detail, 'url' => ['eform-template/update', 'id' => $_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;

?>


<script src="../../js-sortable/jquery-1.10.2.js"></script>
<script src="../../js-sortable/jquery-ui-1.11.2.js"></script>

<link rel="stylesheet" href="../../draggable/kendo.default-v2.min.css"/>
<!-- <script src="../../draggable/jquery-1.12.4.min.js"></script> -->
<script src="../../draggable/kendo.all.min.js"></script>
<style>
#sortable-row { 
	list-style: none;
	overflow: scroll;
}

#show-preview{
	overflow: scroll;
}
#show-preview div { 
	cursor:pointer;
	color: #212121;
	width: 100%;
	border-radius: 3px;
}
#show-preview div.ui-state-highlight { 
	height: 2.6em !important; 
	background-color:#F0F0F0;
	border:#ccc 2px dotted;
}

.text_data:hover {
	background-color: #007bff61 !important;
	font-weight: bold;
}

.card-report{
	height: 40px;
	margin-top: 0px !important;
	padding: 10px;
}
.card-move{
	cursor: move;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
#show-media-vimeo{
	display: none;
}
iframe {
	-moz-transform: scale(1, 1); 
	-webkit-transform: scale(1, 1); 
	-o-transform: scale(1, 1);
	-ms-transform: scale(1, 1);
	transform: scale(1, 1); 
	-moz-transform-origin: top left;
	-webkit-transform-origin: top left;
	-o-transform-origin: top left;
	-ms-transform-origin: top left;
	transform-origin: top left;
}
#IDNAME {
	-moz-transform: scale(1, 1); 
	-moz-transform-origin: top left;
}
.sub{
	cursor: move;
}
.li_design{
	border: 1px solid #dee2e6;
	padding: 6px;
	border-radius: 5px;
	margin-top: .4em;
}
.remove_design {
	color: #dc3545 !important;
	cursor: pointer;
}
</style>
<div class="row">
	<div class="col-md-12 mt-3">
		<h4>ออกแบบหน้ารายงานแบบรายการเดียว <?=$this->title?> <i class="fa fa-question-circle" aria-hidden="true" data-toggle="modal" data-target="#exampleModal"></i></h4>
	</div>
</div>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				<h2 class="card-title"><dt>[2] ผลลัพธ์รายงาน</dt></h2>
			</div>
			<div class="card-body" style="min-height: 410px;" id="mainArea">
				<div class="row" id="show-preview">
				</div>
			</div>
		</div>

		<div class="card" id="show-media-vimeo">
			<div class="card-header bg-secondary text-white">
				<h3 class="card-title">ตัวอย่างรายงาน</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse text-white" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div id="media-vimeo">
					<iframe src="" frameborder="0" id="IDNAME" style="height: 31cm; width: 100%;"></iframe>
				</div>
			</div>
		</div>
		
		<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'guide_report_record')->textArea(['maxlength' => true,'rows'=>'1','style'=>'visibility: hidden;height: 0px !important;'])->label(false);
		?>
		<div id="data_guide_report_record" style="visibility: hidden;height: 0px;">
			<?=$model->guide_report_record;?>
		</div>

		<button type="submit" class="btn btn-lg btn-primary savesort">บันทึก</button>
		<button type="reset" class="btn btn-lg btn-danger clear_data">ยกเลิก</button>
		<?php ActiveForm::end(); ?>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				<h2 class="card-title"><dt>[1] รายการที่ต้องการแสดง</dt></h2>
			</div>
			<div class="card-body" style="overflow: auto;height: 64vh;">

				<div id="manage_sort">
					<ul id="sortable-row" style="padding: 0px;">
					</ul>
				</div>

			</div>
		</div>

		<a href="index.php?r=eform-template/update-header&id=<?=$model->id;?>">
			<div class="card">
				<div class="card-body">
					<i class="fa fa-gears" data-toggle="tooltip" title="" data-original-title="fa fa-gears"></i> เปลี่ยนแปลง Form Template
				</div>
			</div>
		</a>


	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">คำแนะนำ</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				ลากเปลี่ยนตำแหน่งเพื่อกำหนดลำดับ คลิ๊กแต่ละส่วนเพื่อกำหนดความกว้างและ Align
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade show" id="modal-true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" style="z-index: inherit;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title-show">เลือกขนาดความกว้างที่ต้องการแสดง</h5>
				<button type="button" id="close-modal" class="close close-modal" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="mydiv">
				<h6 style="line-height: 1.5 !important;">Layout – Grid ทำหน้าที่คอยควบคุมวัตถุต่างๆ บนหน้าเว็บไซต์ให้แสดงผลได้อย่างถูกต้องตามหลัก box layout ซึ่งจะส่งผลดีต่อการเขียนหนึ่งหน้าเว็บไซต์ โดยแบ่งออกเป็น 12 คอลัมน์ ใน 1 แถว <b>ซึ่งหน่วยที่เป็น 12 นี้ สามารถเฉลี่ยแต่ละส่วนได้ตามความต้องการ</b></h6>
				<div class="selectgroup w-100 row">
					<label class="selectgroup-item col-md-12">
						<input type="radio" name="select_size_column" value="col-md-12" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-12</span>
					</label>
					<label class="selectgroup-item col-md-10">
						<input type="radio" name="select_size_column" value="col-md-10" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-10</span>
					</label>
					<label class="selectgroup-item col-md-2">
						<input type="radio" name="select_size_column" value="col-md-2" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-2</span>
					</label>
					<label class="selectgroup-item col-md-8">
						<input type="radio" name="select_size_column" value="col-md-8" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-8</span>
					</label>
					<label class="selectgroup-item col-md-4">
						<input type="radio" name="select_size_column" value="col-md-4" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-4</span>
					</label>
					<label class="selectgroup-item col-md-6">
						<input type="radio" name="select_size_column" value="col-md-6" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-6</span>
					</label>
					<label class="selectgroup-item col-md-6">
						<input type="radio" name="select_size_column" value="col-md-6" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-6</span>
					</label>
					<label class="selectgroup-item col-md-4">
						<input type="radio" name="select_size_column" value="col-md-4" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-4</span>
					</label>
					<label class="selectgroup-item col-md-4">
						<input type="radio" name="select_size_column" value="col-md-4" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-4</span>
					</label>
					<label class="selectgroup-item col-md-4">
						<input type="radio" name="select_size_column" value="col-md-4" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-4</span>
					</label>
					<label class="selectgroup-item col-md-2">
						<input type="radio" name="select_size_column" value="col-md-2" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-2</span>
					</label>
					<label class="selectgroup-item col-md-2">
						<input type="radio" name="select_size_column" value="col-md-2" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-2</span>
					</label>
					<label class="selectgroup-item col-md-2">
						<input type="radio" name="select_size_column" value="col-md-2" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-2</span>
					</label>
					<label class="selectgroup-item col-md-2">
						<input type="radio" name="select_size_column" value="col-md-2" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-2</span>
					</label>
					<label class="selectgroup-item col-md-2">
						<input type="radio" name="select_size_column" value="col-md-2" class="selectgroup-input">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-2</span>
					</label>
					<label class="selectgroup-item col-md-2">
						<input type="radio" name="select_size_column" value="col-md-2" class="selectgroup-input" data-dismiss="modal">
						<span class="selectgroup-button" style="white-space: nowrap !important;text-align: left !important;">.col-md-2</span>
					</label>
				</div>
				<!-- <hr> -->
				<!-- <div class="text-center">
					<button type="button" class="btn btn-primary confirm_class" >ยืนยัน</button>
				</div> -->
			</div>

		</div>
	</div>
	<div class="modal-backdrop show"></div>
</div>



<script type="text/javascript">
	jQuery.noConflict();
	(function($) {
		$(document).ready(function(){
			var data_guide_report_record = $("#data_guide_report_record").html();
			var array_column = [];

			<?php if (!empty($model->guide_report_record)): ?>
				array_column = JSON.parse(data_guide_report_record);
			<?php endif ?>

			
			show_preview();

			load_data();
			function load_data(){
				var data = $.ajax({
					url:"index.php?r=site/json-report-design-record",
					global: false,
					dataType: "json",
					data:{ id: "<?=$model->id?>"},
					contentType: "application/json; charset=utf-8",
					async:false,
					success: function(msg){
						return msg.data;
					}
				}
				).responseJSON;

				var show_data = [];
				var array_detail = data[0]["detail"];
				for (i = 0; i < array_detail.length; i++) {
					var key = array_detail[i].key;

					var _column_checked = '';
					if(array_column.find(x => x.key === key)){
						_column_checked = 'checked';
					}
					show_data.push(`<li id="${array_detail[i].id}" class="menu-slot li_design"><label class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input check_box" name="data-checkbox" value="${array_detail[i].id}" data-name="${array_detail[i].label}" data-key="${array_detail[i].key}" ${_column_checked} disabled id="checked_id_${array_detail[i].id}">
						<span class="custom-control-label sub" data-id="${array_detail[i].id}" data-name="${array_detail[i].label}" data-key="${array_detail[i].key}">${array_detail[i].label}</span>
						</label></li>`);
				}
				$('#sortable-row').html(show_data.join(""));


			}

			$(".sub").kendoDraggable({
				group: "subGroup",
				hint: function(element) {
					data_name = $(element).attr("data-name");
					data_id = $(element).attr("data-id");
					data_key = $(element).attr("data-key");
					return element.clone();
				}
			});

			$("#mainArea").kendoDropTarget({ 
				group: "subGroup",
				drop : function( event, ui ){
					Drop(data_name,data_id,data_key);
				}
			});

			function Drop(data_name,data_id,data_key) {
				$("#modal-true").css("display", "block");
				checkbox_now = [];
				checkbox_now.push({
					id:data_id,
					key:data_key,
					name:data_name,
				});
			}

			var select_size_column = '';
			var checkbox_now = [];
			$(document).on('click', 'input[name="select_size_column"]', function(){
				$(this).attr("checked", true);

				select_size_column = $(this).val();
				var index = array_column.map(x => {
					return x.id;
				}).indexOf(""+checkbox_now[0].id+"");
				
				if (index==-1) {
					array_column.push({
						sort:checkbox_now[0].id,
						id:checkbox_now[0].id,
						key:checkbox_now[0].key,
						name:checkbox_now[0].name,
						class_column:""+select_size_column+"",
					});
				}
				close_modal();
				show_preview();
				$("#checked_id_"+checkbox_now[0].id).prop('checked', true);
				
			});

			$(document).on('click', '.remove_design', function(){
				var id = $(this).data("id");
				if(confirm('ต้องการยกเลิกข้อมูลนี้ใช่หรือไม่')){
					var index = array_column.map(x => {
						return x.id;
					}).indexOf(""+id+"");
					if (index!=-1) {
						array_column.splice(index, 1);
					}
					$("#checked_id_"+id).removeAttr("checked");
					show_preview();
				}
			});


			$(document).on('click', 'input[name="data-checkbox"]', function(){
				var id = $(this).val();
				var name = $(this).data("name");
				var key = $(this).data("key");
				checkbox_now = [];
				if ($(this).is(':checked')) {
					$("#modal-true").css("display", "block");
					checkbox_now.push({
						id:id,
						key:key,
						name:name,
					});
				}else{
					var index = array_column.map(x => {
						return x.id;
					}).indexOf(id);
					if (index!=-1) {
						array_column.splice(index, 1);
					}
					show_preview();
				}

			});



			$(document).on('click', '.close-modal', function(){
				checkbox_now = [];
				$("#modal-true").css("display", "none");
				// if (select_size_column!='') {
				// 	$("#modal-true").css("display", "none");
				// }else{
				// 	alert('กรุณาเลือกขนาดความกว้างที่ต้องการแสดง');
				// }
			});


			function close_modal(){
				$("#modal-true").css("display", "none");
			}

			var show_column = [];
			function show_preview(){
				select_size_column = '';
				show_column = [];
				$.each(array_column, function(i) {
					show_column.push(`<div class="text_body ${array_column[i].class_column} ui-state-default" data-id="${array_column[i].id}" data-sort="${array_column[i].sort}"><div class="card-move card card-report text_data row" style="border-radius: 0rem !important;"><div class="col-md-10">${array_column[i].name}</div><div class="col-md-2 text-right"><a class="remove_design" data-id="${array_column[i].id}"><i class="fa fa-times"></i></a></div></div></div>`);
				});
				$('#show-preview').html(show_column.join(""));
				$("input[name='select_size_column']").attr("checked", false);
				$("#mydiv").load(location.href + " #mydiv");
				$("#eformtemplate-guide_report_record").val(JSON.stringify(array_column));

				if (array_column.length>0) {
					var arr = {report_template : array_column};
					$("#show-media-vimeo").css('display', 'block');
					$("#media-vimeo iframe").attr("src", "index.php?r=eform-data/print-report-record&form_id=<?=$model->id;?>&"+$.param(arr));
				}else{
					$("#show-media-vimeo").css('display', 'none');
				}

			}

			var text_bodydivst = $('#show-preview');
			text_bodydivst.sortable({
				placeholder: "ui-state-highlight",
				handle: '.text_data', 
				update: function() {
					$('.text_body', text_bodydivst).each(function(index, elem) {
						var $divstItem = $(elem),
						newIndex = $divstItem.index();
					});
					savesort();
				},
				start: function (event, ui) {
					$(".ui-state-highlight")
					.css('width', $(ui.item).css('width'));
					$(".ui-state-highlight")
					.css('height', $(ui.item).css('height'));
				},

			});


			$(document).on('click', '.clear_data', function(){
				$("#mydiv").load(location.href + " #mydiv");
				load_data();
				array_column = [];
				$('#show-preview').html('');
			});


			function savesort(){
				var index_sort = new Array();
				$('div#show-preview div.text_body').each(function() {
					var old_sort = $(this).data("sort")
					var objIndex = array_column.map(x => x.sort).indexOf(""+old_sort+"");

					index_sort.push(objIndex);
				});
				change_sort(index_sort);
			}

			function change_sort(index_sort){
				for (var i = 0; i < index_sort.length; i++) {
					var index_key = index_sort[i];
					array_column[index_key].sort = ""+(i+1)+"";
				}
				var objdata = array_column.sort( function( left, right ) {
					return left.sort - right.sort;
				});
				array_column = objdata;
				show_preview();
			}

			

		});
}) (jQuery);

</script>




<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รายงานเบิกจ่ายประจำวัน');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลอุปกรณ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<link rel="stylesheet" href="../../html-version/assets/css/style_equipment.css"/>
<script type="text/javascript" src="../../datatable/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../../datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../datatable/dataTables.bootstrap4.min.js"></script>
<style>
	.dataTables_paginate > ul.pagination > li {
		padding: 0px !important;
	}
	.dataTables_wrapper .dataTables_filter{
		display: none !important;
	}
</style>
<h4><?= Html::encode($this->title) ?></h4>
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary ">
			<div class="card-body">

				<div class="row">
					<label for="myInputTextField" class="col-sm-1 col-form-label">ค้นหา :</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="myInputTextField" placeholder="กรอกคำค้น">
					</div>
				</div>
				<div class="loading-alert">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					กำลังโหลดข้อมูล...
				</div>
				<div class="table-responsive">
					<table id="show_view" class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="disremark" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เพิ่มรายงานเบิกจ่ายประจำวัน</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label for="">หน่วยที่เบิกจ่าย</label>
						<div class="form-control" id="show_user_name" readonly></div>
					</div>
					<div class="col-md-6">
						<label for="">ผู้เบิกจ่ายอุปกรณ์</label>
						<div class="form-control" id="show_user_dis" readonly></div>				
					</div>
					<div class="col-md-12 mt-3">
						<label for="">สถานการณ์เบิกจ่าย</label>
						<textarea class="form-control" id="remark"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="label-main label-success">บันทึกข้อมูลสำเร็จ!!</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="hide-sub-id" id="show_disremark_id"></div>
				<div class="hide-sub-id" id="show_id_main"></div>
				<div class="hide-sub-id" id="show_id_sub"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<button type="button" id="add-equipment-disremark" class="btn btn-primary">บันทึก</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		var unit_id = <?php echo $_SESSION['unit_id']; ?>;
		$.ajax({
			url:"index.php?r=site/json_add_equipment&type=view_equipment_report&unit_id="+unit_id,
			method:"GET",
			"dataType": "json",
			success:function(data)
			{
				$(".loading-alert").css("display", "block");
				setTimeout(function(){
					$(".loading-alert").css("display", "none");
					show_report(data);
				},3000);
			}
		});

		function show_report(data)
		{
			var dataSet = data;
			datatable = $('#show_view').DataTable({
				"language": {
					"lengthMenu": "แสดง &nbsp; _MENU_ &nbsp; จำนวน",
					"zeroRecords": "ไม่พบข้อมูล",
					"info": "แสดงข้อมูลจาก _START_ ถึง _END_ จำนวน _TOTAL_ รายการ",
					"infoEmpty": "ไม่มีรายการ",
					"search": "ค้นหา : &nbsp;",
					"searchPlaceholder": "กรอกคำค้น",
					"infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ รายการ)",
					"paginate": {
						"first":      "หน้าแรก",
						"last":       "หน้าสุดท้าย",
						"next":       "ถัดไป",
						"previous":   "ก่อนหน้า"
					},
				},
				"pageLength": 10,
				"lengthMenu": [ [15, 50, 80, 100, -1], [15, 50, 80, 100, "ทั้งหมด"] ],
				data: dataSet,
				destroy: true,
				columns: [
				{
					title: "ลำดับ"
				},
				{
					title: "หมายเลขการเบิกจ่าย"
				},
				{
					title: "หน่วยที่เบิกจ่าย"
				},
				{
					title: "ผู้เบิกจ่ายอุปกรณ์"
				},
				{
					title: "วันเวลาที่เบิกจ่าย"
				},
				{
					title: "วันเวลาที่ส่งคืน"
				},
				{
					title: "จัดการ"
				}
				],
				'columnDefs': [
				{
					"targets": [0],
					"data" : "no",
					"className": "text-center",
					"width" : "10%"
				},
				{
					"targets": [1],
					"data" : "key_auth_dis",
					"width" : "20%"
				},
				{
					"targets": [2],
					"data" : "unit_name",
					"width" : "15%"
				},
				{
					"targets": [3],
					"data" : "user_disbursement",
					"width" : "15%"
				},
				{
					"targets": [4],
					"data" : "date_time",
					"width" : "15%"
				},
				{
					"targets": [5],
					"data" : "date_time_repatriate",
					"width" : "15%"
				},
				{
					"targets": [6],
					"data" : "link",
					"width" : "15%"
				}
				],
				dom: 'Bfrtip',
				select: true,
				buttons: [{
					text: 'Select all',
					action: function () {
						table.rows().select();
					}
				},
				{
					text: 'Select none',
					action: function () {
						table.rows().deselect();
					}
				}
				],
			});

		}

		$('#myInputTextField').keyup(function(){
			datatable.search($(this).val()).draw() ;
		});

		$(document).on('click', '.disremark-in-modal', function(){
			var id = $(this).data("id");
			var id_main = $(this).data("id-main");
			var id_sub = $(this).data("id-sub");
			var user_name = $(this).data("user-name");
			var user_dis = $(this).data("user-dis");
			$('#show_disremark_id').html(id);
			$('#show_id_main').html(id_main);
			$('#show_id_sub').html(id_sub);
			$('#show_user_name').html(user_name);
			$('#show_user_dis').html(user_dis);
		});

		$(document).on('click', '#add-equipment-disremark', function(){
			var disremark_id = $('#show_disremark_id').text();
			var id_main = $('#show_id_main').text();
			var id_sub = $('#show_id_sub').text();
			var remark = $('#remark').val();

			console.log(disremark_id+" "+id_main+" "+id_sub+" "+remark);

			$.ajax({
				url:"index.php?r=site/json_add_equipment&type=add-disremark",
				method:"GET",
				dataType:"json",
				data:{ disremark_id: disremark_id,id_main:id_main,id_sub:id_sub,remark:remark},
				contentType: "application/json; charset=utf-8",
				success: function(){
					if (status == 1) {
						console.log('false');
					}else{
						console.log('success');
						$(".label-main").css("display", "block");
						setTimeout(function(){
							$(".label-main").css("display", "none");
							location.reload();
						},2000);
					}
				}
			});
		});
	});
</script>
<?php
use yii\helpers\Html;

$equipment_dis = Yii::$app->db->createCommand("SELECT * FROM `equipment_disbursement` WHERE id_disbursement = '".$_GET['id']."'")->queryOne();
$unit = Yii::$app->db->createCommand("SELECT * FROM unit WHERE unit_id = '".$equipment_dis['unit_id']."'")->queryOne();

if (!empty($equipment_dis['date_time_repatriate'])) {
	$date_time_repatriate = DateThai($equipment_dis['date_time_repatriate']);
}else{
	$date_time_repatriate = 'ยังไม่ส่งคืน';
}

$this->title = Yii::t('app', 'สถานะการเบิกจ่าย : '.$equipment_dis['key_auth_dis']);
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
<h4><?= Html::encode($this->title); ?></h4>
<div class="row clearfix">
	<div class="col-12 col-md-12 col-xl-6">
		<div class="card">
			<div class="card-body">
				<b>หน่วยที่เบิกจ่าย : <?php echo $unit['unit_name']; ?> (ผู้เบิกจ่ายอุปกรณ์ : <?php echo $equipment_dis['user_disbursement'];?>)</b>
				<br><b>วันเวลาที่เบิกจ่าย</b> : <?php echo dateThai($equipment_dis['date_time']); ?>
				<br><b>หมายเหตุเบิกจ่าย</b> : <?php echo $equipment_dis['remark']; ?>
				<br><b>วันเวลาที่ส่งคืน</b> : <?php echo $date_time_repatriate; ?>
				<br><b>หมายเหตุส่งคืน</b> : <?php echo $equipment_dis['remark_repatriate']; ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">

				<div class="row">
					<label for="myInputTextField" class="col-sm-1 col-form-label">ค้นหา :</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="myInputTextField" placeholder="กรอกคำค้น">
					</div>
				</div>
				<hr>

				<div class="table-responsive">
					<table id="show_view" class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

		var disremark_id = <?php echo $_GET['id']; ?>;
		$.ajax({
			url:"index.php?r=site/json_add_equipment&type=view-disremark&disremark_id="+disremark_id,
			method:"GET",
			"dataType": "json",
			success:function(data)
			{
				//console.log(data);
				show_detail(data);
			}
		});

		function show_detail(data)
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
					title: "สถานะการเบิกจ่าย"
				},
				{
					title: "เวลาที่บันทึก"
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
					"data" : "disbursement_status",
					"width" : "70%"
				},
				{
					"targets": [2],
					"data" : "date_create",
					"width" : "20%"
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



	});
</script>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รายงานการเบิกจ่าย');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลอุปกรณ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$count_equipment = Yii::$app->db->createCommand("SELECT COUNT(*) FROM equipment_sn WHERE status = 1")->queryScalar();
$count_between = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `equipment_disbursement` WHERE date_time_end > CURRENT_DATE()")->queryScalar();
$count_deadline = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `equipment_disbursement` WHERE date_time_end !='0000-00-00' AND date_time_end <= CURRENT_DATE()")->queryScalar();
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
<div class="row clearfix">
	<div class="col-6 col-md-4 col-xl-3">
		<div class="card card-primary ">
			<div class="card-body card-height ribbon">
				<div class="ribbon-box green">
					<?php echo $count_equipment;?>
				</div>
				<div href="javascript:void(0)" class="my_sort_cut text-muted">
					<i class="icon-cursor"></i>
					<span>อยู่ในระหว่างเบิกจ่าย</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6 col-md-4 col-xl-3">
		<div class="card card-primary ">
			<div class="card-body card-height ribbon">
				<div class="ribbon-box indigo">
					<?php echo $count_between; ?>
				</div>
				<div href="javascript:void(0)" class="my_sort_cut text-muted">
					<i class="icon-clock"></i>
					<span>ใกล้กำหนดส่งคืน</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6 col-md-4 col-xl-3">
		<div class="card card-primary ">
			<div class="card-body card-height ribbon">
				<div class="ribbon-box pink">
					<?php echo $count_deadline; ?>
				</div>
				<div href="javascript:void(0)" class="my_sort_cut text-muted">
					<i class="icon-info"></i>
					<span>เลยกำหนด</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card card-primary ">
	<div class="card-body">
		<div class="row">
			<label for="myInputTextField" class="col-sm-1 col-form-label">ค้นหา :</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="myInputTextField" placeholder="กรอกคำค้น">
			</div>
		</div>
		<hr>
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
<script>
	$(document).ready(function(){
		$.ajax({
			url:"index.php?r=site/json_add_equipment&type=view_equipment_report_all",
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
					title: "รายละเอียดการเบิกจ่าย"
				},
				{
					title: "รายละเอียดเวลาเบิกจ่าย"
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
					"data" : "unit_dis",
					"width" : "30%"
				},
				{
					"targets": [3],
					"data" : "calculate_detail",
					"width" : "30%"
				},
				{
					"targets": [4],
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

	});
</script>
<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลรายละเอียดอุปกรณ์');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลอุปกรณ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$equipment = Yii::$app->db->createCommand("SELECT * FROM `equipment` WHERE id = '".$_GET['id']."'")->queryOne();
$type_qu = Yii::$app->db->createCommand("SELECT * FROM `equipment_type` WHERE id = '".$equipment['type']."'")->queryOne();
$unit = Yii::$app->db->createCommand("SELECT * FROM unit ORDER BY unit_id ASC")->queryAll();

$count_equip_sn = Yii::$app->db->createCommand("SELECT COUNT(*) AS sum FROM `equipment_sn` WHERE id_main = '".$_GET['id']."'")->queryOne();
$count_equip_dis = Yii::$app->db->createCommand("SELECT COUNT(*) AS sum FROM `equipment_disbursement` WHERE id_main = '".$_GET['id']."'")->queryOne();
$count_repair = Yii::$app->db->createCommand("SELECT COUNT(*) AS sum FROM `equipment_sn` WHERE `id_main` = '".$_GET['id']."' AND `status` IN (2,3)")->queryOne();
$count_dis_now = Yii::$app->db->createCommand("SELECT COUNT(*) AS sum FROM `equipment_sn` WHERE `id_main` = '".$_GET['id']."' AND `status` = 1")->queryOne();
$count_dis_return = Yii::$app->db->createCommand("SELECT COUNT(*) AS sum FROM `equipment_disbursement` WHERE `id_main` = '".$_GET['id']."' AND date_time_repatriate IS NOT NULL")->queryOne();
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
	<div class="col-12 col-md-12 col-xl-4">
		<div class="card card-primary ">
			<div class="card-body card-height">
				<b><?php echo $equipment['name']; ?> (<?php echo $type_qu['name'];?>) ยี่ห้อ : <?php echo $equipment['brand']; ?> รุ่น : <?php echo $equipment['model']; ?></b> <br><?php echo $equipment['detail']; ?>
			</div>
		</div>
	</div>
	<div class="col-6 col-md-6 col-xl-6">
		<div class="card card-primary ">
			<div class="card-body card-height">
			<!-- 				
				<div class="row">
					<div class="col-md-12">จำนวนอุปกรณ์ทั้งหมด <?php echo $count_equip_sn['sum']; ?> รายการ</div>
				</div> 
			-->
			<div class="row">
				<div class="col-md-3">
					<div class="detail-stat-card card-primary ">
						<i class="icon-folder equipment-icon equipment-icon-skyblue"></i> เบิกจ่ายทั้งหมด
						<div class="equipment-views-box">
							<div class="equipment-views-count"><?php echo $count_equip_dis['sum']; ?></div>
							<div class="equipment-views-pronoun">รายการ</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="detail-stat-card card-primary ">
						<i class="icon-wrench equipment-icon equipment-icon-green"></i> 
						ชำรุ/ส่งซ่อม
						<div class="equipment-views-box">
							<div class="equipment-views-count"><?php echo $count_repair['sum'] ?></div>
							<div class="equipment-views-pronoun">รายการ</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="detail-stat-card card-primary ">
						<i class="icon-cursor equipment-icon equipment-icon-red"></i> กำลังเบิกจ่าย
						<div class="equipment-views-box">
							<div class="equipment-views-count"><?php echo $count_dis_now['sum']; ?></div>
							<div class="equipment-views-pronoun">รายการ</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="detail-stat-card card-primary ">
						<i class="icon-login equipment-icon equipment-icon-yellow"></i> 
						ส่งคืน
						<div class="equipment-views-box">
							<div class="equipment-views-count"><?php echo $count_dis_return['sum']; ?></div>
							<div class="equipment-views-pronoun">รายการ</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-6 col-md-4 col-xl-2">
	<div class="card card-primary ">
		<div class="card-body card-height ribbon">
			<div class="ribbon-box green">+</div>
			<a href="javascript:void(0)" class="my_sort_cut text-muted" data-toggle="modal" data-target="#addprosn">
				<i class="icon-folder-alt"></i>
				<span>เพิ่มข้อมูล<br>หมายเลขอุปกรณ์</span>
			</a>
		</div>
	</div>
</div>
</div>

<!-- <div class="row clearfix">
	<div class="col-12 col-md-12 col-xl-12">
		<div class="card card-primary ">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">จำนวนอุปกรณ์ทั้งหมด <?php echo $count_equip_sn['sum']; ?> รายการ</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-3">
						<div class="detail-stat-card card-primary ">
							<i class="icon-folder equipment-icon equipment-icon-skyblue"></i> จำนวนการเบิกจ่ายทั้งหมด
							<div class="equipment-views-box">
								<div class="equipment-views-count"><?php echo $count_equip_dis['sum']; ?></div>
								<div class="equipment-views-pronoun">รายการ</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="detail-stat-card card-primary ">
							<i class="icon-wrench equipment-icon equipment-icon-green"></i> 
							เสียหาย/ชำรุ/ส่งซ่อม
							<div class="equipment-views-box">
								<div class="equipment-views-count"><?php echo $count_repair['sum'] ?></div>
								<div class="equipment-views-pronoun">รายการ</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="detail-stat-card card-primary ">
							<i class="icon-cursor equipment-icon equipment-icon-red"></i> อยู่ในระหว่างการเบิกจ่าย
							<div class="equipment-views-box">
								<div class="equipment-views-count"><?php echo $count_dis_now['sum']; ?></div>
								<div class="equipment-views-pronoun">รายการ</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="detail-stat-card card-primary ">
							<i class="icon-login equipment-icon equipment-icon-yellow"></i> 
							ส่งคืน
							<div class="equipment-views-box">
								<div class="equipment-views-count"><?php echo $count_dis_return['sum']; ?></div>
								<div class="equipment-views-pronoun">รายการ</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->
<div class="row clearfix">
	<div class="col-12 col-md-8 col-xl-8">
		<div class="card card-primary ">
			<div class="card-body card-view-height">

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
	</div>
	<div class="col-12 col-md-4 col-xl-4">
		<div class="card card-primary ">
			<div class="card-body card-view-height">
				<div class="title-history">ประวัติการเบิกจ่ายทั้งหมด</div>
				<hr>
				<div class="loading-alert">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					กำลังโหลดข้อมูล...
				</div>
				<div class="table-responsive">
					<table id="show_view_main" class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addprosn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-aqua">
				<h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลหมายเลขอุปกรณ์</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label for="">รายการ</label>
						<input type="text" class="form-control" value="<?php echo $equipment['name'];?>" readonly>
						<input type="hidden" class="form-control" id="equipment_id" value="<?php echo $equipment['id'];?>">
						<br>
						<label for="">หมายเลขอุปกรณ์(Serial Number)</label>
						<input type="text" class="form-control" id="serial_number">
					</div>
					<div class="col-md-12">
						<div class="label-main label-success">บันทึกข้อมูลสำเร็จ!!</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<button type="button" id="add-equipment-serial-number" class="btn btn-primary">บันทึก</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="adddisbursement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-aqua">
				<h5 class="modal-title" id="exampleModalLabel">เบิกจ่ายอุปกรณ์</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">

					<div class="col-md-6">
						<label for="">รายการ</label>
						<input type="text" class="form-control" value="<?php echo $equipment['name'];?>" readonly>
						<input type="hidden" class="form-control" id="equipment_id" value="<?php echo $equipment['id'];?>">
					</div>

					<div class="col-md-6">
						<label for="">หมายเลขอุปกรณ์(Serial Number)</label>
						<div class="form-control" id="show_serial_number" readonly></div>					
					</div>

					<div class="col-md-6 mt-3">
						<label for="">หน่วยที่เบิกจ่าย</label>
						<div class="form-group multiselect_div">
							<select id="unit" class="form-control multiselect multiselect-custom">
								<?php foreach ($unit as $u) { ?>
									<option value="<?php echo $u['unit_id']?>"><?php echo $u['unit_name']?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-md-6 mt-3">
						<label for="">ผู้เบิกจ่ายอุปกรณ์</label>
						<input class="form-control" id="user_disbursement" placeholder="กรอกผู้เบิกจ่ายอุปกรณ์">
					</div>

					<div class="col-md-6">
						<label for="">เวลาที่เบิกจ่าย</label>
						<input type="text" id="date_data" class="form-control datepicker_input" placeholder="เลือกวันที่บันทึก" readonly>
						<input type="hidden" class="get_val_datetime">
					</div>

					<div class="col-md-6">
						<label for="">เวลาส่งคืน</label>
						<input type="text" id="date_data_end" class="form-control datepicker_input" placeholder="เลือกวันที่บันทึก" readonly>
						<input type="hidden" class="get_val_datetime">
						<label class="custom-control custom-checkbox mt-3">
							<input type="checkbox" class="custom-control-input" id="date_end" name="date_end" value="">
							<span class="custom-control-label">ไม่ระบุเวลาส่งคืน</span>
						</label>
					</div>
					
					<div class="col-md-12 mt-3">
						<label for="">หมายเหตุ</label>
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
				<div class="hide-sub-id" id="show_id_sub"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<button type="button" id="add-equipment-disbursement" class="btn btn-primary">บันทึก</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deldisbursement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-aqua">
				<h5 class="modal-title" id="exampleModalLabel">ส่งคืนอุปกรณ์</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label for="">รายการ</label>
						<input type="text" class="form-control" value="<?php echo $equipment['name'];?>" readonly>
						<input type="hidden" class="form-control" id="equipment_id" value="<?php echo $equipment['id'];?>">
					</div>
					<div class="col-md-6">
						<label for="">หมายเลขอุปกรณ์(Serial Number)</label>
						<div class="form-control" id="del-show_serial_number" readonly></div>					
					</div>
					<div class="col-md-6 mt-3">
						<label for="">หน่วยที่เบิกจ่าย</label>
						<div class="form-control" id="del-show_unit" readonly></div>
					</div>
					<div class="col-md-6 mt-3">
						<label for="">เวลาที่ส่งคืน</label>
						<input type="text" id="del-date_data" class="form-control datepicker_input" placeholder="เลือกวันที่บันทึก" readonly>
						<input type="hidden" class="get_val_datetime">
					</div>
					<div class="col-md-6 mt-3">
						<label for="">ผู้เบิกจ่ายอุปกรณ์</label>
						<div class="form-control" id="del-user_disbursement" readonly></div>
					</div>
					<div class="col-md-12 mt-3">
						<label for="">หมายเหตุส่งคืน</label>
						<textarea class="form-control" id="del-remark"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="label-main label-success">บันทึกข้อมูลสำเร็จ!!</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="hide-sub-id" id="del-show_id_sub"></div>
				<div class="hide-sub-id" id="del-id_disbursement"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<button type="button" id="del-equipment-disbursement" class="btn btn-primary">บันทึก</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-aqua">
				<h5 class="modal-title" id="exampleModalLabel">ลบข้อมูลอุปกรณ์</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">คุณต้อง
					การลบข้อมูลนี้ใช่หรือไม่?</div>
					<div class="col-md-12">
						<div class="label-main label-delete">ลบข้อมูลสำเร็จ!!</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="hide-sub-id" id="delete-show_id_sub"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<button type="button" id="delete-equipment-sn" class="btn btn-danger">ยืนยัน</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-aqua">
				<h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลอุปกรณ์</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label for="">รายการ</label>
						<input type="text" class="form-control" value="<?php echo $equipment['name'];?>" readonly>
						<input type="hidden" class="form-control" id="equipment_id" value="<?php echo $equipment['id'];?>">
					</div>
					<div class="col-md-6">
						<label for="">หมายเลขอุปกรณ์(Serial Number)</label>
						<div class="form-control" id="update-show_serial_number" readonly></div>					
					</div>
					<div class="col-md-6 mt-3">
						<label for="">สถานะของอุปกรณ์</label>
						<select class="form-control" id="equipment-status">
							<option value="">เลือกสถานะของอุปกรณ์</option>
							<option value="0">ปกติ</option>
							<option value="2">ชำรุด/เสียหาย</option>
							<option value="3">ส่งซ่อม</option>

						</select>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="label-main label-success">แก้ไขสถานะของอุปกรณ์สำเร็จ!!</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="hide-sub-id" id="update-show_id_sub"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<button type="button" id="update-equipment-sn" class="btn btn-primary">บันทึก</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="alert-permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-aqua">
				<h5 class="modal-title" id="exampleModalLabel"><i class="icon-info"></i> ข้อความแจ้งเตือน</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">คุณไม่สามารถดำเนินการได้ เนื่องจากไม่มีสิทธิ์การเข้าถึง</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="hide-sub-id" id="delete-show_id_sub"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>


<script src="../../html-version/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function(){
		var view_equipment_sn = [];
		var equipment_id = <?php echo $_GET['id']; ?>;

		$(document).on('click', '#add-equipment-serial-number', function(){
			var equipment_id = $('#equipment_id').val();
			var serial_number = $('#serial_number').val();
			$.ajax({
				url:"index.php?r=site/json_add_equipment&type=serialnumber",
				method:"GET",
				dataType:"json",
				data:{ equipment_id: equipment_id,serial_number:serial_number},
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

		$.ajax({
			url:"index.php?r=site/json_add_equipment&type=view_equipment_sn&id="+equipment_id,
			method:"GET",
			"dataType": "json",
			success:function(data)
			{
				//console.log(data);
				// show_equipment_sn(data);
				$(".loading-alert").css("display", "block");
				setTimeout(function(){
					$(".loading-alert").css("display", "none");
					show_equipment_sn(data);
				},3000);
			}
		});

		function show_equipment_sn(data)
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
				// {
				// 	title: "รายการ"
				// },
				{
					title: "รายการ"
				},
				{
					title: "หน่วยที่เบิกจ่าย"
				},
				{
					title: "วันที่เบิกจ่าย"
				},
				{
					title: "สถานะ"
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
				// {
				// 	"targets": [1],
				// 	"data" : "equipment_main",
				// 	"width" : "15%"
				// },
				{
					"targets": [1],
					"data" : "serial_number",
					"width" : "15%"
				},
				{
					"targets": [2],
					"data" : "unit_id",
					"width" : "15%"
				},
				{
					"targets": [3],
					"data" : "date_time",
					"width" : "15%"
				},
				{
					"targets": [4],
					"data" : "status",
					"width" : "15%"
				},
				{
					"targets": [5],
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

		var equipment_disbursement_id = <?php echo $_GET['id']; ?>;
		$.ajax({
			url:"index.php?r=site/json_add_equipment&type=view_equipment_disbursement_main&id="+equipment_disbursement_id,
			method:"GET",
			"dataType": "json",
			success:function(data)
			{
				$(".loading-alert").css("display", "block");
				setTimeout(function(){
					$(".loading-alert").css("display", "none");
					show_equipment_main(data);
				},3000);
			}
		});

		function show_equipment_main(data)
		{
			var dataSet = data;
			datatable = $('#show_view_main').DataTable({
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
				"pageLength": 7,
				"lengthMenu": [ [15, 50, 80, 100, -1], [15, 50, 80, 100, "ทั้งหมด"] ],
				data: dataSet,
				destroy: true,
				columns: [
				{
					title: "ลำดับ"
				},
				{
					title: "รายการ"
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
					"data" : "detail",
					"width" : "90%"
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


		$(document).on('click', '.add-data-in-modal', function(){
			var id_sub = $(this).data("id");
			var sn = $(this).data("sn");
			$('#show_serial_number').html(sn);
			$('#show_id_sub').html(id_sub);
		});

		$(document).on('change', '#date_end', function(){
			if(this.checked) {
				$("#date_data_end").removeClass("datepicker_input");
				$('#date_data_end').prop('readonly', false);
				$('#date_data_end').prop('disabled', true);
				$('#date_data_end').attr('data-value', null);
			}else{
				$("#date_data_end").addClass("datepicker_input");
				$('#date_data_end').prop('readonly', true);
				$('#date_data_end').prop('disabled', false);
			}
			
		});

		$(document).on('click', '#add-equipment-disbursement', function(){
			var id_main = <?php echo $_GET['id']; ?>;
			var id_sub = $('#show_id_sub').text();
			var unit_id = $('#unit').val();
			var date_data = $('#date_data').val();
			var remark = $('#remark').val();
			var user_disbursement = $('#user_disbursement').val();
			var date_data_end = $('#date_data_end').val();
			var date_end = $('#date_end').val();

			if ($('#date_end').is(':checked')) {
				var time_end = '0000-00-00';
			}else{
				var time_end = date_data_end;
			}
			// console.log('id_main '+id_main+' id_sub '+id_sub+' unit_id '+unit_id+' date_data '+date_data+' date_data_end '+time_end+' remark '+remark);
			$.ajax({
				url:"index.php?r=site/json_add_equipment&type=add-disbursement",
				method:"GET",
				dataType:"json",
				data:{ id_main: id_main,id_sub:id_sub,unit_id:unit_id,user_disbursement:user_disbursement,date_data:date_data,date_data_end:time_end,remark:remark},
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

		$(document).on('click', '.del-data-in-modal', function(){
			var id_sub = $(this).data("id");
			var sn = $(this).data("sn");
			var unit_name = $(this).data("unit");
			var id_disbursement = $(this).data("id-disbursement");
			var user = $(this).data("user");
			$('#del-show_serial_number').html(sn);
			$('#del-show_id_sub').html(id_sub);
			$('#del-show_unit').html(unit_name);
			$('#del-id_disbursement').html(id_disbursement);
			$('#del-user_disbursement').html(user);
		});

		$(document).on('click', '#del-equipment-disbursement', function(){
			var id_main = <?php echo $_GET['id']; ?>;
			var id_sub = $('#del-show_id_sub').text();
			var id_disbursement = $('#del-id_disbursement').text();
			var date_data = $('#del-date_data').val();
			var remark = $('#del-remark').val();
			console.log('id_disbursement '+id_disbursement+' id_main '+id_main+' id_sub '+id_sub+' date_data '+date_data+' remark '+remark);
			$.ajax({
				url:"index.php?r=site/json_add_equipment&type=del-disbursement",
				method:"GET",
				dataType:"json",
				data:{ id_disbursement:id_disbursement,id_main: id_main,id_sub:id_sub,date_data:date_data,remark:remark},
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


		$(document).on('click', '.update-data-in-modal', function(){
			var id_sub = $(this).data("id");
			var sn = $(this).data("sn");
			$('#update-show_serial_number').html(sn);
			$('#update-show_id_sub').html(id_sub);
		});

		$(document).on('click', '#update-equipment-sn', function(){
			var id_sn = $('#update-show_id_sub').text();
			var status = $('#equipment-status').val();
			console.log("id_sn = "+id_sn+" status = "+status);
			$.ajax({
				url:"index.php?r=site/json_add_equipment&type=update-equipment-sn",
				method:"GET",
				dataType:"json",
				data:{ id_sn:id_sn,status:status},
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

		$(document).on('click', '.delete-data-in-modal', function(){
			var id_sub = $(this).data("id");
			$('#delete-show_id_sub').html(id_sub);
		});

		$(document).on('click', '#delete-equipment-sn', function(){
			var id_sn = $('#delete-show_id_sub').text();
			$.ajax({
				url:"index.php?r=site/json_add_equipment&type=delete-disbursement-sn",
				method:"GET",
				dataType:"json",
				data:{ id_sn:id_sn},
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

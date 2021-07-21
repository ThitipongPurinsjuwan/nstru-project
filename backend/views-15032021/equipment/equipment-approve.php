<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'ตรวจสอบการเบิกจ่าย');
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
</div>

<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-aqua">
				<h5 class="modal-title" id="exampleModalLabel">ตรวจสอบการเบิกจ่าย</h5>
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
					<div class="col-md-6 mt-3">
						<label for="">สถานะเบิกจ่าย</label>
						<select class="form-control" id="equipment-approve-status">
							<option value="">เลือกสถานะของอุปกรณ์</option>
							<option value="2">ถูกต้อง</option>
							<option value="3">ไม่ถูกต้อง</option>
						</select>
					</div>
					<div class="col-md-12 mt-3">
						<label for="">หมายเหตุ</label>
						<textarea class="form-control" id="equipment-approve-remark"></textarea>
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
				<button type="button" id="update-equipment-approve" class="btn btn-primary">บันทึก</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		var unit_id = <?php echo $_SESSION['unit_id']; ?>;

		$.ajax({
			url:"index.php?r=site/json_add_equipment&type=equipment-approve&unit_id="+unit_id,
			method:"GET",
			"dataType": "json",
			success:function(data)
			{
				// console.log(data);
				// show_equipment(data);
				$(".loading-alert").css("display", "block");
				setTimeout(function(){
					$(".loading-alert").css("display", "none");
					show_equipment(data);
				},3000);
			}
		});

		function show_equipment(data)
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
					title: "ผู้เบิกจ่ายอุปกรณ์"
				},
				{
					title: "วันที่เบิกจ่าย"
				},
				{
					title: "จำนวนวันที่เบิกจ่าย"
				},
				{
					title: "สถานะการตรวจสอบ"
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
					"data" : "user_disbursement",
					"width" : "20%"
				},
				{
					"targets": [3],
					"data" : "date_time",
					"width" : "15%"
				},
				{
					"targets": [4],
					"data" : "calculate_day",
					"width" : "15%"
				},
				{
					"targets": [5],
					"data" : "equipment_approve_detail",
					"width" : "20%"
				},
				{
					"targets": [6],
					"data" : "link",
					"width" : "10%"
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

		$(document).on('click', '.approve-in-modal', function(){
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

		$(document).on('click', '#update-equipment-approve', function(){
			var disremark_id = $('#show_disremark_id').text();
			var id_sub = $('#show_id_sub').text();
			var status = $('#equipment-approve-status').val();
			var remark = $('#equipment-approve-remark').val();

			//console.log(disremark_id+" "+id_main+" "+id_sub+" "+status+" "+remark);

			$.ajax({
				url:"index.php?r=site/json_add_equipment&type=update-equipment-approve",
				method:"GET",
				dataType:"json",
				data:{ disremark_id: disremark_id,status:status,remark:remark,id_sub:id_sub},
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
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DropdownModel;
use app\models\OperatingKam;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingMain */
/* @var $form yii\widgets\ActiveForm */

$operating_kam = OperatingKam::find()->All();

?>
<link rel="stylesheet" href="../../html-version/assets/css/style_operating.css"/>
<style>
	.btn-group{
		width: 100%;
		text-align: left;
	}
	.multiselect-selected-text{
		float: left !important;
	}
	.dropdown-toggle::after{
		right: 10px;
		float: right;
	}
	.label-main{
		display: none;
	}
	.label-success{
		width: 100%;
		background-color: #188E49;
		color: #FFFFFF;
		font-size: 16px;
		margin-top: 10px;
		padding: 4px 4px 4px 10px;
		border-radius: 5px;
	}
	#show-amphures{
		display: none;
	}
	#show-district{
		display: none;
	}
</style>
<div class="operating-main-form">

	<?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'detail')->textArea(['maxlength' => true,'rows' => '4']) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<label for="">โซน(Zone)</label>
			<?php
			$operating_zone = Yii::$app->db->createCommand("SELECT id,zone_name FROM operating_zone ORDER BY id ASC")->queryAll();
			foreach ($operating_zone as $value) {
				$listzone[$value['id']] = $value['zone_name'];
			}
			echo $form->field($model, 'zone_id')->dropDownList($listzone, ['prompt' => 'เลือกโซน','class'=>'multiselect multiselect-custom'])->label(false);
			?>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#addzone"><span class="tag tag-blue mb-3" style="cursor: pointer;"><i class="fe fe-home operating-btn-create-mini"></i> เพิ่มข้อมูลโซน</span></a>
		</div>
		<div class="col-md-4">
			<label for="">พื้นที่/กองร้อย(Area)</label>
			<?php
			$operating_area = Yii::$app->db->createCommand("SELECT area_id,area_name FROM operating_area ORDER BY area_id ASC")->queryAll();
			foreach ($operating_area as $value) {
				$listarea[$value['area_id']] = $value['area_name'];
			}
			echo $form->field($model, 'area_id')->dropDownList($listarea, ['prompt' => 'เลือกพื้นที่/กองร้อย','class'=>'multiselect multiselect-custom'])->label(false);
			?>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#addarea"><span class="tag tag-blue mb-3" style="cursor: pointer;"><i class="fe fe-flag operating-btn-create-mini"></i> เพิ่มข้อมูลพื้นที่/กองร้อย</span></a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<?= $form->field($model, 'province')->hiddenInput(['maxlength' => true,'id' => 'operating-province'])->label(false); ?>

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
					<option value="<?=$val_province['code']?>" data-id="<?=$val_province['id']?>"
						data-code="<?=$val_province['code']?>" <?=$selected;?>>
						<?=$val_province['name_th']?>
					</option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="col-md-3" id="">
			<?= $form->field($model, 'amphure')->hiddenInput(['maxlength' => true,'id' => 'operating-amphure'])->label(false); ?>
			<label> อำเภอ :</label>
			<select name="amphure" id="amphure" class="form-control select__amphoe">

				<option value="">
					เลือกอำเภอ
				</option>

			</select>
		</div>

		<div class="col-md-3" id="">
			<?= $form->field($model, 'district')->hiddenInput(['maxlength' => true,'id' => 'operating-district'])->label(false); ?>
			<label>ตำบล :</label>
			<select name="district" id="district" class="form-control select__tombon">

				<option value="">
					เลือกตำบล
				</option>

			</select>
		</div>

	</div>

	<div class="row mt-2">
		<div class="col-md-4">
			<label for="">องค์กรที่รับผิดชอบ</label>
			<?php
			$organization = Yii::$app->db->createCommand("SELECT id,name FROM organization ORDER BY id ASC")->queryAll();
			foreach ($organization as $value) {
				$listorganization[$value['id']] = $value['name'];
			}
			echo $form->field($model, 'organization_id')->dropDownList($listorganization, ['prompt' => 'เลือกองค์กรที่รับผิดชอบ','class'=>'multiselect multiselect-custom'])->label(false);
			?>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-md-6">
			<?= $form->field($model, 'remark')->textArea(['maxlength' => true,'rows' => '2']) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<?= $form->field($model, 'user_create')->hiddenInput(['maxlength' => true,'value' => $_SESSION['user_id']])->label(false); ?>
				<?= $form->field($model, 'date_create')->hiddenInput(['maxlength' => true,'value' => date('Y-m-d')])->label(false); ?>
				<?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
			</div>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

	<div class="modal fade" id="addzone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fe fe-home"></i> เพิ่มข้อมูลโซน</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label for="">ประเภท KAM</label>
							<select class="form-control multiselect multiselect-custom" id="kam_id">
								<option value="">เลือกประเภท KAM</option>
								<?php foreach ($operating_kam as $kam) { ?>
									<option value="<?php echo $kam['id']?>"><?php echo $kam['kam']?></option>
								<?php } ?>
							</select>
							<label for="" class="mt-2">รายการ</label>
							<input type="text" class="form-control" id="zone_name" maxlength="255">
							<label for="" class="mt-2">รายละเอียด</label>
							<textarea class="form-control" id="zone_detail" rows="3" maxlength="255"></textarea>
							<label for="" class="mt-2">หมายเหตุ</label>
							<input type="text" class="form-control" id="zone_remark" maxlength="255">
						</div>
						<div class="col-md-12">
							<div class="label-main label-success">บันทึกข้อมูลสำเร็จ!!</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<button type="button" id="add-zone" class="btn btn-primary">บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><i class="fe fe-flag"></i> เพิ่มข้อมูลพื้นที่/กองร้อย(Area)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label for="">โซน(Zone)</label>
							<select name="zone_id" id="zone_id" class="multiselect multiselect-custom form-control">
								<option value="">เลือกโซน</option>
								<?php
								$operating_area = Yii::$app->db->createCommand("SELECT area_id,area_name FROM operating_area ORDER BY area_id ASC")->queryAll();
								foreach ($operating_area as $value) {
									?>
									<option value="<?php echo $value['area_id'] ?>"><?php echo $value['area_name']; ?></option>
									<?php
								}
								?>
							</select>
							<br>
							<label for="">รายการ</label>
							<input type="text" class="form-control" id="area_name" maxlength="255">
							<br>
							<label for="">รายละเอียด</label>
							<textarea class="form-control" id="area_detail" rows="3" maxlength="255"></textarea>
							<br>
							<label for="">หมายเหตุ</label>
							<input type="text" class="form-control" id="area_remark" maxlength="255">
						</div>
						<div class="col-md-12">
							<div class="label-main label-success">บันทึกข้อมูลสำเร็จ!!</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<button type="button" id="add-area" class="btn btn-primary">บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){

			$(document).on('click', '#add-zone', function(){
				var kam_id = $('#kam_id').val();
				var name = $('#zone_name').val();
				var detail = $('#zone_detail').val();
				var remark = $('#zone_remark').val();

				$.ajax({
					url:"index.php?r=site/json-operating&type=operating_add_zone",
					method:"GET",
					dataType:"json",
					data:{ kam_id: kam_id,name: name,detail:detail,remark:remark},
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
			$(document).on('click', '#add-area', function(){
				var zone_id = $('#zone_id').val();
				var name = $('#area_name').val();
				var detail = $('#area_detail').val();
				var remark = $('#area_remark').val();

				$.ajax({
					url:"index.php?r=site/json-operating&type=operating_add_area",
					method:"GET",
					dataType:"json",
					data:{ zone_id: zone_id,name: name,detail:detail,remark:remark},
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


			get_amphures($("#operating-province").val(),$("#operating-amphure").val());
			get_districts($("#operating-amphure").val(),$("#operating-district").val());

			$(document).on('change', '.select__province', function() {
				var id = $(this).find(':selected').data('id');
				var code = $(this).find(':selected').data('code');
				var name_id = $(this).attr('id');
				$("#show-amphures").css("display", "block");
				$("#operating-province").val(id);
				if (id != undefined) {
					get_amphures(id, '');
				}
			});

			$(document).on('change', '.select__amphoe', function() {
				var id = $(this).find(':selected').data('id');
				var code = $(this).find(':selected').data('code');
				var name_id = $(this).attr('id');
				$("#show-district").css("display", "block");
				$("#operating-amphure").val(id);
				if (id != undefined) {
					get_districts(id, '');
				}
			});

			function get_amphures(id, idselect) {
				$.ajax({
					url: "index.php?r=operating-main/selectamphures&type=get_amphures&province_id=" +
					id + "&idselect=" + idselect,
					method: "GET",
					success: function(data) {
						$(".select__amphoe").html(data);
					}
				});
			}

			function get_districts(id, idselect) {
				$.ajax({
					url: "index.php?r=operating-main/selectamphures&type=get_districts&amphure_id=" +
					id + "&idselect=" + idselect,
					method: "GET",
					success: function(data) {
						$(".select__tombon").html(data);
					}
				});
			}

			$(document).on('change', '.select__tombon', function() {
				var id = $(this).find(':selected').data('id');
				var code = $(this).find(':selected').data('code');
				var name_id = $(this).attr('id');
				$("#operating-district").val(id);
			});

		});

	</script>



</div>

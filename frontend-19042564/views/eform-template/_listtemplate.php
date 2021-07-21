<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\models\EformTemplateType;
?>

<style>
.div-scrollbar{
	height: 150px;
	overflow-y: scroll;
	padding: 0em 1em 1em 1em;
	margin-bottom: 1em;
}

.div-scrollbar-120{
	height: 120px !important;
	overflow-y: scroll;
}
.isDisabled {
  pointer-events: none;
  cursor: default;
  text-decoration: none;
}
</style>

<div class="card p-3 card-success">
<div class="card-status card-status-left bg-green"></div>
                <div class="card-header bg-green text-white">
                    <dt><?= Html::encode($model->detail) ?>
                    
                
                    </dt>
                </div>

	<!----> <h3 class="card-title"><dt>
    <!-- แบบฟอร์ม : <?= Html::encode($model->detail) ?>  -->
    <dt>  <br>
                <a href="#" class="badge badge-danger">
                <font color="#FFFFFF">
                    <?php echo EformTemplateType::find()->where(['id' => $model->type])->one()->type;?>
                </font></a> 
     </dt></h3> <!---->
	<div class="div-scrollbar">
		<?php
		if(!empty($model->form_element))
		{
			$data_main = @json_decode($model->form_element,TRUE);
			$show = '';


			foreach ($data_main[0]['fieldGroup'] as $col){
				$show .= $col['templateOptions']['placeholder']." (".$col['key'].")<br> ";
			}
			$string = rtrim($show, "<br> ");
			echo  $string;

		}
		?>
	</div>
	<div class="row">
		<div class="col-md-8">
			<a onclick="window.open('index.php?r=site/pages&view=eform_template&form_id=<?=$model->id;?>');" href="#"><span class="tag tag-blue mb-3" style="cursor: pointer;">ตัวอย่างฟอร์ม</span></a>

			<div class="div-scrollbar-120">
			<dt>หน่วยงานที่สามารถใช้งานได้</dt>
			<small class="d-block text-muted">
				<?php echo (!empty($model->unit_id) && $model->unit_id!='[]') ? getList($model->unit_id,'unit','unit_id','unit_name') : '<br>'; ?>
			</small>

			<b class="d-inline">จำนวนข้อมูลที่บันทึกผ่านฟอร์ม </b>
			<a href="index.php?r=eform-data/index&form_id=<?=$model->id;?>">
			<small class="text-muted d-block">
				<?php $eform_data = Yii::$app->db->createCommand("SELECT COUNT(*)  FROM `eform_data` WHERE data_json LIKE '%\"form_id\":\"".$model->id."\"%'")->queryScalar(); 
								echo number_format($eform_data);
							?> รายการ
			</small></a>
			</div>
		</div>
		<div class="ml-auto text-muted col-md-4 text-right">
			<br>
			<br>

          <!--   <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary"><i class="fe fe-eye mr-1"></i></button>
            <button type="button" class="btn btn-secondary"><i class="fe fe-edit-3 mr-1"></i></button>
            <button type="button" class="btn btn-secondary"><i class="fe fe-slash mr-1"></i></button>
            </div> -->

			<a href="index.php?r=eform-template/view&id=<?=$model->id;?>" title="รายละเอียด" class="icon"><i class="fe fe-eye mr-1"></i></a>
			<!-- <a href="#" title="ตัวอย่าง" onclick="window.open('index.php?r=site/pages&view=eform_template&form_id=<?=$model->id;?>', '_blank')" class="icon d-md-inline-block ml-3"><i class="fe fe-layout mr-1"></i></a> -->
			<a href="index.php?r=eform-template/update&id=<?=$model->id;?>" title="แก้ไข" class="icon d-md-inline-block ml-3"><i class="fe fe-edit-3 mr-1"></i></a>
			<?php echo Html::a('<i class="fe fe-slash mr-1"></i>', ['disable', 'id' => $model->id], ['class'=>'icon d-md-inline-block ml-3','style'=>'    font-weight: bold;color: #dc3545;','data' => ['confirm' => Yii::t('app', 'ต้องการปิดการใช้งานใช่หรือไม่?'),'method' => 'post','title'=>'ปิดการใช้งาน'],]); ?>
		</div>
	</div>
</div>

<?php
// $checkeform = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `eform` WHERE form_id = '".$model->id."'")->queryScalar();
// $checked = ($checkeform>0) ? 'checked' : '';

?>

<!-- <div class="card card-collapsed card_hide" id="card<?=$model->id;?>">
	<div class="card-header">
		<h4 class="card-title"><dt>เปิดการใช้งาน</dt></h4>
		<div class="card-options">
			<label class="custom-switch m-0">
				<input type="checkbox" value="1" class="custom-switch-input" <?=$checked;?> disabled="true">
				<span class="custom-switch-indicator"></span>
			</label>
			<?php if ($checkeform>0): ?>
				<a href="#card<?=$model->id;?>" class="card-options-collapse" data-toggle="card-collapse" id="<?=$model->id;?>"><i class="fe fe-chevron-up"></i></a>
				<?php else: ?>
					<div style="margin-bottom: 1.7em !important;"></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="card-body">
			<?php $eform = Yii::$app->db->createCommand("SELECT *  FROM `eform_template` WHERE id = '".$model->id."' ORDER BY version ASC")->queryAll(); 
			$i = 1;
			?>
			<?php foreach ($eform as $val): ?>
				<span class="tag tag-orange mb-3">Version <?=$val['version']?></span>
				<div class="row">
					<div class="col-5 py-1"><strong>วันที่บันทึก:</strong></div>
					<div class="col-7 py-1"><?=DateThaiTime($val['date_create']);?></div>
					<div class="col-5 py-1"><strong>หน่วยที่บันทึก:</strong></div>
					<div class="col-7 py-1"><?php $unit = Yii::$app->db->createCommand("SELECT * FROM `unit` WHERE unit_id = '".$val['unit_id']."'")->queryOne();
					echo $unit['unit_name'];
					?></div>
					<div class="col-5 py-1"><strong>รูปแบบฟอร์ม:</strong></div>
					<div class="col-7 py-1">
						<?php if ($val['active']==1): ?>
							<a onclick="window.open('index.php?r=site/pages&view=eform_information&form_id=<?=$val['form_id'];?>&unit_id=<?=$val['unit_id'];?>');" href="#"><span class="tag tag-success mb-3" style="cursor: pointer;">เปิดใช้งาน</span></a>
							<?php else: ?>
								<a href="#" class="isDisabled"><span class="tag tag-default mb-3">ปิดใช้งาน</span></a>
							<?php endif; ?>

						</div>
						<div class="col-5 py-1"><strong>รายละเอียด:</strong></div>
						<div class="col-7 py-1"><?=$val['detail']?></div>
						<div class="col-5 py-1"><strong>จำนวนข้อมูลที่บันทึกผ่านฟอร์ม:</strong></div>
						<div class="col-7 py-1"><strong>
							<?php $eform_data = Yii::$app->db->createCommand("SELECT COUNT(*)  FROM `eform_data` WHERE data_json LIKE '%\"form_id\":\"".$val['form_id']."\"%' AND data_json LIKE '%\"eform_version\":\"".$val['version']."\"%'")->queryScalar(); 
								echo number_format($eform_data);
							?>
						</strong></div>
					</div>
					<hr>
					<?php
					$i++;
				endforeach; ?>
			</div>

	<div class="card-footer">
		<div class="clearfix">
			<div class="float-left"><strong>15%</strong></div>
			<div class="float-right"><small class="text-muted">Progress</small></div>
		</div>
		<div class="progress progress-xs">
			<div class="progress-bar bg-red" role="progressbar" style="width: 15%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div> 
</div>-->



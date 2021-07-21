<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EformDataSearch */
/* @var $form yii\widgets\ActiveForm */
if (isset($_GET['form_id'])) {
	$action = ['eform-data/index', 'form_id' => $model->form_id];
}else if(isset($_GET['form_id']) && isset($_GET['eversion'])){
	$action = ['eform-data/index', 'form_id' => $model->form_id, 'eversion' => $_GET['eversion'],'eform_id' => $_GET['eform_id']];
}else{
	$action = ['eform-data/index'];
}
?>

<div class="eform-data-search">

	<?php $form = ActiveForm::begin([
		// 'action' => $action,
		'method' => 'get',
		'options' => [
			'data-pjax' => 1
		],
	]); ?>

	<div class="row">
		<?//= $form->field($model, 'id') ?>

		<?php if (!isset($_GET['form_id'])): ?>
			<div class="col-md-3">
				<?php 
				$eform_template = Yii::$app->db->createCommand("SELECT * FROM `eform_template`")->queryAll();
				foreach ($eform_template as $value) {
					$listeform_template[$value['id']] = $value['detail'];
				}
				echo $form->field($model, 'form_id')->dropDownList($listeform_template, ['prompt' => 'เลือกประเภทข้อมูล']);
				?>
			</div>
		<?php endif ?>


		

		<div class="col-md-3">
			<label for="">วันที่บันทึก/แก้ไข ระหว่าง - </label>
			<?= $form->field($model, 'date_time')->textInput(['class'=>'form-control datepicker_input_search'])->label(false); ?>
		</div>

		<div class="col-md-3">
			<label for="">ถึงวันที่</label>
			<!-- <input type="text" class="form-control datepicker_input_search" name="end_date"> -->
			<?= $form->field($model, 'eform_id')->textInput(['class'=>'form-control datepicker_input_search'])->label(false); ?>
		</div>

		<div class="col-md-4">
			<label for="">รายละเอียดข้อมูล</label>
			<?= $form->field($model, 'data_json')->label(false) ?>
		</div>

		<div class="form-group col-md-12">
			<?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>

			<?php if (isset($_GET['EformDataSearch'])):
				$data = array('EformDataSearch'=>$_GET['EformDataSearch']);
				$linkquery = http_build_query($data, '', '&amp;');
			?>
			<div class="dropdown">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
					Export
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?r=eform-data/print-pdf-csv&type=pdf&<?=$linkquery;?>&form_id=<?=$_GET['form_id']?>" target="_blank">PDF</a>
					<a class="dropdown-item" onclick="window.open('index.php?r=eform-data/print-pdf-csv&type=csv&<?=$linkquery;?>&form_id=<?=$_GET['form_id']?>');" href="" target="_blank">CSV</a>
					<a class="dropdown-item" href="index.php?r=eform-data/print-pdf-csv&type=xls&<?=$linkquery;?>&form_id=<?=$_GET['form_id']?>" target="_blank">Excel</a>
				</div>
			</div>
			<?php //var_dump($data['EformDataSearch']); ?>
			<?php endif ?>
		</div>

	</div>

	<?php ActiveForm::end(); ?>

</div>

<script>
	$(document).ready(function(){
		$.fn.datepicker.dates['th'] = {
			days: ["วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์", "วันเสาร์"],
			daysShort: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
			daysMin: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
			months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤศภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
			monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
			today: "วันนี้",
			clear: "ล้างค่า",
			format: "yyyy-mm-dd",
			titleFormat: "MM yyyy", 
			weekStart: 0
		};
		$('.datepicker_input_search').datepicker({
			todayHighlight: true,
			format: 'yyyy-mm-dd',
			language: "th",
			thaiyear: true,
			autoclose: true
		}
		);
	});
</script>

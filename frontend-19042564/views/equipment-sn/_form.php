<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentSn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-sn-form">

	<?php $form = ActiveForm::begin(); ?>

	<div class="row">
		<div class="col-md-6">
			<?php 
			$id_main = Yii::$app->db->createCommand("SELECT id,name FROM equipment ORDER BY id ASC")->queryAll();
			foreach ($id_main as $value) {
				$listtype[$value['id']] = $value['name'];
			}
			echo $form->field($model, 'id_main')->dropDownList($listtype, ['prompt' => 'เลือกข้อมูลอุปกรณ์']);
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]); ?>
		</div>
	</div>


	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>

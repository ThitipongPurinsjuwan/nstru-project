<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\EformSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eform-search">
	<div class="row">
		<div class="col-md-12">

			<?php $form = ActiveForm::begin([
				'action' => ['eforms_dashboard'],
				'method' => 'get',
				'options' => [
					'data-pjax' => 1
				],
			]); ?>

			<div class="row">

				<div class="col-md-4">
					<?= $form->field($model, 'detail') ?>
				</div>
				<div class="col-md-4">
					<?= $form->field($model, 'version')->input('number',['maxlength' => true,'min'=>'1','max'=>'100']) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<?= Html::submitButton('สืบค้น', ['class' => 'btn btn-primary']) ?>
						<?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
					</div>
				</div>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
	</div>

</div>

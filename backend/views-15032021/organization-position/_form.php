<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationPosition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-position-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'position_name')->textInput(['maxlength' => true]) ?>

    <?php $model->user_create = ($model->isNewRecord) ? $_SESSION['user_id'] : $model->user_create; ?>
				<?= $form->field($model, 'user_create')->hiddenInput(['maxlength' => true])->label(false); ?>

    <div class="form-group text-center">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

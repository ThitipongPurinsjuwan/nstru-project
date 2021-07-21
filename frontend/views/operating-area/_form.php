<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingArea */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operating-area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'zone_id')->textInput() ?>

    <?= $form->field($model, 'area_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'user_create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

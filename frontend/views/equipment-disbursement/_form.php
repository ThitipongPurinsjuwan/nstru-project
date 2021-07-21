<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentDisbursement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-disbursement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_main')->textInput() ?>

    <?= $form->field($model, 'id_sub')->textInput() ?>

    <?= $form->field($model, 'unit_id')->textInput() ?>

    <?= $form->field($model, 'date_time')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

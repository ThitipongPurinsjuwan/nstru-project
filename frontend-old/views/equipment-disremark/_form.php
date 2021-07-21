<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentDisremark */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-disremark-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_main')->textInput() ?>

    <?= $form->field($model, 'id_sub')->textInput() ?>

    <?= $form->field($model, 'id_disbursement')->textInput() ?>

    <?= $form->field($model, 'disbursement_status')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

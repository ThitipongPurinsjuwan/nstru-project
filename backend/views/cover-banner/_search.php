<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CoverBannerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cover-banner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?#= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?#= $form->field($model, 'image') ?>

    <?#= $form->field($model, 'image_order') ?>

    <div class="form-group">
        <?= Html::submitButton('สืบค้น', ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

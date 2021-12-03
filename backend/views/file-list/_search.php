<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?//= $form->field($model, 'id') ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'download_name') ?>
        </div>
        
        <!-- <div class="col-md-3">
            <?//= $form->field($model, 'type') ?>
            <?#= $form->field($model, 'type')->radioList([1 => 'File', 2 => 'Link Video Youtube']); ?>  
        </div> -->

        <div class="form-group col-md-3" style="padding-top: 32px;">
            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('คืนค่า', ['class' => 'btn btn-outline-secondary']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>

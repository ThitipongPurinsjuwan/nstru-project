<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TypePlaceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-place-search">

    <?php $form = ActiveForm::begin([
        // 'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

     <div class="row">

    <?//= $form->field($model, 'id') ?>

<div class="col-md-6">
    <?= $form->field($model, 'name') ?>

    </div>


    <?//= $form->field($model, 'status') ?>

    <?//= $form->field($model, 'images') ?>

    <?//= $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <div class="form-group col-md-12">
          <?= Html::submitButton('สืบค้น', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelationsSearch */
/* @var $form yii\widgets\ActiveForm */
$type = $_GET['type'];
?>

<div class="public-relations-search">

    <?php $form = ActiveForm::begin([
        // 'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">

      <?= $form->field($model, 'type')->hiddenInput(['maxlength' => true,'value'=>$type])->label(false); ?>

    <?//= $form->field($model, 'id') ?>

    <div class="col-md-4">
    <?= $form->field($model, 'topic') ?>
    </div>

      <div class="col-md-3">

    <?= $form->field($model, 'date_imparting')->textInput(['maxlength' => true,'class'=>'form-control datepicker_input']); ?>

    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'details') ?>
    </div>



    <?//= $form->field($model, 'details') ?>

    <?//= $form->field($model, 'status') ?>

  

    <?php // echo $form->field($model, 'key_images') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <div class="form-group col-md-12">
        <?= Html::submitButton('สืบค้น', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

</div>
    <?php ActiveForm::end(); ?>

     

</div>

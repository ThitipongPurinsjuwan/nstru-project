<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PlaceSearch */
/* @var $form yii\widgets\ActiveForm */
$type = $_GET['type'];

?>

<div class="place-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">

    <?//= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type')->hiddenInput(['maxlength' => true,'value'=>$type])->label(false); ?>

 <div class="col-md-6">
    <?= $form->field($model, 'name') ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'contact') ?>
    </div>



    <?//= $form->field($model, 'details') ?>

    <?//= $form->field($model, 'activity') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'contact') ?>

    <?php // echo $form->field($model, 'business_hours') ?>

    <?php // echo $form->field($model, 'key_images') ?>

    <?php // echo $form->field($model, 'amphure') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'user_create') ?>

    <div class="form-group col-md-12">
        <?= Html::submitButton('สืบค้น', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

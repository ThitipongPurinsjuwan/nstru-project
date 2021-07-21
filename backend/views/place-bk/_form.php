<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Place */
/* @var $form yii\widgets\ActiveForm */
?> 

<div class="place-form">

    <div class="row">
        <div class="col-md-8">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'type')->textInput() ?>

            <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'activity')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'business_hours')->textInput(['maxlength' => true]) ?>

            <?php $model->isNewRecord==1 ? $model->key_images=date("Ymd_His"):$model->key_images;?>
            <?=$form->field($model, 'key_images')->hiddenInput(['maxlength' => true])->label(false); ?>

            <?= $form->field($model, 'amphure')->textInput() ?>

            <?= $form->field($model, 'district')->textInput() ?>

            <?= $form->field($model, 'province')->textInput() ?>

            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->textInput() ?>

            <?= $form->field($model, 'date_create')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'user_create')->textInput() ?>

             <div class="form-group">
                <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
                <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-secondary']) ?>
            </div>


            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-4">

            <?php
            $key_images = $model->key_images;
            include '../../upload_images/upload_images.php';
            ?>
        </div>
    </div>
</div>
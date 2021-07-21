<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\OperatingKam;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingZone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operating-zone-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'zone_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'detail')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
          
            <?php
                          $Unit=OperatingKam::find()->orderBy(['kam'=>SORT_ASC])->all();
                          $unit_id=ArrayHelper::map($Unit,'id','kam');

                          echo $form->field($model, 'kam_id')->dropDownList($unit_id,['prompt'=>'Select...']) ;
                          ?>
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>
        </div>
        




    <?= $form->field($model, 'date_create')->hiddenInput(['value' => date("Y-m-d H:i:s")])->label(false); ?>

    <?= $form->field($model, 'user_create')->hiddenInput(['value' => $_SESSION['user_id'] ])->label(false); ?>

    <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Place;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\PackageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
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

    <?//= $form->field($model, 'details') ?>

        <div class="col-md-2">
    <?= $form->field($model, 'date_moment')->textInput(['type' => 'number','min'=>0,'maxlength' => true,'max'=>20]) ?>
    </div>

          <div class="col-md-4">
   
    <?php
								$Place=Place::find()->all();
								$data=ArrayHelper::map($Place,'id','name');

								echo $form->field($model, 'place')->dropDownList($data,['prompt'=>'เลือกสถานที่','class'=>'select2search']);
								?>
    </div>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'status') ?>

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

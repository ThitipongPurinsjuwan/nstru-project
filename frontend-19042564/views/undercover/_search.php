<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Unit;


/* @var $this yii\web\View */
/* @var $model app\models\UndercoverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="undercover-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

<div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'undercover_number') ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-4">
       
        <?php 
            $unit = $unit = Unit::find()->orderBy(['unit_name' => SORT_ASC ])->All(); //Yii::$app->db->createCommand("SELECT * FROM `unit` ORDER BY unit_name")->queryAll();
            foreach ($unit as $value) {
                $list_unit[$value['unit_id']] = $value['unit_name'];
            }
            echo $form->field($model, 'unitid')->dropDownList($list_unit, ['prompt' => 'เลือกหน่วยที่เพิ่มรายการ','class'=>' multiselect multiselect-custom multiselect-filter ']);
            ?>
        </div>
    </div>
   

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <div class="form-group">
        <?= Html::submitButton('สืบค้น', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

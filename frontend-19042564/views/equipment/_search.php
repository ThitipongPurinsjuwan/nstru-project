<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EquipmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">

        <div class="col-md-4"><?= $form->field($model, 'name') ?></div>

        <div class="col-md-3">
            <?php 
            $equipment_type = Yii::$app->db->createCommand("SELECT * FROM `equipment_type`")->queryAll();
            foreach ($equipment_type as $value) {
                $listequipment[$value['id']] = $value['name'];
            }
            echo $form->field($model, 'type')->dropDownList($listequipment, ['prompt' => 'เลือกประเภทอุปกรณ์']);
            ?>

        </div>

        <div class="col-md-3"><?= $form->field($model, 'brand') ?></div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'ค้นหา'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'ล้างค่า'), ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

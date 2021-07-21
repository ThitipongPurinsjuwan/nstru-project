<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-search">

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

        <?//= $form->field($model, 'detail') ?>

        <?//= $form->field($model, 'address') ?>

        <div class="col-md-3">
            <?php 
            $organization_type = Yii::$app->db->createCommand("SELECT * FROM `organization_type` ORDER BY type")->queryAll();
            foreach ($organization_type as $value) {
                $list_organization_type[$value['id']] = $value['type'];
            }
            echo $form->field($model, 'type')->dropDownList($list_organization_type, ['prompt' => 'เลือกประเภทองค์กร']);
            ?>
            <?//= $form->field($model, 'type') ?>
        </div>
        <div class="col-md-3">
            
            <!-- <label class="control-label" for="organizationsearch-unit_create">หน่วยที่เพิ่มรายการ</label> -->
            <?php 
            $unit = Yii::$app->db->createCommand("SELECT * FROM `unit` ORDER BY unit_name")->queryAll();
            foreach ($unit as $value) {
                $list_unit[$value['unit_id']] = $value['unit_name'];
            }
            echo $form->field($model, 'unit_create')->dropDownList($list_unit, ['prompt' => 'เลือกหน่วยที่เพิ่มรายการ','class'=>'multiselect multiselect-custom multiselect-filter form-control']);
            ?>
            <?//= $form->field($model, 'unit_create') ?>
            
        </div>

        <?php // echo $form->field($model, 'user_create') ?>

        <?php // echo $form->field($model, 'coor.lat') ?>

        <?php // echo $form->field($model, 'coor.lon') ?>

        <?php // echo $form->field($model, 'data_json') ?>

        <div class="form-group col-md-12">
            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary loadmapsearch']) ?>
            <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
 $(document).ready(function(){
    $(".field-organizationsearch-unit_create").addClass('multiselect_div');
});

</script>
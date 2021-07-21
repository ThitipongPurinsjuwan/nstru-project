<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-type-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title">ตั้งค่าแบบฟอร์ม - ข้อมูลทั่วไป</h3>
        </div>

        <div class="card-body row">

            <div class="col-md-3">
                <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'marker_color')->input('color',['maxlength' => true]) ?>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
                    <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>



            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<script>
$('.my-colorpicker2').colorpicker()

$('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
});
</script>
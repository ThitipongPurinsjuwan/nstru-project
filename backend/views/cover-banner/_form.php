<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CoverBanner */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="cover-banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?#= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php $key_images = (!$model->isNewRecord) ? $model->image : time();?>
        <?= $form->field($model, 'image')->hiddenInput(['maxlength' => true,'value'=>$key_images, 'class'=>'get_key_images'])->label(false);?>

    <?#= $form->field($model, 'image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image_order')->textarea(['rows' => 6]) ?>

    <div class="form-group text-center col-md-12 mt-3">
            <?= Html::submitButton(Yii::t('app', 'บันทึกข้อมูล'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

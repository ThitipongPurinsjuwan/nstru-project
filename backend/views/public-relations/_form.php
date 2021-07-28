<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */
/* @var $form yii\widgets\ActiveForm */
$type = $_GET['type'];
?>

<div class="public-relations-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-12">

     <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

     
</div>


        <div class="col-md-12">

    <?= $form->field($model, 'details')->textarea(['rows' => '3','class'=>'summernote']) ?>

    </div>

     <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false); ?>

      <?php $date_imparting = (!$model->isNewRecord) ? $model->date_imparting : date("Y-m-d H:i:s");?>
    <?= $form->field($model, 'date_imparting')->hiddenInput(['maxlength' => true,'value'=>$date_imparting])->label(false); ?>

     <?= $form->field($model, 'type')->hiddenInput(['maxlength' => true,'value'=>$type])->label(false); ?>
        <?php $key_images = (!$model->isNewRecord) ? $model->key_images : time();?>
        <?= $form->field($model, 'key_images')->hiddenInput(['maxlength' => true,'value'=>$key_images, 'class'=>'get_key_images'])->label(false);?>

        <?= $form->field($model, 'date_create')->hiddenInput(['maxlength' => true, 'value'=>date("Y-m-d H:i:s")])->label(false); ?>

        <?= $form->field($model, 'user_create')->hiddenInput(['value'=>$_SESSION['user_id']])->label(false); ?>

    <div class="form-group text-center col-md-12 mt-3">
            <?= Html::submitButton(Yii::t('app', 'บันทึกข้อมูล'), ['class' => 'btn btn-success']) ?>
        </div>

        </div>

    <?php ActiveForm::end(); ?>

    


</div>

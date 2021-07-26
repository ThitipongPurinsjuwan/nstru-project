<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="public-relations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'date_imparting')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key_images')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_create')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

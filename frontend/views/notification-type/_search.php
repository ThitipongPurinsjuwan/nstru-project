<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'ค้นหา'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'ล้างค่า'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
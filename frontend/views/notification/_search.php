<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\NotificationType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">

        <div class="col-md-4">
            <?php
     $NotificationType = NotificationType::find()->all();
    $Notification=ArrayHelper::map($NotificationType,'id','type');

    echo $form->field($model, 'notification_type')->dropDownList($Notification,['prompt'=>'เลือกประเภทการแจ้งเตือน']) ;
    ?>

           
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'date_time')->input('date',['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'user_accept') ?>

    <?php // echo $form->field($model, 'read_news') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'notification_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'ค้นหา'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'ล้างค่า'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
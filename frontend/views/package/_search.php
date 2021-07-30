<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PackageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-search">

  <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
  ]); ?>

  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-md-4 col-sm-12 my-1">
      <?= $form->field($model, 'date_moment')->input('number', ['placeholder' => "เลือกจำนวนวันสำหรับท่องเที่ยว"])->label(false) ?>
    </div>
    <div class="col-md-2 col-sm-12 my-1">
      <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary mb-0 w-100']) ?>
      </div>
    </div>
  </div>

  <?php ActiveForm::end(); ?>

</div>
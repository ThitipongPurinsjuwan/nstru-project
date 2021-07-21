<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingKam */

$this->title = Yii::t('app', 'แก้ไขพื้นที่เขต : {name}', [
    'name' => $model->kam,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'พื้นที่เขตทหาร'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kam, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="operating-kam-update">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card  card-primary ">
        <div class="card-body">

            <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div>
    </div>
</div>
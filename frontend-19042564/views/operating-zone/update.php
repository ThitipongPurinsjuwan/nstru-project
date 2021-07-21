<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingZone */

$this->title = Yii::t('app', 'แก้ไขพื้นที่โซน : {name}', [
    'name' => $model->zone_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operating Zones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->zone_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="operating-zone-update">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card  card-primary ">

        <div class="card-body">


            <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div>
    </div>
</div>
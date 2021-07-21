<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingArea */

$this->title = Yii::t('app', 'Update Operating Area: {name}', [
    'name' => $model->area_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operating Areas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->area_id, 'url' => ['view', 'id' => $model->area_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="operating-area-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

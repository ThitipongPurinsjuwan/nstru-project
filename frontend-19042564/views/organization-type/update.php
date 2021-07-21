<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationType */

$this->title = Yii::t('app', 'แก้ไขข้อมูลประเภทองค์กร : {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ประเภทองค์กร'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="organization-type-update">

<h4><?= Html::encode($this->title) ?></h4>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>

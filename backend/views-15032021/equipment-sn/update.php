<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentSn */

$this->title = Yii::t('app', 'แก้ไขข้อมูลหมายเลขเครื่อง: {name}', [
	'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลหมายเลขเครื่อง'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'แก้ไข');
?>
<div class="equipment-sn-update">

	<h4><?= Html::encode($this->title) ?></h4>
	<div class="card">
		<div class="card-body">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>
	</div>
</div>
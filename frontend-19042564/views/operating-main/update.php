<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingMain */

$this->title = Yii::t('app', 'แก้ไขข้อมูลพื้นที่ปฏิบัติการ: {name}', [
	'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'แก้ไข');
?>
<div class="operating-main-update">
	<div class="row clearfix">
		<div class="col-md-12">
			<h4><?= Html::encode($this->title) ?></h4>
			<div class="card card-info">
				<div class="card-body">
					<?= $this->render('_form', [
						'model' => $model,
					]) ?>
				</div>
			</div>
		</div>
	</div>
</div>

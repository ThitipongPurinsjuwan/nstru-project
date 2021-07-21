<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingMain */

$this->title = Yii::t('app', 'เพิ่มข้อมูลพื้นที่ปฏิบัติการ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-main-create">
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

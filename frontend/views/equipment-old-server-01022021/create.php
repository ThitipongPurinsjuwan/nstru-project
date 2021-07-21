<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */

$this->title = Yii::t('app', 'เพิ่มข้อมูลอุปกรณ์');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลอุปกรณ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-create">

	<h4><?= Html::encode($this->title) ?></h4>
	<div class="card">
		<div class="card-body">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>

		</div>
	</div>
</div>
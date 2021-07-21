<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentSn */

$this->title = Yii::t('app', 'เพิ่มข้อมูลหมายเลขเครื่อง');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลหมายเลขเครื่อง'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-sn-create">

	<h4><?= Html::encode($this->title) ?></h4>
	<div class="card">
		<div class="card-body">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>
	</div>
</div>

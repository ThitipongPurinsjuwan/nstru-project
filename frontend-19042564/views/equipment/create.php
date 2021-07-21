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


	<div class="text-right">
			<a href="index.php?r=equipment/create" class="btn btn-success">
			<i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> เพิ่มประเภทอุปกรณ์
				<!-- <span class="tag tag-green-new" style="cursor: pointer;">เพิ่มข้อมูลอุปกรณ์</span> -->
			</a>
	</div>

	<div class="card card-primary ">
		<div class="card-body">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>

		</div>
	</div>
</div>
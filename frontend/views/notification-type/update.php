<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationType */

$this->title = Yii::t('app', 'แก้ไข : {name}', [
    'name' => $model->type,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ประเภทการแจ้งเตือน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="notification-type-update">


<h4><?= Html::encode($this->title) ?></h4>
	<div class="row clearfix">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card  card-primary ">
				<div class="card-body ribbon">

					<?= $this->render('_form', [
						'model' => $model,
					]) ?>

				</div>
			</div>
		</div>
	</div>
</div>
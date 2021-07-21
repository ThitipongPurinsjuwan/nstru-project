<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationType */

$this->title = Yii::t('app', 'เพิ่มประเภทการแจ้งเตือน');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ประเภทการแจ้งเตือน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-type-create">

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


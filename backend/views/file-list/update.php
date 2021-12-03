<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileList */

$this->title = 'แก้ไขรายการ : ' . $model->download_name;
$this->params['breadcrumbs'][] = ['label' => 'รายการฝากไฟล์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->download_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-list-update panel-shadow">

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

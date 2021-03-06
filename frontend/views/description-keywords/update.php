<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DescriptionKeywords */

$this->title = 'แก้ไขรายการ : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'คำอธิบายการใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="description-keywords-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="row clearfix">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card">
				<div class="card-body ribbon">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                 </div>
			</div>
		</div>
	</div>

</div>

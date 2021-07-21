<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EformTemplate */

$this->title = 'สร้าง Eform Template';
//$this->params['breadcrumbs'][] = ['label' => 'ผู้ดูแลระบบ', 'url' => ['eform-template/index']]; 
$this->params['breadcrumbs'][] = ['label' => 'จัดการ Template', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="eform-template-create">

	<h4><?= Html::encode($this->title) ?></h4>

	<div class="row clearfix">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card ">
                <div class="card-header bg-green text-white">
                    <dt>สร้าง Eform Template</dt>
                </div>
				<div class="card-body ribbon">
					<?= $this->render('_form', [
						'model' => $model,
					]) ?>
				</div>
			</div>
		</div>
	</div>

</div>

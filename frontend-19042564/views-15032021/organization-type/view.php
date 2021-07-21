<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationType */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ประเภทองค์กร'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organization-type-view">

<h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body ribbon">
                    <p>
                        <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'ยกเลิก'), ['delete', 'id' => $model->id], [
							'class' => 'btn btn-danger',
							'data' => [
								'confirm' => Yii::t('app', 'ต้องการยกเลิกข้อมูลองค์กรนี้ใช่หรือไม่?'),
								'method' => 'post',
							],
						]) ?>
                    </p>

                    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'marker_color',
        ],
    ]) ?>

                </div>
            </div>
        </div>

    </div>

</div>
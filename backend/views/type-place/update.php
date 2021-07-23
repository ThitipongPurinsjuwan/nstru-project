<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypePlace */

$this->title = Yii::t('app', 'แก้ไขประเภทสถานที่ : {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลประเภทสถานที่'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'แก้ไข');
?>
<div class="type-place-update">

     <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card card-success">
                <div class="card-body ribbon">

                    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>

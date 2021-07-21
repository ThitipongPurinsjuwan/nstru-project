<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingZone */

$this->title = Yii::t('app', 'สร้างพื้นที่โซน');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'พื้นที่โซน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-zone-create">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card  card-primary ">

        <div class="card-body">

            <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div>
    </div>
</div>
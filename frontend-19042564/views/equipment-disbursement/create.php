<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentDisbursement */

$this->title = Yii::t('app', 'Create Equipment Disbursement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipment Disbursements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-disbursement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EquipmentDisremark */

$this->title = Yii::t('app', 'Create Equipment Disremark');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipment Disremarks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-disremark-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypePlace */

$this->title = Yii::t('app', 'Create Type Place');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

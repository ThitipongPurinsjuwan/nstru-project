<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eform */

$this->title = 'Create Eform';
$this->params['breadcrumbs'][] = ['label' => 'Eforms', 'url' => ['eform-template/eforms_dashboard']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eform-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

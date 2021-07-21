<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EformData */

$this->title = 'Create Eform Data';
$this->params['breadcrumbs'][] = ['label' => 'Eform Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eform-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

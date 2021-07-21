<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationPosition */

$this->title = 'Create Organization Position';
$this->params['breadcrumbs'][] = ['label' => 'Organization Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-position-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

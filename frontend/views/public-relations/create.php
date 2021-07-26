<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */

$this->title = Yii::t('app', 'Create Public Relations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Public Relations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-relations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

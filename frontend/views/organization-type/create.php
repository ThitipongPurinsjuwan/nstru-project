<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationType */

$this->title = Yii::t('app', 'เพิ่มข้อมูลประเภทองค์กร');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ประเภทองค์กร'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-type-create">
<h4><?= Html::encode($this->title) ?></h4>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>

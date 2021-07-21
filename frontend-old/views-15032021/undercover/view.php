<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Undercover */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Undercovers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="undercover-view">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card card-success">
        <div class="card-body ribbon">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
            </p>

            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'undercover_number',
            'name',
            'unitid',
            'images:ntext',
            'status',
            'email:email',
            'address:ntext',
            'phone',
        ],
    ]) ?>

        </div>
    </div>
</div>
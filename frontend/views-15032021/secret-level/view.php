<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SecretLevel */

$this->title = $model->level;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Secret Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="secret-level-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="card card-success">
        <div class="card-body">
            <p>
                <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'ลบ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
            </p>

            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'level',
            'description',
           # 'status',
           [
            'attribute'=>'status',
            'format'=>'raw',
            'value' => function($model, $key)
            {
                if($model->status=='1')
                {
                    return 'เปิดการใช้งาน';
                }else{
                    return 'ปิดการใช้งาน';
                }
            },
        ],
        ],
    ]) ?>

        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OperatingZone */

$this->title = $model->zone_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'พื้นที่โซน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="operating-zone-view">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card  card-primary ">

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
            'zone_name',
            [
                'attribute'=>'kam_id',
                'format'=>'raw',    
                'value' => function($model, $key)
                {
                    if(!empty($model->kam_id))
                    {
                        $type = Yii::$app->db->createCommand("SELECT * FROM operating_kam WHERE id = '".$model->kam_id."'")->queryOne();
                        return $type['kam'];
                    }
                },
            ], 
            'detail',
            'remark',
            'date_create',
            'user_create',
        ],
    ]) ?>

        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OperatingZoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'พื้นที่โซน');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-zone-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card  card-primary ">

        <div class="card-body">


            <p>
                <?= Html::a('เพิ่ม'.$this->title, ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'zone_name',
           
            [
                'attribute'=>'kam_id',
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {
                    if(!empty($model->kam_id))
                    {
                        $type = Yii::$app->db->createCommand("SELECT * FROM operating_kam WHERE id = '".$model->kam_id."'")->queryOne();
                        return $type['kam'];
                    }
                },
            ], 
            'detail',
            // 'remark',
            'date_create',
            //'user_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Amphures; 
use common\models\Districts; 
use common\models\Provinces; 
use app\models\Users; 
/* @var $this yii\web\View */
/* @var $searchModel common\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$type = $_GET['type'];
$this->title = Yii::t('app', 'ข้อมูล'.titlePlace($type));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card card-success">
                <div class="card-body ribbon">
                    <p>
                        <?= Html::a(Yii::t('app', 'เพิ่มข้อมูล'), ['create','type'=>$type], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php Pjax::begin(); ?>
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'type',
            'name',
            // 'details',
            // 'activity',
            //'price',
            'business_day',
            [
                                    'attribute'=>'business_hours',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->business_hours))
                                        {
                                            return str_replace(","," - ",$model->business_hours)." น."; 
                                        }
                                    },
                                ],
              'price',
                                 'contact',
            //'business_hours',
            //'key_images',
            //'amphure',
            //'district',
            //'province',
            //'latitude',
            //'longitude',
            //'status',
            //'date_create',
            //'user_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
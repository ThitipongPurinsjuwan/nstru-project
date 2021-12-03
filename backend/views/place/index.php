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
                        <?php 
                        if ($type == 75) {
                          echo  Html::a(Yii::t('app', 'เพิ่มข้อมูล'), ['create-otop','type'=>$type], ['class' => 'btn btn-success']);
                        } else {
                          echo  Html::a(Yii::t('app', 'เพิ่มข้อมูล'), ['create','type'=>$type], ['class' => 'btn btn-success']);
                        }
                         
                        ?>
                    </p>

                    <?php Pjax::begin(); ?>
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?php 
                        if ($type == 75) {
                          echo  GridView::widget([
                            'dataProvider' => $dataProvider,
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                // 'id',
                                // 'type',
                                'name',
                                [
                                    'attribute'=>'date_create',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->date_create))
                                        {
                                            return DateThaiTime($model->date_create);
                                        }
                                    },
                                ],
                                [
                                    'attribute'=>'user_create',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->user_create))
                                        {
                                            $query = Users::find()
                                            ->where(['id'=>$model->user_create])->one();
                                            return $query->name;
                                        }
                                    },
                                ],
                    
                                ['class' => 'yii\grid\ActionColumn',
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::a('<i class="fas fa-eye"></i>',
                                            ['place/view', 'id' =>$model->id],['title' => 'View']
                                        );
                                    },
                                    'update' => function ($url, $model, $key) {
                                       
                                        return Html::a('<i class="fas fa-pencil-alt"></i>',
                                            ['place/update-otop', 'id' => $model->id],['title' => 'Update']

                                        );
                                    },
                                   
                                    'delete' => function ($url, $model, $key) {
                                        
                                    return  Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], ['data' => ['confirm' => Yii::t('app', 'ต้องการลบข้อมูลชุดนี้ใช่หรือไม่?'),'method' => 'post','title'=>'Delete']]);
                                           
                                    },
                                

                                ],
                                // 'options'=> ['style'=>'width:10%;'],
                            ],
        ],
                        ]);

                        } else {
                          echo GridView::widget([
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
                        ]);
                        }
                        
                        ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
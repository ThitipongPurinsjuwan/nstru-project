<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TypePlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ประเภทสถานที่');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-place-index">

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
            'name:ntext',
            //  [
            //                         'attribute'=>'status',
            //                         'format'=>'raw',    
            //                         'value' => function($model)
            //                         {
            //                             if(!empty($model->status))
            //                             {
            //                                 return ($model->status==0) ? 'ปิดใช้งาน':'เปิดใช้งาน';
            //                             }
            //                         },
            //                     ],
            // 'images:ntext',
             [
                                'format'=>'raw',
                                'attribute'=>'images',
                                'value' => function($model,$index)
                                {
                                    if(!empty($model->images))
                                    {
                                        return Html::img($model->photoViewer,['class'=>'img-thumbnail','style'=>'width:200px;', "onerror"=>"this.onerror=null;this.src='img/none.png';"]);
                                    }else{
                                        return Html::img('@web/img/none.png',['class'=>'img-thumbnail','style'=>'width:200px;']);
                                    }
                                },
                            ],
            // 'date_create',
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

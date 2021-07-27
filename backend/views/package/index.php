<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Place;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Package ท่องเที่ยว');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-index">

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
            'name',
            // 'details:ntext',
            'date_moment',
            // 'place:ntext',
             [
                                    'attribute'=>'place',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->place))
                                        {
                                   $myArray = str_replace('"',"",$model->place);
                                 $myArray = explode(',', $myArray);               
 $query =  Place::find()->where(['id'=>$myArray])
                    ->orderBy([
                        'name'=>SORT_ASC,
                    ])
                    ->all();
$showplace = "";
foreach ($query as $row) {
    $showplace .= "- ".$row['name']."<br>";
}
$showplace = substr($showplace, 0, -4);
                                            return  $showplace;
                                        }
                                    },
                                ],
            //'price',
            //'status',
            //'key_images',
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
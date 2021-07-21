<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Users; 
use app\models\NotificationType; 
use app\models\Notification;
 
/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'แจ้งเตือนถึงคุณ');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.badge1 {
    color: #fff;
    padding: 6px;
    /* width: 100%; */
}
.badge-success1 {
    background-color: #21ba45;
    border: transparent;
}

</style>


<div class="notification-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card  card-primary " style="font-size: 100%;">
                <div class="card-body w_sparkline" style="font-size: 100%;">
                    <div class="details">
                        <span>การแจ้งเตือนทั้งหมด</span>
                        <h3 class="mb-0 counter"> <?php echo $count = Notification::find()->count(); ?></h3>
                    </div>
                    <div class="w_chart">
                        <i class="users-box-icon text-orange icon-bell" style="font-size: 26px;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card  card-primary " style="font-size: 100%;">
                <div class="card-body w_sparkline" style="font-size: 100%;">
                    <div class="details">
                        <span>มาใหม่</span>
                        <h3 class="mb-0 counter">
                            <?php  echo $count = Notification::find()->where(['NOT LIKE', 'user_accept', '"'.$_SESSION['user_id'].'"'])->count(); ?>
                        </h3>
                    </div>
                    <div class="w_chart">
                        <i class="fa fa-bullhorn text-red" aria-hidden="true" style="font-size: 26px;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card  card-primary " style="font-size: 100%;">
                <div class="card-body w_sparkline" style="font-size: 100%;">
                    <div class="details">
                        <span>อ่านแล้ว</span>
                        <h3 class="mb-0 counter">
                            <?php echo $count = Notification::find()->where(['LIKE', 'read_news', '"'.$_SESSION['user_id'].'"'])->count(); ?>
                        </h3>
                    </div>
                    <div class="w_chart">
                        <i class="users-box-icon text-black icon-eye" style="font-size: 26px;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card  card-primary " style="font-size: 100%;">
                <div class="card-body w_sparkline" style="font-size: 100%;">
                    <div class="details">
                        <span>รับทราบแล้ว</span>
                        <h3 class="mb-0 counter">
                            <?php echo $count = Notification::find()->where(['LIKE', 'user_accept', '"'.$_SESSION['user_id'].'"'])->count(); ?>

                        </h3>
                    </div>
                    <div class="w_chart">
                        <i class="users-box-icon text-green icon-check" style="font-size: 26px;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card  card-primary ">
                <div class="card-body ribbon">

                    <p>
                        <?#= Html::a(Yii::t('app', 'Create Notification'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php Pjax::begin(); ?>
                    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            [
                                'attribute'=>'notification_type',
                                'format'=>'raw',    
                                'value' => function($model, $key)
                                        {
                                            if(!empty($model->notification_type))
                                            {
                                                $query = NotificationType::find()->where("id = ".$model->notification_type)->one();
                            
                                                return $query->type;
                                            }
                                        },
                            ],
                            'topic',
                            'content',
                            //'date_time',
                            [   
                                'attribute' => 'user_accept',
                                'contentOptions' => [ 'style' => 'width: 10%; text-align: center;' ],
                                'header'=> 'สถานะ',
                                'format' => 'raw',
                                'value' => function ($model, $key) {
                                    if (!empty($model->user_accept)) {
                                        $count = Notification::find()->where(['LIKE', 'user_accept', '"'.$_SESSION['user_id'].'"'])->andWhere([ 'id' => $model->id])->count();
                                        $count1 = Notification::find()->where(['LIKE', 'read_news', '"'.$_SESSION['user_id'].'"'])->andWhere([ 'id' => $model->id])->One();
    
                                        if ($count1 == 0 && $count == 0) {
                                            return '<span class="badge badge1 badge-danger">มาใหม่</span>';
                                       } else if ($count1 != 0 && $count == 0) {
                                           return '<span class="badge badge1 badge-secondary">อ่านแล้ว</span>';
                                       } else {
                                           return '<span class="badge badge1 badge-success1">รับทราบแล้ว</span>';
                                    }
                                       
                                    }
                                },
                            ],

                            [
                                'attribute' => 'date_time',
                                'contentOptions' => [ 'style' => 'width: 15%;' ],
                            ],
                           [   
                              'attribute' => 'user',
                              'format' => 'raw',
                              'value' => function ($model, $key) {
                                  if (!empty($model->user)) {
                                      return '<a href="index.php?r=notification/view&id='.$model->id.'">อ่าน</a>';
                                  }
                              },
                          ]
                            //'user',
                            /* [
                                'attribute' => 'user',
                                'format' => 'raw',
                                'value' => function ($model, $key) {
                                    if (!empty($model->user)) {
                                        $user = str_replace('"',"'",$model->user);
                                        $user_name =  Yii::$app->db->createCommand("SELECT * FROM users WHERE id IN (".$user.")")->queryAll();
                                        $valla_show = array(); 
                                            foreach ($user_name as $row_villa){
                                                $valla_show[] = $row_villa['name'];
                                            }
                                            $vs = implode(", ",$valla_show);
                                        
                                        return $vs;
                                    }
                                },
                            ], */
                            //'user_accept',
                            //'read_news',
                            //'link',
                            //'notification_by',

                            //['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
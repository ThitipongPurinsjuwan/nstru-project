<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Users; 
/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */

$this->title = $model->topic;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ''.titleNews($model->type)), 'url' => ['index','type'=>$model->type]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="public-relations-view">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-body ribbon">

                            <p>
                                <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('app', 'ยกเลิก'), ['delete', 'id' => $model->id], [
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
            'topic',
            'details:html',
            // 'status',
              [
                                    'attribute'=>'date_imparting',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->date_imparting))
                                        {
                                            return DateThaiTime($model->date_imparting);
                                        }
                                    },
                                ],
            // 'key_images',
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
        ],
    ]) ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-body ribbon">
                            <input type="hidden" class="get_key_images" value="<?=$model->key_images;?>">
                            <?php
                    $manage = 0; 
                    include('../../js/dropzone-4.3.0/page-uploadfile.php');
                    ?>
                        </div>
                    </div>

                </div>


            </div>



        </div>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Users;
/* @var $this yii\web\View */
/* @var $model app\models\TypePlace */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลประเภทสถานที่'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="type-place-view">

   
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
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
            'name:ntext',
            'name_eng:ntext',
            // 'status',
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
</div></div></div></div>
</div>

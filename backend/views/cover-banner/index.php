<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CoverBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 
$this->title = Yii::t('app', 'Cover Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cover-banner-index">

    <h4><dt><?= Html::encode($this->title) ?></dt></h4>

    <!-- <p>
        <?#= Html::a(Yii::t('app', 'Create Cover Banner'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card card-success">
                <div class="card-body ribbon">
                    <p>
                        <?= Html::a(Yii::t('app', 'เพิ่มข้อมูล'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            // 'image:ntext',
            'image_order:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    </div>
    </div>
    </div>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DropdownModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รายชื่อตัวเลือกแบบ drop down');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dropdown-model-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="card card-success">
        <div class="card-body">
            <p class="text-right">
                <?= Html::a(Yii::t('app', '<i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> เพิ่มข้อมูล drop down'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            #'id',
            'model_name',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
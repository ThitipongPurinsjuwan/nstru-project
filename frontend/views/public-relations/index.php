<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PublicRelationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Public Relations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-relations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Public Relations'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'topic',
            'details:ntext',
            'status',
            //'date_imparting',
            //'key_images',
            //'date_create',
            //'user_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

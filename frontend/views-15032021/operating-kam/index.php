<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OperatingKamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'พื้นที่เขตทหาร');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operating-kam-index">
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card card-primary">

        <div class="card-body">
            <p>
                <?= Html::a('เพิ่ม'.$this->title, ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'kam',
                    'detail',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลหมายเลขเครื่อง');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-sn-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card">
        <div class="card-body">
            <p>

                <?= Html::a(Yii::t('app', 'เพิ่มข้อมูลหมายเลขเครื่อง'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'id_main',
                    'serial_number',
                    'status',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>

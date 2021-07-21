<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizationTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ประเภทองค์กร');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-type-index">

<h4><?= Html::encode($this->title) ?></h4>

    <div class="row clearfix">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card">
				<div class="card-body ribbon">
					<p>
						<?= Html::a('เพิ่มข้อมูลองค์กร', ['create'], ['class' => 'btn btn-success']) ?>
					</p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'type',
            [
                'attribute'=>'marker_color',
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {
                    if(!empty($model->marker_color))
                    {
                        //$type = Yii::$app->db->createCommand("SELECT * FROM organization_type WHERE id = '".$model->type."'")->queryOne();
                        $bg=$model->marker_color;
                        
                        return '<span class="badge bt">รอการชำระ</span>';
                    }
                },
            ],
            'marker_color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    </div>
			</div>
		</div>
	</div>

</div>


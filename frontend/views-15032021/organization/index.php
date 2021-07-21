<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\OperatingZone;
use app\models\OperatingArea;
use app\models\OperatingMain;
use app\models\Provinces;
use app\models\Amphures;
use app\models\Districts;
use app\models\EformData;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลองค์กร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">

	<h4><?= Html::encode($this->title) ?></h4>
	<div class="row">
		<!-- <div class="col-xl-12 col-lg-12 col-md-12">
			<a class="btn btn-dark btn-lg" href="index.php?r=organization/dashboard"> Dashboard</a>
		</div> -->
	</div>
	<div class="row clearfix">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card card-success">
				<div class="card-body ribbon">
					<p>
						<?= Html::a('เพิ่มข้อมูลองค์กร', ['create'], ['class' => 'btn btn-success']) ?>
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
							
							[
								'attribute'=>'type',
								'format'=>'raw',    
								'value' => function($model, $key, $index)
								{
									if(!empty($model->type))
									{
										$type = Yii::$app->db->createCommand("SELECT * FROM organization_type WHERE id = '".$model->type."'")->queryOne();
										return $type['type'];
									}
								},
							],
							// 'detail:ntext',
							// 'address:ntext',
							// 'unit_create',
							'address:ntext',
							'village',
							[
								'attribute'=>'district',
								'format'=>'raw',
								'value' => function($model)
								{
									if(!empty($model->district))
									{
										$unit = Yii::$app->db->createCommand("SELECT * FROM districts WHERE id = '".$model->district."'")->queryOne();
										//Customer::find()->where(['id' => 123])->one();
										return $unit['name_th'];
									}
								},
							],
							[
								'attribute'=>'amphure',
								'format'=>'raw',
								'value' => function($model)
								{
									if(!empty($model->amphure))
									{
										$unit = Yii::$app->db->createCommand("SELECT * FROM amphures WHERE id = '".$model->amphure."'")->queryOne();
										return $unit['name_th'];
									}
								},
							],
							[
								'attribute'=>'province',
								'format'=>'raw',
								'value' => function($model)
								{
									if(!empty($model->province))
									{
										$unit = Yii::$app->db->createCommand("SELECT * FROM provinces WHERE id = '".$model->province."'")->queryOne();
										return $unit['name_th'];
									}
								},
							],
							[
								'attribute'=>'unit_create',
								'format'=>'raw',
								'value' => function($model, $key, $index)
								{
									if(!empty($model->unit_create))
									{
										$unit = Yii::$app->db->createCommand("SELECT * FROM unit WHERE unit_id = '".$model->unit_create."'")->queryOne();
										return $unit['unit_name'];
									}
								},
							],

							['class' => 'yii\grid\ActionColumn'],
						],
					]); ?>

					<?php Pjax::end(); ?>

				</div>
			</div>
		</div>
	</div>

</div>

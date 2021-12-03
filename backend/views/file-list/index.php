<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FileListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการฝากไฟล์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-list-index panel-shadow">

<h4><?= Html::encode($this->title) ?></h4>
	<div class="row clearfix">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card  card-primary ">
				<div class="card-body ribbon">
       
            <p>
                <?= Html::a('ฝากไฟล์', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'download_name',
            // 'file_name',
            [
                'attribute'=>'file_name','format'=>'raw', 
                'value' => function($model, $key)
                {
                    // if($model->type=='1'){
                    //     return '<a href="../../deposit_files/'.$model->file_name.'" target="_blank">ดาวน์โหลดไฟล์ : '.$model->download_name.'</a>';
                    // }else{
                        return '<a href="'.$model->file_name.'" target="_blank">'.$model->file_name.'</a>';
                    // }


                },
            ],
            [   
                'attribute'=>'date_create','format'=>'raw', 
                'value' => function($model, $key)
                {
                    if(!empty($model->date_create)){
                        return DateThai($model->date_create);
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

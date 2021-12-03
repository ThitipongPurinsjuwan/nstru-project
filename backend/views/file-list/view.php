<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FileList */

$this->title = $model->download_name;
$this->params['breadcrumbs'][] = ['label' => 'รายการฝากไฟล์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="file-list-view panel-shadow">


<h4><?= Html::encode($this->title) ?></h4>
	<div class="row clearfix">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card  card-primary ">
				<div class="card-body ribbon">

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ยกเลิก', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการลบข้อมูลนี้หรือไหม?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'download_name',
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
                'attribute'=>'type','format'=>'raw', 
                'value' => function($model, $key)
                {
                    if($model->type=='1'){
                        return 'File';
                    }else{
                        return 'Link Video Youtube';
                    }


                },
            ],
            // 'date_create',
            [   
                'attribute'=>'date_create','format'=>'raw', 
                'value' => function($model, $key)
                {
                    if(!empty($model->date_create)){
                        return DateThai($model->date_create);
                    }


                },
            ],
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</div>

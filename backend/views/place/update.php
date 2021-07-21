<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Place */


$this->title = Yii::t('app', 'แก้ไขข้อมูล: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูล'.titlePlace($model->type)), 'url' => ['index','type'=>$model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="place-update">
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-body ribbon">

                            <?= $this->render('_form', [
						'model' => $model,
					]) ?>



                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    $manage = 1; 
                    include('../../js/dropzone-4.3.0/page-uploadfile.php');
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>
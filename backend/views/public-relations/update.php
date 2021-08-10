<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */

$this->title = Yii::t('app', 'แก้ไขข้อมูล: {name}', [
    'name' => $model->topic,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ''.titleNews($model->type)), 'url' => ['index','type'=>$model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->topic, 'url' => ['view', 'id' => $model->id]];
?>
<div class="public-relations-update">

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
                    $table = 'PublicRelations';
                    include('../../js/dropzone-4.3.0/page-uploadfile.php');
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>

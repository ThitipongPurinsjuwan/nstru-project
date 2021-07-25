<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = Yii::t('app', 'แก้ไข Package: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Package ท่องเที่ยว'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="package-update">

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

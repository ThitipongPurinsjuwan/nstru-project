<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CoverBanner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cover Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cover-banner-view">

<h4><dt><?= Html::encode($this->title) ?></dt></h4>
    <!-- <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12"> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-body ribbon">

                            <p>
                                <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('app', 'ล้างค่า'), ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </p>

                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    'name',
                                    // 'image:ntext',
                                    'image_order',
                                ],
                            ]) ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-body ribbon">
                            <h6><b>ภาพประกอบ</b></h6>
                            <input type="hidden" class="get_key_images" value="<?=$model->image;?>">
                            <?php
                    $manage = 0; 
                    include('../../js/dropzone-4.3.0/page-uploadfile.php');
                    ?>
                        </div>
                    </div>
                   
                </div>

            <!-- </div>

        </div> -->
    </div>
</div>


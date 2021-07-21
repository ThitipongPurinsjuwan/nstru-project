<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OperatingZone;
/* @var $this yii\web\View */
/* @var $model app\models\OperatingKam */

$this->title = $model->kam;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'พื้นที่เขตทหาร'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<link rel="stylesheet" href="../../html-version/assets/css/style_operating.css"/>
<div class="operating-kam-view">

    <h4><?= Html::encode($this->title) ?></h4>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">พื้นที่เขตทหาร</h3>
                    <div class="card-options">
                        <a href="index.php?r=operating-kam/update&id=<?php echo $model->id; ?>">
                            <i class="fe fe-edit-3"></i>
                        </a>
                        <a href="index.php?r=operating-kam/delete&id=<?php echo $model->id; ?>" data-confirm="ต้องการยกเลิกข้อมูลองค์กรนี้ใช่หรือไม่?" data-method="post">
                            <i class="fe fe-trash-2"></i>
                        </a>
                        <a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <b>พื้นที่เขต. </b><?php echo $model->kam; ?><br>
                        <b>รายละเอียด. </b><?php echo $model->detail; ?><br>
                        <hr>
                        <div><b>ข้อมูลโซน/กองร้อย(Zone) ที่อยู่ภายใต้ <?php echo $model->kam; ?></b></div>
                        <div class="row">
                            <?php 
                            $zone = OperatingZone::find()->where('kam_id = "'.$model->id.'"')->All();
                            foreach ($zone as $z) {
                                ?>
                                <div class="col-md-6">
                                    <div class="card operating-kam-card">
                                        <div class="card-body operating-kam-height">
                                            <div>โซน/กองร้อย. <?php echo $z['zone_name']; ?></div>
                                            <div>รายละเอียด. <?php echo $z['detail']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
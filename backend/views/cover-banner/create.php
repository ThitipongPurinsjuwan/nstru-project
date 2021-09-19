<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CoverBanner */

$this->title = Yii::t('app', 'Create Cover Banner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cover Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cover-banner-create">

<h4><dt><?= Html::encode($this->title) ?></dt></h4>
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
        <div class="card card-success">
            <div class="card-body ribbon">
            <label for="">อัพโหลดรูปภาพ</label>
          <?php
          $manage = 1;
          $table = 'CoverBanner';
          include('../../js/dropzone-4.3.0/page-uploadfile.php');
          ?>
          </div>
      </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PublicRelations */

$type = $_GET['type'];
$this->title = Yii::t('app', 'เพิ่มข้อมูล');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '' . titleNews($type)), 'url' => ['index', 'type' => $type]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-relations-create">

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

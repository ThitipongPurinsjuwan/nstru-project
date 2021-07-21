<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Unit;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UndercoverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (isset($_GET['unitid'])) {
    $UnitName = Yii::$app->db->createCommand("SELECT * FROM unit WHERE unit_id = '".$_GET['unitid']."'")->queryOne();
    $this->title = 'ข้อมูลสายข่าวในหน่วยงาน : '.$UnitName['unit_name'];
}else{
    if ($_SESSION['user_role']=='2') {
        echo "<script>window.location='index.php?r=site/pages&view=alert_permission';</script>";
    }
    $this->title = 'ข้อมูลสายข่าว';
}


$this->params['breadcrumbs'][] = $this->title;
$day_now = date('Y-m-d');
?>

<style>
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: .5rem 0;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: .25rem;
    width: 100%;
}
.btn-group, .btn-group-vertical {
    position: relative;
    display: -ms-inline-flexbox;
    display: inline-flex;
    vertical-align: middle;
    width: 100%;
}
</style>


<div class="undercover-index">
<h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card card-success">
                <div class="card-body ribbon">
                    <p class="text-right">
                        <?php if (isset($_GET['unitid'])): ?>
                        <?php if ($_SESSION['user_role']==1): ?>
                        <?= Html::a('<i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> เพิ่มสายข่าวในหน่วย', ['create_undercover','unitid'=>$_GET['unitid'],'unitname'=>$UnitName['unit_name']], ['class' => 'btn btn-success']) ?>
                        <?php else: ?>
                        <?= Html::a('<i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> เพิ่มสายข่าวในหน่วย', ['create_undercover'], ['class' => 'btn btn-success']) ?>
                        <?php endif ?>
                        <?php else: ?>
                        <?= Html::a('<i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> เพิ่มสายข่าวในหน่วย', ['/unit'], ['class' => 'btn btn-success']) ?>
                        <?php endif ?>
                    </p>

                    <?php Pjax::begin(); ?>
                    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'undercover_number',
            'name',
            // 'unitid',
            [
                'attribute'=>'unitid',
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {
                    if($model->unitid != '000'){
                        $unit = Unit::find()->where(["unit_id" => $model->unitid ])->One(); //Yii::$app->db->createCommand("SELECT * FROM unit WHERE unit_id = '".$model->unitid."'")->queryOne();
                        return $unit['unit_name'];
                    } else {
                        return '-';
                    }
                },
            ],
            // 'images:ntext',
            'trust',
            [
                'attribute'=>'status',
                'label'=>'สถานะการปฏิบัติงาน',
                'format'=>'raw',
                'value' => function($model, $key, $index)
                {

                    if ($model->status=='1') {
                        return 'ปฏิบัติงาน';
                    }else{
                        return 'หยุดปฏิบัติงาน';
                    }


                },
            // 'visible' => $_SESSION['user_role']=='1' ? true : false
            ],
            //'email:email',
            //'address:ntext',
            //'phone',

            ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="fas fa-eye"></i>',
                        ['undercover/view', 'id' => $model->id],['title' => 'View','class'=>'btn btn-light']
                    );
                },
                'update' => function ($url, $model, $key) {

                    return Html::a('<i class="fas fa-pencil-alt"></i>',
                        ['undercover/update', 'id' => $model->id],['title' => 'Update','class'=>'btn btn-light']
// ['target'=>'_blank', 'title' => 'Update']
                    );
                },
                'delete' => function ($url, $model, $key) {
                    if($_SESSION['user_role']=='2' && $model->role=='2'){
                        return false;
                    // }else if($_SESSION['user_role']=='1' && $model->role=='1'){
                    //     return false;
                    }else{
                        return  Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], ['data' => ['confirm' => Yii::t('app', 'ต้องการยกเลิกผู้ใช้งานใช่หรือไม่?'),'method' => 'post','title'=>'Delete'],'class'=>'btn btn-light']);
                    }

                },

                ],
                'options'=> ['style'=>'width:20%;'],
            ],
        ],
    ]); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
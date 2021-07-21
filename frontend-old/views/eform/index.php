<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eforms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eform-index">

    <div class="row clearfix">
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body ribbon">
                    <div class="ribbon-box green">0</div>
                    <a href="#" class="my_sort_cut text-muted">
                        <i class="icon-layers"></i>
                        <span>Create Eform<br><br></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body ribbon">
                    <div class="ribbon-box orange">0</div>
                    <a href="#" class="my_sort_cut text-muted">
                        <i class="icon-user-following"></i>
                        <span>Eform<br><br></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body ribbon">
                    <div class="ribbon-box orange">0</div>
                    <a href="#" class="my_sort_cut text-muted">
                        <i class="icon-user-follow"></i>
                        <span>Eform<br><br></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="my_sort_cut text-muted">
                        <i class="icon-calendar"></i>
                        <span>Eform<br><br></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="my_sort_cut text-muted">
                        <i class="icon-calendar"></i>
                        <span>Eform<br><br></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="my_sort_cut text-muted">
                        <i class="icon-pie-chart"></i>
                        <span>Eform<br><br></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><dt>Eforms</dt></h2>
                </div>
                <div class="card-body ribbon">

                    <p>
                        <?= Html::a('Create Eform', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
                            'form_id',
                            [
                                'attribute'=>'form_element',
                                'format'=>'raw',
                                'value' => function($model, $key, $index)
                                {
                                    if(!empty($model->form_element))
                                    {

                                        $data_main = @json_decode($model->form_element,TRUE);
                                        $show = '';


                                        foreach ($data_main[0]['fieldGroup'] as $col){
                                           $show .= $col['templateOptions']['placeholder']." (".$col['key']."), ";
                                       }
                                       $string = rtrim($show, ", ");
                                       return  $string;

                                   }
                               },
                           ],
                           'version',
                           'detail',
                           [
                            'attribute'=>'active',
                            'format'=>'raw',
                            'value' => function($model, $key, $index)
                            {
                                if($model->active==1){
                                    return '<h5><i class="fa fa-square" data-toggle="tooltip" title="" data-original-title="Use" style="color: #28a745 !important;"></i></h5>';
                                }else{
                                    return '<h5><i class="fa fa-square" data-toggle="tooltip" title="" data-original-title="Not Use" style="color: #dc3545 !important;"></i></h5>';
                                }
                            },
                            'contentOptions' => ['style'=>'text-align:center;'],
                        ],
                        ['class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return false;
                            },
                            'delete' => function ($url, $model, $key) {
                                if($model->unit_id==$_SESSION['user_id']){
                                    return  Html::a('<span class="glyphicon glyphicon-trash"></span>', ['update_status_del', 'id' => $model->id], ['data' => ['confirm' => Yii::t('app', 'ต้องยกเลิกกระดานข่าวใช่หรือไม่?'),'method' => 'post','title'=>'Delete'],]);
                                }else{
                                    return false;
                                }
                            },
                        ]
                    ]
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
</div>

</div>

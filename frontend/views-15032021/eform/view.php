<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Eform */

$this->title = $model->detail;
$this->params['breadcrumbs'][] = ['label' => 'Eforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="eform-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'ต้องการลบข้อมูลใช่หรือไม่?',
            'method' => 'post',
        ],
    ]) ?>

    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body ribbon">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
            // 'id',
                            'form_id',
                            [
                                'attribute'=>'form_element',
                                'format'=>'raw',
                                'value' => function($model)
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
                            'value' => function($model)
                            {
                                if($model->active==1){
                                    return '<h5><i class="fa fa-square" data-toggle="tooltip" title="" data-original-title="Use" style="color: #28a745 !important;"></i></h5>';
                                }else{
                                    return '<h5><i class="fa fa-square" data-toggle="tooltip" title="" data-original-title="Not Use" style="color: #dc3545 !important;"></i></h5>';
                                }
                            },
                        ],
                        [
                            'attribute'=>'unit_id',
                            'format'=>'raw',
                            'value' => function($model)
                            {
                                if(!empty($model->unit_id)){
                                    $user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id = '".$model->unit_id."'")->queryOne();
                                    return $user['name'];
                                }
                            }
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>

</div>

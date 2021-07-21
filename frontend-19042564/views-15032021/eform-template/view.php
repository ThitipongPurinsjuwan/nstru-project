<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EformTemplate */

$this->title = $model->detail;
$this->params['breadcrumbs'][] = ['label' => 'Eform Templates', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => 'จัดการสิทธ์การใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="eform-template-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('ตัวอย่างแบบฟอร์ม', ['site/pages', 'view' => 'eform_template','form_id'=> $model->id], ['class' => 'btn btn-dark btn-sm','target'=>'_blank']) ?>
        <?= Html::a('แก้ไขแบบฟอร์ม', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ยกเลิก', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card card-success">
                <div class="card-body ribbon">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute'=>'type',
                                'format'=>'raw',
                                'value' => function($model, $key)
                                {
                                    if(!empty($model->type))
                                    {
                                        $row = Yii::$app->db->createCommand("SELECT * FROM `eform_template_type` WHERE id = '".$model->type."'")->queryOne();
                                        return $row['type'];
                                    }
                                },
                            ],
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
                                         $show .= $col['templateOptions']['placeholder']." (".$col['key'].")<br> ";
                                     }
                                     $string = rtrim($show, "<br> ");
                                     return  $string;

                                 }
                             },
                         ],
                         'version',
                         'detail',
                         [
                            'attribute'=>'unit_id',
                            'format'=>'raw',
                            'value' => function($model, $key)
                            {
                                if(!empty($model->unit_id) && $model->unit_id!='[]')
                                {
                                    return getList($model->unit_id,'unit','unit_id','unit_name');
                                }
                            },
                        ],
                        [
                            'attribute'=>'approve_type',
                            'format'=>'raw',
                            'value' => function($model, $key)
                            {
                                if(!empty($model->approve_type))
                                {
                                    $row = Yii::$app->db->createCommand("SELECT * FROM `approve_template` WHERE id = '".$model->approve_type."'")->queryOne();
                                    $data_step = @json_decode($row['step'],TRUE);
                                    $show_step = '';
                                    foreach ($data_step[0] as $k => $v) {
                                        $show_step .= "<b>$k :</b> $v<br>";
                                    }

                                    return "<p style='text-decoration:underline;'>".$row['approve_name']."</p>".$show_step;

                                }
                            },
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>


</div>

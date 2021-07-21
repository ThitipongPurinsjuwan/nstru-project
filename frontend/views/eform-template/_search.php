<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EformTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eform-template-search">

    <?php $form = ActiveForm::begin([
        // 'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">

        <div class="col-md-4">
            <?php 
            $eform_template = Yii::$app->db->createCommand("SELECT * FROM `eform_template_type`")->queryAll();
            foreach ($eform_template as $value) {
                $listeform_template[$value['id']] = $value['type'];
            }
            echo $form->field($model, 'type')->dropDownList($listeform_template, ['prompt' => 'เลือกประเภท Eform']);
            ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'version')->input('number',['maxlength' => true,'min'=>'1','max'=>'100']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'detail') ?>
        </div>

        <div class="form-group col-md-12">
            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('ล้างค่า', ['class' => 'btn btn-outline-secondary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
    $(document).on('click', '.card-options-collapse', function(){
        $('.card_hide').addClass('card-collapsed');
        var id = $(this).attr('id');
        $('#card'+id).removeClass('card-collapsed');
    });

</script>
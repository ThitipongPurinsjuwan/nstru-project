<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
date_default_timezone_set("Asia/Bangkok");
/* @var $this yii\web\View */
/* @var $model app\models\FileList */
/* @var $form yii\widgets\ActiveForm */
?>



<style>

.bt{
    float: right;
}
.text-top{
    margin-top: 10px ;
}

</style>

<?php //echo $model->type; ?>
<div class="file-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'download_name')->textInput(['maxlength' => true]) ?>

         
            <?= $form->field($model, 'file_name')->textInput(['maxlength' => true])->label(); ?>

            <?= $form->field($model, 'date_create')->hiddenInput(['maxlength' => true,'value'=>date('Y-m-d H:i:s')])->label(false); ?>
            <?= $form->field($model, 'type')->hiddenInput(['maxlength' => true,'value'=>"2"])->label(false); ?>

            <?php if (!$model->isNewRecord): ?>
                <input type="hidden" name="file_name_old" value="<?=$model->file_name;?>">
                 <input type="hidden" name="cover_img_old" value="<?=$model->cover_images;?>">
            <?php endif ?>
            <div class="form-group">
                <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            </div>
        </div>


    </div>
    <?php ActiveForm::end(); ?>

</div>


<script>
//     $(document).on("change", "#filelist-type", function(){
//         var type_check_input = $("input[name='FileList[type]']:checked").val();
//         if (type_check_input==2) {
//            $('.showinputfile').css('display', 'none');
//            $('.showinputtext').css('display', 'block');
//        }else{
//         $('.showinputfile').css('display', 'block');
//         $('.showinputtext').css('display', 'none');

//     }
// });
</script>
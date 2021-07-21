<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\UserRole;
use app\models\UserGroup;
use app\models\Unit;
use app\models\UndercoverTrust;


/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>


<style>
input[type="file"] {
    display: none;
}
</style>

<div class="undercover-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>


    <div class="row">
        <div class="col-md-4">
            <label for="">รูปภาพ</label>
            <div class="well">
                <?= Html::img($model->getPhotoViewer(),['style'=>'width:170px;height:170px;object-fit: cover;border-radius:10px;box-shadow: 2px 3px 7px #00000096;','class'=>'img-rounded','id'=>'imgOld',"onerror"=>"this.onerror=null;this.src='img/none.png';"]); ?>
                <img id="person_pic" style="height:170px;object-fit: cover;">
            </div><br>
            <label for="undercover-images" class="custom-file-upload">
                <i class="fe fe-upload"></i> เลือกไฟล์รูปภาพ
            </label>
            <?= $form->field($model, 'images')->fileInput(["onchange"=>"document.getElementById('person_pic').src = window.URL.createObjectURL(this.files[0]),document.getElementById('imgOld').style.display ='none'","accept"=>"image/*"])->label(false); ?>
            <div id="imgerror"></div>
            <?php if (!$model->isNewRecord): ?>
            <input type="hidden" name="file_name_old" value="<?=$model->images;?>" id="file_name_old">
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'undercover_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->input('email',['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
        </div>
        <div class="col-md-4">
        <?php
                $Organization =UndercoverTrust::find()->all();
                $trust =ArrayHelper::map($Organization,'id','trust');

                echo $form->field($model, 'trust')->dropDownList($trust,['prompt'=>'เลือกระดับความน่าเชื่อถือ'])->label();
                ?>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-4">
            <label for="">หน่วยงาน</label><br>
            <?php  if($model->unitid != '000'){
                        $unit = Unit::find()->where(["unit_id" => $model->unitid ])->One();
                        ?>
            <input type="text" class="form-control" value="<?php echo $unit['unit_name'];?>" disabled>
            <?php } else { ?>
            <input type="text" class="form-control" value="ไม่ได้สังกัดหน่วยงาน" disabled>
            <?php } ?>
        </div>
        <div class="col-md-4">
            <?php if ($_SESSION['user_role']=='2' && $model->id!=$_SESSION['user_id'] && $model->unitid == $_SESSION['unit_id']): ?>
            <?= $form->field($model, 'status')->radioList([0 => 'หยุดปฏิบัติงาน', 1 => 'ปฏิบัติงาน'])->label('สถานะการปฏิบัติงาน'); ?>
            <?php elseif ($_SESSION['user_role']=='1' && $model->id!=$_SESSION['user_id']): ?>
            <?= $form->field($model, 'status')->radioList([0 => 'หยุดปฏิบัติงาน', 1 => 'ปฏิบัติงาน'])->label('สถานะการปฏิบัติงาน'); ?>
            <?php else: ?>
            <?=$form->field($model, 'status')->hiddenInput(['value' => '1'])->label(false); ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <?#= $form->field($model, 'notification')->radioList([0 => 'ปิดการแจ้งเตือน', 1 => 'เปิดการแจ้งเตือน']); ?>
            <!-- <input type="checkbox" checked data-toggle="toggle" data-on="เปิดการแจ้งเตือน" data-off="ปิดการแจ้งเตือน" data-onstyle="success" data-offstyle="danger"> -->
        </div>

    </div>



    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success checkimg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>




<script>
$(document).ready(function() {
    $(".field-undercover-unitid").addClass('multiselect_div');
    $('.multiselect-filter').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200,
    });
});

$(document).on('click', '.checkimg', function() {
    <?php if (!$model->isNewRecord): ?>
    if (!$('#file_name_old').val()) {
        if (!$('#undercover-images').val()) {
            $("#imgerror").html('<span class="help-block">รูปภาพต้องไม่ว่างเปล่า</span>');
            return false;
        }
    }
    <?php else: ?>
    if (!$('#undercover-images').val()) {
        $("#imgerror").html('<span class="help-block">รูปภาพต้องไม่ว่างเปล่า</span>');
        return false;
    }
    <?php endif; ?>

});
</script>


<script>
$(document).ready(function() {
    $('#mytextbox').bind('keyup blur', function() {
        $(this).val($(this).val().replace(/[^A-Za-z0-9_-@ ]/g, ''))
    });

    $('#mytextbox1').bind('keyup blur', function() {
        $(this).val($(this).val().replace(/[^A-Za-z0-9_-@ ]/g, ''))
    });
});
</script>
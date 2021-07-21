<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\NotificationType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-md-6">
            <?php
			 $NotificationType = NotificationType::find()->all();
			$Notification=ArrayHelper::map($NotificationType,'id','type');

			echo $form->field($model, 'notification_type')->dropDownList($Notification,['prompt'=>'เลือกประเภทการแจ้งเตือน']) ;
			?>

            <?= $form->field($model, 'date_time')->textInput() ?>
            <?= $form->field($model, 'notification_by')->textInput() ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'content')->textArea(['maxlength' => true,'rows'=>'4']) ?>
        </div>

        <?php if ($_SESSION['user_role']==1) { ?>
        <div class="col-md-4">
            <?#= $form->field($model, 'user')->textInput(['maxlength' => true]) ?>
            <label for="">ผู้รับข่าว</label><br>
            <?php
            $villa =  Yii::$app->db->createCommand("SELECT * FROM users WHERE id IN (".$model->user.")")->queryAll();
                foreach ($villa as $row_villa){
            ?>

            <label for="animal"> - <?php echo $row_villa['name'];?></label><br>

            <?php  } ?>
        </div>

        <div class="col-md-4">
            <?#= $form->field($model, 'user_accept')->textInput(['maxlength' => true]) ?>
            <label for="">ผู้ที่รับทราบข่าวแล้ว</label><br>

            <?php
            $villa =  Yii::$app->db->createCommand("SELECT * FROM users WHERE id IN (".$model->user_accept.")")->queryAll();
                foreach ($villa as $row_villa){
            ?>

            <label for="animal"> - <?php echo $row_villa['name'];?></label><br>

            <?php  } ?>
        </div>

        <div class="col-md-4">
            <?#= $form->field($model, 'read_news')->textInput(['maxlength' => true]) ?>
            <label for="">ผู้ที่อ่านข่าวแล้ว</label><br>

            <?php
            $villa =  Yii::$app->db->createCommand("SELECT * FROM users WHERE id IN (".$model->read_news.")")->queryAll();
                foreach ($villa as $row_villa){
            ?>

            <label for="animal"> - <?php echo $row_villa['name'];?></label><br>

            <?php  } ?>
        </div>

        <?php } ?>


        <div class="col-md-12 text-center"><br><br><br>
            <input type="checkbox" class="form-check-input" id="select-user_accept" name="select-user_accept"
                value="<?php echo $_SESSION['user_id'] ;?>">
            <label for="user_accept">รับทราบข่าว</label>
        </div>


    </div>
    <?= $form->field($model, 'user_accept')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'read_news')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function() {

    <?php if((!$model->isNewRecord)):?>
    var dd = '<?php echo $model->user_accept;?>';
    var ddd = dd.replaceAll('"', "");
    var res = ddd.split("," );
    var villa = res;
    console.log(ddd);
    console.log(res);
    <?php else:?>
    var villa = [];
    <?php endif;?>

    $(document).on('click', 'input[name="select-user_accept"]', function() {

        var id = $(this).val();
        if ($(this).is(':checked')) {
            villa.push(id);
        } else {
            villa.splice($.inArray(id, villa), 1);
        }
        var use_array = villa.join('","');
        var use_array1 =('"' + use_array + '"');
        console.log(use_array);
        $("#notification-user_accept").val(use_array1);
    });

});
</script>


<script>
$(document).ready(function() {

    <?php if((!$model->isNewRecord)):?>
    var dd1 = '<?php echo $model->read_news;?>';
    var ddd1 = dd1.replaceAll('"', "");
    var res1 = ddd1.split("," );
    var villa1 = res1;
    <?php else:?>
    var villa1 = [];
    <?php endif;?>
    // $(document).on('click', 'input[name="select-read_news"]', function() {

        var id = <?php echo $_SESSION['user_id'] ;?>
        // if ($(this).is(':checked')) {
            villa1.push(id);
        // } else {
        //     villa1.splice($.inArray(id, villa1), 1);
        // }
        var use_array = villa1.join('","');
        var use_array1 =('"' + use_array + '"');
        console.log(use_array1);
        $("#notification-read_news").val(use_array1);
    // });


});
</script>
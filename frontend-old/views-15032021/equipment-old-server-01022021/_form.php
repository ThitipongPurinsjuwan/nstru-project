<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DropdownModel;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .label-main{
        display: none;
    }
    .label-success{
        width: 100%;
        background-color: #188E49;
        color: #FFFFFF;
        font-size: 16px;
        margin-top: 10px;
        padding: 4px 4px 4px 10px;
        border-radius: 5px;
    }
</style>
<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
        
    </div>

    <div class="row">
        <div class="col-md-3">
            <?php
            $equipment_type = Yii::$app->db->createCommand("SELECT id,name FROM equipment_type ORDER BY id ASC")->queryAll();
            foreach ($equipment_type as $value) {
                $listtype[$value['id']] = $value['name'];
            }
            echo $form->field($model, 'type')->dropDownList($listtype, ['prompt' => 'เลือกประเภทอุปกรณ์']);
            ?>
            <a href="#" data-toggle="modal" data-target="#addtype"><span class="tag tag-blue mb-3" style="cursor: pointer;">เพิ่มประเภทอุปกรณ์</span></a>     
        </div>
        <div class="col-md-3"><?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?></div>
    </div>


    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-2"><?= $form->field($model, 'pronoun')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'detail')->textArea(['maxlength' => true,'rows' => '4']) ?></div>
    </div>

    

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มประเภทอุปกรณ์</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label for="">รายการ</label>
                <input type="text" class="form-control" id="name">
                <br>
                <label for="">รายละเอียด</label>
                <input type="text" class="form-control" id="detail">
            </div>
            <div class="col-md-12">
                <div class="label-main label-success">บันทึกข้อมูลสำเร็จ!!</div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" id="add-equipment-type" class="btn btn-primary">บันทึก</button>
    </div>
</div>
</div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#add-equipment-type', function(){
            var name = $('#name').val();
            var detail = $('#detail').val();
            $.ajax({
                url:"index.php?r=site/json_add_equipment&type=type",
                method:"GET",
                dataType:"json",
                data:{ name: name,detail:detail},
                contentType: "application/json; charset=utf-8",
                success: function(){
                    if (status == 1) {
                        console.log('false');
                    }else{
                        console.log('success');
                        $(".label-main").css("display", "block");
                        setTimeout(function(){
                            $(".label-main").css("display", "none");
                            location.reload();
                        },2000);
                        
                    }
                    
                }
            });
        });
    });
</script>


<?php ActiveForm::end(); ?>

</div>

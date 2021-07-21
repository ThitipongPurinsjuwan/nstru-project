<?php

use yii\helpers\Html;

use app\models\EformHeader;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EformTemplate */

$this->title = 'เปลี่ยนแปลง Form Template: ' . $model->detail;
$this->params['breadcrumbs'][] = ['label' => 'Eform Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'ตัวอย่างฟอร์ม '.$model->detail, 'url' => ['site/pages','view'=>'eform_template', 'form_id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไขฟอร์ม';
?>
<!-- <link rel="stylesheet" href="../../html-version/assets/plugins/bootstrap/css/bootstrap.min.css"/> -->
<link rel="stylesheet" href="../../html-version/assets/plugins/summernote/dist/summernote.css"/>
<!-- Core css -->
<!-- <link rel="stylesheet" href="../../html-version/assets/css/main.css"/> -->
<!-- <link rel="stylesheet" href="../../html-version/assets/css/theme1.css"/> -->

<style>
     .help-block{
        color: #dc3545;
        font-weight: 600;
    }
    .img-rounded{
        border: 1px solid #777777;
        padding: 10px;
        margin-bottom: 10px;
    }
    .img-new-upload{
        width: 218px;
        border: 0px solid #777777;
        margin-bottom: 10px;
    }
    .button-wrapper {
        position: relative;
        width: 100%;
        text-align: center;
    }
    .button-wrapper span.label {
        position: relative;
        z-index: 0;
        display: inline-block;
        width: 100%;
        background: #1d4d80;
        cursor: pointer;
        color: #fff;
        padding: 10px 0;
        text-transform:uppercase;
        font-size:13px;
    }
    #upload {
        display: inline-block;
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 50px;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }
    .btn-purchase-payment{
        margin-left: 10px;
        margin-top: 20px;
    }
</style>

<div class="btn-group" style="float: right !important;">



</div>

<div class="eform-template-update">

<h4><?= Html::encode($this->title) ?></h4>


	<div class="row clearfix">
        
		<div class="col-md-8">
			<div class="card">
                <div class="card-header bg-green text-white">
                    <dt>ตั้งค่าแบบฟอร์ม - ข้อมูลทั่วไป</dt>
                </div>
				<div class="card-body ribbon">
                
                    <?php $form = ActiveForm::begin(); ?>

                    <div class="row">
                        <div class="col-md-9">

                            <?= $form->field($model, 'header_record')->textArea(['maxlength' => true, 'class' => 'summernote','rows'=>'10',])->label();
                            # 'style'=>'visibility: hidden;height: 0px !important;'
                            ?>
                            <?= $form->field($model, 'footer_record')->textArea(['maxlength' => true, 'class' => 'summernote', 'rows'=>'10',])->label();
                            # 'style'=>'visibility: hidden;height: 0px !important;'
                            ?>
                            <?= $form->field($model, 'header_all')->textArea(['maxlength' => true, 'class' => 'summernote', 'rows'=>'10',])->label();
                            # 'style'=>'visibility: hidden;height: 0px !important;'
                            ?>
                            <?= $form->field($model, 'footer_all')->textArea(['maxlength' => true, 'class' => 'summernote', 'rows'=>'10',])->label();
                            # 'style'=>'visibility: hidden;height: 0px !important;'
                            ?>

                            <div id="data_guide_report_record" style="visibility: hidden;height: 0px;">
                                <? #=$model->guide_report_record;?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row ">
                                <div class="col-md-12 text-center">
                                    <label for=""><dt>รูปประจำแบบฟอร์ม</dt></label>
                                </div>
                                <?php //  if ($model->images = '') { ?>   
                                <div class="col-md-12 mt-2 text-center">
                                    <?= Html::img($model->getPhotoViewer(),['style'=>'width:40%;','class'=>'img-rounded','id'=>'imgOld']); ?>
                                    <div class="row text-center">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="button-wrapper text-center">
                                                <img id="person_pic" class="img-new-upload">
                                                <span class="label">
                                                <i class="fe fe-upload"></i> เลือกไฟล์รูปภาพ
                                                </span>
                                                <?= $form->field($model, 'images')->fileInput(["onchange"=>"document.getElementById('person_pic').src = window.URL.createObjectURL(this.files[0]),document.getElementById('imgOld').style.display ='none'","accept"=>"image/*",'id'=>'upload','class'=>'upload-box'])->label(false); ?>
                                                <?php if (!$model->isNewRecord): ?>
                                                    <input type="hidden" name="file_name_old" value="<?=$model->images;?>" id="file_name_old">
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div><br><br><br>
                                <div class="col-md-10">
                                    <label for=""><dt>ตำแหน่งการแสดงรูปภาพ</dt></label>
                                    <?= $form->field($model, 'position_images')->radioList([1 => 'แสดงด้านซ้าย' , 2 => 'แสดงตรงกลาง', 3 => 'แสดงด้านขวา',0 => 'ไม่แสดงรูปภาพ'])->label(false); ?>
                                    <!-- <label class="radio-inline"><input type="radio" name="optradio" > แสดงด้านซ้าย   </label><br>
                                    <label class="radio-inline"><input type="radio" name="optradio"> แสดงตรงกลาง</label><br>
                                    <label class="radio-inline"><input type="radio" name="optradio"> แสดงด้านขวา</label>บนหัวกระดาษรายงาน -->

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-primary savesort">บันทึก</button>
                            <button type="reset" class="btn btn-lg btn-danger clear_data">ยกเลิก</button>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>	

				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="card">
                <div class="card-header bg-green text-white">
                    <dt>ออกแบบรายงาน</dt>
                </div>
				<div class="card-body">
                
				</div>
			</div>
            <div class="card">
                <div class="card-header bg-green text-white">
                    <dt>รายละเอียดข้อมูล</dt>
                </div>
				<div class="card-body">
					----
				</div>
			</div>
		</div>
	</div>

</div>
<!-- <script src="../../html-version/assets/bundles/lib.vendor.bundle.js"></script>

<script src="../../html-version/assets/bundles/summernote.bundle.js"></script>

<script src="../../html-version/assets/js/core.js"></script> -->
<script src="../../html-version/theme2/assets/js/page/summernote.js"></script>


<!-- <script type="text/javascript" src="../../ckeditor/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor');
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script> -->

<!-- <script>
$(document).ready(function() {
            tinymce.init({
            selector:'#editor',
            menubar: false,
            statusbar: false,
            plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
            skin: 'bootstrap',
            toolbar_drawer: 'floating',
            min_height: 200,           
            autoresize_bottom_margin: 16,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor="#80bdff"
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow="",
                    editor.getContainer().style.borderColor=""
                });
            }
        });
});
</script> -->
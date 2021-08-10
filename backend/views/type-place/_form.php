<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TypePlace */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
input[type="file"] {
    display: none;
}
</style>
<div class="type-place-form">

      <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                 <?php $key_images = (!$model->isNewRecord) ? $model->key_images : time();?>
        <?= $form->field($model, 'key_images')->hiddenInput(['maxlength' => true,'value'=>$key_images, 'class'=>'get_key_images'])->label(false);?>

        </div>
        
        <div class="col-md-6">

            <?= $form->field($model, 'name_eng')->textInput(['maxlength' => true,'class'=>'form-control characterEngOnly']) ?>

        </div>

      

        <div class="col-md-6">

            <label for="">Icon Marker บนแผนที่ (ความกว้าง x ความยาว ควรมีขนาดเท่ากัน)</label>
            <div class="well">
                <?= Html::img($model->getPhotoViewer(),['style'=>'width:170px;height:170px;object-fit: cover;border-radius:10px;box-shadow: 2px 3px 7px #00000096;','class'=>'img-rounded','id'=>'imgOld',"onerror"=>"this.onerror=null;this.src='img/none.png';"]); ?>
                <img id="person_pic" style="height:170px;object-fit: cover;">
            </div><br>
            <label for="typeplace-images" class="custom-file-upload">
                <i class="fe fe-upload"></i> เลือกไฟล์รูปภาพ
            </label>
            <?= $form->field($model, 'images')->fileInput(["onchange"=>"document.getElementById('person_pic').src = window.URL.createObjectURL(this.files[0]),document.getElementById('imgOld').style.display ='none'","accept"=>"image/*"])->label(false); ?>
            <div id="imgerror"></div>
            <?php if (!$model->isNewRecord): ?>
            <input type="hidden" name="file_name_old" value="<?=$model->images;?>" id="file_name_old">
            <?php endif ?>
        </div>

        
		<div class="col-md-12">
			<label for="">เลือกไอคอนเมนู</label>
			<div id="target"></div>
			<?= $form->field($model, 'm_icon')->hiddenInput(['maxlength' => true,'id'=>'showdata'])->label(false); ?>
		</div>

        <?= $form->field($model, 'date_create')->hiddenInput(['maxlength' => true, 'value'=>date("Y-m-d H:i:s")])->label(false); ?>

        <?= $form->field($model, 'user_create')->hiddenInput(['value'=>$_SESSION['user_id']])->label(false); ?>
        <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false); ?>

        <div class="form-group text-center col-md-12 mt-3">
            <?= Html::submitButton(Yii::t('app', 'บันทึกข้อมูล'), ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<link rel="stylesheet" href="../../js/bootstrap-iconpicker-1.10.0/icon-fonts/elusive-icons-2.0.0/css/elusive-icons.min.css"/>
<link rel="stylesheet" href="../../js/bootstrap-iconpicker-1.10.0/icon-fonts/map-icons-2.1.0/css/map-icons.min.css"/>
<link rel="stylesheet" href="../../js/bootstrap-iconpicker-1.10.0/dist/css/bootstrap-iconpicker.css"/>
<script type="text/javascript" src="../../js/bootstrap-iconpicker-1.10.0/dist/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap-iconpicker-1.10.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap-iconpicker-1.10.0/dist/js/bootstrap-iconpicker.bundle.min.js"></script>

<script type="text/javascript">

	(function($) {
		$('#target').iconpicker({
			align:'left',
			arrowClass: 'btn-primary',
			arrowPrevIconClass: 'fas fa-angle-left',
			arrowNextIconClass: 'fas fa-angle-right',
			cols: 8,
			footer: true,
			header: true,
			icon: '<?=$model->m_icon;?>',
			iconset: 'fontawesome5',
			labelHeader: '{0} of {1} pages',
			labelFooter: '{0} - {1} of {2} icons',
			placement: 'bottom',
			rows: 6,
			search: true,
			searchText: 'Search',
			selectedClass: 'btn-warning',
			unselectedClass: ''
		}
		).on('change', function(e) {
			$("#showdata").val(e.icon);
		});

	})(jQuery);

</script>

<script>

var _URL = window.URL || window.webkitURL;
var file_marker, img_marker;
$(document).on('change', '#typeplace-images', function() {
if ((file_marker = this.files[0])) {
		img_marker = new Image();
		var objectUrl = _URL.createObjectURL(file_marker);
		img_marker.onload = function () {
			if (this.width!=this.height) {
				alert('ความกว้าง x ความยาว ควรมีขนาดเท่ากัน');
				$('#typeplace-images').val('');
				$('#person_pic').attr('src', 'img/none.png');
			}else{
				
			}
			_URL.revokeObjectURL(objectUrl);
		};
		img_marker.src = objectUrl;
	}
});

$(document).on('click', '.checkimg', function() {
    <?php if (!$model->isNewRecord): ?>
        if (!$('#file_name_old').val()) {
            if (!$('#typeplace-images').val()) {
                $("#imgerror").html('<span class="help-block">รูปภาพต้องไม่ว่างเปล่า</span>');
                return false;
            }
        } <?php else: ?>
        if (!$('#typeplace-images').val()) {
            $("#imgerror").html('<span class="help-block">รูปภาพต้องไม่ว่างเปล่า</span>');
            return false;
        }<?php endif; ?>

});
</script>
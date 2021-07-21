<?php

use yii\helpers\Html;

use app\models\EformHeader;

/* @var $this yii\web\View */
/* @var $model app\models\EformTemplate */

$this->title = 'เปลี่ยนแปลง Form Template: ' . $model->detail;
$this->params['breadcrumbs'][] = ['label' => 'Eform Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'ตัวอย่างฟอร์ม '.$model->detail, 'url' => ['site/pages','view'=>'eform_template', 'form_id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไขฟอร์ม';
?>
<div class="btn-group" style="float: right !important;">



</div>

<div class="eform-template-update">

<h4><?= Html::encode($this->title) ?></h4>


	<div class="row clearfix">
        
		<div class="col-md-10">
			<div class="card">
                <div class="card-header bg-green text-white">
                    <dt>ตั้งค่าแบบฟอร์ม - ข้อมูลทั่วไป</dt>
                </div>
				<div class="card-body ribbon">
                
					<?= $this->render('_form', [
						'model' => $model,
					]) ?>
				</div>
			</div>
		</div>
		<div class="col-2">
			<div class="card">
                <div class="card-header bg-green text-white">
                    <dt>ออกแบบรายงาน</dt>
                </div>
				<div class="card-body">
                <h5> Header - Footer</h5>
                <li><a href="index.php?r=eform-template/update-header&id=<?=$model->id?>" >ออกแบบรายงาน [header - footer]</a></li>
                <!-- <span class="badge bg-primary">ออกแบบรายงาน [ภาพรวม]</span> -->
                <hr>
                <h5>รายงาน [ภาพรวม]</h5>
                <li><a href="index.php?r=eform-template/report-design-sum&id=<?=$model->id?>" >ออกแบบรายงาน [ภาพรวม]</a></li>
                <hr>

                

                <!-- Button trigger modal 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                แก้ไข
                </button>-->

                <!-- <strong>ออกแบบรายงาน [ภาพรวม]</strong> <br> -->
                <?
                    //echo $model->header_all;
                ?>
               <!--  <li><a href="index.php?r=eform-header/<?=($count_header==1) ? 'update' : ''?>&type=header">ออกแบบ Header</a></li>
                <li><a href="index.php?r=eform-template/report-design-sum&id=<?=$model->id?>" >ออกแบบรายงาน</a></li>
                <li><a href="index.php?r=eform-header/update&id=<?=$model->id?>&type=footer">ออกแบบ Footer</a></li>
                -->
                
                <!-- <span class="badge bg-primary">ออกแบบรายงาน [รายการเดียว]</span> -->
                <h5>รายงาน [รายการเดียว]</h5>
                <li><a href="index.php?r=eform-template/report-design-record&id=<?=$model->id?>" >ออกแบบรายงาน [รายการเดียว]</a> </li> 

				</div>
			</div>
            <div class="card">
                <div class="card-header bg-green text-white">
                    <dt><i class="fa fa-gears" data-toggle="tooltip" title="" data-original-title="fa fa-gears"></i> เปลี่ยนแปลง Form Template</dt>
                </div>
				<div class="card-body">
                <?php
                if($model->images!=''){
                    $img_article = '../../images/template_files/'.$model->images;
                }else{
                    $img_article = '../../images/template_files/none.png';
                }
                ?>
                    <img src = "<?=$img_article;?>" width="150px;" /> 
                    <br> <br>
                    <a href="index.php?r=eform-template/update-header&id=<?=$model->id?>" >แก้ไข</a>
					
				</div>
			</div>
		</div>
	</div>

</div>

<?php
use yii\helpers\Html;
use app\models\EformTemplate;

$type = Yii::$app->db->createCommand("SELECT * FROM `eform_template_type` WHERE id = '".$model['type']."'")->queryOne();
$eform = Yii::$app->db->createCommand("SELECT * FROM `eform` WHERE  form_id = '".$model['id']."' AND unit_id = '".$_SESSION['unit_id']."' ORDER BY active DESC")->queryAll();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .card-height{
        height: 200px;
        overflow: scroll;
    }
    .eform-not-data{
        width: 100%;
        padding: 5px;
        margin-top: 10px;
        background-color: #D1D3D4;
        color: #000000;
        text-align: center;
        /*font-weight: 300;*/
    }
    .text-center{
        text-align: center !important;
        display: block !important;
    }
</style>

<br>
<h6><b><?=$model['detail'];?></b></h6>
<div class="card">
	<div class="card-body card-height">
		<div class="row">
			<?php
			$count = Yii::$app->db->createCommand("SELECT COUNT(*) AS numrows FROM `eform` WHERE  form_id = '".$model['id']."' AND unit_id = '".$_SESSION['unit_id']."' ORDER BY active DESC")->queryOne();
			if ($count['numrows']==0) {
				?>

				<div class="col-md-12">
					<div class="eform-not-data">ไม่มีข้อมูล</div>
				</div>

				<?php
			}

			$i=1;
			foreach ($eform as $ef) {
				?>
				<div class="col-md-6 font-weight-normal">
					<?php echo $i.'. '.$ef['detail'];?>
				</div>
				<div class="col-md-3">
					<?php echo 'version. '.$ef['version'];?>
				</div>
				<div class="col-md-3">
					<?php if($ef['active']==1){?>
						<a onclick="window.open('index.php?r=site/pages&view=eform_information&form_id=<?php echo $ef['form_id']?>');">
							<div class="tag tag-blue mb-1 text-center" style="cursor: pointer;width: 100%;">ตัวอย่างฟอร์ม</div>
						</a>
					<?php }else{ ?> 
						<div class="tag tag-default mb-1 text-center" style="cursor: pointer;width: 100%;">ตัวอย่างฟอร์ม</div>
					<?php } ?>
				</div>
				<div class="col-6"><small class="text-muted" style="padding-left: 1em;">จำนวนข้อมูลที่บันทึกผ่านฟอร์ม :</small></div>
				<div class="col-3"><strong>
					<?php $eform_data = Yii::$app->db->createCommand("SELECT COUNT(*)  FROM `eform_data` WHERE data_json LIKE '%\"form_id\":\"".$ef['form_id']."\",\"eform_id\":\"".$ef['id']."\",\"eform_version\":\"".$ef['version']."\"%'")->queryScalar();
					echo number_format($eform_data);
					?>
				</strong></div>
				<div class="col-3">
					<a onclick="window.open('index.php?r=eform-data/index&form_id=<?php echo $ef['form_id']?>&eversion=<?php echo $ef['version']?>&eform_id=<?php echo $ef['id']?>');" style="text-align: center !important;">
						<div class="tag tag-warning mb-1 text-center" style="cursor: pointer;width: 100%;color: #000;font-weight: bold;">รายการข้อมูลทั้งหมด</div>
					</a>
                    <a  onclick="window.open('index.php?r=eform/create');" style="text-align: center !important;">
						<div class="tag tag-blue mb-1 text-center" style="cursor: pointer;width: 100%;color: #FFFFFF;font-weight: bold;">ปรับปรุงแบบฟอร์ม</div>
					</a>
				</div>
				<div class="col-12"><hr></div>
				
				<?php $i++; } ?>
			</div>
		</div>
	</div>

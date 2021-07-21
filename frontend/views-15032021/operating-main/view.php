<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OperatingZone;
use app\models\OperatingArea;
use app\models\OperatingMain;
use app\models\Provinces;
use app\models\Amphures;
use app\models\Districts;
use app\models\Organization;
use app\models\OrganizationType;
use app\models\EformData;
/* @var $this yii\web\View */
/* @var $model app\models\OperatingMain */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$zone = OperatingZone::find()->where('id = "'.$model->zone_id.'"')->One();
$area = OperatingArea::find()->where('area_id ='.$model->area_id)->One();
$provices = Provinces::find()->where('code ='.$model->province)->One();
$amphures = Amphures::find()->where('id ='.$model->amphure)->One();
$districts = Districts::find()->where('id ='.$model->district)->One();

// ORG
$organization = Organization::find()->where('id ='.$model->organization_id)->One();
$organizationType = OrganizationType::find()->where('id ='.$organization->type)->One();
$provices_org = Provinces::find()->where('code ='.$organization->province)->One();
$amphures_org = Amphures::find()->where('id ='.$organization->amphure)->One();
$districts_org = Districts::find()->where('id ='.$organization->district)->One();

?>
<style>
	.map-container {
		width: 100%;
		margin: 50px 0 3000px;
	}
	.map-container iframe{
		width: 100%;
		display: block;
		pointer-events: none;
		position: relative; /* IE needs a position other than static */
	}
	.map-container iframe.clicked{
		pointer-events: auto;
	}
</style>
<link rel="stylesheet" href="../../html-version/assets/css/style_operating.css"/>
<div class="operating-main-view">

	<div class="row clearfix">
		<div class="col-md-9">
			<div class="card card-info">
				<div class="card-header">
					<h3 class="card-title">ข้อมูลพื้นที่ปฏิบัติการ</h3>
					<div class="card-options">
						<a href="index.php?r=operating-main/update&id=<?php echo $model->id; ?>">
							<i class="fe fe-edit-3"></i>
						</a>
						<a href="index.php?r=operating-main/delete&id=<?php echo $model->id; ?>" data-confirm="ต้องการยกเลิกข้อมูลองค์กรนี้ใช่หรือไม่?" data-method="post">
							<i class="fe fe-trash-2"></i>
						</a>
						<a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body">
						<div class="timeline_item">
							<small class="float-right text-right">วันที่บันทึก <?php echo DateThai($model->date_create);?></small>
							<div class="operating-view-name"><?php echo $model->name;?></div>
							<div class="operating-view-zone">
								<b class="operating-view-title">โซน(Zone) : </b>
								<?php echo $zone['zone_name'];?>
							</div>
							<div class="operating-view-area">
								<b class="operating-view-title">พื้นที่(Area) : </b>
								<?php echo $area['area_name'];?>
							</div>
							<div class="operating-view-area">
								<b class="operating-view-title">จังหวัด.</b>
								<?php echo $provices['name_th'];?>
								<b class="operating-view-title">อำเภอ.</b>
								<?php echo $amphures['name_th'];?>
								<b class="operating-view-title">ตำบล.</b>
								<?php echo $districts['name_th'];?>
							</div>
							<div class="operating-view-map map-container">
								<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1AxJEHXxmow-4mredyVnApKZSpUFtNtyD" width="1100" height="750" frameborder="0" scrolling="no" allowfullscreen="" marginheight="0" marginwidth="0"></iframe>
							</div>
							<div class="operating-view-title">รายละเอียด</div>
							<div class="operating-view-detail"><?php echo $model->detail;?></div>
							<div class="operating-view-title">หมายเหตุ</div>
							<div class="operating-view-remark"><?php echo $model->remark;?></div>
							<div>
								
							</div>                                
						</div>

					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card card-default">
					<div class="card-header">
						<h3 class="card-title"><i class="fe fe-home"></i> องค์กรที่รับผิดชอบ</h3>
						<div class="card-options">
							<a href="index.php?r=organization/view&id=<?php echo  $organization['id'];?>">
								<i class="fe fe-file-text operating-view-org"></i>
							</a>
							<a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen">
								<i class="fe fe-maximize"></i>
							</a>
						</div>
					</div>
					<div class="card-body">
						<div><h5> <?php echo $organization['name']; ?></h5></div>
						<div>รายละเอียด. <?php echo $organization['detail']; ?></div>
						<div>
							ประเภท. 
							<?php echo $organizationType['type']; ?>
							<div class="operating-view-tag-type" style="background-color: <?php echo $organizationType['marker_color'];?>!important;"></div>
						</div>
						<div>สถานที่ตั้ง. <?php echo $organization['address']; ?></div>
						<div>หมู่. <?php echo $organization['village']; ?></div>
						<div>
							จังหวัด. <?php echo $provices_org['name_th'];?>
							อำเภอ. <?php echo $amphures_org['name_th']; ?>
							ตำบล. <?php echo $districts_org['name_th']; ?>
						</div>
					</div>
				</div>

				<div class="card card-default operating-in-org-box">
					<div class="card-header">
						<h3 class="card-title"><i class="fe fe-users"></i> ข้อมูล ผกร. ภายในองค์กร</h3>
						<div class="card-options">
							<a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<?php 
									$org_person = EformData::find()->where('eform_id = 21')->All();
									foreach ($org_person as $org) {

										$data = @json_decode($org['data_json'],TRUE);
										$val_eform = $data[0];
										$op = $val_eform['data_org'];

										if (in_array($model->organization_id,$op)){

											?>
											<div class="operating-in-org">
												<div class="org-view-name">
													ชื่อ-นามสกุล : <?php echo $val_eform['name'];?>
													<a href="index.php?r=eform-data/view-person&id=<?php echo $org['id']; ?>">
														<div class="org-view-person">
															<i class="fe fe-file-text"></i>
														</div>
													</a>
												</div>
												<div>เพศ : <?php echo $val_eform['gender'];?></div>
												<div>วันเดือนปีเกิด : <?php echo DateThai($val_eform['birthday']);?></div>
												<div>หมายเลขบัตรประชาชน : <?php echo $val_eform['idcard']; ?></div>
											</div>
											<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<script>
			$('.map-container')
			.click(function(){
				$(this).find('iframe').addClass('clicked')})
			.mouseleave(function(){
				$(this).find('iframe').removeClass('clicked')});
			</script>
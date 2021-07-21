<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OperatingZone;
use app\models\OperatingArea;
use app\models\OperatingMain;
use app\models\Provinces;
use app\models\Amphures;
use app\models\Districts;
use app\models\EformData;
/* @var $this yii\web\View */
/* @var $model app\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลองค์กร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<link rel="stylesheet" href="../../html-version/assets/css/style_organization
.css"/>
<div class="organization-view">

	<h4><?= Html::encode($this->title); ?></h4>
	<div class="row clearfix">
		<div class="col-xl-7 col-lg-7 col-md-7">
			<div class="card card-success">
				<div class="card-header">
					<h3 class="card-title"><i class="fe fe-home"></i> รายละเอียดข้อมูลองค์กร</h3>
					<div class="card-options">
						<a href="index.php?r=organization/update&id=<?php echo $model->id; ?>">
							<i class="fe fe-edit-3"></i>
						</a>
						<a href="index.php?r=organization/delete&id=<?php echo $model->id; ?>" data-confirm="ต้องการยกเลิกข้อมูลองค์กรนี้ใช่หรือไม่?" data-method="post">
							<i class="fe fe-trash-2"></i>
						</a>
						<a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i>
						</a>
					</div>
				</div>
				<div class="card-body organization-card-height">

					<?= DetailView::widget([
						'model' => $model,
						'attributes' => [
							//'id',
							'name',
							[
                                'format'=>'raw',
                                'attribute'=>'images',
                                'value' => function($model,$index)
                                {
                                    if(!empty($model->images))
                                    {
                                        return Html::img($model->photoViewer,['class'=>'img-thumbnail','style'=>'width:200px;', "onerror"=>"this.onerror=null;this.src='img/none.png';"]);
                                    }else{
                                        return Html::img('@web/img/none.png',['class'=>'img-thumbnail','style'=>'width:200px;']);
                                    }
                                },
                            ],
							[
								'attribute'=>'type',
								'format'=>'raw',    
								'value' => function($model, $key)
								{
									if(!empty($model->type))
									{
										$type = Yii::$app->db->createCommand("SELECT * FROM organization_type WHERE id = '".$model->type."'")->queryOne();
										return $type['type'];
									}
								},
							],
							'detail:ntext',
							
							'address:ntext',
							'village',
							[
								'attribute'=>'district',
								'format'=>'raw',
								'value' => function($model)
								{
									if(!empty($model->district))
									{
										$unit = Yii::$app->db->createCommand("SELECT * FROM districts WHERE id = '".$model->district."'")->queryOne();
										return $unit['name_th'];
									}
								},
							],
							[
								'attribute'=>'amphure',
								'format'=>'raw',
								'value' => function($model)
								{
									if(!empty($model->amphure))
									{
										$unit = Yii::$app->db->createCommand("SELECT * FROM amphures WHERE id = '".$model->amphure."'")->queryOne();
										return $unit['name_th'];
									}
								},
							],
							[
								'attribute'=>'province',
								'format'=>'raw',
								'value' => function($model)
								{
									if(!empty($model->province))
									{
										$unit = Yii::$app->db->createCommand("SELECT * FROM provinces WHERE id = '".$model->province."'")->queryOne();
										return $unit['name_th'];
									}
								},
							],
							
							[
								'attribute'=>'unit_create',
								'format'=>'raw',
								'value' => function($model)
								{
									if($model->unit_create != '000'){
										$unit = Yii::$app->db->createCommand("SELECT * FROM unit WHERE unit_id = '".$model->unit_create."'")->queryOne();
										return $unit['unit_name'];
									} else {
										return '-';
									}
								},
							],
							[
								'attribute'=>'user_create',
								'format'=>'raw',
								'value' => function($model)
								{
									if(!empty($model->user_create))
									{
										$users = Yii::$app->db->createCommand("SELECT * FROM users WHERE id = '".$model->user_create."'")->queryOne();
										return $users['name'];
									}
								},
							],
							'coor_lat',
							'coor_lon',
						],
					]) ?>

				</div>
			</div>
		</div>



		<div class="col-xl-5 col-lg-5 col-md-5">
			<div class="card card-success">
				<div class="card-header">
					<h3 class="card-title"><i class="fe fe-list"></i> ทำเนียบภายในองค์กร</h3>
					<div class="card-options">
						<a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body organization-card-height" style="overflow: auto; max-height: 495px;">
						<link rel="stylesheet" href="../../html-version/assets/css/bootstrap-treefy.css">
						<table class="table table-striped" id="table_grid_org">
							<tbody id="grid_org">
							</tbody>
						</table>
						<script src="../../js/bootstrap-treefy.js"></script> 
					</div>
				</div>
			</div>

			<div class="col-xl-12 col-lg-12">
				<div class="card card-success">
					<div class="card-header">
						<div class="card-title">กดปุ่ม Control + เลื่อนทิศทางของเมาส์เพื่อ ย่อ/ขยาย</div>
						<div class="card-options">
							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body">
						<div style="width:100%;" id="tree" class="svg-container"> </div>
					</div>
				</div>
				<?php include ('js-org-view.php'); ?>
			</div>

			<div class="col-xl-12 col-lg-12">
				<div class="card card-success">
					<div class="card-header">
						<h3 class="card-title"><dt>แผนที่แสดงพิกัด (ละติจูด , ลองจิจูด)</dt></h3>
						<div class="card-options">
							<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body">
						<link
						data-require="leaflet@0.7.3"
						data-semver="0.7.3"
						rel="stylesheet"
						href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css"
						/>
						<script
						data-require="leaflet@0.7.3"
						data-semver="0.7.3"
						src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"
						></script>


						<div id="mapshow" style="width: 100%; height: 500px;"></div>    
						<script>

							var mymap = L.map('mapshow').setView([<?=$model->coor_lat;?>, <?=$model->coor_lon;?>], 10);

							L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
								maxZoom: 15,
								attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
								'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
								'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
								id: 'mapbox/streets-v11',
								tileSize: 512,
								zoomOffset: -1
							}).addTo(mymap);

							L.marker([<?=$model->coor_lat;?>, <?=$model->coor_lon;?>],{
								icon: new L.Icon({
									iconSize: [50, 50],
									iconAnchor: [25, 45],
									shadowAnchor: [4, 62],
									iconUrl: '../../leaflet-0.7.3/images/marker-icon.png',
								})
							}).addTo(mymap)
							.bindPopup("<b>พิกัด (<?=$model->coor_lat;?>, <?=$model->coor_lon;?>)</b>").openPopup();

							var popup = L.popup();
						</script>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6">
				<div class="card card-success">
					<div class="card-header">
						<div class="card-title"><i class="fe fe-flag"></i> พื้นที่ปฏิบัติการที่รับผิดชอบ</div>
						<div class="card-options">
							<?php $main = OperatingMain::find()->where('organization_id = "'.$_GET['id'].'"')->All(); ?>
							จำนวน <?php echo count($main); ?> รายการ
							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body organization-card-height">
						<div class="row">
							<div class="col-md-12">
								<?php 
								foreach ($main as $m) {
									$zone = OperatingZone::find()->where('id = "'.$m['zone_id'].'"')->One();
									$area = OperatingArea::find()->where('area_id ='.$m['area_id'])->One();
									$provices = Provinces::find()->where('code ='.$m['province'])->One();
									$amphures = Amphures::find()->where('id ='.$m['amphure'])->One();
									$districts = Districts::find()->where('id ='.$m['district'])->One();
									?>
									<div class="operating-in-org">
										<div class="org-view-name">
											พื้นที่ : <?php echo $m['name'];?>
											<a href="index.php?r=operating-main/view&id=<?php echo $m['id'];?>">
												<div class="org-view-person">
													<i class="fe fe-file-text"></i>
												</div>
											</a>
										</div>
										<div>โซน. <?php echo $zone['zone_name'];?> พื้นที่/กองร้อย. <?php echo $area['area_name'];?></div>
										<div>
											จังหวัด. <?php echo $provices['name_th'];?> 
											อำเภอ. <?php echo $amphures['name_th'];?>
											ตำบล. <?php echo $districts['name_th'];?>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6">
				<div class="card card-success">
					<div class="card-header">
						<div class="card-title"><i class="fe fe-users"></i> ข้อมูล ผกร. ภายในองค์กร</div>
						<div class="card-options">
							<?php 
							$org_person = EformData::find()->where('eform_id = 21')->All(); 
							?>
							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body organization-card-height">
						<div class="row">
							<div class="col-md-12">
								<?php 
								
								foreach ($org_person as $org) {

									$data = @json_decode($org['data_json'],TRUE);
									$val_eform = $data[0];
									$op = $val_eform['data_org'];

									if (in_array($_GET['id'],$op)){

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


	<div class="modal fade show" id="showdata_person" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-sm" style="z-index: inherit;">
			<div class="modal-content">

				<div class="modal-body">
					<button type="button" class="close close-showdata_person" data-dismiss="modal"></button>
					<div class="text-center mb-4">
						<div id="rate"></div>
						<div id="img_person"></div>
					</div>
					<span id="person_name"></span><br>
					<b>ตำแหน่ง : </b> <span id="position_name"></span>
				</div>

			</div>
		</div>
		<div class="modal-backdrop show"></div>
	</div>

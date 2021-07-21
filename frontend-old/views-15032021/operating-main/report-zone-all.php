<?php 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OperatingKam;
use app\models\OperatingZone;
use app\models\OperatingArea;
use app\models\OperatingMain;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OperatingMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
	#load-data {
		display: none;
	}
	.card .card-options a {
		color: #f5f6f7;
	}
</style>
<link rel="stylesheet" href="../../html-version/assets/css/style_operating.css" />
<div class="operating-main-index">

	<div class="row clearfix">
		<div class="col-md-12">
			<h4><?= Html::encode($this->title); ?></h4>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12">
			<div class="card card-default">
				<div class="card-body">
					<div class="operating-view-map map-container">
						<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1AxJEHXxmow-4mredyVnApKZSpUFtNtyD"
						width="100%" height="700" frameborder="0" scrolling="no" allowfullscreen="" marginheight="0"
						marginwidth="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row clearfix">
		<div class="col-md-12">
			<div class="card card-default">
				<div class="card-body">
					<div class="row">
						<div class="col-md-9">
							<h5>ข้อมูลพื้นที่ปฏิบัติการทั้งหมด---</h5>
						</div>
						<div class="col-md-3 card-options operating-report-zone-col-right">
							<a href="index.php?r=operating-main" target="_blank" class="btn btn-success">
								<i class="fa fa-file-pdf-o"></i> จัดการข้อมูล
							</a>
							<a href="index.php?r=operating-main/report-zone-all-pdf" target="_blank"
							class="operating-btn-export-mpf">
							<i class="fa fa-file-pdf-o"></i> PDF
						</a>

					</div>
				</div>
				<hr>
				<div class="loading-alert">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					กำลังโหลดข้อมูล...
				</div>

				<div id="load-data">
					<?php $kam = OperatingKam::find()->All();
					$ik = 1;
					foreach ($kam as $k) { ?>
						<div class="dashboard-kam"><?php echo $ik.'. '.$k['kam']; ?></div>
						<div class="row dashboard-row dashboard-row-padding">
							<div class="col-md-3 dashboard-border dashboard-tt">โซน/พื้นที่</div>
							<div class="col-md-3 dashboard-border dashboard-tt">กองร้อย</div>
							<div class="col-md-3 dashboard-border dashboard-tt">พื้นที่ปฏิบัติการ</div>
							<div class="col-md-3 dashboard-border dashboard-tt">หมายเหตุ</div>
							<?php 
							$zone = OperatingZone::find()->where('kam_id = '.$k['id'])->All();
							foreach ($zone as $z) {

								?>
								<div class="col-md-3 dashboard-border dashboard-db">
									<?php echo $z['zone_name']; ?>
								</div>
								<div class="col-md-9 dashboard-border">
									<?php 
									$area = OperatingArea::find()->where('zone_id = '.$z['id'])->All();
									$ia = 1;
									foreach ($area as $a) {
										?>
										<div class="row dashboard-row">
											<div class="col-md-4 dashboard-border dashboard-db">
												<?php echo $ia.'. '.$a['area_name']; ?>
											</div>
											<div class="col-md-4 dashboard-border">
												<?php 
												$main = OperatingMain::find()->where('zone_id = '.$z['id'].' and area_id ='.$a['area_id'])->All(); 
												foreach ($main as $m) {
													?>
													<div class="dashboard-border-bt">
														<div class="dashboard-db"><?php echo $m['name']; ?></div>
													</div>
												<?php } ?>
											</div>
											<div class="col-md-4 dashboard-border dashboard-db">
												<?php echo $a['area_remark']; ?>
											</div>
										</div>

										<?php $ia++; } ?>
									</div>
								<?php } ?>
							</div>
							<?php $ik++; } ?>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".loading-alert").css("display", "block");
			setTimeout(function() {
				$(".loading-alert").css("display", "none");
				$("#load-data").css("display", "block");
			}, 3000);
		});
	</script>
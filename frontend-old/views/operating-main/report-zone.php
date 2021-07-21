<?php 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\OperatingZone;
use app\models\OperatingArea;
use app\models\OperatingMain;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OperatingMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รายละเอียดข้อมูลโซน');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$zone_m = OperatingZone::find()->where('id = '.$_GET['id'])->One();
?>
<style>
	.load-data{
		display: none;
	}
</style>
<link rel="stylesheet" href="../../html-version/assets/css/style_operating.css"/>
<div class="operating-main-index">

	<div class="row clearfix">
		<div class="col-md-12">
			<h4><?= Html::encode($this->title) ?></h4>
		</div>
	</div>

	<div class="row clearfix">
		<div class="col-md-12">
			<div class="card card-info">
				<div class="card-body">
					<div class="row">
						<div class="col-md-9"><h4><?= $zone_m['zone_name']; ?></h4></div>
						<div class="col-md-3">
							<a href="index.php?r=operating-main/report-zone-pdf&id=<?php echo $_GET['id']?>" target="_blank" class="operating-btn-export-mpf">
								<i class="fa fa-file-pdf-o"></i> Export PDF
							</a>
						</div>
					</div>
					<hr>
					<div class="loading-alert">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						กำลังโหลดข้อมูล...
					</div>

					<div class="load-data" >
						<div class="row dashboard-row dashboard-row-padding" id="export-pdf">
							<div class="col-md-3 dashboard-border dashboard-tt">โซน/พื้นที่</div>
							<div class="col-md-3 dashboard-border dashboard-tt">กองร้อย</div>
							<div class="col-md-3 dashboard-border dashboard-tt">พื้นที่ปฏิบัติการ</div>
							<div class="col-md-3 dashboard-border dashboard-tt">หมายเหตุ</div>
							<?php 
							$zone = OperatingZone::find()->where('id = '.$_GET['id'])->All();
							foreach ($zone as $z) {

								?>
								<div class="col-md-3 dashboard-border dashboard-db">
									<?php echo $z['zone_name']; ?>
								</div>
								<div class="col-md-9 dashboard-border">
									<?php 
									$area = OperatingArea::find()->where('zone_id = '.$z['id'])->All(); 
									foreach ($area as $a) {
										?>
										<div class="row dashboard-row">
											<div class="col-md-4 dashboard-border dashboard-db">
												<?php echo $a['area_name']; ?>
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

									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".loading-alert").css("display", "block");
		setTimeout(function(){
			$(".loading-alert").css("display", "none");
			$(".load-data").css("display", "block");
		},3000);
	});

</script>
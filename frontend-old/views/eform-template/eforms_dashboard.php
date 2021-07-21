<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eforms';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="eform-index">
	<div class="row clearfix">
		<div class="col">
			<div class="card">
				<div class="card-body ribbon">
					<div class="ribbon-box green"><?php echo $count_eform = Yii::$app->db->createCommand("SELECT COUNT(*) FROM eform WHERE unit_id = '".$_SESSION['unit_id']."' ORDER BY id ASC")->queryScalar(); ?></div>
					<a href="index.php?r=eform/create" class="my_sort_cut text-muted">
						<i class="icon-layers"></i>
						<span>ปรับปรุงแบบฟอร์ม<br><br></span>
					</a>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card">
				<div class="card-body ribbon">
					<a href="index.php?r=users/create_users" class="my_sort_cut text-muted">
						<i class="icon-user-follow"></i>
						<span>เพิ่มผู้ใช้งานในหน่วย<br><br></span>
					</a>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-body ribbon">
					<div class="ribbon-box orange">
						<?php //echo $not_active = Yii::$app->db->createCommand("SELECT COUNT(*) FROM eform WHERE unit_id = '".$_SESSION['unit_id']."' AND active = 0 ORDER BY id ASC")->queryScalar();
						echo $users = Yii::$app->db->createCommand("SELECT COUNT(*) FROM users WHERE unit_id = '".$_SESSION['unit_id']."' ORDER BY name ASC")->queryScalar();
					?>
					</div>
					<a href="index.php?r=users/index&unitid=<?=$_SESSION['unit_id']?>" class="my_sort_cut text-muted">
						<i class="icon-users"></i>
						<span>ผู้ใช้งานในหน่วยทั้งหมด<br><br></span>
					</a>
				</div>
			</div>
		</div>
        <!-- 
		<div class="col">
			<div class="card">
				<div class="card-body ribbon">
					<div class="ribbon-box orange"><?php echo $active = Yii::$app->db->createCommand("SELECT COUNT(*) FROM eform WHERE unit_id = '".$_SESSION['unit_id']."' AND active = 1 ORDER BY id ASC")->queryScalar(); ?></div>
					<a href="#" class="my_sort_cut text-muted">
						<i class="icon-bulb"></i>
						<span>เปิดการใช้งานฟอร์ม<br><br></span>
					</a>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-body">
					<a href="index.php?r=site/pages&view=stat_users_department" class="my_sort_cut text-muted">
						<i class="icon-pie-chart"></i>
						<span>รายงาน<br><br></span>
					</a>
				</div>
			</div>
		</div> -->
		<div class="col">
			<div class="card">
				<div class="card-body">
					<a href="index.php?r=site/pages&view=setting_users_group" class="my_sort_cut text-muted">
						<i class="icon-power"></i>
						<span>สิทธิ์การเข้าใช้งานระบบ<br><br></span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<?php Pjax::begin();?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title"><dt>EFORM</dt></h2>
				</div>
				<div class="card-body ribbon">
					<?php 
					    echo $this->render('_eforms_search', ['model' => $searchModel]);
					?>
				</div>
			</div>
		</div>
	</div>
	

	<?php

	$columns = 2;
	$cl = 12 / $columns;

	echo ListView::widget([
		'dataProvider' => $dataProvider,
		'layout'       => '{items}{pager}',
		'itemOptions'  => ['class' => "col-md-$cl"],
		'itemView'     => '_eform',
		'options'      => ['class' => 'grid-list-view row' ],
		'emptyText' => '<div class="row text-center" style="margin-left: 0.5em;"><div class="">ไม่พบผลลัพธ์</div></div>',
		'pager' => [
			'options' =>[
				'class' => 'pagination col-md-12'], 
			],
		]);

		?>
		<?php Pjax::end();?>
	</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\EformTemplate;
use yii\helpers\ArrayHelper;
// use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EformDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$id = isset($_GET['form_id']) ?  $_GET['form_id'] : (isset($_POST['form_id']) ? $_POST['form_id'] : '');
$form_id = $id;

$where_user_role = ($_SESSION['user_role']=='1') ? "" : "AND unit_id LIKE '%\"".$_SESSION['unit_id']."\"%'";

$query = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '$id' AND disable = '0' $where_user_role")->queryOne();
if (empty($id)) {
	$this->title = 'ข้อมูลทั้งหมด (Eform Data)';
}else{
	$this->title = $query['detail'];
// if($_SESSION['user_role']=='3'){
// echo "<script>alert('คุณไม่มีสิทธิ์เข้าถึงข้อมูลหน้านี้');window.location='index.php'</script>";
// }

}

$url_node = Yii::$app->db->createCommand("SELECT setting_value FROM `setting` WHERE setting_name = 'url_node'")->queryOne();

$this->params['breadcrumbs'][] = $this->title;

if ($_GET['form_id'] == '21') {
	 $culor = "card-rad" ;
} elseif ($_GET['form_id'] == '16') {
	 $culor = "card-maroon" ;
} else {
      $culor ='';
}



?>

<style>
.grid-view > table.table th:last-child, .grid-view > table.table td:last-child {
	width: 129px !important;
	text-align: center;
}
.datepicker-days{
	text-align: center !important;
	cursor: pointer;
}

</style>

<div class="eform-data-index">

	<!-- <iframe src="http://45.127.62.51:5601/app/dashboards#/view/19bb0ed0-0564-11eb-8457-d17f5bb70f4f?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-1y,to:now))&_a=(description:'%5BTextXDB%5D%20-%20%E0%B8%9A%E0%B8%B8%E0%B8%84%E0%B8%84%E0%B8%A5%E0%B9%80%E0%B8%AA%E0%B8%B5%E0%B8%A2%E0%B8%8A%E0%B8%B5%E0%B8%A7%E0%B8%B4%E0%B8%95',filters:!(),fullScreenMode:!f,options:(hidePanelTitles:!f,useMargins:!t),query:(language:kuery,query:''),timeRestore:!f,title:%E0%B8%9A%E0%B8%B8%E0%B8%84%E0%B8%84%E0%B8%A5%E0%B9%80%E0%B8%AA%E0%B8%B5%E0%B8%A2%E0%B8%8A%E0%B8%B5%E0%B8%A7%E0%B8%B4%E0%B8%95,viewMode:view)&show-time-filter=true" height="300" width="100%"  style="border:0;"></iframe> -->


<? //echo $id;
    /*$eform = EformTemplate::find()
    ->where(['id' => $id])
    ->all()->dashboard_header_link;

    $form = EformTemplate::find()
    ->where(['id' => 1])
    ->orderBy('id')
    ->all(); */
    //$eform = EformTemplate::find()->where(['id' => 4])->one()->dashboard_header_link;
    $eform = EformTemplate::find()->where(['id'=>4])->all();
    //print_r($eform); //$eform->dashboard_header_link;
    foreach($eform as $e){
    	echo $e->dashboard_header_link;

    }
    ?>
<!--  <iframe src="http://45.127.62.51:5601/goto/7685e5336eef10e6caf154a07e727a78" height="670" width="100%"  style="border:0;"></iframe>
-->
<h4><?= Html::encode($this->title) ?></h4>

<div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="card" style="font-size: 100%;">
                    <div class="card-body" style="font-size: 100%;">
                        <div class="card-value float-right text-azure-new"><i class="fas fa-user-alt-slash"></i></div>
                        <h4 class="mb-1"><span class="countAll"><?php echo number_format($count_zdi = Yii::$app->db->createCommand("SELECT COUNT(*) FROM eform_data WHERE form_id = '21' ORDER BY id ASC")->queryScalar()); ?></span></h4>
                        <div>ผกร. ทั้งหมด</div>
                        <div class="mt-4">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-blue-gradient" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card" style="font-size: 100%;">
                    <div class="card-body" style="font-size: 100%;">
                        <div class="card-value float-right text-green-new"><i class="fas fa-align-center"></i></div>
                        <h4 class="mb-1"><span class="sumToDay"><?php echo number_format($count_Terrorist_type = Yii::$app->db->createCommand("SELECT COUNT(*) FROM Terrorist_type ORDER BY id ASC")->queryScalar()); ?>
                                </span></h4>
                        <div>ประเภทของผกร.</div>
                        <div class="mt-4">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-green-gradient" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card" style="font-size: 100%;">
                    <div class="card-body" style="font-size: 100%;">
                        <div class="card-value float-right text-danger-new"><i class="fas fa-male"></i></div>
                        <h4 class="mb-1"><span class="sumNotify">
							<?php   
                                            $boy = "ชาย";
                                            $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$boy."%'")->queryAll();
                                            echo count($b); 
                                    ?>
									</span>
									</h4>
                        <div>ชาย</div>
                        <div class="mt-4">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-red-gradient" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="card" style="font-size: 100%;">
                    <div class="card-body" style="font-size: 100%;">
                        <div class="card-value float-right text-request-new">
                            <i class="fas fa-female"></i></div>
                        <h4 class="mb-1"><span class="toUnit"><?php   
                                            $female = "หญิง";
                                            $g = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$female."%'")->queryAll();
                                            echo count($g); 
                                    ?></span></h4>
                        <div>หญิง</div>
                        <div class="mt-4">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-request-new toUnit_per" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
<div class="row clearfix">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card <?php echo $culor;?>">
			<div class="card-body ribbon">
				<?php if (!empty($id)): ?>
					<?php if ($_SESSION['user_role']=='3'): ?>
						<p style="float:right;">
							<a href="index.php?r=site/pages&view=eform_information&form_id=<?=$id;?>" class="btn btn-lg btn-danger"> <i class="fa fa-plus-circle"></i> เพิ่มข้อมูล</a>
							<a href="index.php?r=site/pages&view=eform_information&form_id=<?=$id;?>" class="btn btn-lg btn-success"> <i class="fa fa-signal"></i> dashboard</a>
						</p>
					<?php endif ?>
				<?php endif ?>


				<?php Pjax::begin(['id' => 'pjax-grid-eform-data']); ?>
				<?php echo $this->render('_search', ['model' => $searchModel]); ?>

				<?= GridView::widget([
					'dataProvider' => $dataProvider,
// 'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],
						[
							'attribute'=>'form_id',
							'filter'=>ArrayHelper::map(EformTemplate::find()->asArray()->all(), 'id', 'detail'),
							'format'=>'raw',
							'value' => function($model, $key, $index)
							{
								if(!empty($model->form_id))
								{
									$query = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '".$model->form_id."'")->queryOne();
									return $query['detail'];
								}
							},
							'visible' => $id=='' ? true : false
						],
						[
							'attribute'=>'data_json',
							'format'=>'raw',
							'value' => function($model, $key, $index)
							{
								if(!empty($model->data_json))
								{

									$where_unit_id = (!isset($_GET['form_id'])) ? '' : $where_user_role;
									$show = '';
									$query = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '".$model->form_id."' $where_unit_id")->queryOne();
									$data_main = @json_decode($query['form_element'],TRUE);

									$data_object = @json_decode($model->data_json,TRUE);
									$dta = $data_object[0];

									$approve_template = Yii::$app->db->createCommand("SELECT approve_template.step FROM eform_template,approve_template WHERE eform_template.id = '".$model->form_id."' AND eform_template.approve_type = approve_template.id")->queryScalar();

									$object_approve_template = @json_decode($approve_template,TRUE);

									foreach ($data_main[0]['fieldGroup'] as $col){
										if ($col['type']=='select') {
											if ($col['templateOptions']['model']!=null) {
			// $id_column = $col['templateOptions']['model']['id'];
			// $type_column = $col['templateOptions']['model']['type_name'];
			// $table_column = $col['templateOptions']['model']['table'];

			// $sql = "SELECT $id_column,$type_column FROM $table_column WHERE $id_column = '".$dta[$col['key']]."'";
			// $query = Yii::$app->db->createCommand($sql)->queryOne();

			// $show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$query[$type_column]."<br>";
												$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
											}else{
			// $arr = $col['templateOptions']['options'];
			// $key = array_search($dta[$col['key']], array_column($arr, 'value'));
			// $show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$col['templateOptions']['options'][$key]['label']."<br>";
												$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
											}
										}else if ($col['type']=='input') {
											if ($col['templateOptions']['type']=='date'){
												$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".DateThai($dta[$col['key']])."<br>";
											}else if ($col['templateOptions']['type']=='radio'){
			// $arr = $col['templateOptions']['options'];
			// $key = array_search($val_eform[$col['key']], array_column($arr, 'value')); 
			// $show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$col['templateOptions']['options'][$key]['label']."<br>";
												$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
											}else if ($col['templateOptions']['type']=='checkbox'){
												if(count($dta[$col['key']])>0){
													$show_checkbox ='';
													foreach ($dta[$col['key']] as $value) {
					// $arr = $col['templateOptions']['options'];
					// $key = array_search($value, array_column($arr, 'value'));
					// $show_checkbox .= $col['templateOptions']['options'][$key]['label'].", ";
														$show_checkbox .= $value.", ";
													}
													$show .=  "<b>".$col['templateOptions']['placeholder']."</b> : ".rtrim($show_checkbox, ", ")."<br>";
												}
											}else{
												$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
											}
										}else if ($col['type']=='latlong') {
											$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta['latitude'].", ".$dta['longitude']."<br>";
										}else if ($col['type']=='address') {
											$nameaddress = $col["key"];
											$nameaddress_no = $nameaddress."_no";
											$nameaddress_mooban = $nameaddress."_mooban";
											$nameaddress_tombon = $nameaddress."_tombon";
											$nameaddress_amphoe = $nameaddress."_amphoe";
											$nameaddress_province = $nameaddress."_province";
											$show .= "<b>".$col['templateOptions']['placeholder']."</b> : เลขที่ ".$dta[$nameaddress_no]." หมู่บ้าน .".$dta[$nameaddress_mooban]." ต.".$dta[$nameaddress_tombon]." อ.".$dta[$nameaddress_amphoe]." จ.".$dta[$nameaddress_province]."<br>";
										}else{
											$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
										}

									}

									$user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id = '".$dta['user_create_id']."'")->queryOne();
									$show .= "<b>ผู้บันทึก</b> : ".$user['name']."<br>";
									$check_status = array('<span style="color: #dc3545;"><b>ข้อมูลยังไม่ได้รับการตรวจสอบ</b></span>','<span style="color: #28a745;"><b>รับทราบข้อมูลแล้ว</b></span>','<span style="color: #e28f00;"><b>ไม่อนุญาตให้เผยแพร่ข้อมูล</b></span>');
									$show .= "<b>Form Version</b> : ".$dta['eform_version']."<br>";


									if(!empty($approve_template)){
										if($dta['approve']==''){
											$show .= "<b>สถานะ</b> : ".$check_status[0];
										}else{
											$show .= "<b>สถานะ</b> : <br>";
											foreach ($dta['approve'] as $value) {
												$show .= "วันที่".$object_approve_template[0][$value['step']]." : ".DateThaiTime($value['date_time'])."<br>
												ผู้".$object_approve_template[0][$value['step']]." : ".$value['user_approve']."";

												if (!empty($value['unit_name'])){

													$show .= "
													<br>
													หน่วยที่".$object_approve_template[0][$value['step']]." : ".$value['unit_name']."<br><br>";
												}

											}
										}
									}

									return  $show;

								}
							},
						],
						[
							'attribute'=>'date_time',
							'filterInputOptions' => [
								'class' => 'form-control datepicker_input',
							],
							'format'=>'raw',
							'value' => function($model, $key, $index)
							{
								if(!empty($model->date_time))
								{
									return DateThaiTime($model->date_time);
								}
							},
							'contentOptions' => ['style' => 'width: 130px;', 'class' => 'text-center'],
						],

						['class' => 'yii\grid\ActionColumn',
						'buttons' => [
							'view' => function ($url, $model, $key) {
								if (isset($_GET['form_id'])) {
									$checkform_id = array(
										16 =>"view-process",
										21 =>"view-person");
									return '<a class="btn btn-light btn-sm" href="index.php?r=eform-data/'.$checkform_id[$_GET['form_id']].'&id='.$model->id.'"><i class="fas fa-eye"></i></a>';
								}else{
									return '<a class="btn btn-light btn-sm" href="index.php?r=eform-data/view&id='.$model->id.'"><i class="fas fa-eye"></i></a>';
								}
							},
							'update' => function ($url, $model, $key) {
								if($_SESSION['user_role']=='3'){
									return '<a class="btn btn-light btn-sm" href="index.php?r=site/pages&view=eform_information&eform_data='.$model->id.'"><i class="fas fa-pencil-alt"></i></a>';
								}
							},

							'delete' => function ($url, $model, $key) {
								if($_SESSION['user_role']=='3'){
									return '<button class="btn btn-light del_data btn-sm" data-id="'.$model->id.'"><i class="fas fa-trash"></i></button>';
								}
							},
						]
					]
				],
			]); ?>

			<?php Pjax::end(); ?>

		</div>
	</div>
</div>
</div>
</div>

<?php 

$this->registerJs("
	$('.del_data').on('click', function(e) {
		if (confirm('ต้องการลบข้อมูลใช่หรือไม่?')) {
			var id_sql_eform = $(this).data('id');
			load_data_files(id_sql_eform);
		}

		});

		function load_data_files(id_sql_eform){
			$.ajax({
				url:'index.php?r=site/insert_file_upload_list&type=show&form_id='+id_sql_eform,
				method:'GET',
				dataType:'json',
				contentType: 'application/json; charset=utf-8',
				success:function(data)
				{
					if (data.length>0) {
						$.each(data, function(index) {
							removefile_minio(data[index].file_name,data[index].file_id,data[index].bucket,id_sql_eform);
							});
							}else{
								delete_eform_data(id_sql_eform);
							}
						}
						});
					}

					function removefile_minio(file_name,file_id,bucket,id_sql_eform){
						$.ajax({
							url:'".$url_node['setting_value']."/removefileminio?namefile='+file_name+'&bucket='+bucket,
							method:'GET',
							dataType:'json',
							contentType: 'application/json; charset=utf-8',
							success:function(data)
							{
								deleteDatabase(file_id,id_sql_eform);
							}
							});
						}


						function deleteDatabase(file_id,id_sql_eform){
							$.ajax({
								url:'index.php?r=site/insert_file_upload_list&type=delete&file_id='+file_id,
								method:'GET',
								success:function(data)
								{
									load_data_files(id_sql_eform);
								}
								});
							}

							function delete_eform_data(id_sql_eform){
								$.ajax({
									url:'index.php?r=site/insert_file_upload_list&type=delete_eform&id_sql_eform='+id_sql_eform,
									method:'GET',
									dataType:'json',
									contentType: 'application/json; charset=utf-8',
									success:function(data)
									{
										$.pjax({container: '#pjax-grid-eform-data'})
									}
									});
								}
								");

								?>

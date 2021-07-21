<?php
$type = isset($_GET['type']) ?  $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : '');

$datetime = $_GET['EformDataSearch']['date_time'];
$mapping = $_GET['EformDataSearch']['eform_id'];


function subarray_element($arr, $id_key, $id_val = NULL) {
	return current(array_filter(
		$arr,
		function ($subarr) use($id_key, $id_val) {
			if(array_key_exists($id_key, $subarr))
				return $subarr[$id_key] == $id_val;
		}
	));
}

$start = substr($datetime, 0, 10);
$end = substr($mapping, 0, 10);
$enddate = new DateTime($end);
$end_use = $enddate->format('Y-m-d');

$date_time = (!empty($start) && !empty($end_use)) ? "AND date_time BETWEEN '$start' AND '$end_use'" : "";
$date_time2 = (!empty($start) && !empty($end_use)) ? "WHERE date_time BETWEEN '$start' AND '$end_use'" : "";

$etemplate_main = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '".$_GET['form_id']."'")->queryOne();
$data_eform_main = @json_decode($etemplate_main['form_element'],TRUE);
$data_arr_eform_main = $data_eform_main[0]['fieldGroup'];

$sub = Yii::$app->db->createCommand("SELECT id FROM eform_template WHERE unit_id LIKE '%\"".$_SESSION['unit_id']."\"%'")->queryAll();
$column = array();
foreach ($sub as $s) {
	$column[] = $s['id'];
}

$column = '("' . implode('","', $column) . '")';
$column = str_replace('(', '', $column);
$column = str_replace(')', '', $column);
$column = str_replace('"', '\'', $column);

$form_id = (isset($_GET['form_id'])) ? $_GET['form_id'] : '';

$stay_informed = (isset($_GET['stay_informed'])) ? "AND data_json LIKE '%\"stay_informed\":\"".$_GET['stay_informed']."\"%'" : '';

$eversion = (isset($_GET['eversion'])) ? "AND data_json LIKE '%\"form_id\":\"".$form_id."\",\"eform_id\":\"".$_GET['eform_id']."\",\"eform_version\":\"".$_GET['eversion']."\"%'" : '';

$usercreate = ($_SESSION['user_role']=='3') ? "AND data_json LIKE '%\"user_create_id\":\"".$_SESSION['user_id']."\"%'" : "";

if (!empty($form_id)) {

	$query = "SELECT * FROM `eform_data` WHERE form_id = '".$form_id."' AND eform_id IN (".$column.") $stay_informed $eversion $usercreate $date_time";
}else{
	$query = "SELECT * FROM `eform_data` $date_time2";
}

$statement = Yii::$app->db->createCommand($query)->queryAll();


$show_data = '';
$i = 1;
foreach ($statement as $st) {

	$show_data .= '<tr>
	<td style="vertical-align: top;text-align:center;">'.$i.'</td>';

	$show = '';
	$query = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '".$st['form_id']."' AND unit_id LIKE '%\"".$_SESSION['unit_id']."\"%'")->queryOne();
	$data_main = @json_decode($query['form_element'],TRUE);

	$data_object = @json_decode($st['data_json'],TRUE);
	$dta = $data_object[0];

	$approve_template = Yii::$app->db->createCommand("SELECT approve_template.step FROM eform_template,approve_template WHERE eform_template.id = '".$st['form_id']."' AND eform_template.approve_type = approve_template.id")->queryScalar();
	$object_approve_template = @json_decode($approve_template,TRUE);


	foreach ($data_main[0]['fieldGroup'] as $col){

		$check_column_report = subarray_element($data_arr_eform_main, 'key', $col['key']);
		$check_ineform_main = $check_column_report['templateOptions']['column_report'];

		$check_true_false = ($check_ineform_main==null) ? $col['templateOptions']['column_report'] : $check_ineform_main;

		if ($check_true_false==true){
			if ($col['type']=='select') {
				if ($col['templateOptions']['model']!=null) {
					$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
				}else{

					$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
				}
			}else if ($col['type']=='input') {
				if ($col['templateOptions']['type']=='date'){
					$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".DateThai($dta[$col['key']])."<br>";
				}else if ($col['templateOptions']['type']=='radio'){

					$show .= "<b>".$col['templateOptions']['placeholder']."</b> : ".$dta[$col['key']]."<br>";
				}else if ($col['templateOptions']['type']=='checkbox'){
					if(count($dta[$col['key']])>0){
						$show_checkbox ='';
						foreach ($dta[$col['key']] as $value) {

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

	}

	$user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id = '".$dta['user_create_id']."'")->queryOne();
	$show .= "<b>ผู้บันทึก</b> : ".$user['name']."<br>";
	$check_status = array('<span style="color: #dc3545;"><b>ข้อมูลยังไม่ได้รับการตรวจสอบ</b></span>','<span style="color: #28a745;"><b>รับทราบข้อมูลแล้ว</b></span>','<span style="color: #e28f00;"><b>ไม่อนุญาตให้เผยแพร่ข้อมูล</b></span>');
	$show .= "<b>Form Version</b> : ".$dta['eform_version']."<br>";
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



	$show_data .= '<td>'.$show.'</td>';


	$show_data .= '<td style="vertical-align: top;">'.DateThaiTime($st['date_time']).'</td>
	</tr>';

	$i++;
}



if ($type=='pdf') {

	ob_clean();
	require_once '../../vendor/autoload.php';
	$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
	$fontDirs = $defaultConfig['fontDir'];

	$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
	$fontData = $defaultFontConfig['fontdata'];

	$detail = $_POST['msg'];
	$mpdf = new \Mpdf\Mpdf([
		'tempDir' => __DIR__ . '/tmp',
		'fontDir' => array_merge($fontDirs, ['../../pdf-fonts/',
	]),
		'fontdata' => $fontData + [
			'sarabun' => [
				'R' => 'THSarabunNew.ttf',
				'I' => 'THSarabunNew Italic.ttf',
				'B' =>  'THSarabunNew Bold.ttf',
			]
		],
	]);


	$content = '
	<html>
	<head>

	<title>พิมพ์รายงาน '.$etemplate_main['detail'].'</title>
	<style>
	.container{
		font-family: "sarabun";
		font-size: 12pt;
	}
	table ,th ,tr ,td{
		font-family: "sarabun";
		border: 1px solid #999999;
		border-collapse: collapse;
	}
	p{
		text-align: justify;
	}
	h1{
		text-align: center;
	}
	.btn{
		display:none;
	}
	</style>

	</head>
	<body>
	<div class="container" style="width: 100%">
	<h1><dt>'.$etemplate_main['detail'].'</dt></h1>
	<table class="table table-striped table-bordered" style="width: 100%">
	<thead>
	<tr>
	<th style="width: 5%">#</th>
	<th style="width: 75%">ข้อมูล</th>
	<th style="width: 20%">วันที่บันทึก/แก้ไข</th>
	</tr>
	</thead>
	<tbody>'.$show_data.'';
	$content .= '</tbody></table></div></body>
	</html>';


	// echo $content;
	$mpdf->SetWatermarkText('textx');
	$mpdf->showWatermarkText = true;
	$mpdf->WriteHTML($content);
	$mpdf->Output();
	ob_end_flush();
}


if($type=='csv'){?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="../../jquery.tabletoCSV/csvExport.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $(document).ready(function(){
        	$("#export_table").csvExport({
        		title:'<?=$etemplate_main['detail'].'-'.date('Ymd').'';?>'
        	});
        	// window.close();

            // $("#export").click(function(){
            //     $("#export_table").tableToCSV();
            // });
        });
    </script>
	<html>
	<head>
	<meta charset="UTF-8">
	</head><table class="table table-striped table-bordered" style="width: 100%" id="export_table">
	<thead>
	<tr>
	<td>#</td>
	<td>ข้อมูล</td>
	<td>วันที่บันทึก/แก้ไข</td>
	</tr>
	</thead>
	<tbody><?php echo $show_data;?>
	</tbody></table></body></html>

<?php
}?>

<?php if($type=='xls'){
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="'.$etemplate_main['detail'].'-'.date('Ymd').'.xls"');
	?>
<html>
	<head>
	<meta charset="UTF-8">
	</head>
	<body>
	<table class="table table-striped table-bordered" style="width: 100%">
	<thead>
	<tr>
	<th>#</th>
	<th>ข้อมูล</th>
	<th>วันที่บันทึก/แก้ไข</th>
	</tr>
	</thead>
	<tbody><?php echo $show_data;?>
	</tbody></table></body></html>
<?php
}?>
<?php

ob_clean();
require_once '../../vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

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

$eformdata_id = isset($_GET['id']) ?  $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : '');

$eform_data = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE id = '".$eformdata_id."'")->queryOne();

$data_edata = @json_decode($eform_data['data_json'],TRUE);
$val_eform = $data_edata[0];
$id = $eform_data['form_id'];

$sql_template = "SELECT * FROM `eform_template` WHERE id = '$id'";
$query_template = Yii::$app->db->createCommand($sql_template)->queryOne();
$data = @json_decode($query_template['form_element'],TRUE);
$data_loop = $data[0]['fieldGroup'];
sksort($data_loop, "sort", true);


$etemplate_main = Yii::$app->db->createCommand("SELECT * FROM `eform_template` WHERE id = '".$eform_data['form_id']."'")->queryOne();
$data_eform_main = @json_decode($etemplate_main['form_element'],TRUE);
$data_arr_eform_main = $data_eform_main[0]['fieldGroup'];

function subarray_element($arr, $id_key, $id_val = NULL) {
  return current(array_filter(
    $arr,
    function ($subarr) use($id_key, $id_val) {
      if(array_key_exists($id_key, $subarr))
        return $subarr[$id_key] == $id_val;
    }
  ));
}


$content = '
<html>
<head>

<title>'.$query_template['detail'].'</title>
<style>
.container{
	font-family: "sarabun";
	font-size: 18px !important;
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
table {
	font-family: "sarabun";
	font-size: 18px !important;
	border-collapse: collapse;
	width: 100%;
}

td, th {
	border: 1px solid #dddddd;
	text-align: left;
	padding: 8px;
}

tr:nth-child(even) {
	background-color: #dddddd;
}
</style>
</head>
<body>

<div class="container" style="width: 100%">
';

$content .= '
<h1><dt>'.$query_template['detail'].'</dt></h1>
<table>';

foreach ($data_loop as $col) {

	// var_dump($check_column_report);
	$check_column_report = subarray_element($data_arr_eform_main, 'key', $col['key']);
	$check_ineform_main = $check_column_report['templateOptions']['column_report'];

	$check_true_false = ($check_ineform_main==null) ? $col['templateOptions']['column_report'] : $check_ineform_main;

if ($check_true_false==true){
	$content .= '
	<tr>
	<td>
	<b>'.$col['templateOptions']['label'].'</b></td>
	<td>';

	if ($col['type']=='input'){ 
if ($col['templateOptions']['type']!=null){
if ($col['templateOptions']['type']=='date'){
$content .= ''.DateThai($val_eform[$col['key']]).'';
}elseif($col['templateOptions']['type']=='radio'){
$content .= ''.$val_eform[$col['key']].'';
}elseif($col['templateOptions']['type']=='checkbox'){
foreach ($val_eform[$col['key']] as $key => $value) {
$show .= $value.", ";
}
$string = rtrim($show, ", ");
$content .= ''.$string.'';
}else{ 
	$content .= ''.$val_eform[$col['key']].'';
}
}else{
$content .= ''.$val_eform[$col['key']].'';
}

}elseif($col['type']=='textarea'){
$content .= '<br>'.$val_eform[$col['key']].'';
}elseif($col['type']=='select'){
if ($col['templateOptions']['model']!=null){

$content .= ''.$val_eform[$col['key']].'';
}else{
$content .= ''.$val_eform[$col['key']].'';
}
}elseif($col['type']=='idcard'){
$content .= ''.$val_eform[$col['key']].'';
}elseif($col['type']=='address'){
$nameaddress = $col["key"];
$content .= '
เลขที่ : ';
$nameaddress_no = $nameaddress."_no";
$content .= '
'.$val_eform[$nameaddress_no].'<br>
หมู่บ้าน : ';
$nameaddress_mooban = $nameaddress."_mooban";
$content .= '
'.$val_eform[$nameaddress_mooban].'<br>
ตำบล : ';
$nameaddress_tombon = $nameaddress."_tombon";
$content .= '
'.$val_eform[$nameaddress_tombon].'<br>
อำเภอ : ';
$nameaddress_amphoe = $nameaddress."_amphoe";
$content .= '
'.$val_eform[$nameaddress_amphoe].'<br>
จังหวัด : ';
$nameaddress_province = $nameaddress."_province";
$content .= '
'.$val_eform[$nameaddress_province].'<br>';
}else{
$content .= ''.$val_eform['latitude'].', '.$val_eform['longitude'].'';
}

	$content .= '</td>
	</tr>';
}
}

$content .= '
</table>
';

$content .= '
</div>
</body>
</html>

';

// echo $content;
$mpdf->SetWatermarkText('textx');
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($content);
$mpdf->Output();
ob_end_flush();

?>
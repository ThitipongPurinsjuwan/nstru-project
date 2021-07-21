
<?php
ob_clean();
require_once '../../vendor/autoload.php';
//custom font
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

use app\models\OperatingZone;
use app\models\OperatingArea;
use app\models\OperatingMain;

$text = "
<table class='table-main table-width'>
<thead>
<tr>
<th>โซน/พื้นที่</th>
<th class='bg-color-main'>
<table class='table-width table-sub'>
<tr class='bg-color-sub'>
<th style='width: 100px;'>กองร้อย</th>
<th style='width: 120px;'>พื้นที่ปฏิบัติการ</th>
<th style='width: 120;'>หมายเหตุ</th>
</tr>
</table>
</th>
</tr>
</thead>
<tbody>";
$zone = OperatingZone::find()->where('id = '.$_GET['id'])->All();
foreach ($zone as $z) {
	$text .= "<tr>";
	$text .= "<td style='width: 20%'>".$z['zone_name']."</td>";
	$text .= "<td class='bg-color-main'>";
	$text .= "<table class='table-width'>";
	$area = OperatingArea::find()->where('zone_id = '.$z['id'])->All(); 
	foreach ($area as $a) {
		$text .= "<tr class='bg-color-sub'>";
		$text .= "<td style='width: 152px;'>".$a['area_name']."</td>";

		$text .= "<td style='width: 211px;'>";
		$text .= "<table class='table-width'>";
		$main = OperatingMain::find()->where('zone_id = '.$z['id'].' and area_id ='.$a['area_id'])->All(); 
		foreach ($main as $m) {
			$text .= "<tr class='border-detail' style='border-bottom: 1px solid #999999;border-top: 1px solid white;border-left: 1px solid white;border-right: 1px solid white;'>";
			$text .= "<td>";
			$text .= "".$m['name']."";
			$text .= "</td>";
			$text .= "</tr>";
		}
		$text .= "</table>";
		$text .=  "</td>";

		$text .= "<td style=''>".$a['area_remark']."</td>";

		$text .= "</tr>";
	}
	$text .= "</table>";
	$text .= "</td>";
	$text .= "</tr>";
}
$text .= "</tbody>
</table>";

$content = '
<style>
.container{
	font-family: "sarabun";
	font-size: 12pt;
}
.table-main ,.table-main thead ,.table-main th ,.table-main tr ,.table-main td{
	font-family: "sarabun";
	border: 1px solid #999999;
	border-collapse: collapse;
	vertical-align: top;
}
.table-sub tr th {
	border-top: 0px solid #999999 !important;
	border-collapse: collapse;
}
.table-width{
	width: 100%;
	border-collapse: collapse;
}
.bg-color-main{
	padding: -1px;
	background-color: #999999;
}
.bg-color-sub{
	background-color: #ffffff;
}
.border-detail td:last-child{
	border-bottom: 1px solid #ffffff;
}
</style>
<div class="container" style="width: 100%">
'.$text.'
</div>
';


$mpdf->SetWatermarkText('textx');
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($content);
$mpdf->Output();
ob_end_flush();

?>
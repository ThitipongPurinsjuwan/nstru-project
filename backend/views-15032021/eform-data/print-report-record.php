<?php

if (isset($_GET['report_template'])) {
	$form_id = $_GET['form_id'];
	$eform_data = Yii::$app->db->createCommand("SELECT * FROM eform_data WHERE form_id = '".$form_id."' ORDER BY RAND() LIMIT 1")->queryOne();
	$eform_template = Yii::$app->db->createCommand("SELECT * FROM eform_template WHERE id = '".$form_id."'")->queryOne();
	$report_template = $_GET['report_template'];
}else{
	$id = $_GET['id'];
	$eform_data = Yii::$app->db->createCommand("SELECT * FROM eform_data WHERE id = '".$id."'")->queryOne();
	$eform_template = Yii::$app->db->createCommand("SELECT * FROM eform_template WHERE id = '".$eform_data['form_id']."'")->queryOne();
	$report_template = @json_decode($eform_template['guide_report_record'],TRUE);
}

$data_edata = @json_decode($eform_data['data_json'],TRUE);
$val_eform = $data_edata[0];

$data = @json_decode($eform_template['form_element'],TRUE);
$data_loop = $data[0]['fieldGroup'];
sksort($data_loop, "sort", true);

?>

<link rel="stylesheet" href="../../html-version/assets/css/style.css"/>
<link rel="stylesheet" href="../../html-version/assets/plugins/bootstrap/css/bootstrap.min.css" />
<style>

thead.report-header {
	display: table-header-group;
}

tfoot.report-footer {
	display:table-footer-group;
}
table.report-container {
	page-break-after: always;
}

body {
	background: rgb(204,204,204); 
}
page {
	padding: 16mm;
	background: white;
	display: block;
	margin: 0 auto;
	margin-top: 0.5cm;
	margin-bottom: 0.5cm;
	box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
	width: 21cm;
	height: 29.7cm;
	overflow:auto;
}

div.main{
	min-height: 45vh !important;
}

.header-logo{
width: 80px;
height: auto;
}

@media print {
	body {
		background: rgb(255,255,255); 
		font-size: 2rem !important;
		font-weight: 400 !important;
		line-height: 1.5 !important;
	}
	@page 
	{
		background: white;
		margin: 0 auto;
		mso-title-page:yes;
		mso-page-orientation: portrait;
		mso-header: header;
		mso-footer: footer;
	}
	@page content {margin: 50cm;}
	tbody.report-content {page: content;}
	div.header-info {
		padding: 5em 2.5em 2em 2.5em;
		text-align: justify;
	}
	div.footer-info{
		padding: 1em 2.5em 5em 2.5em;
		text-align: justify;
	}
	div.main{
		min-height: 99.5vh !important;
		padding: 0em 2.5em 0em 2.5em;
		text-align: justify;
	}
}
</style>


<?php if (isset($_GET['printnow'])): ?>
	<script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {

			var str = document.getElementById("printarea").innerHTML; 
			var res = str.replace('<page size="A4">', "");
			var res2 = res.replace('</page>', "");
			$("#printarea").html(res2);
			printDiv('printarea');
			function printDiv(divname){
				var printContents = document.getElementById(divname).innerHTML;
				var originalContents = document.body.innerHTML;
				document.body.innerHTML = printContents;
				window.print();
				document.body.innerHTML = originalContents;
			}


		});
	</script>
<?php endif ?>

<div id="printarea">
	<page size="A4">
		<table class="report-container">
			<thead class="report-header">
				<tr>
					<th>
						<div class="header-info">
							<?php if ($eform_template['position_images']!=""): ?>
								<?php if ($eform_template['position_images']=='1'): ?>
							<div class="row">
								<div class="col-md-1">
									<img src="../../images/template_files/<?php echo $eform_template['images']; ?>" class="header-logo">
								</div>
								<?php $style_header_record = (isset($_GET['printnow'])) ? 'padding-left: 1.3em;' : 'padding-left: 3em;'; ?>
								<div class="col-md-11" style="<?=$style_header_record;?>">
									<?php echo $eform_template['header_record']; ?>
								</div>
							</div>
							<?php endif ?>
							<?php if ($eform_template['position_images']=='2'): ?>
								<div class="text-center">
									<img src="../../images/template_files/<?php echo $eform_template['images']; ?>" class="header-logo">
								</div>
								<?php echo $eform_template['header_record']; ?>
							<?php endif ?>
							<?php if ($eform_template['position_images']=='3'): ?>
								<div class="row">
								<div class="col-md-10">
									<?php echo $eform_template['header_record']; ?>
								</div>
								<div class="col-md-2">
									<img src="../../images/template_files/<?php echo $eform_template['images']; ?>" class="header-logo">
								</div>
							</div>
							<?php endif ?>
							<?php if ($eform_template['position_images']=='0'): ?>
								
								<?php echo $eform_template['header_record']; ?>
							<?php endif ?>
							<?php else: ?>
								<?php echo $eform_template['header_record']; ?>
							<?php endif ?>
							<hr>
						</div>
					</th>
				</tr>
			</thead>
			<tfoot class="report-footer">  
				<tr> 
					<td>
						<div class="footer-info">
							<hr>
							<?php echo $eform_template['footer_record']; ?>
						</div>
					</td>
				</tr>
			</tfoot>
			<tbody class="report-content"> 
				<tr> 
					<td>
						<div class="main">
							<div class="row mt-3">
<?php if (!empty($report_template)): ?>
<?php foreach ($report_template as $col_template) : ?>
<div class="<?=$col_template['class_column'];?> mb-3">

<?php
$searchedValue = $col_template['key']; 
$neededObject = array_filter(
$data_loop,
function ($e) use ($searchedValue) {
return $e['key'] == $searchedValue;
}
);

?>
<?php foreach ($neededObject as $col) : 
if ($col['templateOptions']['urlmarker']!=null) {
$iconmarker = $col['templateOptions']['urlmarker'];
}
?>
<label for="<?=$col['key'];?>"><dt><?=$col['templateOptions']['label'];?> :</dt></label>
<?php if ($col['type']=='input'): ?>
<?php if ($col['templateOptions']['type']!=null): ?>
<?php if ($col['templateOptions']['type']=='date'): ?>
<?php echo ($eform_data==true) ? DateThai($val_eform[$col['key']]) : DateThai(date("Y-m-d"));?>
<?php elseif($col['templateOptions']['type']=='radio'): ?>
<?php
echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';
?>
<?php elseif($col['templateOptions']['type']=='checkbox'): ?>
<?php 
foreach ($val_eform[$col['key']] as $key => $value) {

$show .= $value.", ";
}
$string = rtrim($show, ", ");
echo ($eform_data==true) ? $string : 'ทดสอบ';
?>
<?php else: ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php endif ?>
<?php else: ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php endif ?>

<?php elseif($col['type']=='textarea'): ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>

<?php elseif($col['type']=='select'): ?>

<?php if ($col['templateOptions']['model']!=null): ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php else: ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php endif; ?>
<?php elseif($col['type']=='idcard'): ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php elseif($col['type']=='birthday'): ?>
<?php echo ($eform_data==true) ? DateThai($val_eform[$col['key']]) : DateThai(date("Y-m-d"));?>
<?php
if($eform_data==true){
$y2 = substr($val_eform[$col['key']],0,4);
$age = date("Y")-$y2;
echo ' ('.$age.' ปี)';
}
?>
<?php elseif($col['type']=='address'): 
$nameaddress = $col["key"];
?>
<div class="row" style="font-weight: 100 !important;">
<div class="col-md-2 text-right-align">
เลขที่ : 
<?php $nameaddress_no = $nameaddress."_no"; ?>
</div>
<div class="col-md-9">
<?=$val_eform[$nameaddress_no];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
หมู่บ้าน : 
<?php $nameaddress_mooban = $nameaddress."_mooban"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_mooban];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
ตำบล : 
<?php $nameaddress_tombon = $nameaddress."_tombon"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_tombon];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
อำเภอ : 
<?php $nameaddress_amphoe = $nameaddress."_amphoe"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_amphoe];?>
</div>
<div class="col-md-2 pt-1 text-right-align">
จังหวัด :
<?php $nameaddress_province = $nameaddress."_province"; ?>
</div>
<div class="col-md-9 pt-1">
<?=$val_eform[$nameaddress_province];?>
</div>
</div>
<?php else: ?>
<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>
<?php $have_map = 1; ?>
<?php endif; ?>

</div>
<?php endforeach ?>


<?php endforeach; ?>

<?php else: ?>

<?php foreach ($data_loop as $col) : 
if ($col['templateOptions']['urlmarker']!=null) {
$iconmarker = $col['templateOptions']['urlmarker'];
}
?>
<div class="<?=$col['className'];?> mb-3">
<label for="<?=$col['key'];?>"><dt><?=$col['templateOptions']['label'];?> :</dt></label>
<?php if ($col['type']=='input'): ?>
<?php if ($col['templateOptions']['type']!=null): ?>
<?php if ($col['templateOptions']['type']=='date'): ?>
<?php echo ($eform_data==true) ? DateThai($val_eform[$col['key']]) : DateThai(date("Y-m-d"));?>
<?php elseif($col['templateOptions']['type']=='radio'): ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php elseif($col['templateOptions']['type']=='checkbox'): ?>
<?php 
foreach ($val_eform[$col['key']] as $key => $value) {

$show .= $value.", ";
}
$string = rtrim($show, ", ");
echo ($eform_data==true) ? $string : 'ทดสอบ';
?>
<?php else: ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php endif ?>
<?php else: ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php endif ?>

<?php elseif($col['type']=='textarea'): ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>

<?php elseif($col['type']=='select'): ?>

<?php if ($col['templateOptions']['model']!=null): ?>
<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php else: ?>
	<?php echo ($eform_data==true) ? $val_eform[$col['key']] : 'ทดสอบ';?>
<?php endif; ?>
<?php elseif($col['type']=='idcard'): ?>
	<?=$val_eform[$col['key']];?>
	<?php elseif($col['type']=='birthday'): ?>
		<?php echo ($eform_data==true) ? DateThai($val_eform[$col['key']]) : DateThai(date("Y-m-d"));?>
		<?php
		if($eform_data==true){
			$y2 = substr($val_eform[$col['key']],0,4);
			$age = date("Y")-$y2;
			echo ' ('.$age.' ปี)';
		}
		?>
	<?php elseif($col['type']=='address'): 
		$nameaddress = $col["key"];
		?>
		<div class="row" style="font-weight: 100 !important;">
			<div class="col-md-2 text-right-align">
				เลขที่ : 
				<?php $nameaddress_no = $nameaddress."_no"; ?>
			</div>
			<div class="col-md-9">
				<?=$val_eform[$nameaddress_no];?>
			</div>
			<div class="col-md-2 pt-1 text-right-align">
				หมู่บ้าน : 
				<?php $nameaddress_mooban = $nameaddress."_mooban"; ?>
			</div>
			<div class="col-md-9 pt-1">
				<?=$val_eform[$nameaddress_mooban];?>
			</div>
			<div class="col-md-2 pt-1 text-right-align">
				ตำบล : 
				<?php $nameaddress_tombon = $nameaddress."_tombon"; ?>
			</div>
			<div class="col-md-9 pt-1">
				<?=$val_eform[$nameaddress_tombon];?>
			</div>
			<div class="col-md-2 pt-1 text-right-align">
				อำเภอ : 
				<?php $nameaddress_amphoe = $nameaddress."_amphoe"; ?>
			</div>
			<div class="col-md-9 pt-1">
				<?=$val_eform[$nameaddress_amphoe];?>
			</div>
			<div class="col-md-2 pt-1 text-right-align">
				จังหวัด :
				<?php $nameaddress_province = $nameaddress."_province"; ?>
			</div>
			<div class="col-md-9 pt-1">
				<?=$val_eform[$nameaddress_province];?>
			</div>
		</div>
		<?php else: ?>
			<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>
			<?php $have_map = 1; ?>
		<?php endif; ?>

	</div>
<?php endforeach ?>
<?php endif; ?>

<?php if ($have_map>0): ?>
<div class="col-xl-12 col-lg-12">
	<div class="card">

		<div class="card-body" style="padding: 0.3rem;">
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


			<div id="mapshow" style="width: 100%; height: 400px;"></div>    
			<script>

				var mymap = L.map('mapshow').setView([<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>], 10);

				L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					maxZoom: 15,
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
					'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
					id: 'mapbox/streets-v11',
					tileSize: 512,
					zoomOffset: -1
				}).addTo(mymap);

				L.marker([<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>],{
					icon: new L.Icon({
						iconSize: [50, 50],
						iconAnchor: [25, 45],
						shadowAnchor: [4, 62],
						iconUrl: '<?=$iconmarker;?>',
					})
				}).addTo(mymap)
				.bindPopup("<b>พิกัด (<?=$val_eform['latitude'];?>, <?=$val_eform['longitude'];?>)</b>");

				var popup = L.popup();


			</script>
		</div>
	</div>
</div>
<?php endif ?>

</div>
						
						</div>
					</td>
				</tr>
			</tbody>
		</table>



	</page>
</div>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
header('Content-Type: application/json');

$type = isset($_GET['type']) ?  $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : '');


if($type=='select_level'){
	$data = array();
	$query = Yii::$app->db->createCommand("SELECT * FROM organization_level")->queryAll();
	foreach ($query as $value) {
		$access_role = ($value['user_create']==$_SESSION['user_id']) ? 1 : 0;
		$data[] = array(
			"level_id" => "".$value['level_id']."",
			"level_name" => "".$value['level_name']."",
			"access_role" => $access_role,
		);
	}
	$showdata = $data;
}

if($type=='select_position'){
	$data = array();
	$query = Yii::$app->db->createCommand("SELECT * FROM organization_position")->queryAll();
	foreach ($query as $value) {
		$access_role = ($value['user_create']==$_SESSION['user_id']) ? 1 : 0;
		$data[] = array(
			"position_id" => "".$value['position_id']."",
			"position_name" => "".$value['position_name']."",
			"access_role" => $access_role,
		);
	}
	$showdata = $data;
}



if($type=='add_level'){
	$data = array();
	$query = Yii::$app->db->createCommand("INSERT INTO organization_level (`level_name`,`user_create`) VALUES ('".$_GET['value_level']."','".$_SESSION['user_id']."')");
	if ($query->execute()) {
		$data['status'] = 1;
	}else{
		$data['status'] = 0;
	}
	$showdata = $data;
}

if($type=='edit_level'){
	$data = array();
	$query = Yii::$app->db->createCommand("UPDATE `organization_level` SET `level_name`='".$_GET['value_level']."' WHERE level_id='".$_GET['level_id']."'");
	if ($query->execute()) {
		$data['status'] = 1;
	}else{
		$data['status'] = 0;
	}
	$showdata = $data;
}

if($type=='del_level'){
	$data = array();
	$query = Yii::$app->db->createCommand("DELETE FROM `organization_level` WHERE level_id='".$_GET['level_id']."'");
	if ($query->execute()) {
		$data['status'] = 1;
	}else{
		$data['status'] = 0;
	}
	$showdata = $data;
}


if($type=='showdata_person'){
	$get_person = Yii::$app->db->createCommand("SELECT id,data_json FROM `eform_data` WHERE data_json LIKE '%\"data_org\":[\"".$_GET['org_id']."\",%'")->queryAll();

	$org_person = array();
	foreach ($get_person as $value_person) {
		$data_object = @json_decode($value_person['data_json'],TRUE);

		$count = 0;
		$data_person = '';
		foreach ($data_object[0] as $k => $v) {
			if($count>0 && $count<2){
				$data_person .= $v;
			}
			$count ++;
		}

		$org_person[] = array(
			"main_id" => $data_object[0]['data_org'][1],
			"pid_id" => $data_object[0]['data_org'][2],
			"position_id" => $data_object[0]['data_org'][3],
			"rate" => $data_object[0]['data_org'][4],
			"data_person" => $data_person,
			"id_person" => $value_person['id'],
			"img_person" => $data_object[0]['data_org'][5],
		);

	}
	$showdata = $org_person;
}


if($type=='showall_person'){
	$get_person = Yii::$app->db->createCommand("SELECT eform_data.id AS id_person, eform_data.data_json AS eform_data_data_json, eform_data.date_time AS date_record FROM eform_data,eform_template WHERE eform_data.form_id = eform_template.id AND eform_template.type = '6'")->queryAll();

	$org_person = array();
	$n = 1;
	foreach ($get_person as $value_person) {
		$data_object = @json_decode($value_person['eform_data_data_json'],TRUE);

		$data_org_show = "ยังไม่สังกัดองค์กรใด";
		if ($data_object[0]['data_org'][0]!="") {
			$org = Yii::$app->db->createCommand("SELECT * FROM organization WHERE id = '".$data_object[0]['data_org'][0]."'")->queryOne();

			$data_org = @json_decode($org['data_json'],TRUE);

			$index = array_search($data_object[0]['data_org'][1], array_column($data_org, 'id'));

			$data_org_show = "<b>".$org['name']."</b> / ".$data_org[$index]['title'];
		}

		$count = 0;
		$data_person = '';
		foreach ($data_object[0] as $k => $v) {
			if($count>0 && $count<2){
				$data_person .= "$v";
			}
			$count ++;
		}

		$org_person[] = array(
			"no"=>$n,
			"data_person" => "<a href='index.php?r=eform-data/view-person&id=".$value_person['id_person']."' target='_blank'>".$data_person."</a>",
			"org_old" => "".$data_org_show."",
			"id_person" => $value_person['id_person'],
			"img_person" => $data_object[0]['data_org'][5],
			"manages" => '<button type="button" class="btn btn-primary select_person_org" data-id_person="'.$value_person['id_person'].'"><i class="fa fa-arrow-down"></i> เลือก</button>',
			"date_time"=> "".DateThaiTime($value_person['date_record']).""
		);
		$n++;
	}
	$showdata = $org_person;
}


if($type=='update_org_person'){
	$get_person_for_update = Yii::$app->db->createCommand("SELECT data_json,id FROM eform_data WHERE id = '".$_GET['id_person']."'")->queryOne();
	$data_object = @json_decode($get_person_for_update['data_json'],TRUE);
	$data_json = $data_object[0];
	$data_json['data_org'] = array(
		0 => $_GET['org_id'], 
		1 => $_GET['main_id'],
		2 => $data_json['data_org'][2],
		3 => $data_json['data_org'][3],
		4 => $data_json['data_org'][4],
		5 => $data_json['data_org'][5]
	);

	$data_object_new = json_encode($data_json, JSON_UNESCAPED_UNICODE);

	$data_object_vv = str_replace("null","",$data_object_new);

	$id_sql_eform = array("id_sql_eform"=>$_GET['id_person']);
	$insert_new = array_merge($data_json,$id_sql_eform);

	$query = "
	UPDATE `eform_data` SET data_json='[".$data_object_new."]' WHERE id = '".$_GET['id_person']."'";
	$result = Yii::$app->db->createCommand($query);
	if ($result->execute()) {
		$manager = new MongoDB\Driver\Manager("mongodb://freeman:abcd1234@database:27017");
		$bulk = new MongoDB\Driver\BulkWrite();
		$bulk->delete(['id_sql_eform' => $_GET['id_person']]);
		$bulk->insert($insert_new);
		$writeConcern = new MongoDB\Driver\writeConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
		$result = $manager->executeBulkWrite('textx.eform_data', $bulk);

		if ($result) {
			$output['status'] = 1;
		}else{
			$output['status'] = 0;
		}
	}

	$showdata = $output;
}

$token = "2ffa459adcc37176dbf93a82addf61dc";
$auth = "Authenticator=>".$token."".date("Ymd");
if(isset($_GET['auth']) && $_GET['auth'] == $auth){
	echo $someJSON = json_encode($showdata);
}
?>
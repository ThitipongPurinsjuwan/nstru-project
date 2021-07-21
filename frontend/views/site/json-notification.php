<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
header('Content-Type: application/json');


$type = isset($_GET['type']) ?  $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : '');

if ($type=='add') {

	$name = isset($_GET['name']) ?  $_GET['name'] : (isset($_POST['name']) ? $_POST['name'] : '');
	$detail = isset($_GET['detail']) ?  $_GET['detail'] : (isset($_POST['detail']) ? $_POST['detail'] : '');

	$sql = "UPDATE `notification` SET `user_accept`='".$_POST['user_accept']."',`read_news`='".$_POST['read_news']."' WHERE id = '".$_POST['nid']."' ";
	$query = Yii::$app->db->createCommand($sql);
	if ($query->execute()) {
		$output['status'] = 1;
	}else{
		$output['status'] = 0;
	}


	echo json_encode($output);

}

if ($type=='add1') {

	$name = isset($_GET['name']) ?  $_GET['name'] : (isset($_POST['name']) ? $_POST['name'] : '');
	$detail = isset($_GET['detail']) ?  $_GET['detail'] : (isset($_POST['detail']) ? $_POST['detail'] : '');

	$sql = "UPDATE `notification` SET `user_accept`='".$_POST['user_accept']."' WHERE id = '".$_POST['nid']."' ";
	$query = Yii::$app->db->createCommand($sql);
	if ($query->execute()) {
		$output['status'] = 1;
	}else{
		$output['status'] = 0;
	}


	echo json_encode($output);

}
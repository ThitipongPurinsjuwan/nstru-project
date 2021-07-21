<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
header('Content-Type: application/json');

use app\models\FileUploadList;
use app\models\DeleteWords;
use app\models\RememberWords;

$type = isset($_GET['type']) ?  $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : '');

if ($type=='insert-keyword') {

	$txts = isset($_GET['txts']) ?  $_GET['txts'] : (isset($_POST['txts']) ? $_POST['txts'] : '');
	$file_id = isset($_GET['file_id']) ?  $_GET['file_id'] : (isset($_POST['file_id']) ? $_POST['file_id'] : '');

	$model = FileUploadList::findOne($file_id);
	$model->textx_data = $txts;
	$model->update();

}

if ($type=='delete-keyword') {

	$txts = isset($_GET['txts']) ?  $_GET['txts'] : (isset($_POST['txts']) ? $_POST['txts'] : '');
	$file_id = isset($_GET['file_id']) ?  $_GET['file_id'] : (isset($_POST['file_id']) ? $_POST['file_id'] : '');
	$val_keyword = isset($_GET['val_keyword']) ?  $_GET['val_keyword'] : (isset($_POST['val_keyword']) ? $_POST['val_keyword'] : '');
	$val_keyword_type = isset($_GET['val_keyword_type']) ?  $_GET['val_keyword_type'] : (isset($_POST['val_keyword_type']) ? $_POST['val_keyword_type'] : '');
	$tag_keyword = isset($_GET['tag_keyword']) ?  $_GET['tag_keyword'] : (isset($_POST['tag_keyword']) ? $_POST['tag_keyword'] : '');

	$sql = FileUploadList::find()->where("id = '".$file_id."'")->one();
	$txt_data = $sql->textx_data;

	$checkKeyword = DeleteWords::find()->all();
	$resultArray = array();
	foreach ($checkKeyword as $ch) {
		$resultArray[] = $ch['word'];
	}

	// $remember = RememberWords::find()->where("keyword = '".$val_keyword."'")->one();
	$delete_remember = RememberWords::find()->where("keyword = '".$val_keyword."'")->one()->delete();

	if (!in_array($val_keyword, $resultArray))
	{
		$model = new DeleteWords();
		$model->word = $val_keyword;
		$model->tag = $val_keyword_type;
		$model->save();

	}

	$str_replace = str_replace($tag_keyword,$val_keyword,$txt_data);

	$model = FileUploadList::findOne($file_id);
	$model->textx_data = $str_replace;

	if ($model->update()) {
		$output['status'] = 1;
	}else{
		$output['status'] = 0;
	}
	echo json_encode($output);

}

if ($type=='add-keyword') {

	$file_id = isset($_GET['file_id']) ?  $_GET['file_id'] : (isset($_POST['file_id']) ? $_POST['file_id'] : '');
	$aKeyword = isset($_GET['aKeyword']) ?  $_GET['aKeyword'] : (isset($_POST['aKeyword']) ? $_POST['aKeyword'] : '');
	$tag_keyword = isset($_GET['tag_keyword']) ?  $_GET['tag_keyword'] : (isset($_POST['tag_keyword']) ? $_POST['tag_keyword'] : '');
	$tag = isset($_GET['tag']) ?  $_GET['tag'] : (isset($_POST['tag']) ? $_POST['tag'] : '');

	$sql = FileUploadList::find()->where("id = '".$file_id."'")->one();
	$txt_data = $sql->textx_data;

	$checkKeyword = RememberWords::find()->all();
	$resultArray = array();
	foreach ($checkKeyword as $ch) {
		$resultArray[] = $ch['keyword'];
	}

	if (!in_array($aKeyword, $resultArray))
	{
		$model = new RememberWords();
		$model->keyword = $aKeyword;
		$model->tag = $tag;
		$model->save();
	}

	$str_replace_add = str_replace($aKeyword,$tag_keyword,$txt_data);

	$model = FileUploadList::findOne($file_id);
	$model->textx_data = $str_replace_add;

	if ($model->update()) {
		$output['status'] = 1;
	}else{
		$output['status'] = 0;
	}
	echo json_encode($output);

}

if ($type=='add-data-array') {

	$file_id = isset($_GET['file_id']) ?  $_GET['file_id'] : (isset($_POST['file_id']) ? $_POST['file_id'] : '');
	$person = isset($_GET['person']) ?  $_GET['person'] : (isset($_POST['person']) ? $_POST['person'] : '');
	$location = isset($_GET['location']) ?  $_GET['location'] : (isset($_POST['location']) ? $_POST['location'] : '');
	$organization = isset($_GET['organization']) ?  $_GET['organization'] : (isset($_POST['organization']) ? $_POST['organization'] : '');
	$date = isset($_GET['date']) ?  $_GET['date'] : (isset($_POST['date']) ? $_POST['date'] : '');
	$time = isset($_GET['time']) ?  $_GET['time'] : (isset($_POST['time']) ? $_POST['time'] : '');
	$email = isset($_GET['email']) ?  $_GET['email'] : (isset($_POST['email']) ? $_POST['email'] : '');
	$len = isset($_GET['len']) ?  $_GET['len'] : (isset($_POST['len']) ? $_POST['len'] : '');
	$phone = isset($_GET['phone']) ?  $_GET['phone'] : (isset($_POST['phone']) ? $_POST['phone'] : '');
	$url = isset($_GET['url']) ?  $_GET['url'] : (isset($_POST['url']) ? $_POST['url'] : '');
	$zip = isset($_GET['zip']) ?  $_GET['zip'] : (isset($_POST['zip']) ? $_POST['zip'] : '');
	$money = isset($_GET['money']) ?  $_GET['money'] : (isset($_POST['money']) ? $_POST['money'] : '');
	$lew = isset($_GET['lew']) ?  $_GET['lew'] : (isset($_POST['lew']) ? $_POST['lew'] : '');


	$sql = FileUploadList::find()->where("id = '".$file_id."'")->one();
	$txt_data = $sql->textx_data;
	$text_extract = $sql->text_extract;

	$detail = '{ 
		"stuff": {
			"text_extract": '.$text_extract.',
			"text_data": "'.$txt_data.'",
			"data": {
				"person": ['.json_encode($person).'],
				"location": ['.json_encode($location).'],
				"organization": ['.json_encode($organization).'],
				"date": ['.json_encode($date).'],
				"time": ['.json_encode($time).'],
				"len": ['.json_encode($len).'],
				"phone": ['.json_encode($phone).'],
				"url": ['.json_encode($url).'],
				"zip": ['.json_encode($zip).'],
				"money": ['.json_encode($money).'],
				"lew": ['.json_encode($lew).'],
			}
		}
	}';

	$model = FileUploadList::findOne($file_id);
	$model->data_array = $detail;
	if ($model->update()) {
		$output['status'] = 1;
	}else{
		$output['status'] = 0;
	}
	echo json_encode($output);

}

if ($type=='show-array-data') {

	$sql = FileUploadList::find()->where("id = 141")->one();
	$txt_data = $sql->textx_data;

	$checkKeyword = RememberWords::find()->all();
	$resultArray = array();
	$remember = array();
	foreach ($checkKeyword as $ch) {
		$resultArray[] = $ch['keyword'];
		$remember[] = "<".$ch['tag'].">".$ch['keyword']."</".$ch['tag'].">";
	}

	echo str_replace($resultArray, $remember, $txt_data);


}







?>
<?php
use common\models\Images;
use common\models\Place;

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token'); 
header('Content-Type: application/json'); 
$type = isset($_GET['type'])?$_GET['type']:(isset($_POST['type'])?$_POST['type']:''); 
$key_images = isset($_GET['key_images'])?$_GET['key_images']:(isset($_POST['key_images'])?$_POST['key_images']:''); 

if ($type == 'upload') {
if (count($_FILES[ 'fileOther' ]) > 0) {
foreach ($_FILES[ 'fileOther' ][ 'tmp_name' ] as $index => $tmpName) {
// var_dump($_FILES[ 'fileOther' ][ 'name' ][ $index ]); 

if ( ! empty($_FILES[ 'fileOther' ][ 'error' ][ $index ])) {
return false; 
}

	$countimages = Images::find()->where(['key_images' => $key_images])->andWhere(['important'=>1])->count();
	$random = substr(str_shuffle ("0123456789"), 0, 10); 
		$date_create = date('Y-m-d'); 

		$img_name = $_FILES["fileOther"]["name"][ $index ]; 
		$file_array = explode(".", $img_name); 
		$file_extension = end($file_array); 
		$img_name = $random . '-' . date('ymdhis') . '.' . $file_extension; 
		$location = '../../images/images_upload_forform/' . $img_name; 
        // $location = Yii::getAlias('@webroot').'/images_upload_forform/' . $img_name; 




if ( ! empty($tmpName) && is_uploaded_file($tmpName)) {
move_uploaded_file($tmpName, $location); 

		$important = ($countimages>0)? 0:($index==0)?1:0;
			
	    $model = new Images;
		$model->name = $img_name;
		$model->date_create = date("Y-m-d H:i:s");
		$model->key_images = $key_images;
		$model->important = $important;
		if ($model->insert()) {
			$output['status'] = 1;
		} else {
			$output['status'] = 0;
		}
		echo json_encode($output);
}
}
}
}


if ($type == 'show') {
    	$query = Images::find()
			->where(['key_images' => $key_images])
			->all();
            $count = 0;
		$resultArray = array();
		foreach ($query as $row) {
            $resultArray[] = array(
				'no' => $count,
                'id' => $row['id'],
				'name' => $row['name'],
				'date_create' => $row['date_create'],
				'key_images' => $row['key_images'],
                'important' => $row['important'],
			);
        }
        echo json_encode($resultArray);
}

if ($type == 'setting_important') {
	if (isset($_POST["img_id"])) {
			$model = Images::find()->where(['id' => $_POST["img_id"]])->one();
			$model->important = 1;
			$model->save();

			$model = Place::find()->where(['key_images' => $_POST["key_images"]])->one();
			if($model!=null){
			$model->name_img_important = $_POST['img_name'];
			$model->save();
	}

			Images::updateAll(['important' => 0], ['and',['<>', 'id', $_POST["img_id"]],['key_images'=>$_POST['key_images']]]);
		}
}

if ($type == "delete") {
	if(isset($_POST["img_id"]))
	{
		// echo $_POST["img_name"];
		$file_path = '../../images/images_upload_forform/' . $_POST["img_name"];
		if(unlink($file_path))
		{
			$model = Images::findOne($_POST["img_id"]);
			$model->delete();
			
		}
	}
}



?>
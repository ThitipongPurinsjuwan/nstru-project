<?php
use common\models\Place;
use common\models\Images;
use common\models\TypePlace;

$type = $_GET['type'];


if($type=='somedata'){
$arr_id = $_POST['arr_id'];

 $query =  Place::find()
 ->where(['id'=>$arr_id])
                    ->orderBy([
                        'name'=>SORT_ASC,
                    ])
                    ->all();

$resultArray = array();
		foreach ($query as $row) {
            $Images = Images::find()->where(['key_images' => $row["key_images"]])->andWhere(['important'=>1])->one();
            $TypePlace = TypePlace::find()->where(['id' => $row["type"]])->one();
            $resultArray[] = array(
                'id' => $row['id'],
				'name' => $row['name'],
				'type' => $row['type'],
				'latitude' => (float)$row['latitude'],
                'longitude' => (float)$row['longitude'],
                'name_img_important' => $Images['name'],
                'icon_marker' => $TypePlace['images'],
                'contact' => $row['contact'],
                'price' => $row['price'],
                'business_day' => $row['business_day'],
                'business_hours' => str_replace(","," - ",$row['business_hours'])." น.",
			);
        }
        echo json_encode($resultArray);
    }


    
if($type=='alldata'){

 $query =  Place::find()
                    ->orderBy([
                        'name'=>SORT_ASC,
                    ])
                    ->all();

$resultArray = array();
		foreach ($query as $row) {
            $Images = Images::find()->where(['key_images' => $row["key_images"]])->andWhere(['important'=>1])->one();
            $TypePlace = TypePlace::find()->where(['id' => $row["type"]])->one();
            $resultArray[] = array(
                'id' => $row['id'],
				'name' => $row['name'],
				'type' => $row['type'],
				'latitude' => (float)$row['latitude'],
                'longitude' => (float)$row['longitude'],
                'name_img_important' => $Images['name'],
                'icon_marker' => $TypePlace['images'],
                'contact' => $row['contact'],
                'price' => $row['price'],
                'business_day' => $row['business_day'],
                'business_hours' => str_replace(","," - ",$row['business_hours'])." น.",
			);
        }
        echo json_encode($resultArray);
    }


?>
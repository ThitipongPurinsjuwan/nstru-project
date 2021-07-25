<?php
use common\models\Place;
use common\models\Images;
use common\models\TypePlace;

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
                'detail' => $row['details'],
                'price' => $row['price'],
			);
        }
        echo json_encode($resultArray);


?>
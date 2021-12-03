<?php

namespace frontend\controllers;

use common\models\Place;
use common\models\TypePlace;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class TravelMapController extends Controller
{
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }

  public function actionIndex()
  {
    $modelPlaceTemp = Place::find()->asArray()->all();
    $modelType = TypePlace::find()->asArray()->all();

    for ($i = 0; $i < count($modelPlaceTemp); $i++) {
      if (is_numeric($modelPlaceTemp[$i]['latitude']) && is_numeric($modelPlaceTemp[$i]['longitude'])) {
        unset($modelPlaceTemp[$i]);
        continue;
      }

      $modelPlaceTemp[$i]['type_name'] = $this->getNameTypePlaceWithId($modelPlaceTemp[$i]['type'], $modelType);
      $modelPlaceTemp[$i]['icon'] = '../../images/image_maker/' . $this->getTypeImage($modelPlaceTemp[$i]['type'], $modelType);
    }

    $modelPlace = array_values($modelPlaceTemp);

    $objTypePlace = $this->getObjTypePlace($modelType);
    $iconsMap = $this->getIconsMap($modelType);
    dd($modelPlace);
    return $this->render('index', [
      'modelPlace' => $modelPlace,
      'modelType' => $modelType,
      'iconsMap' => $iconsMap,
      'objTypePlace' => $objTypePlace,
    ]);
  }


  public function getIconsMap($model)
  {
    $icons = [];

    for ($i = 0; $i < count($model); $i++) {
      array_push($icons, '../../images/image_maker/' . $model[$i]['images']);
    }

    return $icons;
  }

  public function getObjTypePlace($model)
  {
    $obj = [];

    for ($i = 0; $i < count($model); $i++) {
      $key = $model[$i]['name_eng'];
      $key = $this->handleFormatStringName($key);

      $obj[$key] = $model[$i]['name'];
    }

    return $obj;
  }

  public function handleFormatStringName($name)
  {
    $pattern = '[\W|\d]';
    $split = preg_split($pattern, $name);

    $text = '';
    for ($i = 0; $i < count($split); $i++) {
      $text .= $split[$i];
    }

    return $text;
  }

  public function getNameTypePlaceWithId($id, $modelType)
  {
    $key = array_search($id, array_column($modelType, 'id'));

    return $this->handleFormatStringName($modelType[$key]['name_eng']);
  }

  public function getTypeImage($typeId, $modelType)
  {
    for ($i = 0; $i < count($modelType); $i++) {
      if ($typeId == $modelType[$i]['id']) {
        return $modelType[$i]['images'];
      }
    }

    return null;
  }
}

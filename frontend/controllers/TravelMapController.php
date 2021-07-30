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
    $modelPlace = Place::find()->asArray()->all();
    $modelType = TypePlace::find()->asArray()->all();

    for ($i = 0; $i < count($modelPlace); $i++) {
      $modelPlace[$i]['type_name'] = $this->getTypePlace($modelPlace[$i]['type']);
      $modelPlace[$i]['icon'] = '../../images/image_maker/' . $this->getTypeImage($modelPlace[$i]['type'], $modelType);
    }

    return $this->render('index', [
      'modelPlace' => $modelPlace,
      'modelType' => $modelType,
    ]);
  }

  public static function getTypePlace($typeId)
  {
    $addTo = 'others';

    if ($typeId == 1) {
      $addTo = 'attraction';
    } elseif ($typeId == 2) {
      $addTo = 'hostel';
    } elseif ($typeId == 3) {
      $addTo = 'restaurant';
    }

    return $addTo;
  }

  public static function getTypeImage($typeId, $modelType)
  {
    for ($i = 0; $i < count($modelType); $i++) {
      if ($typeId == $modelType[$i]['id']) {
        return $modelType[$i]['images'];
      }
    }

    return null;
  }
}

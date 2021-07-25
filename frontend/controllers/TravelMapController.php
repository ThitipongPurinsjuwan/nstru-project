<?php

namespace frontend\controllers;

use common\models\Place;
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
    $modelPlace = Place::find()->all();
    // echo "<pre>";
    // print_r($modelPlace);
    // echo "</pre>";
    // exit;
    return $this->render('index', [
      'modelPlace' => $modelPlace,
    ]);
  }
}

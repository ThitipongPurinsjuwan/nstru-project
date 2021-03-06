<?php

namespace frontend\controllers;

use Yii;
use common\models\Package;
use app\models\PackageSearch;
use common\models\Images;
use common\models\Place;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PackageController implements the CRUD actions for Package model.
 */
class PackageController extends Controller
{
  /**
   * {@inheritdoc}
   */
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

  /**
   * Lists all Package models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new PackageSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    $query = $dataProvider->query;
    $listOfDateMoment = Package::find()->select(['date_moment'])->groupBy(['date_moment'])->asArray()->all();

    $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9]);
    $model = $query->offset($pages->offset)->limit($pages->limit)->all();

    return $this->render('index', [
      'pages' => $pages,
      'model' => $model,
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'listOfDateMoment' => $listOfDateMoment,
    ]);
  }

  /**
   * Displays a single Package model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $modelImage = Images::find()->where(['key_images' => $model->key_images])->all();

    $modelPlaceArray = [];
    $str = explode(",", $model->place);

    for ($i = 0; $i < count($str); $i++) {
      $model_r = explode('"', $str[$i])[1];
      array_push($modelPlaceArray, (int)$model_r);
    }

    $modelPlace = Place::find()->where(['in', 'id', $modelPlaceArray])->all();

    return $this->render('view', [
      'model' => $model,
      'modelImage' => $modelImage,
      'modelPlace' => $modelPlace,
    ]);
  }

  /**
   * Creates a new Package model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Package();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing Package model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Package model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the Package model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Package the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Package::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
  }
}

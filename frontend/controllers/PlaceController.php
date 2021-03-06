<?php

namespace frontend\controllers;

use Yii;
use common\models\Images;
use common\models\Package;
use common\models\Place;
use common\models\Review;
use common\models\TypePlace;
use frontend\models\PlaceSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlaceController implements the CRUD actions for Place model.
 */
class PlaceController extends Controller
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
   * Lists all Place models.
   * @return mixed
   */
  public function actionIndex($type)
  {
    $searchModel = new PlaceSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    $query = $dataProvider->query;

    $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9]);
    $model = $query->offset($pages->offset)->limit($pages->limit)->all();
    $nameOfType = TypePlace::find()->where(['id' => $type])->one()->name;

    return $this->render('index', [
      'type' => $type,
      'pages' => $pages,
      'model' => $model,
      'nameOfType' => $nameOfType,
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Place model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    // $review = new Review();

    $model = $this->findModel($id);
    $modelImage = Images::find()->where(['key_images' => $model->key_images])->all();
    $modelPackage = Package::find()->where(['like', 'place', $model->id])->all();
    $modelReview = Review::find()->where(['place_id' => $model->id])->all();

    $openDay = Place::getOpenDay($model->business_day);
    $openHour = Place::getOpenHour($model->business_hours);

    return $this->render('view', [
      'model' => $model,
      'modelImage' => $modelImage,
      'modelReview' => $modelReview,
      'modelPackage' => $modelPackage,
      'openDay' => $openDay,
      'openHour' => $openHour,
    ]);
  }


  public function actionSaveComment($id)
  {
    if ($_POST['save_comment']) {
      $model = new Review();

      $model->place_id = $id;
      $model->message = $_POST['comment_message'];
      $model->rating = 5;
      $model->created_at = date('Y-m-d');
      $model->user_create = 1;

      if ($model->save(true)) {
        return $this->redirect(['view', 'id' => $id]);
      }
    }
  }

  /**
   * Creates a new Place model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Place();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing Place model.
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
   * Deletes an existing Place model.
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
   * Finds the Place model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Place the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Place::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
  }
}

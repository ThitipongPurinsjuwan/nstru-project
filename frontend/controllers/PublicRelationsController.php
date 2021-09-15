<?php

namespace frontend\controllers;

use Yii;
use common\models\Images;
use common\models\PublicRelations;
use frontend\models\PublicRelationsSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PublicRelationsController implements the CRUD actions for PublicRelations model.
 */
class PublicRelationsController extends Controller
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
   * Lists all PublicRelations models.
   * @return mixed
   */
  public function actionIndex($type)
  {
    $model = PublicRelations::find()->where(['type' => $type]);

    $pages = new Pagination(['totalCount' => $model->count(), 'pageSize' => 8]);
    $model = $model->offset($pages->offset)->limit($pages->limit)->all();

    return $this->render('index', [
      'type' => $type,
      'pages' => $pages,
      'model' => $model,
    ]);
  }

  /**
   * Displays a single PublicRelations model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $modelImage = Images::find()->where(['key_images' => $model->key_images])->all();

    return $this->render('view', [
      'model' => $model,
      'modelImage' => $modelImage,
    ]);
  }

  public function actionInfoView($id)
  {
    $model = $this->findModel($id);
    $modelImages = Images::find()->where(['key_images' => $model->key_images])->asArray()->all();

    return $this->render('info-view', [
      'model' => $model,
      'modelImages' => $modelImages,
    ]);
  }

  /**
   * Creates a new PublicRelations model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new PublicRelations();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing PublicRelations model.
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
   * Deletes an existing PublicRelations model.
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
   * Finds the PublicRelations model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return PublicRelations the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = PublicRelations::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
  }
}

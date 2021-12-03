<?php

namespace backend\controllers;

use Yii;
use common\models\Place;
use backend\models\PlaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Images;

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
    public function actionIndex()
    {
        $searchModel = new PlaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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

            $image = Images::find()->where(['key_images' => $model->key_images])->andWhere(['important'=>1])->one();
            $update_image = Place::find()->where(['id' => $model->id])->one();
            	if($update_image!=null){
			$update_image->name_img_important = $image->name;
			$update_image->save();
            }


            return $this->redirect(['view', 'id' => $model->id, 'type' => $model->type]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateOtop() 
    {
        $model = new Place();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $image = Images::find()->where(['key_images' => $model->key_images])->andWhere(['important'=>1])->one();
            $update_image = Place::find()->where(['id' => $model->id])->one();
            	if($update_image!=null){
			$update_image->name_img_important = $image->name;
			$update_image->save();
            }


            return $this->redirect(['view', 'id' => $model->id, 'type' => $model->type]);
        }

        return $this->render('create-otop', [
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
            return $this->redirect(['view', 'id' => $model->id, 'type' => $model->type]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionUpdateOtop($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'type' => $model->type]);
        }

        return $this->render('update-otop', [
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
        $gettype = Place::find()->where(['id' => $id])->one();
        Images::deleteAll(['key_images'=>$gettype->key_images]);
        
        $this->findModel($id)->delete();

        return $this->redirect(['index','type'=>$gettype->type]);
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
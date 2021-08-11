<?php

namespace backend\controllers;

use Yii;
use app\models\TypePlace;
use app\models\TypePlaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Images;
use common\models\Place;
use yii\web\Response;

/**
 * TypePlaceController implements the CRUD actions for TypePlace model.
 */
class TypePlaceController extends Controller
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
                    'delete-all' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TypePlace models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TypePlaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TypePlace model.
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
     * Creates a new TypePlace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TypePlace();

       if ($model->load(Yii::$app->request->post())) {
            $model->images = $model->upload($model,'images');
            if (!empty($model->images )) {
                if ($model->validate()) {

                 if($model->save())

                  $image = Images::find()->where(['key_images' => $model->key_images])->andWhere(['important'=>1])->one();
            $update_image = TypePlace::find()->where(['id' => $model->id])->one();
            	if($update_image!=null){
			$update_image->name_img_important = $image->name;
			$update_image->save();
            }
                   
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {

                    $errors = $model->errors;
                }
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TypePlace model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post())) {
 if ($model->validate()) {
            $model->images = $model->upload($model,'images');

            if($model->images!=$_POST['file_name_old']){
                if(!empty($_POST['file_name_old'])){
                    // unlink(Yii::getAlias('@webroot').'/uploads/'.$_POST['file_name_old']);
                     unlink('../../images/image_maker/'.$_POST['file_name_old']);
                }
            }

            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
      } else {

        $errors = $model->errors;
    }
}


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TypePlace model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       
        $gettype = TypePlace::find()->where(['id' => $id])->one();
        Images::deleteAll(['key_images'=>$gettype->key_images]);

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteAll($id)
    {
       
        Place::deleteAll(['type'=>$id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionDeleteAndChange($id,$newtype)
    {
        Place::updateAll(['type' => $newtype]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSelectType($id)
    {
       
        $query_type = TypePlace::find()->where(['<>','id', $id])->all();

        $response = Yii::$app->response;
    $response->format = \yii\web\Response::FORMAT_JSON;
    $response->data = $query_type;

    return $response;

        // return $this->redirect(['index']);
    }


    /**
     * Finds the TypePlace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TypePlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TypePlace::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
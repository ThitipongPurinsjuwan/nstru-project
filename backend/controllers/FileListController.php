<?php

namespace backend\controllers;

use Yii;
use app\models\FileList;
use app\models\FileListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FileListController implements the CRUD actions for FileList model.
 */
class FileListController extends Controller
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
     * Lists all FileList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FileList model.
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
     * Creates a new FileList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FileList();

    //     if ($model->load(Yii::$app->request->post())) {
    //         // if ($model->type==1) {
    //         //     $model->file_name = $model->upload($model,'file_name');
    //         //     $model->cover_images = $model->upload_cover($model,'cover_images');
    //         // }
    //         if($model->save())
    //           return $this->redirect(['view', 'id' => $model->id]);
    //   } 
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
    }

      return $this->render('create', [
        'model' => $model,
    ]);
  }

    /**
     * Updates an existing FileList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post())) {
    //         // if ($model->type==1) {
    //         //     $model->file_name = $model->upload($model,'file_name');

                
    //         //     if($model->file_name!=$_POST['file_name_old']){
    //         //         if(!empty($_POST['file_name_old'])){
    //         //         unlink('../../deposit_files/'.$_POST['file_name_old']);
    //         //         }
    //         //     }
            

            
    //         //     $model->cover_images = $model->upload_cover($model,'cover_images');
    //         //     if($model->cover_images!=$_POST['cover_img_old']){
    //         //         if(!empty($_POST['cover_img_old'])){
    //         //         unlink('../../deposit_files/'.$_POST['cover_img_old']);
    //         //         }
    //         //     }
    

    //         // }
    //         if($model->save())
    //           return $this->redirect(['view', 'id' => $model->id]);
    //   }
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
    }

      return $this->render('update', [
        'model' => $model,
    ]);
  }

    /**
     * Deletes an existing FileList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $data = FileList::findOne($id);
        //$path = 'https://www.friends1935.com/';
        unlink('../../deposit_files/'.$model->cover_images);
        unlink('../../deposit_files/'.$model->file_name);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FileList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

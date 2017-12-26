<?php

namespace frontend\controllers;

use frontend\models\CreateOccasion;
use frontend\models\UpdateOccasion;
use Yii;
use common\models\Occasion;
use common\models\OccasionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OccasionController implements the CRUD actions for Occasion model.
 */
class OccasionController extends Controller
{
    
    // set the layout to be views/layouts/bodydata.php
    public $layout = 'bodydata';
    
    /**
     * @inheritdoc
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
     * Lists all Occasion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OccasionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single Occasion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Creates a new Occasion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreateOccasion();
        $model->setUserId(Yii::$app->user->identity->getId());
        
        if ($model->load(Yii::$app->request->post()) && $occasion = $model->signup()) {
            return $this->redirect(['create']);
        } else {
            return $this->render('createoccasion', [
                'model' => $model
            ]);
        }
    }
    
    /**
     * Updates an existing Occasion model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new UpdateOccasion();
        $model->setUserId(Yii::$app->user->identity->getId());
        $model->setOccasion(Occasion::findOne($id));
        
        if ($model->load(Yii::$app->request->post()) && $occasion = $model->update()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('updateoccasion', [
                'model' => $model
            ]);
        }
    }
    
    /**
     * Deletes an existing Occasion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    
    /**
     * Quick deletes end time of a existing occasion.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteendtime($id) {
        $occasion = Occasion::findOne($id);
        $occasion->end_time = null;
        $occasion->save();
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Occasion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Occasion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Occasion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
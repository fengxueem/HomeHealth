<?php

namespace frontend\controllers;

use Yii;
use common\models\Camera;
use frontend\models\CreateCamera;
use frontend\models\MyCamera;
use frontend\models\SharingCamera;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class CameraController extends Controller
{
    public $layout = 'camera';
    /**
     * Lists all Camera models.
     * @return mixed
     */
    
    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['mycamera']);
        } else {
            $this->redirect(['site/login']);
        }
    }
    
    public function actionMycamera()
    {
        $searchModel = new MyCamera();
        $dataProvider = $searchModel->search( Yii::$app->user->identity->getId(),Yii::$app->request->queryParams);
        
        return $this->render('myCamera', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Creates a new camera model.
     * If creation is successful, the browser will be redirected to the 'mycamera' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreateCamera();
        $model->setOwnerId(Yii::$app->user->identity->getId());
        
        if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
            return $this->redirect(['mycamera']);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Lists all sharing cameras.
     *
     * @return mixed
     */
    public function actionOtherscamera()
    {
        $searchModel = new SharingCamera();
        $dataProvider = $searchModel->search(Yii::$app->user->identity->getId(),Yii::$app->request->queryParams);
        
        return $this->render('othersCamera', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Camera::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

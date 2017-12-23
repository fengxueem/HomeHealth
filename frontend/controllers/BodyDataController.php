<?php

namespace frontend\controllers;

use common\models\PhysiologicalDataEntry;
use frontend\models\QuickRecord;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class BodyDataController extends Controller
{
    
    // set the layout to be views/layouts/bodydata.php
    public $layout = 'bodydata';
    
    /**
     * Lists all Camera models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionAdd() {
        $model = new QuickRecord();
        $model->setUserId(Yii::$app->user->identity->getId());
        
        if ($model->load(Yii::$app->request->post()) && $entry = $model->signup()) {
            return $this->redirect(['add']);
        } else {
            return $this->render('add', [
                'model' => $model
            ]);
        }
    }
}

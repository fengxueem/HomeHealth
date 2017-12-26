<?php

namespace frontend\controllers;

use frontend\models\QuickRecord;
use Yii;
use yii\web\Controller;

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
        $userId = Yii::$app->user->identity->getId();
        $model->setUserId($userId);
        
        if ($model->load(Yii::$app->request->post()) && $entry = $model->signup()) {
            return $this->redirect(['add']);
        } else {
            return $this->render('add', [
                'model' => $model,
                'id' => $userId,
            ]);
        }
    }
    
}

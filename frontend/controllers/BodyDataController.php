<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class BodydataController extends Controller
{
    
    /**
     * Lists all Camera models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

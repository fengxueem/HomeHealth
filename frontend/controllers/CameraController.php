<?php

namespace frontend\controllers;

use Yii;
use common\models\Camera;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class CameraController extends Controller
{

    /**
     * Lists all Camera models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
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

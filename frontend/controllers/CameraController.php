<?php

namespace frontend\controllers;

use Yii;
use common\models\Camera;
use frontend\models\CreateCamera;
use frontend\models\MyCamera;
use frontend\models\SharingCamera;
use frontend\models\FindUserForm;
use yii\db\IntegrityException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\SharedCamera;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class CameraController extends Controller
{
    // disable csrf validation to let post request go through
    public $enableCsrfValidation = false;
    
    // set the layout to be views/layouts/camera.php
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
        
        if ($model->load(Yii::$app->request->post()) && $camera = $model->signup()) {
            return $this->redirect(['mycamera']);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }
    
    public function actionShare($id)
    {
        $request = Yii::$app->request;
        $findUser = new FindUserForm();
        $user = null;
        $error = '';
        // $user only exists when a post arrives, it normally should be null.
        if ($request->isPost) {
            if ($request->get('targetname') == null) {
                // don't run a self lookup
                if ($findUser->load(Yii::$app->request->post()) && $findUser->validate() && $findUser->targetname != Yii::$app->user->identity->username) {
                    $user = User::findByUsername($findUser->targetname);
                }
            } else {
                // if a targetname is found in get(),
                // it means the client does want to share this camera with him.
                $user = User::findByUsername($request->get('targetname'));
                if ($user != null) {
                    $share = new SharedCamera();
                    $share->camera_id = $id;
                    $share->user_id = $user->id;
                    // 2 means pending status
                    $share->status = 2;
                    try  {
                        $share->save();
                        return $this->redirect(['mycamera']);
                    } catch (\Exception $e) {
                        // since (camera_id, user_id) is an unique key in database,
                        // it's possible to save the same pair more than once,
                        // we need to catch this integrity exception here.
                        if ($e instanceof IntegrityException) {
                            $error = Yii::t('yii', 'Camera is already shared to this user');
                        }
                    }
                }
            }
        }
        return $this->render('share', [
            'id' => $id,
            'model' => $user,
            'findUser' => $findUser,
            'error' => $error,
        ]);
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

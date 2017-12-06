<?php

namespace common\models;

use Yii;
use common\models\SharedCameraStatus;

/**
 * This is the model class for table "shared_camera".
 *
 * @property integer $camera_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $update_time
 *
 * @property Camera $camera
 * @property SharedCameraStatus $status0
 * @property User $user
 */
class SharedCamera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shared_camera';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['camera_id', 'user_id', 'status'], 'required'],
            [['camera_id', 'user_id', 'status', 'update_time'], 'integer'],
            [['camera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camera::className(), 'targetAttribute' => ['camera_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => SharedCameraStatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'camera_id' => 'Camera ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'update_time' => 'Update Time',
        ];
    }
    
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->update_time = time();
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamera()
    {
        return $this->hasOne(Camera::className(), ['id' => 'camera_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(SharedCameraStatus::className(), ['id' => 'status']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shared_camera_status".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 *
 * @property SharedCamera[] $sharedCameras
 */
class SharedCameraStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shared_camera_status';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['position'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position' => 'Position',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSharedCameras()
    {
        return $this->hasMany(SharedCamera::className(), ['status' => 'id']);
    }
}
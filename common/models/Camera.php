<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "camera".
 *
 * @property integer $id
 * @property string $url
 * @property string $nickname
 * @property string $password
 * @property integer $owner_id
 *
 * @property User $owner
 */
class Camera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camera';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'nickname', 'password'], 'required'],
            [['owner_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['nickname'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 8],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => '链接',
            'nickname' => '名称',
            'password' => '密码',
            'owner_id' => '所有人',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
}
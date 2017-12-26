<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "occasion".
 *
 * @property integer $id
 * @property integer $start_time
 * @property integer $end_time
 * @property string $illness
 * @property string $hospital
 * @property integer $user_id
 *
 * @property User $user
 * @property PhysiologicalDataEntry[] $physiologicalDataEntries
 */
class Occasion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'occasion';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'illness', 'hospital', 'user_id'], 'required'],
            [['start_time', 'end_time', 'user_id'], 'integer'],
            ['end_time', 'compare', 'compareAttribute' => 'start_time', 'operator' => '>=', 'type' => 'number'],
            [['illness', 'hospital'], 'string', 'max' => 255],
            [['start_time', 'illness', 'hospital', 'user_id'], 'unique', 'targetAttribute' => ['start_time', 'illness', 'hospital', 'user_id'], 'message' => 'The combination of Start Time, Illness, Hospital and User ID has already been taken.'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'illness' => 'Illness',
            'hospital' => 'Hospital',
            'user_id' => 'User ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysiologicalDataEntries()
    {
        return $this->hasMany(PhysiologicalDataEntry::className(), ['occasion_id' => 'id']);
    }
}
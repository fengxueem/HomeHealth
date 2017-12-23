<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "physiological_data_entry".
 *
 * @property integer $id
 * @property integer $time
 * @property integer $update_time
 * @property double $value
 * @property integer $user_id
 * @property integer $type_id
 * @property integer $occasion_id
 *
 * @property Occasion $occasion
 * @property PhysiologicalDataType $type
 * @property User $user
 */
class PhysiologicalDataEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'physiological_data_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'value', 'user_id', 'type_id'], 'required'],
            [['update_time', 'time', 'user_id', 'type_id', 'occasion_id'], 'integer'],
            [['value'], 'number'],
            [['time', 'occasion_id', 'type_id'], 'unique', 'targetAttribute' => ['time', 'occasion_id', 'type_id'], 'message' => 'The combination of Time, Type ID and Occasion ID has already been taken.'],
            [['occasion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occasion::className(), 'targetAttribute' => ['occasion_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhysiologicalDataType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'time' => 'Time',
            'update_time' => 'Update Time',
            'value' => 'Value',
            'user_id' => 'User ID',
            'type_id' => 'Type ID',
            'occasion_id' => 'Occasion ID',
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
    public function getOccasion()
    {
        return $this->hasOne(Occasion::className(), ['id' => 'occasion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PhysiologicalDataType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
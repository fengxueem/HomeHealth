<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "physiological_data_type".
 *
 * @property integer $id
 * @property string $unit
 * @property string $name
 * @property string $description
 * @property double $range_top
 * @property double $range_bottom
 *
 * @property PhysiologicalDataEntry[] $physiologicalDataEntries
 */
class PhysiologicalDataType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'physiological_data_type';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit', 'name'], 'required'],
            [['range_top', 'range_bottom'], 'number'],
            ['range_top', 'compare', 'compareAttribute' => 'range_bottom', 'type' => 'number', 'operator' => '>='],
            ['range_bottom', 'compare', 'compareAttribute' => 'range_top', 'type' => 'number', 'operator' => '<='],
            [['unit', 'name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 255],
            [['unit', 'name'], 'unique', 'targetAttribute' => ['unit', 'name'], 'message' => 'The combination of Unit and Name has already been taken.'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit' => 'Unit',
            'name' => 'Name',
            'description' => 'Description',
            'range_top' => 'Range Top',
            'range_bottom' => 'Range Bottom',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysiologicalDataEntries()
    {
        return $this->hasMany(PhysiologicalDataEntry::className(), ['type_id' => 'id']);
    }
}
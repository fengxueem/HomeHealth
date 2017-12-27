<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Occasion;
use common\models\PhysiologicalDataEntry;
use Yii;

/**
 * Signup form
 */
class QuickRecord extends Model
{
    public $time;
    public $str_time;
    public $value;
    public $type_id;
    public $occasion_id;
    public $user_id;
    public $str_start_time;
    public $str_end_time;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['str_time', 'value', 'type_id'], 'required'],
            ['str_time', 'compare', 'compareValue' => date('Y-m-d H:i', time()), 'operator' => '<=', 'type' => 'string'],
            ['str_time', 'compare', 'compareAttribute' => 'str_start_time','operator' => '>=', 'enableClientValidation' => false, 'message' => Yii::t('yii', 'Unvalid Date')],
            ['str_time', 'compare', 'compareAttribute' => 'str_end_time','operator' => '<=', 'enableClientValidation' => false, 'message' => Yii::t('yii', 'Unvalid Date')],
            [['type_id', 'occasion_id'], 'integer'],
            [['value'], 'number'],
            ['occasion_id', 'default', 'value' => null],
            [['str_time', 'type_id', 'occasion_id'], 'unique', 'targetClass' => PhysiologicalDataEntry::className(),'targetAttribute' => ['time', 'occasion_id', 'type_id'], 'message' => \Yii::t('yii', 'Already had a record of this Time, Type and Occasion.')],
        ];
    }
    
    public function setUserId($id) {
        $this->user_id = $id;
    } 
    
    public function load($data, $formName=null) {
        if (parent::load($data)) {
            $this->time = strtotime($this->str_time);
            if ($this->occasion_id) {
                $occasion = Occasion::findOne($this->occasion_id);
                $this->str_start_time = date('Y-m-d H:i', $occasion->start_time);
                $this->str_end_time = date('Y-m-d H:i', $occasion->end_time);
            } else {
                // if no occasion is assigned, undo the rules of start and end time
                $this->str_start_time = $this->str_end_time = $this->str_time;
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Signs entry up.
     *
     * @return PhysiologicalDataEntry|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $entry = new PhysiologicalDataEntry();
        $entry->time = $this->time;
        $entry->value = $this->value;
        $entry->user_id = $this->user_id;
        $entry->type_id = $this->type_id;
        $entry->occasion_id = $this->occasion_id;
        
        return $entry->save() ? $entry : null;
    }
}

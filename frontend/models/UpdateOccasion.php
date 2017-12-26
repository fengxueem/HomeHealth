<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Occasion;
use Yii;

/**
 * Signup form
 */
class UpdateOccasion extends Model
{
    public $start_time;
    public $str_start_time;
    public $end_time;
    public $str_end_time;
    public $illness;
    public $hospital;
    public $user_id;
    public $occasion;
    public $expected_end;
    public $expected_start;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['str_start_time', 'str_end_time', 'expected_start', 'expected_end'], 'string'],
            ['str_end_time', 'compare', 'compareAttribute' => 'expected_start', 'operator' => '>', 'enableClientValidation' => false, 'message' => Yii::t('yii', 'Unvalid Date')],
            ['str_start_time', 'compare', 'compareAttribute' => 'expected_end', 'operator' => '<', 'enableClientValidation' => false, 'message' => Yii::t('yii', 'Unvalid Date')],
            [['illness', 'hospital'], 'string', 'max' => 255],
            [['start_time', 'illness', 'hospital', 'user_id'], 'unique', 'targetAttribute' => ['start_time', 'illness', 'hospital', 'user_id'], 'message' => Yii::t('yii', 'The combination of Start Time, Illness, Hospital and User has already been taken.')],
        ];
    }
    
    public function load($data, $formName=null) {
        if (parent::load($data)) {
            $this->expected_start = date('Y-m-d H:i', min($this->occasion->start_time, strtotime($this->str_start_time)));
            $this->expected_end = date('Y-m-d H:i', max($this->occasion->end_time, strtotime($this->str_end_time)));
            if ($this->str_start_time) {
                $this->start_time = strtotime($this->str_start_time);
            } else {
                $this->expected_start = date('Y-m-d H:i', $this->occasion->start_time);
            }
            if ($this->str_end_time) {
                $this->end_time = strtotime($this->str_end_time);
            } else {
                $this->expected_end = date('Y-m-d H:i', $this->occasion->end_time);
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function setOccasion($occasion) {
        $this->occasion = $occasion;
    }
    
    public function setUserId($id) {
        $this->user_id = $id;
    } 
    
    /**
     * Signs occasion up.
     *
     * @return occasion|null the saved model or null if saving fails
     */
    public function update()
    {
        if (!$this->validate()) {
            return null;
        }
        
        if ($this->start_time) {
            $this->occasion->start_time = $this->start_time;
        }
        if ($this->end_time) {
            $this->occasion->end_time = $this->end_time;
        }
        if ($this->illness) {
            $this->occasion->illness = $this->illness;
        }
        if ($this->hospital) {
            $this->occasion->hospital = $this->hospital;
        }
        
        if ($this->occasion->save()) {
            return $this->occasion;
        } else {
            $this->addErrors($this->occasion->getErrors());
            return null;
        }
    }
    
    public function find() {
        return Occasion::find();
    }
}

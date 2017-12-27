<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Camera;
use common\models\User;
use common\models\Occasion;

/**
 * Signup form
 */
class CreateOccasion extends Model
{
    public $start_time;
    public $str_start_time;
    public $end_time;
    public $str_end_time;
    public $illness;
    public $hospital;
    public $user_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['str_start_time', 'illness', 'hospital'], 'required'],
            ['str_end_time', 'compare', 'compareAttribute' => 'str_start_time', 'operator' => '>='],
            [['illness', 'hospital'], 'string', 'max' => 255],
            [['str_start_time', 'illness', 'hospital'], 'unique', 'targetClass' => Occasion::className(), 'targetAttribute' => ['start_time', 'illness', 'hospital', 'user_id'], 'message' => \Yii::t('yii', 'Already had a record of this Time, Illness and Hospital.')],
        ];
    }
    
    public function load($data, $formName=null) {
        if (parent::load($data)) {
            $this->start_time = strtotime($this->str_start_time);
            if ($this->str_end_time) {
                $this->end_time = strtotime($this->str_end_time);
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function setUserId($id) {
        $this->user_id = $id;
    } 
    
    /**
     * Signs occasion up.
     *
     * @return occasion|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $occasion = new Occasion();
        $occasion->start_time = $this->start_time;
        $occasion->end_time = $this->end_time;
        $occasion->illness = $this->illness;
        $occasion->hospital = $this->hospital;
        $occasion->user_id = $this->user_id;
        
        return $occasion->save() ? $occasion : null;
    }
}

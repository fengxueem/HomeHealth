<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FindUserForm extends Model
{
    public $targetname;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['targetname', 'trim'],
            [['targetname'], 'required'],
            ['targetname', 'string', 'min' => 2, 'max' => 50],
        ];
    }
    
    public function attributeLabels() {
        return [
            'targetname' => Yii::t('yii', 'User Name'),
        ];
    }
}
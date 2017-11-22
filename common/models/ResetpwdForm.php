<?php
namespace common\models;

use yii\base\Model;
use common\models\User;
use common\models\Admin;

/**
 * Signup form
 */
class ResetpwdForm extends Model
{
    public $password;
    public $password_repeat;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'string', 'max' => 20],
            
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords not consistent.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'password_repeat' => '确认密码'
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }
        
        $admin = Admin::findIdentity($id);
        $admin->setPassword($this->password);
        $admin->removePasswordResetToken();
        
        return $admin->save() ? $admin : null;
    }
}

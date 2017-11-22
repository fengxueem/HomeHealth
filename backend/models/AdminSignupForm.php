<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use common\models\Admin;

/**
 * Signup form
 */
class AdminSignupForm extends Model
{
    public $username;
    public $nickname;
    public $email;
    public $phone;
    public $password;
    public $password_repeat;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Admin', 'message' => '用户名已注册.'],
            ['username', 'string', 'min' => 2, 'max' => 50],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 128],
            ['email', 'unique', 'targetClass' => '\common\models\Admin', 'message' => '邮箱已注册.'],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'max' => 20],
            ['phone', 'unique', 'targetClass' => '\common\models\Admin', 'message' => '手机已注册.'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'string', 'max' => 20],
            
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码输入不一致.'],
            
            ['nickname', 'required'],
            ['nickname', 'string', 'min' => 2, 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'nickname' => '昵称',
            'email' => '邮箱',
            'phone' => '手机',
            'password' => '密码',
            'password_repeat' => '确认密码'
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Admin();
        $user->username = $this->username;
        $user->nickname = $this->nickname;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}

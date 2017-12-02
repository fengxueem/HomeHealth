<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Camera;

/**
 * Signup form
 */
class CreateCamera extends Model
{
    public $url;
    public $nickname;
    public $password;
    public $owner_id;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['url', 'trim'],
            ['url', 'required'],
            ['url', 'unique', 'targetClass' => '\common\models\Camera', 'message' => '摄像头已注册.'],
            ['url', 'string', 'min' => 2, 'max' => 255],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'string', 'max' => 20],
            
            ['nickname', 'required'],
            ['nickname', 'string', 'min' => 2, 'max' => 50],
        ];
    }
    
    public function setOwnerId($id) {
        $this->owner_id = $id;
    } 
    
    /**
     * Signs camera up.
     *
     * @return Camera|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $camera = new Camera();
        $camera->url = $this->url;
        $camera->nickname = $this->nickname;
        $camera->password = $this->password;
        $camera->owner_id = $this->owner_id;
        
        return $camera->save() ? $camera : null;
    }
}

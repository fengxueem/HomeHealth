<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SharedCamera;
use Yii;

/**
 * SharingCamera represents the model behind the search form about `common\models\SharedCamera`.
 */
class SharingCamera extends SharedCamera
{
    
    public function attributes() {
        return array_merge(parent::attributes(),['camera.nickname','camera.password']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['camera_id', 'user_id','status','update_time'], 'integer'],
            [['camera.nickname','camera.password'], 'safe'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($userId,$params)
    {
        $query = SharedCamera::find();
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $userId,
            'camera_id' => $this->camera_id,
            'status' => $this->status,
            'update_time' => $this->update_time,
        ]);
        
        $query->join('INNER JOIN', 'camera', 'shared_camera.camera_id = camera.id');
        $query->andFilterWhere(['like', 'camera.nickname', $this->getAttribute('camera.nickname')])
            ->andFilterWhere(['like', 'camera.password', $this->getAttribute('camera.password')]);
        $dataProvider->sort->attributes['camera.nickname'] = [
            'asc' => ['camera.nickname' => SORT_ASC],
            'desc' => ['camera.nickname' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['camera.password'] = [
            'asc' => ['camera.password' => SORT_ASC],
            'desc' => ['camera.password' => SORT_DESC],
        ];
        
        return $dataProvider;
    }
}

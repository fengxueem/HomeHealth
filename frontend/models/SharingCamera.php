<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SharedCamera;

/**
 * SharingCamera represents the model behind the search form about `common\models\SharedCamera`.
 */
class SharingCamera extends SharedCamera
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['camera_id', 'user_id','status','update_time'], 'integer'],
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
        ]);
        
        $query->andFilterWhere(['like', 'camera_id', $this->camera_id])
        ->andFilterWhere(['like', 'status', $this->status])
        ->andFilterWhere(['like', 'update_time', $this->update_time]);
        
        return $dataProvider;
    }
}

<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PhysiologicalDataEntrySearch represents the model behind the search form about `common\models\PhysiologicalDataEntry`.
 */
class PhysiologicalDataEntrySearch extends PhysiologicalDataEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time', 'update_time', 'type_id', 'occasion_id'], 'integer'],
            [['value'], 'number'],
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
    public function search($params)
    {
        $query = PhysiologicalDataEntry::find();
        
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
            'id' => $this->id,
            'time' => $this->time,
            'update_time' => $this->update_time,
            'value' => $this->value,
            'type_id' => $this->type_id,
            'occasion_id' => $this->occasion_id,
        ]);
        
        return $dataProvider;
    }
}
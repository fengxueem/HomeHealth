<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PhysiologicalDataType;

/**
 * PhysiologicalDataTypeSearch represents the model behind the search form about `common\models\PhysiologicalDataType`.
 */
class PhysiologicalDataTypeSearch extends PhysiologicalDataType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['unit', 'name', 'description'], 'safe'],
            [['range_top', 'range_bottom'], 'number'],
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
        $query = PhysiologicalDataType::find();
        
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
            'range_top' => $this->range_top,
            'range_bottom' => $this->range_bottom,
        ]);
        
        $query->andFilterWhere(['like', 'unit', $this->unit])
        ->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'description', $this->description]);
        
        return $dataProvider;
    }
}
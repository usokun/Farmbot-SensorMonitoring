<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SoilMoistT;

/**
 * SoilMoistTSearch represents the model behind the search form of `app\models\SoilMoistT`.
 */
class SoilMoistTSearch extends SoilMoistT
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['val_id', 's_group_id', 'time'], 'integer'],
            [['SMoist'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = SoilMoistT::find();

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
            'val_id' => $this->val_id,
            's_group_id' => $this->s_group_id,
            'SMoist' => $this->SMoist,
            'time' => $this->time,
        ]);

        return $dataProvider;
    }
}

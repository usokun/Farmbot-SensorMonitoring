<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AirTempPressT;

/**
 * AirTempPressTSearch represents the model behind the search form of `app\models\AirTempPressT`.
 */
class AirTempPressTSearch extends AirTempPressT
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['val_id', 's_group_id', 'time'], 'integer'],
            [['ATemp', 'APress'], 'number'],
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
        $query = AirTempPressT::find();

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
            'ATemp' => $this->ATemp,
            'APress' => $this->APress,
            'time' => $this->time,
        ]);

        return $dataProvider;
    }
}

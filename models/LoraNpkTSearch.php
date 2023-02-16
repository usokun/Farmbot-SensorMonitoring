<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LoraNpkT;

/**
 * LoraNpkTSearch represents the model behind the search form of `app\models\LoraNpkT`.
 */
class LoraNpkTSearch extends LoraNpkT
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['val_id', 's_group_id', 'time'], 'integer'],
            [['T', 'H', 'PH', 'N', 'P', 'K'], 'number'],
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
        $query = LoraNpkT::find();

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
            'T' => $this->T,
            'H' => $this->H,
            'PH' => $this->PH,
            'N' => $this->N,
            'P' => $this->P,
            'K' => $this->K,
            'time' => $this->time,
        ]);

        return $dataProvider;
    }
}

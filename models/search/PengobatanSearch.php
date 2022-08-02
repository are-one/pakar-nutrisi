<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pengobatan;

/**
 * PengobatanSearch represents the model behind the search form of `app\models\Pengobatan`.
 */
class PengobatanSearch extends Pengobatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pengobatan', 'pengobatan'], 'safe'],
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
        $query = Pengobatan::find();

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
        $query->andFilterWhere(['like', 'id_pengobatan', $this->id_pengobatan])
            ->andFilterWhere(['like', 'pengobatan', $this->pengobatan]);

        return $dataProvider;
    }
}

<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Diagnosis;

/**
 * DiagnosisSearch represents the model behind the search form of `app\models\Diagnosis`.
 */
class DiagnosisSearch extends Diagnosis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_diagnosis', 'pengobatan_id_pengobatan', 'penyakit_id_penyakit', 'hasil_diagnosis', 'kondisi'], 'safe'],
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
        $query = Diagnosis::find();

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
        $query->andFilterWhere(['like', 'id_diagnosis', $this->id_diagnosis])
            ->andFilterWhere(['like', 'pengobatan_id_pengobatan', $this->pengobatan_id_pengobatan])
            ->andFilterWhere(['like', 'penyakit_id_penyakit', $this->penyakit_id_penyakit])
            ->andFilterWhere(['like', 'hasil_diagnosis', $this->hasil_diagnosis])
            ->andFilterWhere(['like', 'kondisi', $this->kondisi]);

        return $dataProvider;
    }
}

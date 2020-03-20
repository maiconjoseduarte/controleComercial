<?php

namespace frontend\modules\app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Colaborador;

/**
 * ColaboradorSearch represents the model behind the search form of `common\models\Colaborador`.
 */
class ColaboradorSearch extends Colaborador
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cargo'], 'integer'],
            [['nome'], 'safe'],
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
        $query = Colaborador::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'pagination' => ['pageSize' => 2]
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
            'cargo' => $this->cargo,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}

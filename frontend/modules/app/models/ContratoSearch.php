<?php

namespace frontend\modules\app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contrato;

/**
 * ContratoSearch represents the model behind the search form of `common\models\Contrato`.
 */
class ContratoSearch extends Contrato
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idGrupo', 'numeroLeitos', 'icms', 'enquadramento'], 'integer'],
            [['dataInicio', 'dataUltimaRenovacao', 'vencimento', 'condicaoPagamento', 'tabela', 'create_at', 'update_at'], 'safe'],
            [['totalReceitaLiquidaInicio', 'margemBrutaPonderada', 'reajustePonderado', 'margemBrutaPonderadaRenovacao', 'totalReceitaLiquidaRenovacao', 'minimo'], 'number'],
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
        $query = Contrato::find();

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
            'idGrupo' => $this->idGrupo,
            'dataInicio' => $this->dataInicio,
            'totalReceitaLiquidaInicio' => $this->totalReceitaLiquidaInicio,
            'margemBrutaPonderada' => $this->margemBrutaPonderada,
            'dataUltimaRenovacao' => $this->dataUltimaRenovacao,
            'vencimento' => $this->vencimento,
            'reajustePonderado' => $this->reajustePonderado,
            'margemBrutaPonderadaRenovacao' => $this->margemBrutaPonderadaRenovacao,
            'totalReceitaLiquidaRenovacao' => $this->totalReceitaLiquidaRenovacao,
            'minimo' => $this->minimo,
            'numeroLeitos' => $this->numeroLeitos,
            'icms' => $this->icms,
            'enquadramento' => $this->enquadramento,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'condicaoPagamento', $this->condicaoPagamento])
            ->andFilterWhere(['like', 'tabela', $this->tabela]);

        return $dataProvider;
    }
}

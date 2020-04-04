<?php

namespace frontend\modules\app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ItensContrato;

/**
 * ItensContratoSearch represents the model behind the search form of `common\models\ItensContrato`.
 */
class ItensContratoSearch extends ItensContrato
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idGrupo', 'codCliente', 'codCremer'], 'integer'],
            [['statusItem', 'statusHomologacao', 'descricao', 'unidadeMedida', 'consumoAnual', 'vigencia', 'observacao', 'create_at', 'update_at'], 'safe'],
            [['preco', 'valorMedioAnual'], 'number'],
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
    public function search($params, $idGrupo = false)
    {
        $query = ItensContrato::find();

        if ($idGrupo !=  false) {
            $query->andWhere(['idGrupo' => $idGrupo]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 100]
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
            'codCliente' => $this->codCliente,
            'codCremer' => $this->codCremer,
            'preco' => $this->preco,
            'valorMedioAnual' => $this->valorMedioAnual,
            'vigencia' => $this->vigencia,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'statusItem', $this->statusItem])
            ->andFilterWhere(['like', 'statusHomologacao', $this->statusHomologacao])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'unidadeMedida', $this->unidadeMedida])
            ->andFilterWhere(['like', 'consumoAnual', $this->consumoAnual])
            ->andFilterWhere(['like', 'observacao', $this->observacao]);

        return $dataProvider;
    }
}

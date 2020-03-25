<?php

namespace frontend\modules\app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Filial;

/**
 * FilialSearch represents the model behind the search form of `common\models\Filial`.
 */
class FilialSearch extends Filial
{
    public $pageSize = 50;

    public static $OPCOES_PAGINACAO = [50 => '50 resultados', 100 => '100 resultados', 200 => '200 resultados'];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idGrupo', 'codIsoWeb', 'icms', 'ledTime'], 'integer'],
            [['nome', 'documento', 'uf', 'nomeCidade', 'especialidade', 'cdFaturamento', 'create_at', 'update_at'], 'safe'],
            [['pageSize'], 'in', 'range' => array_keys(self::$OPCOES_PAGINACAO)],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $result = parent::attributeLabels();
        $result['pageSize'] = 'Paginação';
        return $result;
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
        $query = Filial::find();

        // add conditions that should always apply here

        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $this->pageSize]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idGrupo' => $this->idGrupo,
            'codIsoWeb' => $this->codIsoWeb,
            'icms' => $this->icms,
            'ledTime' => $this->ledTime,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'documento', $this->documento])
            ->andFilterWhere(['like', 'uf', $this->uf])
            ->andFilterWhere(['like', 'nomeCidade', $this->nomeCidade])
            ->andFilterWhere(['like', 'especialidade', $this->especialidade])
            ->andFilterWhere(['like', 'cdFaturamento', $this->cdFaturamento]);

        return $dataProvider;
    }
}

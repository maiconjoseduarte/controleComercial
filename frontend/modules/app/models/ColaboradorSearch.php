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
    public $pageSize = 50;

    public static $OPCOES_PAGINACAO = [50 => '50 resultados', 100 => '100 resultados', 200 => '200 resultados'];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cargo'], 'integer'],
            [['nome'], 'safe'],
            [['pageSize'], 'in', 'range' => array_keys(self::$OPCOES_PAGINACAO)],
        ];
    }

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
        $query = Colaborador::find();

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
            'cargo' => $this->cargo,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}

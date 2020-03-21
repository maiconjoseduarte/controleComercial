<?php

namespace frontend\modules\app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Grupo;

/**
 * GrupoSearch represents the model behind the search form of `common\models\Grupo`.
 */
class GrupoSearch extends Grupo
{
    public $pageSize = 50;

    public static $OPCOES_PAGINACAO = [50 => '50 resultados', 100 => '100 resultados', 200 => '200 resultados'];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'idGestor', 'idSuporte'], 'integer'],
            [['nome', 'create_at', 'update_at'], 'safe'],
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
        $query = Grupo::find();

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
            'status' => $this->status,
            'idGestor' => $this->idGestor,
            'idSuporte' => $this->idSuporte,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}

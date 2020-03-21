<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Colaborador".
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $cargo
 */
class Colaborador extends \yii\db\ActiveRecord
{
    const GESTOR = 1;
    const SUPORTE = 2;

    public static $OPCOES_CARGO = [
        self::GESTOR => 'Gestor',
        self::SUPORTE => 'Suporte',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Colaborador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cargo'], 'required'],
            [['id', 'cargo'], 'integer'],
            [['id'], 'unique'],
            [['nome'], 'string', 'max' => 255],
            [['cargo'], 'in', 'range' => array_keys(self::$OPCOES_CARGO)]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'nome' => 'Nome',
            'cargo' => 'Cargo',
        ];
    }

    static public function select2Data($cargo = false)
    {
        $results = [];

        $colaboradores = self::find();

        if ($cargo) {
            $colaboradores = $colaboradores->andWhere(['cargo' => $cargo])->orderBy(['nome' => SORT_ASC]);
        }

        $colaboradores = $colaboradores->all();

        /** @var Colaborador[] $colaboradores */
        if ($colaboradores != null) {
            foreach ($colaboradores as $colaborador) {
                $results[$colaborador->id] = "{$colaborador->nome}";
            }
        }

        return $results;
    }
}

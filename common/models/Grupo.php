<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "Grupo".
 *
 * @property int $id
 * @property string $nome
 * @property int|null $status
 * @property int|null $idGestor
 * @property int|null $idSuporte
 * @property string|null $create_at
 * @property string|null $update_at
 *
 * @property Colaborador $gestor
 * @property Colaborador $suporte
 * @property Contrato $contrato
 * @property Filial $filiais
 */
class Grupo extends \yii\db\ActiveRecord
{
    const CONTRATO = 1;
    const SINERGIA = 2;
    const IMCUBADORA = 3;
    const ACORDO = 4;

    public static $OPCOES_STATUS = [
        self::CONTRATO => 'Contrato',
        self::SINERGIA => 'Sinergia',
        self::IMCUBADORA => 'Incubadora',
        self::ACORDO => 'Acordo',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Grupo';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'id'], 'required'],
            [['id'], 'integer'],
            [['id'], 'unique'],
            [['create_at', 'update_at'], 'safe'],
            [['status', 'idGestor', 'idSuporte'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['status'], 'in', 'range' => array_keys(self::$OPCOES_STATUS)],
            [['idGestor'], 'exist', 'skipOnError' => true, 'targetClass' => Colaborador::className(), 'targetAttribute' => ['idGestor' => 'id']],
            [['idSuporte'], 'exist', 'skipOnError' => true, 'targetClass' => Colaborador::className(), 'targetAttribute' => ['idSuporte' => 'id']],

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
            'status' => 'Status',
            'idGestor' => 'Gestor',
            'idSuporte' => 'Suporte',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * Gets query for [[IdGestor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestor()
    {
        return $this->hasOne(Colaborador::className(), ['id' => 'idGestor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContrato()
    {
        return $this->hasMany(Contrato::className(), ['idGrupo' => 'id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiliais()
    {
        return $this->hasMany(Filial::className(), ['idGrupo' => 'id']);
    }

    /**
     * Gets query for [[IdSuporte0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuporte()
    {
        return $this->hasOne(Colaborador::className(), ['id' => 'idSuporte']);
    }

    static public function select2Data()
    {
        $results = [];

        $grupos = self::find()->all();

        /** @var Grupo[] $grupos */
        if ($grupos != null) {
            foreach ($grupos as $grupo) {
                $results[$grupo->id] = "{$grupo->id} - {$grupo->nome}";
            }
        }

        return $results;
    }
}

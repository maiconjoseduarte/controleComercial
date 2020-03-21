<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "Filial".
 *
 * @property int $id
 * @property int $idGrupo
 * @property string $nome
 * @property int|null $codIsoWeb
 * @property string|null $documento
 * @property string|null $uf
 * @property string|null $nomeCidade
 * @property int|null $codResponsavel
 * @property int|null $codSuporte
 * @property string|null $especialidade
 * @property int|null $icms
 * @property string|null $cdFaturamento
 * @property int|null $ledTime
 * @property string|null $create_at
 * @property string|null $update_at
 *
 * @property Grupo $grupo
 * @property Colaborador $responsavel
 * @property Colaborador $suporte
 */
class Filial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Filial';
    }

    /**
     * @return array
     */
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
            [['id', 'idGrupo', 'nome'], 'required'],
            [['id'], 'unique'],
            [['id', 'idGrupo', 'codIsoWeb', 'codResponsavel', 'codSuporte', 'icms', 'ledTime'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['nome', 'especialidade'], 'string', 'max' => 255],
            [['documento'], 'string', 'max' => 20],
            [['nomeCidade'], 'string', 'max' => 30],
            [['uf'], 'string', 'max' => 2],
            [['cdFaturamento'], 'string', 'max' => 5],
            [['idGrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['idGrupo' => 'id']],
            [['codResponsavel'], 'exist', 'skipOnError' => true, 'targetClass' => Colaborador::className(), 'targetAttribute' => ['codResponsavel' => 'id']],
            [['codSuporte'], 'exist', 'skipOnError' => true, 'targetClass' => Colaborador::className(), 'targetAttribute' => ['codSuporte' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Cod BPCS',
            'idGrupo' => 'Grupo',
            'nome' => 'Razão Social',
            'codIsoWeb' => 'Cod. Iso Web',
            'documento' => 'Documento',
            'uf' => 'Uf',
            'nomeCidade' => 'Cidade',
            'especialidade' => 'Especialidade do cliente',
            'codResponsavel' => 'Cod. Responsavel',
            'codSuporte' => 'Cod. Suporte',
            'icms' => 'Icms',
            'cdFaturamento' => 'Cd Faturamento',
            'ledTime' => 'Led Time',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * Gets query for [[CodResponsavel0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupo::className(), ['id' => 'idGrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsavel()
    {
        return $this->hasOne(Colaborador::className(), ['id' => 'codResponsavel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuporte()
    {
        return $this->hasOne(Colaborador::className(), ['id' => 'codSuporte']);
    }
}

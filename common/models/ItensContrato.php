<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "ItenContrato".
 *
 * @property int $id
 * @property int $idGrupo
 * @property string|null $statusItem
 * @property string|null $statusHomologacao
 * @property int|null $codCliente
 * @property int|null $codCremer
 * @property string|null $descricao
 * @property string|null $unidadeMedida
 * @property string|null $consumoAnual
 * @property float|null $preco
 * @property float|null $valorMedioAnual
 * @property string|null $vigencia
 * @property string|null $observacao
 * @property string|null $create_at
 * @property string|null $update_at
 *
 * @property Grupo $grupo
 */
class ItensContrato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ItenContrato';
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
            [['idGrupo'], 'required'],
            [['idGrupo', 'codCliente', 'codCremer'], 'integer'],
            [['preco', 'valorMedioAnual'], 'number'],
            [['vigencia', 'create_at', 'update_at'], 'safe'],
            [['statusItem', 'statusHomologacao'], 'string', 'max' => 20],
            [['descricao', 'consumoAnual', 'observacao'], 'string', 'max' => 255],
            [['unidadeMedida'], 'string', 'max' => 10],
            [['idGrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['idGrupo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idGrupo' => 'Grupo',
            'statusItem' => 'Status Item',
            'statusHomologacao' => 'Status Homologação',
            'codCliente' => 'Cod Cliente',
            'codCremer' => 'Cod Cremer',
            'descricao' => 'Descrição',
            'unidadeMedida' => 'Un Medida',
            'consumoAnual' => 'Consumo Anual',
            'preco' => 'Preço',
            'valorMedioAnual' => 'Valor Médio Anual',
            'vigencia' => 'Vigencia',
            'observacao' => 'Observação',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupo::className(), ['id' => 'idGrupo']);
    }
}

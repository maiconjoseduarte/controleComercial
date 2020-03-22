<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "Contrato".
 *
 * @property int $id
 * @property int $idGrupo
 * @property string|null $dataInicio
 * @property float|null $totalReceitaLiquidaInicio
 * @property float|null $margemBrutaPonderada
 * @property string|null $dataUltimaRenovacao
 * @property string|null $vencimento
 * @property float|null $reajustePonderado
 * @property float|null $margemBrutaPonderadaRenovacao
 * @property float|null $totalReceitaLiquidaRenovacao
 * @property string|null $condicaoPagamento
 * @property float|null $minimo
 * @property int|null $numeroLeitos
 * @property string|null $tabela
 * @property int|null $icms
 * @property int|null $enquadramento
 * @property string|null $create_at
 * @property string|null $update_at
 *
 * @property Grupo $grupo
 */
class Contrato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Contrato';
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
            [['idGrupo', 'numeroLeitos', 'icms', 'enquadramento'], 'integer'],
            [['dataInicio', 'dataUltimaRenovacao', 'vencimento', 'create_at', 'update_at'], 'safe'],
            [['totalReceitaLiquidaInicio', 'margemBrutaPonderada', 'reajustePonderado', 'margemBrutaPonderadaRenovacao', 'totalReceitaLiquidaRenovacao', 'minimo'], 'number'],
            [['condicaoPagamento', 'tabela'], 'string', 'max' => 255],
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
            'dataInicio' => 'Data Inicio',
            'totalReceitaLiquidaInicio' => 'Total Receita Liquida Inicio',
            'margemBrutaPonderada' => 'Margem Bruta Ponderada',
            'dataUltimaRenovacao' => 'Data Ultima Renovacao',
            'vencimento' => 'Vencimento',
            'reajustePonderado' => 'Reajuste Ponderado',
            'margemBrutaPonderadaRenovacao' => 'Margem Bruta Ponderada Renovacao',
            'totalReceitaLiquidaRenovacao' => 'Total Receita Liquida Renovacao',
            'condicaoPagamento' => 'Condicao Pagamento',
            'minimo' => 'Minimo',
            'numeroLeitos' => 'Numero Leitos',
            'tabela' => 'Tabela',
            'icms' => 'Icms',
            'enquadramento' => 'Enquadramento',
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

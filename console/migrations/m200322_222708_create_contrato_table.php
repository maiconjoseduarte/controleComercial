<?php

use common\models\Grupo;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%contrato}}`.
 */
class m200322_222708_create_contrato_table extends Migration
{
    const TABLE = 'Contrato';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey()->notNull(),
            'idGrupo' => $this->integer()->notNull(),
            'dataInicio' => $this->date(),
            'totalReceitaLiquidaInicio' => $this->double(),
            'margemBrutaPonderada' => $this->double(),
            'dataUltimaRenovacao' => $this->date(),
            'vencimento' => $this->date(),
            'reajustePonderado' => $this->double(),
            'margemBrutaPonderadaRenovacao' => $this->double(),
            'totalReceitaLiquidaRenovacao' => $this->double(),
            'condicaoPagamento' => $this->string(),
            'minimo' => $this->double(),
            'numeroLeitos' => $this->integer(),
            'tabela' => $this->string(),
            'icms' => $this->double(),
            'enquadramento' => $this->double(),
            'create_at' => $this->dateTime(),
            'update_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('contrato_id_grupo_grupo', self::TABLE, 'idGrupo', Grupo::tableName(), 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('contrato_id_grupo_grupo', self::TABLE);
        $this->dropTable(self::TABLE);
    }
}

<?php

use common\models\Grupo;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%itens_contrato}}`.
 */
class m200328_215744_create_itens_contrato_table extends Migration
{
    const TABLE = 'ItensContrato';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'idGrupo' => $this->integer()->notNull(),
            'statusItem' => $this->string(20),
            'statusHomologacao' => $this->string(20),
            'codCliente' => $this->integer(),
            'codCremer' => $this->integer(),
            'descricao' => $this->string(),
            'unidadeMedida' => $this->string(10),
            'consumoAnual' => $this->string(),
            'preco' => $this->double(),
            'valorMedioAnual' => $this->double(),
            'vigencia' => $this->date(),
            'observacao' => $this->string(),
            'create_at' => $this->dateTime(),
            'update_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('item_contrato_id_grupo_grupo', self::TABLE, 'idGrupo', Grupo::tableName(), 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('item_contrato_id_grupo_grupo', self::TABLE);
        $this->dropTable(self::TABLE);
    }
}

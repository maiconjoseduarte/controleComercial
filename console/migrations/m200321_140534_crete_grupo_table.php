<?php

use yii\db\Migration;

/**
 * Class m200321_140534_crete_grupo_table
 */
class m200321_140534_crete_grupo_table extends Migration
{
    const TABLE = 'Grupo';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey()->notNull(),
            'nome' => $this->string(255)->notNull(),
            'status' => $this->integer()->defaultValue(null),
            'idGestor' => $this->integer()->defaultValue(null),
            'idSuporte' => $this->integer()->defaultValue(null),
            'create_at' => $this->dateTime(),
            'update_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('grupo_id_gestor_colaborador', self::TABLE, 'idGestor', 'Colaborador', 'id');
        $this->addForeignKey('grupo_id_suporte_colaborador', self::TABLE, 'idSuporte', 'Colaborador', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('grupo_id_gestor_colaborador', self::TABLE);
        $this->dropForeignKey('grupo_id_suporte_colaborador', self::TABLE);
        $this->dropTable(self::TABLE);
    }
}

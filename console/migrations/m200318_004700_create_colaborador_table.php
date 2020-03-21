<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%colaborador}}`.
 */
class m200318_004700_create_colaborador_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Colaborador', [
            'id' => $this->primaryKey()->notNull(),
            'nome' => $this->string(),
            'cargo' => $this->integer()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Colaborador');
    }
}

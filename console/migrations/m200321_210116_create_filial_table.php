<?php

use common\models\Colaborador;
use common\models\Grupo;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%filial}}`.
 */
class m200321_210116_create_filial_table extends Migration
{
    const TABLE = 'Filial';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey()->notNull(),
            'idGrupo' => $this->integer()->notNull(),
            'nome' => $this->string()->notNull(),
            'codIsoWeb' => $this->integer(),
            'documento' => $this->string(20),
            'uf' => $this->string(2),
            'nomeCidade' => $this->string(30),
            'especialidade' => $this->string(),
            'icms' => $this->double(),
            'cdFaturamento' => $this->string(5),
            'ledTime' => $this->integer(2),
            'create_at' => $this->dateTime(),
            'update_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('filial_id_grupo_grupo', self::TABLE, 'idGrupo', Grupo::tableName(), 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('filial_id_grupo_grupo',self::TABLE);
        $this->dropTable(self::TABLE);
    }
}

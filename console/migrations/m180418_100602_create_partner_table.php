<?php

use yii\db\Migration;

/**
 * Handles the creation of table `partner`.
 */
class m180418_100602_create_partner_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%partner}}', [
            'id'   => $this->primaryKey(),
            'key'  => $this->string()->unique(),
            'hint' => $this->string()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%partner}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `business_character`.
 */
class m180221_070454_create_business_character_table extends Migration
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

        $this->createTable('{{%business_character}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%business_character}}');
    }
}

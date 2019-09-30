<?php

use yii\db\Migration;

/**
 * Handles the creation of table `business_remove`.
 */
class m180315_101529_create_business_remove_table extends Migration
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

        $this->createTable('{{%business_remove}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'removal' => $this->text()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('business_remove');
    }
}

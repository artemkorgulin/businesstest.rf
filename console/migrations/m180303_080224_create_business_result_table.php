<?php

use yii\db\Migration;

/**
 * Handles the creation of table `business_result`.
 */
class m180303_080224_create_business_result_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%business_result}}', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer(),
            'is_complete_main' => $this->integer()->notNull()->defaultValue(0),
            'is_complete_know' => $this->integer()->notNull()->defaultValue(0),
            'created_at'  => $this->integer(),
            'updated_at'  => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_btResult2user', '{{%business_result}}', 'user_id', '{{%user}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_btResult2user', '{{%business_result}}', 'user_id', '{{%user}}', 'id');
        $this->dropTable('{{%business_result}}');
    }
}

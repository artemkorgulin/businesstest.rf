<?php

use yii\db\Migration;

/**
 * Handles the creation of table `unisender_log`.
 */
class m180221_140533_create_unisender_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('unisender_log', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'email' => $this->string(),
            'request' => $this->text(),
            'response' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('unisender_log');
    }

}

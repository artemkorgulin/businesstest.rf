<?php

use yii\db\Migration;

/**
 * Handles the creation of table `unisender_backup`.
 */
class m170911_084831_create_unisender_backup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('unisender_backup', [
            'id'                => $this->primaryKey(),
            'send_id'           => $this->string(),
            'email'             => $this->string()->notNull(),
            'VAR_NAME_L'        => $this->string(),
            'VAR_NAME_F'        => $this->string(),
            'VAR_NAME_M'        => $this->string(),
            'VAR_REGION'        => $this->string(),
            'VAR_MUNICIPALITY'  => $this->string(),
            'VAR_PLACEMENT'     => $this->string(),
            'VAR_SCHOOL_TYPE'   => $this->string(),
            'VAR_SCHOOL_NAME'   => $this->string(),
            'VAR_GRADUATION'    => $this->string(),
            'VAR_ACCESS_TOKEN'  => $this->string(),
            'VAR_HAS_MSK_CITY'  => $this->integer()->defaultValue(0),
            'VAR_HAS_MSK_DIST'  => $this->integer()->defaultValue(0),
            'VAR_SEND_STATUS'   => $this->string()->defaultValue(0),
            'updated_at'        => $this->timestamp(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('unisender_backup');
    }
}

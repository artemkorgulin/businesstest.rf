<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class m171123_054301_create_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'const_name' => $this->string(20)->notNull()->unique(),
            'title' => $this->string()->notNull(),
            'value' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}

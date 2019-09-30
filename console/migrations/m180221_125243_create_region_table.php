<?php

use yii\db\Migration;

/**
 * Handles the creation of table `region`.
 */
class m180221_125243_create_region_table extends Migration
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

        $this->createTable('{{%region}}', [
            'id'           => $this->primaryKey(),
            'parent_id'    => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'level_id'     => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'name'         => $this->string(255)->notNull(),
            'name_display' => $this->string(255)->notNull(),
            'is_visible'   => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('idx_region_parent',  '{{%region}}', 'parent_id');
        $this->createIndex('idx_region_level',   '{{%region}}', 'level_id');
        $this->createIndex('idx_region_visible', '{{%region}}', 'is_visible');

        $this->execute(file_get_contents(__DIR__ . '/dump/region.sql'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx_region_parent',  '{{%region}}');
        $this->dropIndex('idx_region_level',   '{{%region}}');
        $this->dropIndex('idx_region_visible', '{{%region}}');

        $this->dropTable('{{%region}}');
    }

}

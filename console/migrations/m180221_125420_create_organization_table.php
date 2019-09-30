<?php

use yii\db\Migration;

/**
 * Handles the creation of table `organization`.
 */
class m180221_125420_create_organization_table extends Migration
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

        $this->createTable('{{%organization%}}', [
            'id'       => $this->primaryKey(),
            'zip'      => $this->integer()->notNull(),
            'merge_id' => $this->integer()->notNull(),
            'type_id'  => $this->integer()->notNull()->defaultValue(1),
            'name'     => $this->string(255),
            'address'  => $this->string(255),
            'phone'    => $this->string(255),
            'url'      => $this->string(255),
        ], $tableOptions);

        $this->createIndex('idx_merge_id', '{{%organization}}', 'merge_id');

        $this->addForeignKey('idx_org2zip',
            '{{%organization%}}', 'zip',
            '{{%zip}}', 'zip',
            'RESTRICT'
        );

        $this->execute(file_get_contents(__DIR__ . '/dump/organization.sql'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx_merge_id', '{{%organization}}');
        $this->dropForeignKey('idx_org2zip', '{{%organization%}}');
        $this->dropTable('{{%organization}}');
    }

}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `zip`.
 */
class m180221_125330_create_zip_table extends Migration
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

        $this->createTable('{{%zip}}', [
            'id'        => $this->primaryKey(),
            'zip'       => $this->integer()->notNull()->unique(),
            'region_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey('idx_zip2region',
            '{{%zip}}', 'region_id',
            '{{%region}}', 'id',
            'RESTRICT'
        );

        $this->execute(file_get_contents(__DIR__ . '/dump/zip.sql'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('idx_zip2region', '{{%zip}}');
        $this->dropTable('{{%zip}}');
    }

}

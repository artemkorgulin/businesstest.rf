<?php

use yii\db\Migration;

/**
 * Handles the creation of table `business_scale_result`.
 */
class m180315_070411_create_business_scale_result_table extends Migration
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

       $this->createTable('{{%business_scale_result}}', [
            'id' => $this->primaryKey(),
            'scale_id' => $this->integer(),
            'pts_lo' => $this->integer()->notNull(),
            'pts_hi' => $this->integer()->notNull(),
            'content1' => $this->text(),
            'content2' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('fk_result2scale', '{{%business_scale_result}}', 'scale_id', '{{%business_scale}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_result2scale', '{{%business_scale_result}}');
        $this->dropTable('{{%business_scale_result}}');
    }
}

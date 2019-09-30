<?php

use yii\db\Migration;

/**
 * Handles the creation of table `business_scales`.
 */
class m180221_085022_create_business_scales_table extends Migration
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

        $this->createTable('{{%business_scale}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%business_scale_question}}', [
            'id'      => $this->primaryKey(),
            'scale_id' => $this->integer(),
            'name'    => $this->string()->notNull(),
            'pts_yes' => $this->integer()->notNull(),
            'pts_no' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_question2scale', '{{%business_scale_question}}', 'scale_id', '{{%business_scale}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_question2scale', '{{%business_scale_question}}');
        $this->dropTable('{{%business_scale_question}}');
        $this->dropTable('{{%business_scale}}');
    }
}

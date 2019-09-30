<?php

use yii\db\Migration;

/**
 * Handles the creation of table `business_pictured`.
 */
class m180221_071320_create_business_pictured_table extends Migration
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

        $this->createTable('{{%business_pictured}}', [
            'id' => $this->primaryKey(),
            'question_text' => $this->string()->notNull(),
            'variant1_text' => $this->string()->notNull(),
            'variant1_pict' => $this->string()->notNull(),
            'variant2_text' => $this->string()->notNull(),
            'variant2_pict' => $this->string()->notNull(),
            'variant3_text' => $this->string()->notNull(),
            'variant3_pict' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%business_pictured}}');
    }
}

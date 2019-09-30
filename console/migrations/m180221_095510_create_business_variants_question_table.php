<?php

use yii\db\Migration;

/**
 * Handles the creation of table `business_variants_question`.
 */
class m180221_095510_create_business_variants_question_table extends Migration
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

        $this->createTable('{{%business_variants_question}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->text()->notNull(),
            'picture' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%business_variants_answer}}', [
            'id'   => $this->primaryKey(),
            'question_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'is_correct' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_bv_answer2question', '{{%business_variants_answer}}',
            'question_id',
            '{{%business_variants_question}}',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_bv_answer2question', '{{%business_variants_answer}}');

        $this->dropTable('{{%business_variants_answer}}');
        $this->dropTable('{{%business_variants_question}}');
    }
}

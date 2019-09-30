<?php

use yii\db\Migration;

/**
 * Handles the creation of table `busines_aggregate`.
 */
class m180303_085120_create_busines_aggregate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%business_aggregate}}', [
            'id' => $this->primaryKey(),
            'result_id'   => $this->integer()->notNull(),
            'block_id'    => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'answer_id'   => $this->integer()->notNull()->defaultValue(0),
            'created_at'  => $this->integer(),
            'updated_at'  => $this->integer(),
        ]);

        $this->addForeignKey('fk_btAggregate', '{{%business_aggregate}}', 'result_id', '{{%business_result}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_btAggregate', '{{%business_aggregate}}');
        $this->dropTable('{{%business_aggregate}}');
    }
}

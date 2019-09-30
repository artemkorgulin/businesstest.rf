<?php

use yii\db\Migration;

/**
 * Class m180303_082508_add_business_variants_question_block_column
 */
class m180303_082508_add_business_variants_question_block_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%business_variants_question}}', 'block_id', $this->integer()->notNull()->defaultValue(1)->after('id'));
        $this->createIndex('idx_btVariantBlock', '{{%business_variants_question}}', 'block_id');
    }

    public function down()
    {
        $this->dropIndex('idx_btVariantBlock', '{{%business_variants_question}}');
        $this->dropColumn('{{%business_variants_question}}', 'block_id');
    }
}

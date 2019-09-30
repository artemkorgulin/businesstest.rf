<?php

use yii\db\Migration;

/**
 * Class m180315_082141_add_scale_comment
 */
class m180315_082141_add_scale_comment extends Migration
{

    public function up()
    {
        $this->addColumn('{{%business_scale}}', 'comment', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%business_scale}}', 'comment');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m180416_090832_add_partner_column
 */
class m180416_090832_add_partner_column extends Migration
{

    public function up()
    {
        $this->addColumn('{{%organization%}}', 'partner', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{%organization%}}', 'partner');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m180412_083754_add_scale_result
 */
class m180412_083754_add_scale_result extends Migration
{
    public function up()
    {
        $this->addColumn('{{%business_scale}}', 'result_hi', $this->text());
        $this->addColumn('{{%business_scale}}', 'result_me', $this->text());
        $this->addColumn('{{%business_scale}}', 'result_lo', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%business_scale}}', 'result_hi');
        $this->dropColumn('{{%business_scale}}', 'result_me');
        $this->dropColumn('{{%business_scale}}', 'result_lo');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m180315_092031_add_pictured_results
 */
class m180315_092031_add_pictured_results extends Migration
{

    public function up()
    {
        $this->addColumn('{{%business_pictured}}', 'variant1_result', $this->text());
        $this->addColumn('{{%business_pictured}}', 'variant2_result', $this->text());
        $this->addColumn('{{%business_pictured}}', 'variant3_result', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%business_pictured}}', 'variant1_result');
        $this->dropColumn('{{%business_pictured}}', 'variant2_result');
        $this->dropColumn('{{%business_pictured}}', 'variant3_result');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m180222_070656_remove_user_fields_to_profile
 */
class m180222_070656_remove_user_fields_to_profile extends Migration
{
    public function up()
    {
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'name_last');
        $this->dropColumn('user', 'name_first');
    }

    public function down()
    {
        $this->addColumn('user', 'phone', $this->string());
        $this->addColumn('user', 'name_last', $this->string());
        $this->addColumn('user', 'name_first', $this->string());
    }

}

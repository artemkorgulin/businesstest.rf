<?php

use yii\db\Migration;

/**
 * Class m180222_065739_add_testing_tokens
 */
class m180222_065739_add_testing_tokens extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'token_proftest', $this->string());
        $this->addColumn('{{%user}}', 'is_proftest_active', $this->integer()->defaultValue(0));
        $this->addColumn('{{%user}}', 'token_fgtest',   $this->string());
        $this->addColumn('{{%user}}', 'is_fgtest_active', $this->integer()->defaultValue(0));
        $this->addColumn('{{%user}}', 'token_btest',   $this->string());
        $this->addColumn('{{%user}}', 'is_btest_active', $this->integer()->defaultValue(0));

        $this->addColumn('unisender_backup', 'VAR_RECOVERY_PT', $this->string());
        $this->addColumn('unisender_backup', 'VAR_RECOVERY_FG', $this->string());
        $this->addColumn('unisender_backup', 'VAR_RECOVERY_BT', $this->string());
        $this->addColumn('unisender_backup', 'VAR_RECOVERY_CODE', $this->string());

    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'token_proftest');
        $this->dropColumn('{{%user}}', 'is_proftest_active');
        $this->dropColumn('{{%user}}', 'token_fgtest');
        $this->dropColumn('{{%user}}', 'is_fgtest_active');
        $this->dropColumn('{{%user}}', 'token_btest');
        $this->dropColumn('{{%user}}', 'is_btest_active');

        $this->dropColumn('unisender_backup', 'VAR_RECOVERY_PT');
        $this->dropColumn('unisender_backup', 'VAR_RECOVERY_FG');
        $this->dropColumn('unisender_backup', 'VAR_RECOVERY_BT');
        $this->dropColumn('unisender_backup', 'VAR_RECOVERY_CODE');

    }

}

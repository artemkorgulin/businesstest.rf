<?php

use yii\db\Migration;

/**
 * Class m171123_105453_add_default_settings
 */
class m171123_105453_add_default_settings extends Migration
{
    public function up()
    {
        $settings = new \common\modules\settings\common\models\SettingsValues();

        if (!isset($settings->frontend_visibility)) {
            $s = new \common\modules\settings\common\models\Settings([
                'const_name' => 'frontend_visibility',
                'title' => 'Общий доступ к frontend приложению',
                'value' => 'open',
            ]);
            $s->save();
        }

        if (!isset($settings->frontend_block_mess)) {
            $s = new \common\modules\settings\common\models\Settings([
                'const_name' => 'frontend_block_mess',
                'title' => 'Сообщение на экране блокировки',
                'value' => 'Our Team Have Been Working On Something Amazing <br/>We Will Be Back Soon.',
            ]);
            $s->save();
        }

        if (!isset($settings->frontend_block_date)) {
            $s = new \common\modules\settings\common\models\Settings([
                'const_name' => 'frontend_block_date',
                'title' => 'Дата для обратного отсчета',
                'value' => date('Y-m-d h:i:s'),
            ]);
            $s->save();
        }
    }

    public function down()
    {
        echo "m171123_105453_add_default_settings cannot be reverted.\n";
        return false;
    }
}

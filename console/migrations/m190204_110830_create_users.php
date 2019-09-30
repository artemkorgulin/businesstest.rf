<?php

use yii\db\Migration;

/**
 * Class m190204_110830_create_users
 */
class m190204_110830_create_users extends Migration
{

    public function up()
    {
        $this->execute(file_get_contents(__DIR__ . '/dump/users.sql'));
        $this->execute(file_get_contents(__DIR__ . '/dump/users_profile.sql'));
        $this->execute(file_get_contents(__DIR__ . '/dump/auth_assigment.sql'));
    }

    public function down()
    {

        echo "m190204_110830_create_users cannot be reverted.\n";
        $params = ['id' => 1];
        Yii::$app->db->createCommand('DELETE FROM users WHERE id=:id', $params)->execute();
        Yii::$app->db->createCommand('DELETE FROM user_profile WHERE user_id=:id', $params)->execute();
        Yii::$app->db->createCommand('DELETE FROM auth_assignment WHERE user_id=:id', $params)->execute();

        return false;
    }
}

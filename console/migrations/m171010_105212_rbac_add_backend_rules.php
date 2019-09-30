<?php
use yii\db\Migration;

class m171010_105212_rbac_add_backend_rules extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $role= Yii::$app->authManager->createRole('backend-user');
        $role->description = 'Администратор';
        Yii::$app->authManager->add($role);

        $role= Yii::$app->authManager->createRole('access-admin');
        $role->description = 'Администратор доступа';
        Yii::$app->authManager->add($role);

        $role= Yii::$app->authManager->createRole('developer');
        $role->description = 'Разработчик';
        Yii::$app->authManager->add($role);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m171003_105212_rbac_add_backend_rules cannot be reverted.\n";
        return false;
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_profile`.
 */
class m180221_125421_create_user_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name_l' => $this->string()->notNull(),
            'name_f' => $this->string()->notNull(),
            'name_m' => $this->string(),
            'phone'  => $this->string()->notNull(),
            'school_id' => $this->integer()->notNull(),
            'class_id'  => $this->integer()->notNull(),
            'b_date'    => $this->date()->notNull(),
            'gender_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey('idx_profile2user',
            '{{%user_profile}}', 'user_id',
            '{{%user}}', 'id',
            'RESTRICT'
        );

        $this->addForeignKey('idx_profile2school',
            '{{%user_profile}}', 'school_id',
            '{{%organization}}', 'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('idx_profile2user',   '{{%user_profile}}');
        $this->dropForeignKey('idx_profile2school', '{{%user_profile}}');

        $this->dropTable('{{%user_profile}}');
    }
}

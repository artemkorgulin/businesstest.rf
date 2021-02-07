<?php

use yii\db\Migration;

class m170626_175738_tree_menu_json extends Migration
{
    public function up()
    {
        $this->createTable('tree_menu_json', [
            'id' => $this->primaryKey(),
            'name'      => $this->string(500),
            'url'      => $this->string(500),
            'parent'  => $this->integer(1),
            'parent_id'  => $this->integer(1),
            'depth'  => $this->integer(1)
         ]);

        $this->insertData();
    }

    public function insertData() {
        $arr = [
            [
                'name' => 'Игры', 'parent' => 1, 'parent_id' => 0, 'depth' => 0
            ],
            [
                'name' => 'Playstation', 'parent' => 1, 'parent_id' => 1, 'depth' => 1
            ],
            [
                'name' => 'Консоли', 'parent' => 0, 'parent_id' => 2, 'depth' => 2
            ],
            [
                'name' => 'Игровая валюта', 'parent' => 0, 'parent_id' => 2, 'depth' => 2
            ],
            [
                'name' => 'Xbox', 'parent' => 0, 'parent_id' => 1, 'depth' => 1
            ],
            [
                'name' => 'Консоли', 'parent' => 0, 'parent_id' => 5, 'depth' => 2
            ],
            [
                'name' => 'Подписки', 'parent' => 0, 'parent_id' => 5, 'depth' => 2
            ],
            [
                'name' => 'Софт', 'parent' => 1, 'parent_id' => 0, 'depth' => 0
            ]
        ];

        foreach ($arr as $a) {
            $this->insert('tree_menu_json', [
                'name'      => $a['name'],
                'url'      => '#'.$a['name'],
                'parent'  => $a['parent'],
                'parent_id'  => $a['parent_id'],
                'depth'  => $a['depth']
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('tree_menu_json');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

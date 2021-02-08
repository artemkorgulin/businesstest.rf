<?php
namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Дерево разделов
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $parent
 * @property string $parent_id
 *
 */
class TreeMenuJson extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree_menu_json';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'name menu',
            'url' => 'url menu',
            'parent' => 'parent flag',
            'parent_id' => 'parent id',
            'depth' => 'depth level'
        ];
    }

    public function scopes()
    {
        return array(
            'depth'=>array(
                'order'=>'name column'
            ),
        );
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        $items = static::find([])->orderBy(['depth' => SORT_ASC])->all();
        foreach ($items as $item)
        {
            $all[$item->parent_id][] = array("id" => $item->id, "name"=> $item->name, "url"=> $item->url, "parent_id" => $item->parent_id);
        }
        return $all;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getParentId()
    {
        return static::findOne(['parent_id' => $this->id]);
    }

    public function remove($parent_id)
    {
        static::deleteAll([
            ['in', 'id', $parent_id]
        ]);
        return true;
    }

    public function edit($id,$parent_id,$name)
    {
        return static::update([
            'name' => $name,
            'id' => $id,
            'parent_id' => $parent_id
        ]);
    }

    public function add($id,$parent_id,$name,$url)
    {
        return static::insert(false,[
            'id' => $id,
            'parent_id' => $parent_id,
            'name' => $name,
            'url' => $url
        ]);
    }
}

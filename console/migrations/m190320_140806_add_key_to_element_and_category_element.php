<?php

use yii\db\Migration;

/**
 * Class m190320_140806_add
 */
class m190320_140806_add_key_to_element_and_category_element extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('element_cat_id','element','cat_id');
        $this->createIndex('element_sort','element','sort');
        $this->createIndex('element_category_sort','element_category','sort');
        $this->addForeignKey('element_category_to_element','element','cat_id','element_category','id','SET NULL','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('element_cat_id','element');
        $this->dropIndex('element_sort','element');
        $this->dropIndex('element_category_sort','element_category');
        $this->dropForeignKey('element_category_to_element','element');
        return true;
    }
}

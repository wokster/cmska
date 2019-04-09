<?php

use yii\db\Migration;

/**
 * Class m190320_140512_create_table_element_category
 */
class m190320_140512_create_table_element_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%element_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull()->unique(),
            'sort' => $this->tinyInteger(2)->defaultValue(50),
        ], $tableOptions);

        

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%element_category}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_140512_create_table_element_category cannot be reverted.\n";

        return false;
    }
    */
}

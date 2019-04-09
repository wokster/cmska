<?php

use yii\db\Migration;

/**
 * Class m190315_114421_create_table_for_elements
 */
class m190315_114421_create_table_for_elements extends Migration
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

        $this->createTable('{{%element}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(50)->notNull()->unique(),
            'cat_id' => $this->integer(),
            'title' => $this->string(255)->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'type' => $this->tinyInteger(2)->defaultValue(0),
            'sort' => $this->tinyInteger(2)->defaultValue(50),
            'only_webmaster' => $this->boolean()->defaultValue(false),
            'value' => $this->text()->null(),
            ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%element}}');

        return true;
    }
}

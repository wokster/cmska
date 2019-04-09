<?php

use yii\db\Migration;

/**
 * Class m190327_134929_create_template
 */
class m190327_134929_create_template extends Migration
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
        $this->createTable('{{%template}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'updated_at' => $this->integer(11),
            'comment' => $this->string(500),
            'version' => $this->string(255),
            'css' => 'MEDIUMTEXT',
            'html' => 'MEDIUMTEXT',
            'js' => 'MEDIUMTEXT'
        ], $tableOptions);
        $this->createIndex('template_name_version','template',['name','version'],true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%template}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190327_134929_create_template cannot be reverted.\n";

        return false;
    }
    */
}

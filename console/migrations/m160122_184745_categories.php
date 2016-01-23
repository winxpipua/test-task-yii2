<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_184745_categories extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%categories}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'position' => Schema::TYPE_INTEGER,
            'publish' => Schema::TYPE_INTEGER,
            'create_date' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'update_date' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%categories}}');
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

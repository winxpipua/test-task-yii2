<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_184759_products extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%products}}', [
            'id' => Schema::TYPE_PK,
            'cat_id' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'position' => Schema::TYPE_INTEGER,
            'publish' => Schema::TYPE_INTEGER,
            'create_date' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'update_date' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ], $tableOptions);
 
        $this->createIndex('FK_products_categories', '{{%products}}', 'cat_id');
        $this->addForeignKey(
            'FK_products_categories', '{{%products}}', 'cat_id', '{{%categories}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%products}}');
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

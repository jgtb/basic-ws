<?php

use yii\db\Schema;
use yii\db\Migration;

class m170906_045747_createTableTag extends Migration {

    public function up() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%tag}}', [
            'tag_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'description' => Schema::TYPE_STRING . '(225) NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
                ], $tableOptions);
        $this->createIndex('idx-tag-user_id', 'tag', 'user_id');
        $this->addForeignKey('fk-tag-user_id', 'tag', 'user_id', 'user', 'user_id');
    }

    public function down() {
        $this->dropTable('tag');
    }

}

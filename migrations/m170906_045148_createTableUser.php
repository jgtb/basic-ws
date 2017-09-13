<?php

use yii\db\Schema;
use yii\db\Migration;

class m170906_045148_createTableUser extends Migration {
    
    public function up() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%user}}', [
            'user_id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . '(225) NOT NULL',
            'email' => Schema::TYPE_STRING . '(225) NOT NULL',
            'password' => Schema::TYPE_STRING . '(45) NOT NULL',
            'img' => Schema::TYPE_STRING . '(225) NULL',
            'hash' => Schema::TYPE_STRING . '(225) NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
                ], $tableOptions);
    }

    public function down() {
        $this->dropTable('user');
    }
    
}

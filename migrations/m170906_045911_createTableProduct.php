<?php

use yii\db\Schema;
use yii\db\Migration;

class m170906_045911_createTableProduct extends Migration {

    public function up() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%product}}', [
            'product_id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'description' => Schema::TYPE_STRING . '(225) NOT NULL',
            'price' => Schema::TYPE_DOUBLE . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . ' NOT NULL',
            'img' => Schema::TYPE_STRING . '(225) NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
                ], $tableOptions);
        $this->createIndex('idx-product-category_id', 'product', 'category_id');
        $this->addForeignKey('fk-product-category_id', 'product', 'category_id', 'category', 'category_id');
    }

    public function down() {
        $this->dropTable('product');
    }

}

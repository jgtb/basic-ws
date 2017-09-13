<?php

use yii\db\Schema;
use yii\db\Migration;

class m170906_051219_createTableProductTag extends Migration {

    public function up() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%product_tag}}', [
            'product_tag_id' => Schema::TYPE_PK,
            'product_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tag_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                ], $tableOptions);
        $this->createIndex('idx-product_tag-product_id', 'product_tag', 'product_id');
        $this->addForeignKey('fk-product_tag-product_id', 'product_tag', 'product_id', 'product', 'product_id');

        $this->createIndex('idx-product_tag-tag_id', 'product_tag', 'tag_id');
        $this->addForeignKey('fk-product_tag-tag_id', 'product_tag', 'tag_id', 'tag', 'tag_id');
    }

    public function down() {
        $this->dropTable('product_tag');
    }

}

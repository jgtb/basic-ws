<?php

namespace app\models;

use Yii;

class ProductTag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product_tag';
    }

    public function rules()
    {
        return [
            [['product_id', 'tag_id'], 'required'],
            [['product_id', 'tag_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'tag_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'product_tag_id' => 'Product Tag ID',
            'product_id' => 'Product ID',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['tag_id' => 'tag_id']);
    }
}

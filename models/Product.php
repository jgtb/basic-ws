<?php

namespace app\models;

use Yii;

class Product extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['category_id', 'description', 'price', 'quantity', 'status'], 'required'],
            [['category_id', 'quantity', 'status'], 'integer'],
            [['price'], 'number'],
            [['description', 'img'], 'string', 'max' => 225],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'img' => 'Img',
            'status' => 'Status',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['product_id' => 'product_id']);
    }
}

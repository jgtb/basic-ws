<?php

namespace app\models;

use Yii;

class Category extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['user_id', 'description', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['description'], 'string', 'max' => 225],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'category_id']);
    }
}

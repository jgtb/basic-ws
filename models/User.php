<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'user';
    }

    public function rules() {
        return [
                [['username', 'email', 'password', 'status'], 'required'],
                [['status'], 'integer'],
                [['username', 'email', 'img', 'hash'], 'string', 'max' => 225],
                [['password'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels() {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'img' => 'Img',
            'hash' => 'Hash',
            'status' => 'Status',
        ];
    }

    public function getCategories() {
        return $this->hasMany(Category::className(), ['user_id' => 'user_id']);
    }

    public function getTags() {
        return $this->hasMany(Tag::className(), ['user_id' => 'user_id']);
    }

}

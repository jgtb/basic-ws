<?php

namespace app\models;

use Yii;

class Tag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tag';
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
            'tag_id' => 'Tag ID',
            'user_id' => 'User ID',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['tag_id' => 'tag_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}

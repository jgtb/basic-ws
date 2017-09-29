<?php

namespace app\models;

use Yii;

class Checklist extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'checklist';
    }

    public function rules()
    {
        return [
            [['user_id', 'description', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'checklist_id' => 'Checklist ID',
            'user_id' => 'User ID',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    public function getChecklistProducts()
    {
        return $this->hasMany(ChecklistProduct::className(), ['checklist_id' => 'checklist_id']);
    }
}

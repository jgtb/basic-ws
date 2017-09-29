<?php

namespace app\models;

use Yii;

class ChecklistProduct extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'checklist_product';
    }

    public function rules()
    {
        return [
            [['checklist_id', 'product_id'], 'required'],
            [['checklist_id', 'product_id'], 'integer'],
            [['checklist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checklist::className(), 'targetAttribute' => ['checklist_id' => 'checklist_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'checklist_product_id' => 'Checklist Product ID',
            'checklist_id' => 'Checklist ID',
            'product_id' => 'Product ID',
        ];
    }

    public function getChecklist()
    {
        return $this->hasOne(Checklist::className(), ['checklist_id' => 'checklist_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}

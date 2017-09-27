<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductTag;

class ProductController extends BaseController {

    public function actionIndex($id) {
        $models = Product::find()
                ->where(['category.user_id' => $id, 'product.status' => 1])
                ->joinWith('category')
                ->joinWith(['productTags' => function($query) {
                        $query->joinWith('tag')
                        ->orderBy(['tag.description' => SORT_ASC]);
                    }])
                ->orderBy(['category.description' => SORT_ASC, 'product.description' => SORT_ASC])
                ->asArray()
                ->all();

        if ($models)
            return $models;

        return [];
    }

    public function actionView($id) {
        $model = Product::find()->where(['product.product_id' => $id])
                ->joinWith('category')
                ->joinWith(['productTags' => function($query) {
                        $query->joinWith('tag')
                        ->orderBy(['tag.description' => SORT_ASC]);
                    }])
                ->asArray()
                ->one();

        if ($model)
            return $model;

        return [];
    }

    public function actionCreate() {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = new Product();
        $model->category_id = $data['category_id'];
        $model->description = $data['description'];
        $model->price = $data['price'];
        $model->quantity = $data['quantity'];
        $model->img = rand(1, 50) . '.png';
        $model->status = 1;

        if ($model->save()) {
            foreach ($data['productTags'] as $tagID) {
                $modelProductTag = new ProductTag();
                $modelProductTag->product_id = $model->product_id;
                $modelProductTag->tag_id = $tagID;
                $modelProductTag->save();
            }
            return true;
        }

        return false;
    }

    public function actionUpdate($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = $this->findModel($id)->one();
        $model->category_id = $data['category_id'];
        $model->description = $data['description'];
        $model->price = $data['price'];
        $model->quantity = $data['quantity'];
        $model->img = rand(1, 50) . '.png';;

        if ($model->save()) {
            ProductTag::deleteAll(['product_id' => $model->product_id]);

            foreach ($data['productTags'] as $tagID) {
                $modelProductTag = new ProductTag();
                $modelProductTag->product_id = $model->product_id;
                $modelProductTag->tag_id = $tagID;
                $modelProductTag->save();
            }
            return true;
        }

        return false;
    }

    public function actionDelete($id) {
        $model = $this->findModel($id)->one();
        $model->status = 0;

        if ($model->save())
            return true;

        return false;
    }

    protected function findModel($id) {
        if (($model = Product::find()->where(['product_id' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

}

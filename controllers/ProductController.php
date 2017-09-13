<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductTag;

class ProductController extends BaseController {

    public function actionIndex($id) {
        header("Access-Control-Allow-Origin: *");

        $models = Product::find()
                ->where(['category.user_id' => $id, 'product.status' => 1])
                ->joinWith('category')
                ->joinWith(['productTags' => function($query) {
                        $query->select('product_tag.product_id, product_tag.tag_id, tag.description as tag_description')
                        ->leftJoin('tag', 'product_tag.tag_id = tag.tag_id')
                        ->orderBy(['tag.description' => SORT_ASC]);
                    }])
                ->orderBy(['category.description' => SORT_ASC, 'product.description' => SORT_ASC])
                ->asArray()
                ->all();

        if ($models)
            return $models;

        return 0;
    }

    public function actionView($id) {
        header("Access-Control-Allow-Origin: *");

        $model = Product::find()->where(['product.product_id' => $id])
                ->joinWith('category')
                ->joinWith(['productTags' => function($query) {
                        $query->select('product_tag.product_id, product_tag.tag_id, tag.description as tag_description')
                        ->leftJoin('tag', 'product_tag.tag_id = tag.tag_id')
                        ->orderBy(['tag.description' => SORT_ASC]);
                    }])
                ->asArray()
                ->one();

        if ($model)
            return $model;

        return 0;
    }

    public function actionCreate() {
        header("Access-Control-Allow-Origin: *");

        $data = json_decode(file_get_contents('php://input'), true);

        $model = new Product();
        $model->category_id = $data['category_id'];
        $model->description = $data['description'];
        $model->price = $data['price'];
        $model->quantity = $data['quantity'];
        $model->img = $data['img'];
        $model->status = 1;

        if ($model->save()) {
            foreach ($data['productTags'] as $tagID) {
                $modelProductTag = new ProductTag();
                $modelProductTag->product_id = $model->product_id;
                $modelProductTag->tag_id = $tagID;
                $modelProductTag->save();
            }
            return 1;
        }

        return 0;
    }

    public function actionUpdate($id) {
        header("Access-Control-Allow-Origin: *");

        $data = json_decode(file_get_contents('php://input'), true);

        $model = $this->findModel($id)->one();
        $model->category_id = $data['category_id'];
        $model->description = $data['description'];
        $model->price = $data['price'];
        $model->quantity = $data['quantity'];
        $model->img = $data['img'];

        if ($model->save()) {
            ProductTag::deleteAll(['product_id' => $model->product_id]);

            foreach ($data['productTags'] as $tagID) {
                $modelProductTag = new ProductTag();
                $modelProductTag->product_id = $model->product_id;
                $modelProductTag->tag_id = $tagID;
                $modelProductTag->save();
            }
            return 1;
        }

        return 0;
    }

    public function actionDelete($id) {
        header("Access-Control-Allow-Origin: *");

        $model = $this->findModel($id)->one();
        $model->status = 0;

        if ($model->save())
            return 1;

        return 0;
    }

    protected function findModel($id) {
        if (($model = Product::find()->where(['product_id' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

}

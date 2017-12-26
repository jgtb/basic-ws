<?php

namespace app\controllers;

use Yii;
use app\models\Checklist;
use app\models\ChecklistProduct;

class ChecklistController extends BaseController {

    public function actionIndex($id) {
        $models = Checklist::find()
                ->where(['user.user_id' => $id, 'checklist.status' => 1])
                ->joinWith('user')
                ->joinWith(['checklistProducts' => function($query) {
                        $query->joinWith('product')
                        ->orderBy(['product.description' => SORT_ASC]);
                    }])
                ->orderBy(['checklist.description' => SORT_ASC])
                ->asArray()
                ->all();

        if ($models)
            return $models;

        return [];
    }

    public function actionView($id) {
        $model = Checklist::find()->where(['checklist.checklist_id' => $id])
                ->joinWith(['checklistProducts' => function($query) {
                          $query->joinWith('product')
                        ->orderBy(['product.description' => SORT_ASC]);
                    }])
                ->asArray()
                ->one();

        if ($model)
            return $model;

        return [];
    }

    public function actionCreate($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = new Checklist();
        $model->user_id = $id;
        $model->description = $data['description'];
        $model->status = 1;

        if ($model->save()) {
            foreach ($data['productTags'] as $modelProduct) {
                $modelChecklistProduct = new ChecklistProduct();
                $modelChecklistProduct->checklist_id = $model->checklist_id;
                $modelChecklistProduct->product_id = $modelProduct['product_id'];
                $modelChecklistProduct->save();
            }
            return true;
        }

        return false;
    }

    public function actionUpdate($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = $this->findModel($id)->one();
        $model->description = $data['description'];
        $model->status = 1;

        if ($model->save()) {
            ChecklistProduct::deleteAll(['checklist_id' => $model->checklist_id]);

            foreach ($data['productTags'] as $modelProduct) {
                $modelChecklistProduct = new ChecklistProduct();
                $modelChecklistProduct->checklist_id = $model->checklist_id;
                $modelChecklistProduct->product_id = $modelProduct['product_id'];
                $modelChecklistProduct->save();
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
        if (($model = Checklist::find()->where(['checklist_id' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

}

<?php

namespace app\controllers;

use Yii;
use app\models\Tag;

class TagController extends BaseController {

    public function actionIndex($id) {
        $models = Tag::find()
                ->where(['user_id' => $id, 'status' => 1])
                ->orderBy(['description' => SORT_ASC])
                ->asArray()
                ->all();

        if ($models)
            return $models;

        return [];
    }

    public function actionView($id) {
        $model = $this->findModel($id)
                ->asArray()
                ->one();

        if ($model)
            return $model;

        return [];
    }

    public function actionCreate($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = new Tag();
        $model->user_id = $id;
        $model->description = $data['description'];
        $model->status = 1;

        if ($model->save())
            return true;

        return false;
    }

    public function actionUpdate($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = $this->findModel($id)->one();
        $model->description = $data['description'];

        if ($model->save())
            return true;

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
        if (($model = Tag::find()->where(['tag_id' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

}

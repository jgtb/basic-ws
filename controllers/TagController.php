<?php

namespace app\controllers;

use Yii;
use app\models\Tag;

class TagController extends BaseController {

    public function actionIndex($id) {
        header("Access-Control-Allow-Origin: *");

        $models = Tag::find()
                ->where(['user_id' => $id, 'status' => 1])
                ->orderBy(['description' => SORT_ASC])
                ->asArray()
                ->all();

        if ($models)
            return $models;

        return 0;
    }

    public function actionView($id) {
        header("Access-Control-Allow-Origin: *");

        $model = $this->findModel($id)
                ->asArray()
                ->one();

        if ($model)
            return $model;

        return 0;
    }

    public function actionCreate($id) {
        header("Access-Control-Allow-Origin: *");

        $data = json_decode(file_get_contents('php://input'), true);

        $model = new Tag();
        $model->user_id = $id;
        $model->description = $data['description'];
        $model->status = 1;

        if ($model->save())
            return 1;

        return 0;
    }

    public function actionUpdate($id) {
        header("Access-Control-Allow-Origin: *");

        $data = json_decode(file_get_contents('php://input'), true);

        $model = $this->findModel($id)->one();
        $model->description = $data['description'];

        if ($model->save())
            return 1;

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
        if (($model = Tag::find()->where(['tag_id' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

}

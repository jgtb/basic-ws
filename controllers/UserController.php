<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends BaseController {

    public function actionView($id) {
        $model = $this->findModel($id)
                ->asArray()
                ->one();

        if ($model)
            return $model;

        return [];
    }

    public function actionCreate() {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = new User();
        $model->username = $data['username'];
        $model->email = $data['email'];
        $model->password = sha1($data['password']);
        $model->img = $data['img'];
        $model->hash = md5($model->username);
        $model->status = 1;

        if ($model->save())
            return true;

        return false;
    }

    public function actionUpdate($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = $this->findModel($id)->one();
        $model->username = $data['username'];
        $model->email = $data['email'];

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
        if (($model = User::find()->where(['user_id' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

}

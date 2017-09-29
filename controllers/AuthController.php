<?php

namespace app\controllers;

use Yii;
use app\models\User;

class AuthController extends BaseController {

    public function actionLogin() {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = User::find()
          ->where(['email' => $data['email'], 'password' => sha1($data['password']), 'status' => 1])
          ->asArray()
          ->one();

        if ($model)
            return $model;

        return false;
    }

    public function actionRegister() {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = new User();
        $model->username = $data['username'];
        $model->email = $data['email'];
        $model->password = $data['password'];
        $model->img = 'face' . rand(1, 5) . '.jpg';
        $model->status = 1;

        if ($model->save())
            return 1;

        return false;
    }

    public function actionForgotPassword() {

    }

}

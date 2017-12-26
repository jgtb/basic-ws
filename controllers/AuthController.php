<?php

namespace app\controllers;

use Yii;
use app\models\User;

class AuthController extends BaseController {

    public function actionLogin() {
        $data = json_decode(file_get_contents('php://input'), true);

        $email = $data['email'];
        $password = sha1($data['password']);

        $model = User::find()
          ->where(['email' => $email, 'password' => $password, 'status' => 1])
          ->asArray()
          ->one();

        if ($model)
            return $model;

        return false;
    }

    public function actionRegister() {
        $data = json_decode(file_get_contents('php://input'), true);

        $username = $data['username'];
        $email = $data['email'];
        $password = sha1($data['password']);
        $img = 'face' . rand(1, 5) . '.jpg';

        $model = new User();
        $model->username = $username;
        $model->email = $email;
        $model->password = $password;
        $model->img = $img;
        $model->status = 1;

        if ($model->save())
            return true;

        return false;
    }

    public function actionForgotPassword() {

    }

}

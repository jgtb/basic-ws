<?php

namespace app\controllers;

use Yii;
use app\models\User;

class LoginController extends BaseController {

    public function actionLogin() {
        header("Access-Control-Allow-Origin: *");

        $data = json_decode(file_get_contents('php://input'), true);

        $email = $data['email'];
        $password = $data['password'];

        $model = User::find()->where(['email' => $email, 'password' => sha1($password), 'status' => 1])->asArray()->one();

        if ($model)
            return $model;

        return 0;
    }

}

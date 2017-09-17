<?php

namespace app\controllers;

use Yii;
use yii\filters\Cors;
use app\models\User;

class AuthController extends BaseController {

    public function behaviors() {
        return [
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    //'Access-Control-Request-Method' => ['POST', 'GET'],
                    //'Access-Control-Request-Headers' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept'],
                ],
            ],
        ];
    }

    public function actionLogin() {
        $data = json_decode(file_get_contents('php://input'), true);

        $model = User::find()->where(['email' => $data['email'], 'password' => sha1($data['password']), 'status' => 1])->asArray()->one();

        if ($model)
            return $model;

        return 0;
    }

    public function actionRegister() {
        header("Access-Control-Allow-Origin: *");

        $data = json_decode(file_get_contents('php://input'), true);

        $model = new User();
        $model->username = $data['username'];
        $model->email = $data['email'];
        $model->password = $data['password'];
        $model->status = 1;

        if ($model->save())
            return 1;

        return 0;
    }

    public function actionForgotPassword() {
        
    }

}

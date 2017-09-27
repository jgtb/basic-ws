<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller {

    public function init() {
        parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->enableCsrfValidation = false;
    }

    public function behaviors() {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['*']
                ],
            ],
        ];
    }

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        return ["message" => $exception->getMessage()];
    }

    public function checkParms($arr = []) {
        if ($arr) {
            foreach ($arr as $v) {
                if (!Yii::$app->request->post($v)) {
                    throw new \yii\web\HttpException(400, "Missing parameters-{$v}");
                }
            }
        }
    }

}

<?php namespace app\components;

use Yii;
use yii\base\Component;

class Tool extends Component {

    public function isJson($string) {
        $array = json_decode($string, true);
        return !empty($string) && is_string($string) && is_array($array) && !empty($array) && json_last_error() == 0;
    }

}

?>